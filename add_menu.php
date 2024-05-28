<?php
// Include the database connection file
include 'includes/con_db.php';

session_start(); // Start the session at the beginning

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login_page.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <title>Category and Subcategory Form</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Poppins', sans-serif;
        }
        .form-container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s;
        }
        .form-container:hover {
            transform: scale(1.02);
        }
        .form-container label {
            font-weight: bold;
            color: #333333;
        }
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container button {
            margin-top: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container button,
        .form-container table {
            width: 100%;
        }
        .table-borderless td,
        .table-borderless th {
            border: none;
        }
        .table-borderless input {
            width: 80%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-success {
            background-color: #007BFF;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-success:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'includes/restaurant_navbar.php'; ?>  
    <div class="container form-container">
        <!-- Category and Subcategory Form -->
        <form id="categoryForm" method="POST" action="includes/addMenu_db.php" class="p-4" enctype="multipart/form-data">
            <div class="border-bottom border-danger mb-4">
                <!-- Category Name Input -->
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                    <!-- Category Image Input -->
                    <label for="categoryImage" class="form-label mt-2">Category Image</label>
                    <input type="file" class="form-control" id="categoryImage" name="categoryImage">
                </div>
                <!-- Subcategories Table -->
                <div id="subcategoriesContainer" class="mb-3">
                    <label class="form-label">Subcategories</label>
                    <table class="table table-bordered table-borderless" id="subcategoriesTable">
                        <tbody>
                            <!-- First Subcategory Row -->
                            <tr class="subcategory-row">
                                <td><input type="text" class="form-control" placeholder="Name" name="name[]" required></td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Size 1" name="size1[]" required>
                                    <input type="text" class="form-control" placeholder="Size 2" name="size2[]">
                                    <input type="text" class="form-control" placeholder="Size 3" name="size3[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Price 1" name="price1[]" required>
                                    <input type="text" class="form-control" placeholder="Price 2" name="price2[]">
                                    <input type="text" class="form-control" placeholder="Price 3" name="price3[]">
                                </td>
                                <td>
                                    <label for="subcategoryImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="subcategoryimage[]">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Add Subcategory Button -->
                <div class="mb-4">
                    <button type="button" class="btn btn-primary" id="addSubcategory">Add Subcategory</button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success">Save Category</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#addSubcategory").click(function () {
                var clonedRow = $(".subcategory-row:first").clone();
                clonedRow.find("input").val("");
                $("#subcategoriesTable tbody").append(clonedRow);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
