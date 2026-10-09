<?php require_once __DIR__ . '/../../config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

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
    <h1>獎項表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = "../../background.php";
        }
    </script>
    <div class="container">
        <div class="form-container">
			<h3>新增</h3>
            <form action="insert_award.php" method="post">
                <label for="year">年度:</label>
                <input type="text" id="year" name="year">    
                
                <label for="name">名稱:</label>
                <input type="text" id="name" name="name">

                <label for="date">日期:</label>
                <input type="text" id="date" name="date">

                <label for="uint">單位:</label>
                <input type="text" id="uint" name="uint">

                <label for="award">獎項:</label>
                <input type="text" id="award" name="award">

                <label for="type">類型 校內0/校外1:</label>
                <input type="text" id="type" name="type">

                <input type="submit" value="Insert">
            </form>
			<h3>查詢&修改</h3>
			<form action="select_award.php" method="post">
				<label for="name">名稱:</label>
				<input type="text" id="name" name="name1">
                <label for="award">獎項:</label>
                <input type="text" id="award" name="award1">
				<input type="submit" value="Enter">
			</form>
			<h3>刪除</h3>
			<form action="delete_award.php" method="post">
                <label for="name">名稱:</label>
				<input type="text" id="name" name="name">
                <label for="award">獎項:</label>
                <input type="text" id="award" name="award">
			
                <input type="submit" value="Delete">
            </form>
        </div>
        
        <div class="form-container">

            <table>
                <tr>
                    <th>年度</th>
                    <th>名稱</th>
                    <th>單位</th>
                    <th>日期</th>
                    <th>獎項</th>
                    <th>校內/校外</th>
                </tr>
                <?php
                $sql = "SELECT * FROM AWARD ";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row["Year"] . "</td>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Uint"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["Award"] . "</td>";
                    echo "<td>" . $row["Type"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        
    </div>
</body>
</html>
