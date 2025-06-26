<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "hrdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CONFIRMATION 
if (isset($_POST['confirm'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number']; 
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("INSERT INTO receptionist (Fullname, Email, Password, Phone_number, Dob, Country, Gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullname, $email, $password, $number, $dob, $country, $gender);

    if ($stmt->execute()) {
        echo "<script>
            alert('Information saved successfully!');
            window.location.href = 'control.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// FIRST FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['pass']);
    $number = htmlspecialchars($_POST['number']);
    $birthdate = htmlspecialchars($_POST['dob']);
    $country = htmlspecialchars($_POST['country']);
    $gender = htmlspecialchars($_POST['gender']);
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
            <p><strong>Full Name:</strong> <?= $fullname ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Password:</strong> <?= $password ?></p>
            <p><strong>Contact Number:</strong> <?= $number ?></p>
            <p><strong>Birthdate:</strong> <?= $birthdate ?></p>
            <p><strong>Country:</strong> <?= $country ?></p>
            <p><strong>Gender:</strong> <?= ucfirst($gender) ?></p>
        </div>
        <div class="buttons">
             <form method="post" style="margin:0;">
                <input type="hidden" name="fullname" value="<?= $fullname ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="password" value="<?= $password ?>">
                <input type="hidden" name="number" value="<?= $number ?>">
                <input type="hidden" name="dob" value="<?= $birthdate ?>">
                <input type="hidden" name="country" value="<?= $country ?>">
                <input type="hidden" name="gender" value="<?= $gender ?>">
                <button type="submit" name="confirm" class="confirm-btn">Confirm</button>
            </form>
            <form action="Receptionist" method="get" style="margin:0;">
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