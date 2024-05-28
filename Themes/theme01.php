<?php
// Database connection and user check
include 'includes/con_db.php';  // Ensure the path is correct

// Redirect if not logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    header("Location: login_page.php");
    exit;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE['user_email'];

// Fetch the restaurant's business name and ID
$stmt = $conn->prepare("SELECT restaurant_id, businessName FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Restaurant not found.";
    $conn->close();
    exit;
}

$row = $result->fetch_assoc();
$restaurant_id = $row['restaurant_id'];
$businessName = htmlspecialchars($row['businessName']);

// Fetch categories for the restaurant
$categoriesQuery = $conn->prepare("SELECT * FROM categories WHERE restaurant_id = ?");
$categoriesQuery->bind_param("i", $restaurant_id);
$categoriesQuery->execute();
$categoriesResult = $categoriesQuery->get_result();
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
    
    <?php include 'includes/restaurant_navbar.php'; ?>

    <div class="container menu-container">
        <h1 class="text-center mb-4 text-uppercase"><?php echo $businessName; ?> - Menu Preview</h1>

        <?php while ($category = $categoriesResult->fetch_assoc()): ?>
            <div>
                <h2 class="category-title"><?php echo htmlspecialchars($category['name']); ?></h2>
                
                <?php
                    $categoryId = $category['id'];
                    $subcategoriesQuery = $conn->prepare("SELECT * FROM subcategories WHERE category_id = ?");
                    $subcategoriesQuery->bind_param("i", $categoryId);
                    $subcategoriesQuery->execute();
                    $subcategoriesResult = $subcategoriesQuery->get_result();

                    while ($subcategory = $subcategoriesResult->fetch_assoc()): ?>
                        <div class="subcategory-item">
                            <span class="subcategory-name"><?php echo htmlspecialchars($subcategory['name']); ?></span>
                            <div class="size-price-container">
                                <?php
                                for ($i = 1; $i <= 3; $i++) {
                                    $size = htmlspecialchars($subcategory["size$i"]);
                                    $price = htmlspecialchars($subcategory["price$i"]);
                                    if (!empty($size) && !empty($price)) {
                                        echo "<div class='size-price'>";
                                        echo "<span class='size'>" . $size . ":</span>";
                                        echo "<span class='price'>Rs " . $price . "</span>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endwhile; 
                    $subcategoriesQuery->close();
                    ?>
            </div>
        <?php endwhile; 
        $categoriesQuery->close();
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
$conn->close(); 
?>