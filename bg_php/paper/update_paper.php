<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php require_once __DIR__ . '/../../db.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 获取要修改的数据的唯一标识，例如 ID

        
        // 获取要修改的字段值
        $name = ($_POST["name"] ?? '');
        $teacher = ($_POST["teacher"] ?? '');
        $date = ($_POST["date"] ?? '');
        $page = ($_POST["page"] ?? '');
        $source = ($_POST["source"] ?? '');
        $type = ($_POST["type"] ?? '');
        $num = ($_POST["num"] ?? '');
        $place = ($_POST["place"] ?? '');
        $name1 = ($_POST["name1"] ?? '');

        // 构建 SQL 更新语句
        $sql = "UPDATE PAPER SET Name=?, Teacher=?, Date=?, Page=?, Source=?, Type=?, Num=?, Place=? WHERE Name=?";  // ? 為佔位符，實際的值由 db_run 綁定
        try {
            $result = db_run($link, $sql, [$name, $teacher, $date, $page, $source, $type, $num, $place, $name1]);
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