<?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>時間表維護</title>
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
    <h1>時間表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_time.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $day1 = mysqli_real_escape_string($link, $_POST["day1"]);
                $class1 = mysqli_real_escape_string($link, $_POST["class1"]);
                $sql = "SELECT * FROM TIME WHERE Day='$day1' AND Class='$class1'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>星期</th>";
                    echo "<th>節次</th>";
                    echo "<th>課名</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Day"] . "</td>";
                        echo "<td>" . $row["Class"] . "</td>";
                        echo "<td>" . $row["Class_name"] . "</td>";
                        echo "</tr>";
                        $class_name = $row["Class_name"] ;
                    }

                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_time.php" method="post">
                <input type="hidden" id="day1" name="day1" value="<?php echo isset($day1) ? $day1 : ''; ?>">
                <input type="hidden" id="class1" name="class1" value="<?php echo isset($class1) ? $class1 : ''; ?>">
                <label for="day">修改後星期:</label>
                <input type="text" id="day" name="day" value="<?php echo isset($day1) ? $day1 : ''; ?>">

                <label for="class">修改後節次:</label>
                <input type="text" id="class" name="class" value="<?php echo isset($class1) ? $class1 : ''; ?>">

                <label for="class_name">修改後課名:</label>
                <input type="text" id="class_name" name="class_name" value="<?php echo isset($class_name) ? $class_name : ''; ?>">

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
