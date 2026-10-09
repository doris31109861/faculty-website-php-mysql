<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $teacher = mysqli_real_escape_string($link, $_POST["teacher"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $page = mysqli_real_escape_string($link, $_POST["page"]);
        $source = mysqli_real_escape_string($link, $_POST["source"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $num = mysqli_real_escape_string($link, $_POST["num"]);
        $place = mysqli_real_escape_string($link, $_POST["place"]);
        $name1 = mysqli_real_escape_string($link, $_POST["name1"]);

        // 构建 SQL 更新语句
        $sql = "UPDATE PAPER SET Name='$name', Teacher='$teacher', Date='$date', Page='$page', Source='$source', Type='$type', Num='$num', Place='$place' WHERE Name='$name1'";
        try {
            $result = mysqli_query($link, $sql);
            echo "修改成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_paper.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>