<?php
session_start();
if (!(isset($_SESSION['receptinistLogin']) && $_SESSION['receptinistLogin'] = true)){
    echo"<script>
    window.location.href='Rlogin.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body {
            background-color: rgb(150, 202, 98);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .user-logout {
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            padding: 10px 20px;
            background-color: rgb(150, 202, 98);
            position: sticky;
            top: 0;
            z-index: 100;
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

        .buttons {
            margin-top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px; /* Space between buttons */
        }
        .buttons form {
            margin: 0;
            width: 250px;
        }
        .buttons button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            background-color: rgb(126, 4, 4);
            color: white;
            border: 2px solid rgb(191, 30, 30);
            transition: background-color 0.2s ease;
        }
        .buttons button:hover {
            background-color:  rgb(67, 6, 6);
        }
    </style>
</head>
<body>
    <div class="user-logout">
        <button class="log-out" onclick="logout()">Logout</button>
    </div>
    <div class="buttons">
        <form action="registration.html" method="get">
            <button type="submit">User Registration Panel</button>
        </form>
        <form action="Userinfo.php" method="get">
            <button type="submit">User Information</button>
        </form>
        <form action="bookingInfo.php" method="get">
            <button type="submit">Booking Information</button>
        </form>
        <form action="payment.php" method="get">
            <button type="submit">Payment Details</button>
        </form>
    </div>

    <script>
        function logout() {
            window.location.href = "logout_receptionist.php";
        }
    </script>
</body>
</html>
