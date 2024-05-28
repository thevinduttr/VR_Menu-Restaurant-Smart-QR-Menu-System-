<?php
include 'con_db.php';

session_start(); // Start the session at the beginning

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login_page.php';</script>";
    exit;
}

// Fetch the email from the session or cookie
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '');

$stmt = $conn->prepare("SELECT restaurant_id FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$restaurant_id = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $restaurant_id = $row['restaurant_id'];
} else {
    echo "<script>alert('Restaurant not found.'); window.location.href='../dashboard.php';</script>";
    exit;
}

if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];

    $checkSubcategoryStmt = $conn->prepare("SELECT id, image FROM subcategories WHERE id = ? AND restaurant_id = ?");
    $checkSubcategoryStmt->bind_param("ii", $subcategory_id, $restaurant_id);
    $checkSubcategoryStmt->execute();
    $subcategoryResult = $checkSubcategoryStmt->get_result();

    if ($subcategoryResult->num_rows > 0) {
        $subcategoryData = $subcategoryResult->fetch_assoc();
        $imageToDelete = $subcategoryData['image'];

        $deleteSubcategoryStmt = $conn->prepare("DELETE FROM subcategories WHERE id = ?");
        $deleteSubcategoryStmt->bind_param("i", $subcategory_id);
        $deleteSubcategoryStmt->execute();
        $deleteSubcategoryStmt->close();

        // Delete associated image
        if (!empty($imageToDelete)) {
            $subcategoryImagePath = "uploads/" . $restaurant_id . "/subcategory/" . $imageToDelete;
            if (file_exists($subcategoryImagePath)) {
                unlink($subcategoryImagePath);
            }
        }

        echo "<script>alert('Subcategory deleted successfully.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid subcategory.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Subcategory ID not provided.'); window.location.href='../viewedit_menu.php';</script>";
    exit;
}
?>

