<?php
session_start();

// Clear session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear cookies if they are set
if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {
    setcookie('user_email', '', time() - 3600, '/'); // Set the expiration date to one hour ago
    setcookie('user_password', '', time() - 3600, '/');
}

// Redirect to the login page or your homepage
header("Location: ../login_page.php");
exit;
?>


