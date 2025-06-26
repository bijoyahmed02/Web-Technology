<?php
session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] = true)){
    header("Location: admin.php");
}
// Database connection
$conn = new mysqli("localhost", "root", "", "hrdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// LOGIN
if (isset($_POST['login'])) {
    $adminName = $_POST['Admin_Name'];
    $adminPassword = $_POST['Admin_Password'];

    // Use prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM manager WHERE Admin_Name = ? AND Admin_Password = ?");
    $stmt->bind_param("ss", $adminName, $adminPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['adminLogin'] = true;
        $_SESSION['adminId'] = $row['Id'];
        header("Location: control.php");
        exit();
    } else {
        echo "<script>alert('Username or password doesn\\'t match');</script>";
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
            background: rgb(184, 172, 223);
            font-family: Arial, sans-serif;
        }

        .log {
            display: flex;
            justify-content: center;
            text-align: center;
            margin-bottom: 50px;
        }

        .log-container {
            background-color: rgba(105, 215, 189, 0.93);
            padding: 20px;
            width: 360px;
            height: 275px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .log-container h1 {
            margin-bottom: 20px;
        }

        input[type="text"],
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
            margin-left: 58px;
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
            padding: 6px 26px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .login-btn {
            background-color: rgb(24, 9, 118);
            color: white;
            border: 2px solid rgb(157, 39, 39);
        }

        .login-btn:hover {
            background-color: rgb(2, 68, 31);
        }
        .back-btn {
            background-color: rgb(105, 10, 62);
            color: white;
            border: 2px solid rgb(157, 39, 39);
        }

        .back-btn:hover {
            background-color: rgb(191, 0, 201);
        }

        h1.title {
            color: rgb(33, 84, 4);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1 class="title">HOTEL GRAND COX'S</h1>

    <div class="log">
        <div class="log-container">
            <h2 style="color:rgb(65, 2, 68);">ADMIN LOGIN PANEL</h2>
            <form method="POST">
                <label for="Admin_Name">Username</label>
                <input type="text" name="Admin_Name" id="Admin_Name" placeholder="Admin Name" required>

                <label for="Admin_Password">Password</label>
                <input type="password" name="Admin_Password" id="Admin_Password" placeholder="Password" required>

                <div class="buttons">
                    <button type="submit" name="login" class="login-btn">LOGIN</button>
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
