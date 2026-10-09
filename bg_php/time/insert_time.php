<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $day = mysqli_real_escape_string($link, $_POST["day"]);
        $class = mysqli_real_escape_string($link, $_POST["class"]);
        $class_name = mysqli_real_escape_string($link, $_POST["class_name"]);
        
        $sql = "INSERT INTO TIME (Day, Class, Class_name) VALUES ('$day', '$class', '$class_name')";
        try {
            $result = mysqli_query($link, $sql);
            echo "插入成功owob<br>";
            
            // 重定向到 bg_time.php 页面
            header("Location: bg_time.php");
            exit();
            
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>
