<?php
// Include the database connection file
include 'con_db.php';

session_start(); // Start the session

// Check if the user is logged in as an admin
if (!isset($_SESSION['userName'])) {
    echo "<script>alert('Please log in as an admin first.'); window.location.href='../admin_login.php';</script>";
    exit;
}

// Check if restaurant ID is set
if (!isset($_GET['id'])) {
    echo "<script>alert('No restaurant specified.'); window.location.href='../admin_dashboard.php';</script>";
    exit;
}

$restaurant_id = $_GET['id'];

// Begin transaction
$conn->begin_transaction();

try {
    // Delete related records in the theme table
    $stmt = $conn->prepare("DELETE FROM theme WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $stmt->close();

    // Delete related tokens
    $stmt = $conn->prepare("DELETE FROM tokens WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $stmt->close();

    // Delete subcategories
    $stmt = $conn->prepare("DELETE FROM subcategories WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $stmt->close();

    // Delete categories
    $stmt = $conn->prepare("DELETE FROM categories WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $stmt->close();

    // Fetch restaurant logo path before deleting
    $stmt = $conn->prepare("SELECT logo FROM registered_restaurants WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $logoPath = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $logoPath = $row['logo'];
    }
    $stmt->close();

    // Delete the restaurant
    $stmt = $conn->prepare("DELETE FROM registered_restaurants WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $stmt->close();

    // Delete logo file if exists
    if ($logoPath != "") {
        $logoFullPath = "uploads/logo/" . $logoPath; // Corrected path
        if (file_exists($logoFullPath)) {
            unlink($logoFullPath);
        }
    }

    // Delete logo file if exists
    if ($logoPath != "") {
        // Ensure there is a slash between the directory and the file name
        $logoFullPath = "uploads/logo/" . $logoPath;
        if (file_exists($logoFullPath)) {
            unlink($logoFullPath);
        }
    }


    // Delete images from the server
    $uploadDir = "uploads/" . $restaurant_id;
    if (is_dir($uploadDir)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($uploadDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }

        rmdir($uploadDir);
    }

    // Commit transaction
    $conn->commit();

    echo "<script>alert('Restaurant and all related data successfully deleted.'); window.location.href='../admin_dashboard.php';</script>";
} catch (Exception $e) {
    // An error occurred, rollback transaction
    $conn->rollback();
    echo "<script>alert('Error occurred: " . $e->getMessage() . "'); window.location.href='../admin_dashboard.php';</script>";
}

$conn->close();
?>



