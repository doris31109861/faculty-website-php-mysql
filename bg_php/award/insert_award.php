<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $year = mysqli_real_escape_string($link, $_POST["year"]);
        $uint = mysqli_real_escape_string($link, $_POST["uint"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $award = mysqli_real_escape_string($link, $_POST["award"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $sql = "INSERT INTO AWARD (Year,Name,Uint,Date,Award,Type) VALUES ('$year', '$name', '$uint','$date','$award','$type')";
        try {
            $result = mysqli_query($link, $sql);
            echo "插入成功<br>";
            
            // 重定向到 bg_time.php 页面
            header("Location: bg_award.php");
            exit();
            
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>
