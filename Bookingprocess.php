<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hrdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = "User";
if (isset($_COOKIE['user_name']) && !empty($_COOKIE['user_name'])) {
    $user_name = htmlspecialchars($_COOKIE['user_name']);
}
$user_email = "text";
if (isset($_COOKIE['user_email']) && !empty($_COOKIE['user_email'])) {
    $user_email = htmlspecialchars($_COOKIE['user_email']);
}

if (isset($_POST['confirm'])) {
    $cdate = $_POST['cdob'];
    $date = $_POST['dob'];
    $room = $_POST['room']; 

    $stmt = $conn->prepare("INSERT INTO booking (Fullname, Email, Check_in_date, Check_out_date, Total_Amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_name, $user_email, $cdate, $date, $room);

    if ($stmt->execute()) {
        echo "<script>
            alert('Your Booking Confirmed');
            window.location.href = 'ViewDetails.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cdate = htmlspecialchars($_POST['cdob']);
    $data = htmlspecialchars($_POST['dob']);
    $room = htmlspecialchars($_POST['room']);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Your Submitted Data</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: url('/Assignment/jorg-angeli-1tyuLfDOnG0-unsplash.jpg') no-repeat center center fixed;
                background-size: cover;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #333;
            }
            .content {
                background-color: rgb(207, 200, 159);
                border-radius: 10px;
                padding: 40px 45px;
                max-width: 450px;
                width: 100%;
                transition: transform 0.2s ease;
            }
            .content:hover {
                transform: scale(1.02);
            }
            .content h2 {
                text-align: center;
                margin-bottom: 30px;
                color: rgb(21, 7, 7);
                font-size: 25px;
            }
            .info p {
                margin: 12px 0;
                padding: 4px 0;
                font-size: 16px;
                line-height: 1.4;
            }
            .buttons {
                margin-top: 35px;
                display: flex;
                justify-content: center;
                gap: 28px;
            }
            .buttons button {
                padding: 8px 20px;
                border: none;
                border-radius: 6px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.2s ease;
            }
            .confirm-btn {
                background-color: rgb(58, 79, 170);
                color: white;
                border: 2px solid rgb(39, 60, 157);
            }
            .confirm-btn:hover {
                background-color: rgb(9, 26, 112);
            }
            .back-btn {
                background-color: rgb(245, 0, 118);
                color: white;
                border: 2px solid rgb(216, 17, 123);
            }
            .back-btn:hover {
                background-color: rgb(104, 9, 44);
            }
        </style>
    </head>
    <body>
    <div class="content">
        <h2 style="color: rgb(103, 4, 4);">Confirm Your Information</h2>
        <div class="info">
            <p><strong>Full Name:</strong> <?= $user_name ?></p>
            <p><strong>Email:</strong> <?= $user_email ?></p>
            <p><strong>Check in date:</strong> <?= $cdate ?></p>
            <p><strong>Check out date:</strong> <?= $data ?></p>
            <p><strong>Total Amount:</strong> <?= $room ?></p>
        </div>
        <div class="buttons">
            <form method="post" style="margin:0;">
                <input type="hidden" name="cdob" value="<?= $cdate ?>">
                <input type="hidden" name="dob" value="<?= $data ?>">
                <input type="hidden" name="room" value="<?= $room ?>">
                <button type="submit" name="confirm" class="confirm-btn">Confirm</button>
            </form>
            <form action="ViewDetails.php" method="get" style="margin:0;">
                <button type="submit" class="back-btn">Back</button>
            </form>
        </div>
    </div>
    </body>
    </html>

    <?php
} else {
    echo "<p>Invalid request.</p>";
}
?>
