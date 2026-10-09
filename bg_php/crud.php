<?php
/*
 * crud.php — 6 張資料表共用的新增／修改／刪除邏輯
 *
 * 原本 bg_php/<表>/ 底下的 insert_、update_、delete_ 共 18 個檔案幾乎一模一樣，
 * 只差在表名與欄位。改成在 $CRUD_TABLES 描述每張表，再由 crud_handle() 依設定組出 SQL。
 *
 * 表單欄位命名規則（與原本頁面相同）：
 *   - 每個欄位的 POST 名稱是欄位名稱轉小寫，例如 Class_name → class_name
 *   - 修改時用來找出原資料的 key 欄位，POST 名稱再加上 "1"，例如 name1、award1
 * 表名與欄位名稱只來自下面固定的設定，使用者輸入一律經 db_run() 以 ? 綁定。
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../db.php';

$CRUD_TABLES = [
    //  網址上的名稱 => [資料表, 所有欄位, 用來識別一筆資料的 key 欄位]
    'award'      => ['AWARD',      ['Year', 'Name', 'Uint', 'Date', 'Award', 'Type'],                          ['Name', 'Award']],
    'book'       => ['BOOK',       ['Name', 'Press', 'Type', 'Nation', 'Date', 'Teacher'],                     ['Name', 'Type']],
    'experience' => ['EXPERIENCE', ['Department', 'Position', 'Type'],                                         ['Position', 'Department']],
    'paper'      => ['PAPER',      ['Name', 'Teacher', 'Date', 'Page', 'Source', 'Type', 'Num', 'Place'],      ['Name']],
    'plan'       => ['PLAN',       ['Name', 'Role', 'Date', 'Number', 'Type'],                                 ['Name']],
    'time'       => ['TIME',       ['Day', 'Class', 'Class_name'],                                             ['Day', 'Class']],
];

/** 取得 POST 欄位值；沒填時為空字串 */
function crud_post(string $field, string $suffix = ''): string
{
    return (string) ($_POST[strtolower($field) . $suffix] ?? '');
}

/**
 * 依動作組出 SQL 與參數。
 *   insert：INSERT INTO 表 (所有欄位) VALUES (?, ...)
 *   update：UPDATE 表 SET 欄位=?, ... WHERE key=? AND ...（key 的值來自 xxx1 欄位）
 *   delete：DELETE FROM 表 WHERE key=? AND ...
 */
function crud_build(string $action, array $def): array
{
    [$table, $columns, $keys] = $def;
    $where = implode(' AND ', array_map(fn($k) => "$k=?", $keys));

    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES ("
                 . implode(', ', array_fill(0, count($columns), '?')) . ")";
            $params = array_map('crud_post', $columns);
            break;
        case 'update':
            $sql = "UPDATE $table SET " . implode(', ', array_map(fn($c) => "$c=?", $columns)) . " WHERE $where";
            $params = array_merge(array_map('crud_post', $columns),
                                  array_map(fn($k) => crud_post($k, '1'), $keys));
            break;
        case 'delete':
            $sql = "DELETE FROM $table WHERE $where";
            $params = array_map('crud_post', $keys);
            break;
        default:
            throw new InvalidArgumentException("unknown action: $action");
    }
    return [$sql, $params];
}

/** 處理表單送出：執行 SQL，成功後回到該表的維護頁 bg_<名稱>.php，失敗則顯示錯誤 */
function crud_handle(string $name, string $action): void
{
    global $CRUD_TABLES;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: bg_$name.php");
        exit;
    }

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    try {
        [$sql, $params] = crud_build($action, $CRUD_TABLES[$name]);
        db_run($link, $sql, $params);
        header("Location: bg_$name.php");
    } catch (Exception $e) {
        echo "操作失敗：" . h($e->getMessage()) . "<br>";
        echo "<a href=\"bg_$name.php\">返回</a>";
    }
    mysqli_close($link);
}
