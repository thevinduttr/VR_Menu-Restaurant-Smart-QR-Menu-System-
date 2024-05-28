<?php
include 'includes/con_db.php'; // Adjust this path as necessary

// Retrieve and validate the token
$token = isset($_GET['token']) ? $_GET['token'] : '';
if (!$token) {
    die("Access Denied: Token is missing or invalid.");
}

// Fetch the restaurant ID associated with the token
$stmt = $conn->prepare("SELECT restaurant_id FROM tokens WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$tokenResult = $stmt->get_result();

if ($tokenResult->num_rows == 0) {
    die("Access Denied: Token is invalid.");
}

$restaurantRow = $tokenResult->fetch_assoc();
$restaurant_id = $restaurantRow['restaurant_id'];

// Fetch the current theme for the restaurant
$themeStmt = $conn->prepare("SELECT selected_theme FROM theme WHERE restaurant_id = ?");
$themeStmt->bind_param("i", $restaurant_id);
$themeStmt->execute();
$themeResult = $themeStmt->get_result();
$themeRow = $themeResult->fetch_assoc();
$selected_theme = $themeRow['selected_theme'] ?? '';

$conn->close();

// Dynamically include the selected theme file
if ($selected_theme) {
    $themeFilePath = "Themes/Public/$selected_theme.php";
    if (file_exists($themeFilePath)) {
        include($themeFilePath);
    } else {
        echo "The selected theme file does not exist.";
    }
} else {
    echo "No theme selected for this restaurant.";
}
?>

