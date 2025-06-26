<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if (!(isset($_SESSION['userLogin']) && $_SESSION['userLogin'] === true)) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$user_name = "User";
if (isset($_COOKIE['user_name']) && !empty($_COOKIE['user_name'])) {
    $user_name = htmlspecialchars($_COOKIE['user_name']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User</title>
    <style>
        body {
            background: rgb(201, 196, 159);
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 60%;
            margin: 20px auto;
            border: 1px solid #ccc;
        }

        .row {
            display: flex;
            border-bottom: 1px solid #ddd;
            background-color: hwb(153 68% 11%);
            height: 390px;
            width: 100%;
        }

        .col {
            flex: 1;
            padding: 0;
            border-right: 1px solid #ddd;
        }

        .col:last-child {
            border-right: none;
        }

        .buttons {
            margin-top: 10px;
            display: flex;
        }

        .buttons button {
            padding: 6px 20px;
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
            background-color: rgb(29, 44, 117);
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-logout {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 10px;
            position: sticky;
            top: 0;
            z-index: 100;
            background-color: rgb(201, 196, 159);
        }

        .log-out, .user-name {
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

        .log-out:hover, .user-name:hover {
            background-color: rgb(36, 14, 162);
        }
    </style>
</head>
<body>
    <div class="user-logout">
        <button class="user-name" id="usernamebtn"
            onmouseover="showUsername()"
            onmouseout="resetUsername()">Username</button>
        <form method="get" style="margin: 0;">
            <button type="submit" name="action" value="logout" class="log-out">Logout</button>
        </form>
    </div>

    <div class="container">

        <!-- Room 1 -->
        <div class="row">
            <div class="col">
                <img src="vojtech-bruzek-Yrxr3bsPdS0-unsplash.jpg" alt="Room Image">
            </div>
            <div class="col" style="font-size: 18px; margin-left:10px;">
                <h2 style="color: rgb(21, 16, 156); margin-bottom: 10px;">Deluxe Double Room</h2>
                <p><strong>1 Double Bed</strong></p>
                <p>Price: BDT 2,500</p>
                <p>Person allow: 4</p>
                <p><strong>Facilities:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Air conditioning</li>
                    <li>Ensuite bathroom</li>
                    <li>Flat-screen TV</li>
                    <li>Free WiFi</li>
                </ul>
                <div class="buttons">
                    <form action="page1.php" method="post" style="margin: 0;">
                        <button type="submit" name="room" value="deluxe_double" class="login-btn">Booking now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Room 2 -->
        <div class="row">
            <div class="col">
                <img src="visualsofdana-T5pL6ciEn-I-unsplash.jpg" alt="Room Image">
            </div>
            <div class="col" style="font-size: 18px; margin-left:10px;">
                <h2 style="color: rgb(21, 16, 156); margin-bottom: 10px;">Deluxe Single Room</h2>
                <p><strong>1 Double Bed</strong></p>
                <p>Price: BDT 1,800</p>
                <p>Person allow: 2</p>
                <p><strong>Facilities:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Air conditioning</li>
                    <li>Ensuite bathroom</li>
                    <li>Flat-screen TV</li>
                    <li>Free WiFi</li>
                </ul>
                <div class="buttons">
                    <form action="page2.php" method="post" style="margin: 0;">
                        <button type="submit" name="room" value="deluxe_single" class="login-btn">Booking now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Room 3 -->
        <div class="row">
            <div class="col">
                <img src="vojtech-bruzek-Yrxr3bsPdS0-unsplash.jpg" alt="Room Image">
            </div>
            <div class="col" style="font-size: 18px; margin-left:10px;">
                <h2 style="color: rgb(21, 16, 156); margin-bottom: 10px;">Family Double Room</h2>
                <p><strong>2 Double Beds</strong></p>
                <p>Price: BDT 4,500</p>
                <p>Person allow: 8</p>
                <p><strong>Facilities:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Air conditioning</li>
                    <li>Ensuite bathroom</li>
                    <li>Flat-screen TV</li>
                    <li>Free WiFi</li>
                </ul>
                <div class="buttons">
                    <form action="page3.php" method="post" style="margin: 0;">
                        <button type="submit" name="room" value="family_double" class="login-btn">Booking now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Room 4 -->
        <div class="row">
            <div class="col">
                <img src="visualsofdana-T5pL6ciEn-I-unsplash.jpg" alt="Room Image">
            </div>
            <div class="col" style="font-size: 18px; margin-left:10px;">
                <h2 style="color: rgb(21, 16, 156); margin-bottom: 10px;">Family Single Room</h2>
                <p><strong>4 Single Beds</strong></p>
                <p>Price: BDT 5,000</p>
                <p>Person allow: 8</p>
                <p><strong>Facilities:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Air conditioning</li>
                    <li>Ensuite bathroom</li>
                    <li>Flat-screen TV</li>
                    <li>Free WiFi</li>
                </ul>
                <div class="buttons">
                    <form action="page4.php" method="post" style="margin: 0;">
                        <button type="submit" name="room" value="family_single" class="login-btn">Booking now</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        const userName = <?php echo json_encode($user_name); ?>;

        function showUsername() {
            document.getElementById("usernamebtn").innerText = userName;
        }

        function resetUsername() {
            document.getElementById("usernamebtn").innerText = "Username";
        }
    </script>
</body>
</html>
