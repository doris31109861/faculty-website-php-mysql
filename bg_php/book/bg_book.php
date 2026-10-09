<?php require_once __DIR__ . '/../../auth.php'; // 後台頁面：未登入導回登入頁 ?><?php require_once __DIR__ . '/../../config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

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
    <h1>書本表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = "../../background.php";
        }
    </script>
    <div class="container">
        <div class="form-container">
			<h3>新增</h3>
            <form action="insert_book.php" method="post">
                <label for="name">書名:</label>
                <input type="text" id="name" name="name">

                <label for="press">出版社:</label>
                <input type="text" id="press" name="press">

                <label for="type">教材0/專書1:</label>
                <input type="text" id="type" name="type">

                <label for="nation">國家:</label>
                <input type="text" id="nation" name="nation">
                <label for="date">日期:</label>
                <input type="text" id="date" name="date">
                <label for="teacher">教授:</label>
                <input type="text" id="teacher" name="teacher">

                <input type="submit" value="Insert">
            </form>
			<h3>查詢&修改</h3>
			<form action="select_book.php" method="post">
                <label for="name">書名:</label>
                <input type="text" id="name" name="name1">
				<label for="type">教材0/專書1:</label>
                <input type="text" id="type" name="type1">
				<input type="submit" value="Enter">
			</form>
			<h3>刪除</h3>
			<form action="delete_book.php" method="post">
                <label for="name">書名:</label>
                <input type="text" id="name" name="name">
				<label for="type">教材0/專書1:</label>
                <input type="text" id="type" name="type">

                <input type="submit" value="Delete">
            </form>
        </div>
        
        <div class="table-container">
            <table>
                <tr>
                    <th>書名</th>
                    <th>出版社</th>
                    <th>教材0/專書1</th>
                    <th>國家</th>
                    <th>日期</th>
                    <th>教授</th>
                </tr>
                <?php
                $sql = "SELECT * FROM BOOK ";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Press"] . "</td>";
                    echo "<td>" . $row["Type"] . "</td>";
                    echo "<td>" . $row["Nation"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["Teacher"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
