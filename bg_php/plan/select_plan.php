<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>計畫表維護</title>
    <style>
        body {
				font-family: Arial, sans-serif;
				padding: 20px;
				background-color: #F0F0F0;
		}
        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .form-container {
            width: 35%;
            padding-right: 40px;
            padding: 5%;
        }

        .table-container {
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .form-container form {
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            margin-bottom: 10px;
        }

        .form-container input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>計畫表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_plan.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
                $sql = "SELECT * FROM PLAN WHERE Name='$name1'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>名稱</th>";
                    echo "<th>角色</th>";
                    echo "<th>日期</th>";
                    echo "<th>計畫編號</th>";
                    echo "<th>計畫表類型</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Role"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>" . $row["Number"] . "</td>";
                        echo "<td>" . $row["Type"] . "</td>";
                        echo "</tr>";
                        $role1 = $row["Role"] ;
                        $date1 = $row["Date"] ;
                        $number1 = $row["Number"] ;
                        $type1 = $row["Type"] ;
                    }

                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_plan.php" method="post">
                <input type="hidden" id="name1" name="name1" value="<?php echo isset($name1) ? $name1 : ''; ?>">
                <label for="name">名稱:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($name1) ? $name1 : ''; ?>">

                <label for="role">角色:</label>
                <input type="text" id="role" name="role" value="<?php echo isset($role1) ? $role1 : ''; ?>">

                <label for="date">日期:</label>
                <input type="text" id="date" name="date" value="<?php echo isset($date1) ? $date1 : ''; ?>">

                <label for="number">計畫編號:</label>
                <input type="text" id="number" name="number" value="<?php echo isset($number1) ? $number1 : ''; ?>">

                <label for="type">計畫表類型 科技部0/產學合作1/演講2:</label>
                <input type="text" id="type" name="type" value="<?php echo isset($type1) ? $type1 : ''; ?>">

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
