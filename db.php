<?php
/*
 * db.php — 共用的資料庫存取函式（prepared statement）
 *
 * 原本各頁面用 mysqli_real_escape_string 跳脫後把變數直接拼進 SQL 字串；
 * 改成 SQL 只寫 ? 佔位符，使用者輸入透過 bind_param 另外傳給資料庫，
 * 資料永遠不會被當成 SQL 語法解析，從根本避免 SQL injection。
 */

/**
 * 執行一條帶參數的 SQL。
 *
 * @param mysqli $link   資料庫連線
 * @param string $sql    含 ? 佔位符的 SQL，例如 "DELETE FROM PAPER WHERE Name = ?"
 * @param array  $params 依序對應每個 ? 的值（全部以字串型別 's' 綁定，與原本欄位皆為文字一致）
 * @return mysqli_result|bool SELECT 回傳結果集；INSERT / UPDATE / DELETE 成功回傳 true
 */
function db_run(mysqli $link, string $sql, array $params = [])
{
    $stmt = mysqli_prepare($link, $sql);
    if ($params) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);

    // 只有 SELECT 會有結果集；其他語句 get_result 回傳 false，統一改回傳 true
    $result = mysqli_stmt_get_result($stmt);
    return $result === false ? true : $result;
}

/** 輸出到 HTML 前做跳脫，避免資料中的 < > " 被瀏覽器當成標籤執行（XSS） */
function h($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
