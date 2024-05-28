<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Menu</title>
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
        .category-image {
            width: 250px;
            height: 250px;
            margin-bottom: 25px;
            margin-right: 70px;
            border-radius: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .subcategory-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        h2 {
            text-transform: uppercase;
            color: #007bff;
            margin-bottom: 25px;
        }
        .btn-primary, .btn-edit, .btn-delete {
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        }
        .btn-primary {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-primary:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }
        .btn-edit {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-edit:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #bd2130;
            border-color: #bd2130;
        }
        @media screen and (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 30px;
            }
            .category-image{
                width: 100%;
                height: 250px;
            }
            
            .subcategory-image {
                width: 120px;
                height: 100px;
            }
            
            h1, h2 {
                font-size: 24px;
            }
            .table {
                font-size: 14px;
            }
            .btn {
                font-size: 12px;
                padding: 5px 10px;
            }
        }
        img {
            max-width: 100%;
            height: auto;
        }
        @media screen and (max-width: 600px) {
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/restaurant_navbar.php'; ?>
    <div class="container">
        <h1 class="text-center mb-4">View Menu</h1>
        <?php
        include 'includes/con_db.php'; // Database connection

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
            echo "<script>alert('Restaurant not found.'); window.location.href='dashboard.php';</script>";
            exit;
        }

        $categoriesQuery = "SELECT * FROM categories WHERE restaurant_id = $restaurant_id";
        $categoriesResult = $conn->query($categoriesQuery);
        if ($categoriesResult->num_rows > 0):
            while ($category = $categoriesResult->fetch_assoc()): ?>
                <div class="mb-5">
                    <h2>
                        <?php echo htmlspecialchars($category['name']); ?>
                        <a href="includes/delete_category.php?category_id=<?php echo $category['id']; ?>" class="btn btn-delete">Delete Category</a>
                    </h2>
                    <?php if ($category['image']): ?>
                        <img src="includes/uploads/<?php echo $restaurant_id; ?>/maincategory/<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="category-image">
                    <?php endif; ?>

                    <?php
                    $categoryId = $category['id'];
                    $subcategoriesQuery = "SELECT * FROM subcategories WHERE category_id = $categoryId";
                    $subcategoriesResult = $conn->query($subcategoriesQuery);
                    if ($subcategoriesResult->num_rows > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($subcategory = $subcategoriesResult->fetch_assoc()): ?>
                                    <?php for ($i = 1; $i <= 3; $i++): ?>
                                        <?php if (!empty($subcategory['size' . $i]) || $subcategory['price' . $i] != 0): ?>
                                            <tr>
                                                <?php if ($i == 1): ?>
                                                    <td><?php echo htmlspecialchars($subcategory['name']); ?></td>
                                                <?php else: ?>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td><?php echo !empty($subcategory['size' . $i]) ?  htmlspecialchars($subcategory['size' . $i]) : ''; ?></td>
                                                <td><?php echo ($subcategory['price' . $i] != 0) ?  htmlspecialchars($subcategory['price' . $i]) : ''; ?></td>
                                                <?php if ($i == 1): ?>
                                                    <td>
                                                        <?php if ($subcategory['image']): ?>
                                                            <img src="includes/uploads/<?php echo $restaurant_id; ?>/subcategory/<?php echo htmlspecialchars($subcategory['image']); ?>" alt="<?php echo htmlspecialchars($subcategory['name']); ?>" class="subcategory-image">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="includes/edit_subcategory.php?subcategory_id=<?php echo $subcategory['id']; ?>" class="btn btn-edit">Edit</a>
                                                        <a href="includes/delete_subcategory.php?subcategory_id=<?php echo $subcategory['id']; ?>" class="btn btn-delete">Delete</a>
                                                    </td>
                                                <?php else: ?>
                                                    <td colspan="2"></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No subcategories found for this category.</p>
                    <?php endif; ?>
                </div>
            <?php endwhile;
        else: ?>
            <p>No categories found.</p>
        <?php endif; ?>

        <a href="add_menu.php" class="btn btn-primary">Add More Items to Menu</a>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $conn->close(); ?>











