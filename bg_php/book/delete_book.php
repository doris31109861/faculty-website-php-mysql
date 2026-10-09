<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php require_once __DIR__ . '/../../db.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要删除的数据的唯一标识，例如 ID
        $name = ($_POST["name"] ?? '');
        $type = ($_POST["type"] ?? '');
        // 构建 SQL 删除语句
        $sql = "DELETE FROM BOOK WHERE Name=? AND Type=?";  // ? 為佔位符，實際的值由 db_run 綁定
        try {
            $result = db_run($link, $sql, [$name, $type]);
            echo "删除成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_book.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>