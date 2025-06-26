<?php
session_start();
session_destroy();

// Prevent caching of previous pages
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to login/admin page
header("Location: admin.php");
exit();
?>
