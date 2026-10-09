<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $teacher = mysqli_real_escape_string($link, $_POST["teacher"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $page = mysqli_real_escape_string($link, $_POST["page"]);
        $source = mysqli_real_escape_string($link, $_POST["source"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $num = mysqli_real_escape_string($link, $_POST["num"]);
        $place = mysqli_real_escape_string($link, $_POST["place"]);
        
        $sql = "INSERT INTO PAPER (Name, Teacher, Date, Page, Source, Type, Num, Place) VALUES ('$name', '$teacher', '$date', '$page', '$source', '$type', '$num', '$place')";
        try {
            $result = mysqli_query($link, $sql);
            echo "插入成功<br>";
            
            // 重定向到 bg_time.php 页面
            header("Location: bg_paper.php");
            exit();
            
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>
