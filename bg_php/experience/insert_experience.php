<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php require_once __DIR__ . '/../../db.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $department = ($_POST["department"] ?? '');
        $position = ($_POST["position"] ?? '');
        $type = ($_POST["type"] ?? '');
        
        $sql = "INSERT INTO EXPERIENCE (Department,Position,Type) VALUES ( ?,?,?)";  // ? 為佔位符，實際的值由 db_run 綁定
        try {
            $result = db_run($link, $sql, [$department, $position, $type]);
            echo "插入成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_experience.php");
            exit();
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>