<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $day1 = mysqli_real_escape_string($link, $_POST["day1"]);
        $class1 = mysqli_real_escape_string($link, $_POST["class1"]);
        $day = mysqli_real_escape_string($link, $_POST["day"]);
        $class = mysqli_real_escape_string($link, $_POST["class"]);
        $class_name = mysqli_real_escape_string($link, $_POST["class_name"]);

        // 构建 SQL 更新语句
        $sql = "UPDATE TIME SET Day='$day', Class='$class', Class_name='$class_name' WHERE Day='$day1' AND Class='$class1'";
        try {
            $result = mysqli_query($link, $sql);
            echo "修改成功owob<br>";
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