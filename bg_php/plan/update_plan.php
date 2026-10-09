<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $role = mysqli_real_escape_string($link, $_POST["role"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $number = mysqli_real_escape_string($link, $_POST["number"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);

        // 构建 SQL 更新语句
        $sql = "UPDATE PLAN SET Name='$name', Role='$role', Date='$date',Number='$number',Type='$type' WHERE Name='$name1'";
        try {
            $result = mysqli_query($link, $sql);
            header("Location: bg_plan.php");
            exit();
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>