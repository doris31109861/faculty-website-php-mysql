<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php require_once __DIR__ . '/../../db.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name1 = ($_POST["name1"] ?? '');
        $name = ($_POST["name"] ?? '');
        $role = ($_POST["role"] ?? '');
        $date = ($_POST["date"] ?? '');
        $number = ($_POST["number"] ?? '');
        $type = ($_POST["type"] ?? '');

        // 构建 SQL 更新语句
        $sql = "UPDATE PLAN SET Name=?, Role=?, Date=?,Number=?,Type=? WHERE Name=?";  // ? 為佔位符，實際的值由 db_run 綁定
        try {
            $result = db_run($link, $sql, [$name, $role, $date, $number, $type, $name1]);
            header("Location: bg_plan.php");
            exit();
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>