<?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>論文表維護</title>
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
    <h1>論文表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_paper.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $name1 = mysqli_real_escape_string($link, $_POST["name1"]);
                $sql = "SELECT * FROM PAPER WHERE Name='$name1'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>名稱</th>";
                    echo "<th>教授</th>";
                    echo "<th>日期</th>";
                    echo "<th>頁數</th>";
                    echo "<th>出處</th>";
                    echo "<th>類型</th>";
                    echo "<th>卷號</th>";
                    echo "<th>地點</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Teacher"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>" . $row["Page"] . "</td>";
                        echo "<td>" . $row["Source"] . "</td>";
                        echo "<td>" . $row["Type"] . "</td>";
                        echo "<td>" . $row["Num"] . "</td>";
                        echo "<td>" . $row["Place"] . "</td>";
                        echo "</tr>";
                        $teacher1 = $row["Teacher"] ;
                        $page1 = $row["Page"] ;
                        $date1 = $row["Date"] ;
                        $source1 = $row["Source"] ;
                        $type1 = $row["Type"] ;
                        $num1 = $row["Num"] ;
                        $place1 = $row["Place"] ;
                    }

                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_paper.php" method="post">
                <input type="hidden" id="name1" name="name1" value="<?php echo isset($name1) ? $name1 : ''; ?>">
                <label for="name">修改後名稱:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($name1) ? $name1 : ''; ?>">

                <label for="teacher">修改後教授:</label>
                <input type="text" id="teacher" name="teacher" value="<?php echo isset($teacher1) ? $teacher1 : ''; ?>">

                <label for="date">修改後日期:</label>
                <input type="text" id="date" name="date" value="<?php echo isset($date1) ? $date1 : ''; ?>">

                <label for="page">修改後頁數:</label>
                <input type="text" id="page" name="page" value="<?php echo isset($page1) ? $page1 : ''; ?>">

                <label for="source">修改後出處:</label>
                <input type="text" id="source" name="source" value="<?php echo isset($source1) ? $source1 : ''; ?>">

                <label for="type">修改後類型 會議0/專書1/期刊2:</label>
                <input type="text" id="type" name="type" value="<?php echo isset($type1) ? $type1 : ''; ?>">

                <label for="num">修改後卷號:</label>
                <input type="text" id="num" name="num" value="<?php echo isset($num1) ? $num1 : ''; ?>">

                <label for="place">修改後地點:</label>
                <input type="text" id="place" name="place" value="<?php echo isset($place1) ? $place1 : ''; ?>">

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
