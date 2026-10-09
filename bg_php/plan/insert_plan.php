<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $role = mysqli_real_escape_string($link, $_POST["role"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $number = mysqli_real_escape_string($link, $_POST["number"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $sql = "INSERT INTO PLAN ( Name, Role, Date, Number, Type) VALUES ( '$name', ' $role','$date' ,'$number','$type')";
        try {
            $result = mysqli_query($link, $sql);
            echo "插入成功owob<br>";
            header("Location: bg_plan.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>