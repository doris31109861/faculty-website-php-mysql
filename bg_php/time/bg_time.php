<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

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
			padding: 2%;
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
    </style>
</head>

<body>
    <h1>時間表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = "../../background.php";
        }
    </script>
    <div class="container">
        <div class="form-container">
			<h3>新增</h3>
            <form action="insert_time.php" method="post">
                <label for="day">星期:</label>
                <input type="text" id="day" name="day">

                <label for="class">節次:</label>
                <input type="text" id="class" name="class">

                <label for="class_name">課名:</label>
                <input type="text" id="class_name" name="class_name">

                <input type="submit" value="Insert">
            </form>
			<h3>查詢&修改</h3>
			<form action="select_time.php" method="post">
				<label for="day">星期:</label>
				<input type="text" id="day" name="day1">
				<label for="class">節次:</label>
				<input type="text" id="class" name="class1">
				<input type="submit" value="Enter">
			</form>
			<h3>刪除</h3>
			<form action="delete_time.php" method="post">
                <label for="day">星期:</label>
                <input type="text" id="day" name="day">

                <label for="class">節次:</label>
                <input type="text" id="class" name="class">

                <input type="submit" value="Delete">
            </form>
        </div>
        
        <div class="table-container">
            <table>
                <tr>
                    <th>星期</th>
                    <th>節次</th>
                    <th>課名</th>
                </tr>
                <?php
                $sql = "SELECT * FROM TIME ";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row["Day"] . "</td>";
                    echo "<td>" . $row["Class"] . "</td>";
                    echo "<td>" . $row["Class_name"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
