<?php
$connection = new mysqli("localhost", "root", "", "aqidb");
 
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
 
$query = "SELECT id, city FROM info";
$result = $connection->query($query);
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Select atmost 10 Cities</title>
    <style>
        body {
            background-color: rgb(203, 202, 142);
        }
        .log-out {
            display: flex;
            justify-content: flex-end;
            margin: 15px;
        }
        .log-out button {
            padding: 8px 13px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            background-color:rgb(68, 106, 177);
            transition: background 0.2s;
        }

        .log-out button:hover {
            background-color:rgb(36, 14, 162);
        }
        .container {
            max-width: 550px;
            background: white;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
        }
 
        h2 {
            text-align: center;
            color:rgb(36, 4, 4);
        }
        .allcity {
            background-color: rgb(147, 242, 245);
            padding: 10px 15px;
            margin: 10px 0px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 11px;
            font-weight: bold;
            color: rgb(6, 0, 0);
        }
        input[type="checkbox"] {
            transform: scale(1.2);
            accent-color:rgb(129, 14, 52);
        }
 
        input[type="submit"] {
            background-color: rgba(38, 137, 152, 0.97);
            border: none;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 17px;
            cursor: pointer;
            display: block;
            margin: 25px auto 0;
            transition: background 0.2s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(to right, #00acc1, #5e35b1);
        }
    </style>
</head>
<body>

    <div class="log-out">
        <button onclick="logout()">Logout</button>
    </div>
    <div class="container">
        <h2>Select atmost 10 Cities</h2>
        <form action="showaqi.php" method="POST" onsubmit="return validateForm();">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <label class="allcity">
                    <input type="checkbox" name="cities[]" value="<?= $row['id']; ?>">
                    <?= htmlspecialchars($row['city']); ?>
                </label>
            <?php endwhile; ?>
            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        function validateForm() {
            const checkboxes = document.querySelectorAll('input[name="cities[]"]:checked');
            if (checkboxes.length === 0 || checkboxes.length > 10) {
                alert("Please select atmost 10 cities.");
                return false;
            }
            return true;
        }
        function logout() {
            window.location.href = "index.html";
        }
    </script>

</body>
</html>
