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

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch category data
    $checkCategoryStmt = $conn->prepare("SELECT id, image FROM categories WHERE id = ? AND restaurant_id = ?");
    $checkCategoryStmt->bind_param("ii", $category_id, $restaurant_id);
    $checkCategoryStmt->execute();
    $categoryResult = $checkCategoryStmt->get_result();

    if ($categoryResult->num_rows > 0) {
        $categoryData = $categoryResult->fetch_assoc();
        $categoryImageToDelete = $categoryData['image'];

        // Temporarily disable foreign key checks
        $conn->query('SET foreign_key_checks = 0');

        // Delete all associated subcategory images
        $deleteSubcategoryImagesStmt = $conn->prepare("SELECT image FROM subcategories WHERE category_id = ?");
        $deleteSubcategoryImagesStmt->bind_param("i", $category_id);
        $deleteSubcategoryImagesStmt->execute();
        $subcategoryImagesResult = $deleteSubcategoryImagesStmt->get_result();

        while ($subcategoryImageData = $subcategoryImagesResult->fetch_assoc()) {
            $subcategoryImageToDelete = $subcategoryImageData['image'];
            if (!empty($subcategoryImageToDelete)) {
                $subcategoryImagePath = "uploads/" . $restaurant_id . "/subcategory/" . $subcategoryImageToDelete;
                if (file_exists($subcategoryImagePath)) {
                    unlink($subcategoryImagePath);
                }
            }
        }

        $deleteSubcategoryImagesStmt->close();

        // Delete main category image
        if (!empty($categoryImageToDelete)) {
            $categoryImagePath = "uploads/" . $restaurant_id . "/maincategory/" . $categoryImageToDelete;
            if (file_exists($categoryImagePath)) {
                unlink($categoryImagePath);
            }
        }

        // Delete category and associated subcategories
        $deleteCategoryStmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $deleteCategoryStmt->bind_param("i", $category_id);
        $deleteCategoryStmt->execute();
        $deleteCategoryStmt->close();

        // Delete associated subcategories
        $deleteSubcategoriesStmt = $conn->prepare("DELETE FROM subcategories WHERE category_id = ?");
        $deleteSubcategoriesStmt->bind_param("i", $category_id);
        $deleteSubcategoriesStmt->execute();
        $deleteSubcategoriesStmt->close();

        // Re-enable foreign key checks
        $conn->query('SET foreign_key_checks = 1');

        echo "<script>alert('Category and associated subcategories deleted successfully.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid category.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Category ID not provided.'); window.location.href='../viewedit_menu.php';</script>";
    exit;
}
?>




