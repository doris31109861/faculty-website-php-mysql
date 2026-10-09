<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php require_once __DIR__ . '/../../db.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $name = ($_POST["name"] ?? '');
        $role = ($_POST["role"] ?? '');
        $date = ($_POST["date"] ?? '');
        $number = ($_POST["number"] ?? '');
        $type = ($_POST["type"] ?? '');
        $sql = "INSERT INTO PLAN ( Name, Role, Date, Number, Type) VALUES ( ?, ?,? ,?,?)";  // ? 為佔位符，實際的值由 db_run 綁定
        try {
            $result = db_run($link, $sql, [$name, $role, $date, $number, $type]);
            echo "插入成功owob<br>";
            header("Location: bg_plan.php");
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>