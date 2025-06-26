<?php
session_start();
session_unset();
session_destroy();

// Prevent caching of previous pages
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: login.php");
exit();
?>
