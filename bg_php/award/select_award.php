<?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>獎項表維護</title>
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
    <h1>獎項表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_award.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
                $award1 = mysqli_real_escape_string($link, $_POST["award1"]);
                $sql = "SELECT * FROM AWARD WHERE Name='$name1' AND Award='$award1'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>年度</th>";
                    echo "<th>名稱</th>";
                    echo "<th>單位</th>";
                    echo "<th>日期</th>";
                    echo "<th>獎項</th>";
                    echo "<th>校內/校外</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Year"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Uint"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>" . $row["Award"] . "</td>";
                        echo "<td>" . $row["Type"] . "</td>";
                        echo "</tr>";
                        $year1 = $row["Year"] ;
                        $uint1 = $row["Uint"] ;
                        $date1 = $row["Date"] ;
                        $type1 = $row["Type"] ;
                    }

                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_award.php" method="post">
                <input type="hidden" id="name1" name="name1" value="<?php echo isset($name1) ? $name1 : ''; ?>">
                <input type="hidden" id="award1" name="award1" value="<?php echo isset($award1) ? $award1 : ''; ?>">
                <label for="year">修改後年度:</label>
                <input type="text" id="year" name="year" value="<?php echo isset($year1) ? $year1 : ''; ?>">    
                
                <label for="name">修改後名稱:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($name1) ? $name1 : ''; ?>">

                <label for="date">修改後日期:</label>
                <input type="text" id="date" name="date" value="<?php echo isset($date1) ? $date1 : ''; ?>">

                <label for="uint">修改後單位:</label>
                <input type="text" id="uint" name="uint" value="<?php echo isset($uint1) ? $uint1 : ''; ?>">

                <label for="award">修改後獎項:</label>
                <input type="text" id="award" name="award" value="<?php echo isset($award1) ? $award1 : ''; ?>">

                <label for="type">修改後類型 校內0/校外1:</label>
                <input type="text" id="type" name="type" value="<?php echo isset($type1) ? $type1 : ''; ?>">

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
