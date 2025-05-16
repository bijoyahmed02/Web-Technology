<?php
        session_start();
        if (count($_SESSION) > 0) {
            echo "Hello ".$_SESSION['username'];
        }
        else {
            echo "No Session Data";
        }

?>