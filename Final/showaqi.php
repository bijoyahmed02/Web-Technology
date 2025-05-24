<?php
session_start();

if (!isset($_POST['cities']) || count($_POST['cities']) < 1 || count($_POST['cities']) > 10) {
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


// Get user's background color from database using session email
$userEmail = $_SESSION['email'] ?? null;
$bgColor = "#ffffff"; // Default color

if ($userEmail) {
    $stmt = $connection->prepare("SELECT color FROM user WHERE Email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->bind_result($dbColor);
    if ($stmt->fetch() && !empty($dbColor)) {
        $bgColor = htmlspecialchars($dbColor);
    }
    $stmt->close();
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
            background-color: <?= $bgColor ?>;
            margin: 0;
            padding: 0;
        }
 
        .container {
            max-width: 550px;
            background: white;
            margin: 45px auto;
            padding: 25px;
            border-radius: 10px;
            background-color: rgb(245, 223, 116);
        }
 
        h2 {
            text-align: center;
            color:rgb(36, 4, 4);
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
    <div class="log-out">
        <button onclick="logout()">Logout</button>
    </div>

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

    <script>
        function logout() {
            window.location.href = "index.html";
        }
    </script>

</body>
</html>
