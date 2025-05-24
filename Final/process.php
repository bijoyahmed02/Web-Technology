<?php
session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "aqidb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// LOGIN HANDLER (via AJAX)
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['pass'];

    $result = $conn->query("SELECT * FROM user WHERE Email='$email'");

    if ($result && $result->num_rows === 1) {
        
        $row = $result->fetch_assoc();
 
        //updated
        if (password_verify($pass, $row['Password'])) {
            $_SESSION['email'] = $row['Email']; // Store user email in session
            echo 'success';
        }
        else {
            echo 'fail';
        }
    } else {
        echo 'fail';
    }
    exit;
}

// CONFIRMATION HANDLER (final step to save user)
if (isset($_POST['confirm'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // already hashed
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $opinion = $_POST['opinion'];
    $color = $_POST['color'];

    $stmt = $conn->prepare("INSERT INTO user (Fullname, Email, Password, Dob, Country, Gender, Opinion, Color) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fullname, $email, $password, $dob, $country, $gender, $opinion, $color);

    if ($stmt->execute()) {
        echo "<script>
            alert('Information saved successfully!');
            window.location.href = 'index.html';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// INITIAL FORM SUBMISSION HANDLER (from index.html)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT); // encrypt here
    $birthdate = htmlspecialchars($_POST['dob']);
    $country = htmlspecialchars($_POST['country']);
    $gender = htmlspecialchars($_POST['gender']);
    $color = htmlspecialchars($_POST['color']);
    $opinion = htmlspecialchars($_POST['bio']);
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
                background:rgb(208, 178, 201);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #333;
            }

            .content {
                background-color:rgb(206, 228, 226);
                border-radius: 10px;
                padding: 40px 45px;
                max-width: 500px;
                width: 100%;
                transition: transform 0.2s ease;
            }

            .content:hover {
                transform: scale(1.02);
            }

            .content h2 {
                text-align: center;
                margin-bottom: 30px;
                color:rgb(21, 7, 7);
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
                padding: 10px 22px;
                border: none;
                border-radius: 6px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.2s ease;
            }

            .confirm-btn {
                background-color:rgb(58, 79, 170);
                color: white;
                border: 2px solid rgb(39, 60, 157);
            }

            .confirm-btn:hover {
                background-color:rgb(9, 26, 112);
            }

            .back-btn {
                background-color:rgb(245, 0, 118);
                color: white;
                border: 2px solid rgb(216, 17, 123);
            }

            .back-btn:hover {
                background-color:rgb(104, 9, 44);
            }
        </style>
    </head>
    <body>

    <div class="content">
        <h2>Confirm Your Information</h2>
        <div class="info">
            <p><strong>Full Name:</strong> <?= $fullname ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Birthdate:</strong> <?= $birthdate ?></p>
            <p><strong>Country:</strong> <?= $country ?></p>
            <p><strong>Gender:</strong> <?= ucfirst($gender) ?></p>
            <p><strong>Favorite Color:</strong> <span style="color: <?= $color ?>;"><?= $color ?></span></p>
            <p><strong>Opinion:</strong> <?= $opinion ?></p>
        </div>

        <div class="buttons">
            <form action="index.html" method="get" style="margin:0;">
                <button type="submit" class="back-btn">Back</button>
            </form>

            <form method="post" style="margin:0;">
                <!-- Hidden inputs to pass data -->
                <input type="hidden" name="fullname" value="<?= $fullname ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="password" value="<?= $password ?>">
                <input type="hidden" name="dob" value="<?= $birthdate ?>">
                <input type="hidden" name="country" value="<?= $country ?>">
                <input type="hidden" name="gender" value="<?= $gender ?>">
                <input type="hidden" name="opinion" value="<?= $opinion ?>">
                <input type="hidden" name="color" value="<?= $color ?>">
                <button type="submit" name="confirm" class="confirm-btn">Confirm</button>
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