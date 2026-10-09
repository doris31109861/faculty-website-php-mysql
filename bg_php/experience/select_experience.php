<?php require_once __DIR__ . '/../../config.php'; ?><!DOCTYPE html>
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
    <h1>經歷表維護</h1>
    <button onclick="goBack()">返回</button>
    <script>
        function goBack() {
            window.location.href = 'bg_experience.php';
        }
    </script>
    <div class="container">
        <div class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $department1 = mysqli_real_escape_string($link, $_POST["department1"]);
                $position1 = mysqli_real_escape_string($link, $_POST["position1"]);
                $type = mysqli_real_escape_string($link, $_POST["type"]);
                $sql = "SELECT * FROM EXPERIENCE WHERE Position='$position1' AND Department='$department1' ";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>部門</th>";
                    echo "<th>職位</th>";
                    echo "<th>校內0/校外1</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Department"] . "</td>";
                        echo "<td>" . $row["Position"] . "</td>";
                        echo "<td>" . $row["Type"] . "</td>";
                        echo "</tr>";
                        $type1 = $row["Type"] ;
                    }

                    echo "</table>";
                } else {
                    echo "沒有找到匹配的記錄";
                }

                mysqli_close($link);
            }
            ?>

            <form action="update_experience.php" method="post">
                <input type="hidden" id="position1" name="position1" value="<?php echo isset($position1) ? $position1 : ''; ?>">
                <input type="hidden" id="department1" name="department1" value="<?php echo isset($department1) ? $department1 : ''; ?>">
                <label for="department">修改後部門:</label>
                <input type="text" id="department" name="department" value="<?php echo isset($department1) ? $department1 : ''; ?>">
                <label for="position">修改後職位:</label>
                <input type="text" id="position" name="position" value="<?php echo isset($position1) ? $position1 : ''; ?>">
                <label for="type">修改後校內0/校外1:</label>
                <input type="text" id="type" name="type" value="<?php echo isset($type1) ? $type1: ''; ?>">

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
