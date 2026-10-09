<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要删除的数据的唯一标识，例如 ID
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        // 构建 SQL 删除语句
        $sql = "DELETE FROM PAPER WHERE Name='$name'";
        try {
            $result = mysqli_query($link, $sql);
            echo "删除成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_paper.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>