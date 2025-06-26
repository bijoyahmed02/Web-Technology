<?php
session_start();
$connection = new mysqli("localhost", "root", "", "hrdb");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT Fullname, Email, Dob, Country, Gender FROM user";
$result = $connection->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
        body {
            background-color: rgb(188, 188, 120);
            font-family: Arial, sans-serif;
        }
        .user-logout {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 5px 10px;
            background-color: rgb(188, 188, 120);
        }
        .log-out {
            padding: 8px 13px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            background-color: rgb(68, 106, 177);
            transition: background 0.2s;
        }
        .log-out:hover {
            background-color: rgb(36, 14, 162);
        }
        .container {
            max-width: 800px;
            background: white;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: rgb(36, 4, 4);
            margin-bottom: 20px;
        }
        .user-data {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .user-data:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: rgb(6, 0, 0);
        }
    </style>
</head>
<body>  
    <div class="user-logout">
        <form action="control.php" method="get" style="margin:0;">
                <button type="submit" class="log-out">Back</button>
        </form>
    </div>
    <div class="container">
        <h2>User Information</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="user-data">';
                echo '<p><span class="label">Full Name:</span> ' . htmlspecialchars($row['Fullname']) . '</p>';
                echo '<p><span class="label">Email:</span> ' . htmlspecialchars($row['Email']) . '</p>';
                echo '<p><span class="label">Date of Birth:</span> ' . htmlspecialchars($row['Dob']) . '</p>';
                echo '<p><span class="label">Country:</span> ' . htmlspecialchars($row['Country']) . '</p>';
                echo '<p><span class="label">Gender:</span> ' . htmlspecialchars($row['Gender']) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;'>No user records found.</p>";
        }
        $connection->close();
        ?>
    </div>
</body>
</html>
