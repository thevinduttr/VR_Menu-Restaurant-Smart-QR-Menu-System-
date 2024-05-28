<?php

$servername = "localhost";
$username = "u756434494_vrmenu";
$password = "FLc/qMFC[w0";
$dbname = "u756434494_vrmenu_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for and set session or cookies if they exist
if(isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {
    $_SESSION['email'] = $_COOKIE['user_email'];
    $_SESSION['password'] = $_COOKIE['user_password'];
}
?>





