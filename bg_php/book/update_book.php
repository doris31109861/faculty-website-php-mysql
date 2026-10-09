<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $press = mysqli_real_escape_string($link, $_POST["press"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $nation = mysqli_real_escape_string($link, $_POST["nation"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $teacher = mysqli_real_escape_string($link, $_POST["teacher"]);
        $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
        $type1 = mysqli_real_escape_string($link, $_POST["type1"]);

        // 构建 SQL 更新语句
        $sql = "UPDATE BOOK SET Name='$name', Press='$press', Type='$type', Teacher='$teacher', Nation='$nation', Date='$date' WHERE Name='$name1' AND Type='$type1'";
        try {
            $result = mysqli_query($link, $sql);
            echo "修改成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_book.php");
            exit();
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>