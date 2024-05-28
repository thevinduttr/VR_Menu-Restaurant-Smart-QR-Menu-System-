<?php
include 'includes/con_db.php'; // Adjust this path as necessary

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

// Fetch the business name for the restaurant
$nameStmt = $conn->prepare("SELECT businessName FROM registered_restaurants WHERE restaurant_id = ?");
$nameStmt->bind_param("i", $restaurant_id);
$nameStmt->execute();
$nameResult = $nameStmt->get_result();
if ($nameResult->num_rows > 0) {
    $nameRow = $nameResult->fetch_assoc();
    $businessName = $nameRow['businessName'];
} else {
    die("Restaurant not found.");
}

// Fetch categories and subcategories for the restaurant
$categoriesQuery = "SELECT * FROM categories WHERE restaurant_id = ?";
$categoriesStmt = $conn->prepare($categoriesQuery);
$categoriesStmt->bind_param("i", $restaurant_id);
$categoriesStmt->execute();
$categoriesResult = $categoriesStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Menu Preview</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Open Sans', sans-serif;
            color: #333;
        }
        .menu-container {
            padding: 20px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .category-title {
            font-weight: 700;
            color: #007bff;
            padding: 10px 0;
            border-bottom: 2px solid #007bff;
            margin-bottom: 15px;
        }
        .subcategory-item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .subcategory-name {
            font-weight: 600;
            flex-grow: 1;
        }
        .size-price-container {
            display: flex;
            flex-direction: column;
            text-align: right;
            align-items: flex-end;
        }
        .size-price {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            font-size: 0.9rem;
        }
        .size {
            color: #17a2b8; /* Attractive color for size */
            margin-right: 20px; /* Space between size and price */
        }
        .price {
            color: #28a745; /* Attractive color for price */
            font-weight: bold;
        }
        @media (max-width: 767px) {
            .size-price {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

    <div class="container menu-container">
        <h1 class="text-center mb-4 text-uppercase"><?php echo htmlspecialchars($businessName); ?> Menu</h1>

        <?php while ($category = $categoriesResult->fetch_assoc()): ?>
            <div>
                <h2 class="category-title"><?php echo htmlspecialchars($category['name']); ?></h2>
                
                <?php
                    $categoryId = $category['id'];
                    $subcategoriesQuery = "SELECT * FROM subcategories WHERE category_id = $categoryId";
                    $subcategoriesResult = $conn->query($subcategoriesQuery);

                    while ($subcategory = $subcategoriesResult->fetch_assoc()): ?>
                        <div class="subcategory-item">
                            <span class="subcategory-name"><?php echo htmlspecialchars($subcategory['name']); ?></span>
                            <div class="size-price-container">
                                <?php
                                for ($i = 1; $i <= 3; $i++) {
                                    $size = $subcategory["size$i"];
                                    $price = $subcategory["price$i"];
                                    if (!empty($size) && !empty($price)) {
                                        echo "<div class='size-price'>";
                                        echo "<span class='size'>" . htmlspecialchars($size) . ":</span>";
                                        echo "<span class='price'>Rs " . htmlspecialchars($price) . "</span>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class ="text-center">
            <span class="text-muted">&copy; All rights reserved. Owned By <a href ="https://nexcodia.com/" style="text-decoration:none">Nexcodia Software Solutions -</a></span>
            <span class="text-dark"><a href="https://vrmenu.lk/">www.vrmenu.lk</a></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
