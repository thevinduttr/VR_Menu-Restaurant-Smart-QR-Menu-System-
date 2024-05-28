<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subcategory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 60px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #17a2b8;
            border-color: #17a2b8;
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }

        .current-image {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<?php
    include 'restaurant_navbar.php';
    include 'con_db.php';

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

        // Fetch subcategory data
        $getSubcategoryStmt = $conn->prepare("SELECT * FROM subcategories WHERE id = ? AND restaurant_id = ?");
        $getSubcategoryStmt->bind_param("ii", $subcategory_id, $restaurant_id);
        $getSubcategoryStmt->execute();
        $subcategoryResult = $getSubcategoryStmt->get_result();

        if ($subcategoryResult->num_rows > 0) {
            $subcategoryData = $subcategoryResult->fetch_assoc();
        } else {
            echo "<script>alert('Invalid subcategory.'); window.location.href='../viewedit_menu.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Subcategory ID not provided.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['name'];
        $newSize1 = $_POST['size1'];
        $newSize2 = $_POST['size2'];
        $newSize3 = $_POST['size3'];
        $newPrice1 = $_POST['price1'];
        $newPrice2 = $_POST['price2'];
        $newPrice3 = $_POST['price3'];

        // Check if a new image file is uploaded
        if ($_FILES['image']['size'] > 0) {
            // Delete the previous image
            if (!empty($subcategoryData['image'])) {
                $previousImage = 'uploads/' . $restaurant_id . '/subcategory/' . $subcategoryData['image'];
                if (file_exists($previousImage)) {
                    unlink($previousImage);
                }
            }

            $uploadDir = 'uploads/' . $restaurant_id . '/subcategory/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);

            // Move the uploaded file to the destination folder
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

            // Update subcategory details with the new image
            $updateSubcategoryStmt = $conn->prepare("UPDATE subcategories SET name=?, size1=?, size2=?, size3=?, price1=?, price2=?, price3=?, image=? WHERE id=?");
            $updateSubcategoryStmt->bind_param("ssssssssi", $newName, $newSize1, $newSize2, $newSize3, $newPrice1, $newPrice2, $newPrice3, basename($_FILES['image']['name']), $subcategory_id);
        } else {
            // Update subcategory details without changing the image
            $updateSubcategoryStmt = $conn->prepare("UPDATE subcategories SET name=?, size1=?, size2=?, size3=?, price1=?, price2=?, price3=? WHERE id=?");
            $updateSubcategoryStmt->bind_param("sssssssi", $newName, $newSize1, $newSize2, $newSize3, $newPrice1, $newPrice2, $newPrice3, $subcategory_id);
        }

        $updateSubcategoryStmt->execute();
        $updateSubcategoryStmt->close();

        echo "<script>alert('Subcategory updated successfully.'); window.location.href='../viewedit_menu.php';</script>";
        exit;
    }
    ?>

    <div class="container">
        <h1 class="text-center mb-4">Edit Subcategory</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($subcategoryData['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="size1">Size 1</label>
                <input type="text" class="form-control" id="size1" name="size1" value="<?php echo htmlspecialchars($subcategoryData['size1']); ?>">
            </div>
            <div class="form-group">
                <label for="price1">Price 1</label>
                <input type="text" class="form-control" id="price1" name="price1" value="<?php echo htmlspecialchars($subcategoryData['price1']); ?>">
            </div>
            <div class="form-group">
                <label for="size2">Size 2</label>
                <input type="text" class="form-control" id="size2" name="size2" value="<?php echo htmlspecialchars($subcategoryData['size2']); ?>">
            </div>
            <div class="form-group">
                <label for="price2">Price 2</label>
                <input type="text" class="form-control" id="price2" name="price2" value="<?php echo htmlspecialchars($subcategoryData['price2']); ?>">
            </div>
            <div class="form-group">
                <label for="size3">Size 3</label>
                <input type="text" class="form-control" id="size3" name="size3" value="<?php echo htmlspecialchars($subcategoryData['size3']); ?>">
            </div>
            <div class="form-group">
                <label for="price3">Price 3</label>
                <input type="text" class="form-control" id="price3" name="price3" value="<?php echo htmlspecialchars($subcategoryData['price3']); ?>">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <?php if (!empty($subcategoryData['image'])) : ?>
                    <img src="uploads/<?php echo $restaurant_id; ?>/subcategory/<?php echo htmlspecialchars($subcategoryData['image']); ?>" alt="Current Image" class="current-image">
                <?php endif; ?>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Subcategory</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

