<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $year = mysqli_real_escape_string($link, $_POST["year"]);
        $uint = mysqli_real_escape_string($link, $_POST["uint"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $award = mysqli_real_escape_string($link, $_POST["award"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
        $award1 = mysqli_real_escape_string($link, $_POST["award1"]);

        // 构建 SQL 更新语句
        $sql = "UPDATE AWARD SET Year='$year',Name='$name', Uint='$uint', Date='$date', Award='$award', Type='$type' WHERE Name='$name1' AND Award='$award1'";
        try {
            $result = mysqli_query($link, $sql);
            echo "修改成功owob<br>";
            // 重定向到 bg_time.php 页面
            header("Location: bg_award.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>