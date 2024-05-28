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

// Fetch the restaurant ID based on the logged-in user's email
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

function uploadImage($file, $folderPath, $allowedExts = ['jpg', 'jpeg', 'png']) {
    $temp = explode(".", $file["name"]);
    $extension = end($temp);  // Get file extension

    if ((($file["type"] == "image/jpeg") || ($file["type"] == "image/jpg") || ($file["type"] == "image/png"))
        && in_array($extension, $allowedExts)) {
        if ($file["error"] > 0) {
            echo "Error: " . $file["error"] . "<br>";
            return "";
        } else {
            $newfilename = uniqid() . '_' . round(microtime(true)) . '.' . $extension; // Rename file with timestamp
            $destination = $folderPath . $newfilename;
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            move_uploaded_file($file["tmp_name"], $destination);
            return $newfilename; // Return the filename of the uploaded image
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
        return "";
    }
}

// Process and save category image
$categoryImage = '';
if (isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]['error'] === 0) {
    $categoryImagePath = "uploads/" . $restaurant_id . "/maincategory/";
    $categoryImage = uploadImage($_FILES["categoryImage"], $categoryImagePath);
}

// Check if the category already exists for the restaurant
$categoryName = $_POST["categoryName"];
$checkCategoryStmt = $conn->prepare("SELECT id FROM categories WHERE name = ? AND restaurant_id = ?");
$checkCategoryStmt->bind_param("si", $categoryName, $restaurant_id);
$checkCategoryStmt->execute();
$categoryResult = $checkCategoryStmt->get_result();

$categoryId = 0;
if ($categoryResult->num_rows > 0) {
    // Category exists, fetch its ID
    $categoryRow = $categoryResult->fetch_assoc();
    $categoryId = $categoryRow['id'];
} else {
    // Category does not exist, insert a new one
    $insertCategoryStmt = $conn->prepare("INSERT INTO categories (restaurant_id, name, image) VALUES (?, ?, ?)");
    $insertCategoryStmt->bind_param("iss", $restaurant_id, $categoryName, $categoryImage);
    $insertCategoryStmt->execute();
    $categoryId = $insertCategoryStmt->insert_id;
    $insertCategoryStmt->close();
}

$checkCategoryStmt->close();

// Process and save subcategory data
$names = $_POST['name'];
$size1_values = $_POST['size1'];
$size2_values = $_POST['size2'];
$size3_values = $_POST['size3'];
$price1_values = $_POST['price1'];
$price2_values = $_POST['price2'];
$price3_values = $_POST['price3'];

for ($i = 0; $i < count($names); $i++) {
    $subcategoryImage = '';
    if (isset($_FILES['subcategoryimage']['name'][$i]) && $_FILES['subcategoryimage']['error'][$i] === 0) {
        $subcategoryImagePath = "uploads/" . $restaurant_id . "/subcategory/";
        $file = [
            'name' => $_FILES['subcategoryimage']['name'][$i],
            'type' => $_FILES['subcategoryimage']['type'][$i],
            'tmp_name' => $_FILES['subcategoryimage']['tmp_name'][$i],
            'error' => $_FILES['subcategoryimage']['error'][$i],
            'size' => $_FILES['subcategoryimage']['size'][$i]
        ];
        $subcategoryImage = uploadImage($file, $subcategoryImagePath);
    }

    // Insert subcategory into the database
    $stmt_subcategory = $conn->prepare("INSERT INTO subcategories (restaurant_id, category_id, name, size1, size2, size3, price1, price2, price3, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_subcategory->bind_param("iissssssss", $restaurant_id, $categoryId, $names[$i], $size1_values[$i], $size2_values[$i], $size3_values[$i], $price1_values[$i], $price2_values[$i], $price3_values[$i], $subcategoryImage);
    $stmt_subcategory->execute();
}

$conn->close();
header("Location: ../viewedit_menu.php");
exit();
?>





