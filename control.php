<?php
session_start();
if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
    echo "<script>
    window.location.href='admin.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body {
            background-color: rgb(188, 222, 215);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .user-logout {
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            padding: 10px 20px;
            background-color: rgb(188, 222, 215);
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
            background-color: rgba(11, 145, 13, 0.7);
            color: white;
            border: 2px solid rgb(14, 185, 14);
            transition: background-color 0.2s ease;
        }
        .buttons button:hover {
            background-color: rgb(9, 104, 57);
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
        <form action="Receptionist.php" method="get">
            <button type="submit">Receptionist registration Panel</button>
        </form>
        <form action="Receptionistinfo.php" method="get">
            <button type="submit">Receptionist Info</button>
        </form>
    </div>

    <script>
        function logout() {
            window.location.href = "logout_admin.php";
        }
    </script>
</body>
</html>
