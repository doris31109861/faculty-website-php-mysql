<?php require_once __DIR__ . '/../../config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

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
    <h1>論文表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = "../../background.php";
        }
    </script>
    <div class="container">
        <div class="form-container">
			<h3>新增</h3>
            <form action="insert_paper.php" method="post">
                <label for="name">名稱:</label>
                <input type="text" id="name" name="name">

                <label for="teacher">教授:</label>
                <input type="text" id="teacher" name="teacher">

                <label for="date">日期:</label>
                <input type="text" id="date" name="date">

                <label for="page">頁數:</label>
                <input type="text" id="page" name="page">

                <label for="source">出處:</label>
                <input type="text" id="source" name="source">

                <label for="type">類型 會議0/專書1/期刊2:</label>
                <input type="text" id="type" name="type">

                <label for="num">卷號:</label>
                <input type="text" id="num" name="num">

                <label for="place">地點:</label>
                <input type="text" id="place" name="place">

                <input type="submit" value="Insert">
            </form>
			<h3>查詢&修改</h3>
			<form action="select_paper.php" method="post">
				<label for="name">名稱:</label>
				<input type="text" id="name" name="name1">
				<input type="submit" value="Enter">
			</form>
			<h3>刪除</h3>
			<form action="delete_paper.php" method="post">
                <label for="name">名稱:</label>
                <input type="text" id="name" name="name">

                <input type="submit" value="Delete">
            </form>
        </div>
        
        <div class="form-container">

            <table>
                <tr>
                    <th>名稱</th>
                    <th>教授</th>
                    <th>日期</th>
                    <th>頁數</th>
                    <th>出處</th>
                    <th>類型</th>
                    <th>卷號</th>
                    <th>地點</th>
                </tr>
                <?php
                $sql = "SELECT * FROM PAPER ";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
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
                }
                ?>
            </table>
        </div>
        
    </div>
</body>
</html>
