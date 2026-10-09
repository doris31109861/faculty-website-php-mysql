<?php require_once __DIR__ . '/../../config.php'; ?><?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $department = mysqli_real_escape_string($link, $_POST["department"]);
        $position = mysqli_real_escape_string($link, $_POST["position"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $department1 = mysqli_real_escape_string($link, $_POST["department1"]);
        $position1 = mysqli_real_escape_string($link, $_POST["position1"]);
        
        $sql = "UPDATE EXPERIENCE SET Position='$position', Department='$department', Type='$type' WHERE Position='$position1' AND Department='$department1'";
        try {
            $result = mysqli_query($link,$sql);
            echo "修改成功owob<br>";
            header("Location: bg_experience.php");
            exit();
        } catch (Exception $e) {
            echo "出事 \\|/<br>";
            echo $e->getMessage() . "<br>";
        }

        mysqli_close($link);
    }
?>