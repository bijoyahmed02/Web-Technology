<?php
session_start();

if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] === true) {
    header("Location: ViewDetails.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hrdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $Password = $_POST['pass']; 

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($Password, $row['Password'])) {
            $_SESSION['userLogin'] = true;
            $_SESSION['userId'] = $row['Id'];
            setcookie('user_name', $row['Fullname'], time() + (86400 * 30), "/");
            setcookie('user_email', $row['Email'], time() + (86400 * 30), "/");
            header("Location: ViewDetails.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Grand Cox's</title>
    <link rel="icon" href="C:\Users\Asus\Downloads\anlogo.jpg" type="image/x-icon">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: url('/Assignment/runnyrem-LfqmND-hym8-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .log {
            display: flex;
            justify-content: center;
            text-align: center;
            margin-bottom: 50px;
        }

        .log-container {
            background-color: rgba(26, 211, 236, 0.927);
            padding: 20px;
            width: 360px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .log-container h1 {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 65%;
            padding: 6px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            display: block;
            text-align: left;
            margin-left: 55px;
            font-weight: bold;
            color: #000;
        }

        .buttons {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .buttons button {
            padding: 6px 30px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .login-btn {
            background-color: rgb(58, 79, 170);
            color: white;
            border: 2px solid rgb(39, 60, 157);
        }

        .login-btn:hover {
            background-color: rgb(2, 13, 68);
        }

        .back-btn {
            background-color: rgb(245, 0, 118);
            color: white;
            border: 2px solid rgb(216, 17, 123);
        }

        .back-btn:hover {
            background-color: rgb(66, 2, 25);
        }

        h1.title {
            color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1 class="title">Hotel Grand Cox's</h1>

    <div class="log">
        <div class="log-container">
            <h1>Login</h1>
            <form method="post">
                <label for="login_email">Email</label>
                <input type="email" name="email" id="login_email" placeholder="User Email" required>

                <label for="login_password">Password</label>
                <input type="password" name="pass" id="login_password" placeholder="Password" required>

                <div class="buttons">
                    <button type="submit" name="login" class="login-btn">Log in</button>
                </div>
            </form>

            <div class="buttons">
                <form action="index.html" method="get" style="margin: 0;">
                    <button type="submit" class="back-btn">Back</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
