<?php
include 'con_db.php'; // Ensure this path is correct

session_start(); // Start the session at the beginning

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login_page.php';</script>";
    exit;
}

// Fetch the email from the session or cookie
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '');

// Fetch the restaurant ID
$stmt = $conn->prepare("SELECT restaurant_id FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Restaurant not found.'); window.location.href='../dashboard.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
$restaurant_id = $row['restaurant_id'];

// Generate a unique token
$token = bin2hex(random_bytes(16)); // 32 characters long

// Check if the restaurant already has a token
$checkTokenStmt = $conn->prepare("SELECT token FROM tokens WHERE restaurant_id = ?");
$checkTokenStmt->bind_param("i", $restaurant_id);
$checkTokenStmt->execute();
$tokenResult = $checkTokenStmt->get_result();

if ($tokenResult->num_rows > 0) {
    $tokenData = $tokenResult->fetch_assoc();
    $existingToken = $tokenData['token'];
    echo "" .$existingToken;
} else {
    // Insert the new token
    $insertTokenStmt = $conn->prepare("INSERT INTO tokens (restaurant_id, token) VALUES (?, ?)");
    $insertTokenStmt->bind_param("is", $restaurant_id, $token);
    $insertTokenStmt->execute();
    echo "" .$token;
}

$conn->close();
?>

