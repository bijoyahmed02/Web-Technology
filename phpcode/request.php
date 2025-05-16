<?php

        session_start();
        $_SESSION['username'] = $_POST['uname'];
        echo "Session has been set";

?>
