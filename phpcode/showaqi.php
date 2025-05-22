<?php
if (!isset($_POST['cities']) || count($_POST['cities']) > 10) {
    die("Error: You must select atmost 10 cities.");
}
 
$selectedIds = $_POST['cities'];
 
$connection = new mysqli("localhost", "root", "", "aqidb");
 
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
 
$ids = implode(",", array_map('intval', $selectedIds));
$query = "SELECT city, country, aqi FROM info WHERE id IN ($ids)";
$result = $connection->query($query);
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>City Country Aqi</title>
    <style>
        body {
            background-color: rgb(204, 230, 230);
        }
 
        .container {
            max-width: 550px;
            background: white;
            margin: 45px auto;
            padding: 25px;
            border-radius: 10px;
        }
 
        h2 {
            text-align: center;
            color:rgb(36, 4, 4);
        }
 
        .selectcity {
            background: linear-gradient(to right,rgba(98, 172, 141, 0.83),rgb(44, 152, 168));
            padding: 10px 15px;
            margin: 10px 0px;
            border-radius: 6px;
        }
 
        .selectcity span {
            font-weight: bold;
            color:rgb(121, 89, 0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>City Country and AQI</h2>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="selectcity">
                <div><span>City:</span> <?= htmlspecialchars($row['city']); ?></div>
                <div><span>Country:</span> <?= htmlspecialchars($row['country']); ?></div>
                <div><span>AQI:</span> <?= htmlspecialchars($row['aqi']); ?></div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>