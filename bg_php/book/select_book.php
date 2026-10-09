<?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>書本表維護</title>
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
    <h1>書本表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_book.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
                $type1 = mysqli_real_escape_string($link, $_POST["type1"]);
                $sql = "SELECT * FROM BOOK WHERE Name='$name1' AND Type='$type1'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>書名</th>";
                    echo "<th>出版社</th>";
                    echo "<th>教材0/專書1</th>";
                    echo "<th>國家</th>";
                    echo "<th>日期</th>";
                    echo "<th>教授</th>";
                    echo "</tr>";

                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Press"] . "</td>";
                        echo "<td>" . $row["Type"] . "</td>";
                        echo "<td>" . $row["Nation"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>" . $row["Teacher"] . "</td>";
                        echo "</tr>";
                        $press1 = $row["Press"] ;
                        $nation1 = $row["Nation"] ;
                        $date1 = $row["Date"] ;
                        $teacher1 = $row["Teacher"] ;
                    }
                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_book.php" method="post">
            <label for="name">修改後書名:</label>
                <input type="hidden" id="name1" name="name1" value="<?php echo isset($name1) ? $name1 : ''; ?>">
                <input type="hidden" id="type1" name="type1" value="<?php echo isset($type1) ? $type1 : ''; ?>">
                <input type="text" id="name" name="name" value="<?php echo isset($name1) ? $name1 : ''; ?>">

                <label for="press">修改後出版社:</label>
                <input type="text" id="press" name="press" value="<?php echo isset($press1) ? $press1 : ''; ?>">

                <label for="type">修改後教材0/專書1:</label>
                <input type="text" id="type" name="type" value="<?php echo isset($type1) ? $type1 : ''; ?>">

                <label for="nation">修改後國家:</label>
                <input type="text" id="nation" name="nation" value="<?php echo isset($nation1) ? $nation1 : ''; ?>">
                <label for="date">修改後日期:</label>
                <input type="text" id="date" name="date" value="<?php echo isset($date1) ? $date1 : ''; ?>">
                <label for="teacher">修改後教授:</label>
                <input type="text" id="teacher" name="teacher" value="<?php echo isset($teacher1) ? $teacher1 : ''; ?>">
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
