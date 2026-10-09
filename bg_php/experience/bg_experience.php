<?php require_once __DIR__ . '/../../config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>經歷表維護</title>
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
    <h1>經歷表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = "../../background.php";
        }
    </script>
    <div class="container">
        <div class="form-container">
			<h3>新增</h3>
            <form action="insert_experience.php" method="post">
                <label for="department">部門:</label>
                <input type="text" id="department" name="department">

                <label for="position">職位:</label>
                <input type="text" id="position" name="position">

                <label for="type">校內0/校外1:</label>
                <input type="text" id="type" name="type">

                <input type="submit" value="Insert">
            </form>
			<h3>查詢&修改</h3>
			<form action="select_experience.php" method="post">
                <label for="department">部門:</label>
                <input type="text" id="department" name="department1">
				<label for="position">職位:</label>
                <input type="text" id="position" name="position1">
				<input type="submit" value="Enter">
			</form>
			<h3>刪除</h3>
			<form action="delete_experience.php" method="post">
                <label for="department">部門:</label>
                <input type="text" id="department" name="department">
                <label for="position">職位:</label>
                <input type="text" id="position" name="position">
                <input type="submit" value="Delete">
            </form>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>部門</th>
                    <th>職位</th>
                    <th>校內0/校外1</th>
                </tr>
                <?php
                $sql = "SELECT * FROM EXPERIENCE";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row["Department"] . "</td>";
                    echo "<td>" . $row["Position"] . "</td>";
                    echo "<td>" . $row["Type"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
