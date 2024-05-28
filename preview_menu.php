<?php
include 'includes/con_db.php'; // Adjust the path as necessary
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    header("Location: login_page.php");
    exit;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE['user_email'];

$stmt = $conn->prepare("SELECT restaurant_id FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Restaurant not found.");
}
$row = $result->fetch_assoc();
$restaurant_id = $row['restaurant_id'];

$currentThemeStmt = $conn->prepare("SELECT selected_theme FROM theme WHERE restaurant_id = ?");
$currentThemeStmt->bind_param("i", $restaurant_id);
$currentThemeStmt->execute();
$currentThemeResult = $currentThemeStmt->get_result();
$currentTheme = $currentThemeResult->num_rows > 0 ? $currentThemeResult->fetch_assoc()['selected_theme'] : '';

$conn->close();

// List of allowed themes
$allowedThemes = ['theme01', 'theme02', 'theme03']; // Add your theme names here

// Redirect to the selected theme file
if ($currentTheme && in_array($currentTheme, $allowedThemes)) {
    $themePath = "Themes/$currentTheme.php";
    if (file_exists($themePath)) {
        include($themePath);
    } else {
        echo "Theme file not found. Please check the theme path.";
    }
} else {
    echo "No theme selected or invalid theme. Please select a valid theme.";
}
?>

