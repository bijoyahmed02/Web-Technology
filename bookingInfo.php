<?php
session_start();
$connection = new mysqli("localhost", "root", "", "hrdb");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT Fullname, Email, Check_in_date, Check_out_date, Total_Amount FROM booking";
$result = $connection->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Information</title>
    <style>
        body {
            background-color: rgb(131, 191, 193);
            font-family: Arial, sans-serif;
        }
        .user-logout {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 5px 10px;
            background-color: rgb(131, 191, 193);
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
        <h2>Booking Information</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="user-data">';
                echo '<p><span class="label">Full Name:</span> ' . htmlspecialchars($row['Fullname']) . '</p>';
                echo '<p><span class="label">Email:</span> ' . htmlspecialchars($row['Email']) . '</p>';
                echo '<p><span class="label">Check in date:</span> ' . htmlspecialchars($row['Check_in_date']) . '</p>';
                echo '<p><span class="label">Check out date:</span> ' . htmlspecialchars($row['Check_out_date']) . '</p>';
                echo '<p><span class="label">Total Amount:</span> ' . htmlspecialchars($row['Total_Amount']) . '</p>';
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
