<?php
include 'includes/con_db.php'; // Adjust this path to your database connection file

// Redirect if not logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    header("Location: login_page.php");
    exit;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE['user_email'];

// Fetch the restaurant ID based on the logged-in user's email
$stmt = $conn->prepare("SELECT restaurant_id FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Restaurant not found.'); window.location.href='dashboard.php';</script>";
    exit;
}
$row = $result->fetch_assoc();
$restaurant_id = $row['restaurant_id'];

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
    <title>Preview Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --bg-color: #ecf0f1;
            --text-color: #2c3e50;
            --card-bg: #ffffff;
            --card-shadow: rgba(0, 0, 0, 0.1);
            --border-radius: 10px;
            --transition-duration: 0.3s;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            margin: 0;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px var(--card-shadow);
            padding: 20px;
            margin: 30px auto;
        }

        .navbar-custom {
            background: linear-gradient(to right, #3498db, #e74c3c);
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }

        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-logo {
            height: 60px;
            width: auto;
            margin-right: 15px;
        }

        .category-card {
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
            transition: transform var(--transition-duration);
            overflow: hidden;
            border: 1px solid var(--bg-color);
            border-radius: var(--border-radius);
            background-color: var(--card-bg);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-image {
            width: 100%;
            height: 230px;
            object-fit: fill;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
        }

        .category-name {
            display: block;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-color);
            padding: 10px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.8);
        }

        .subcategory-container {
            display: none;
            padding-left: 15px;
            padding-right: 15px;
        }

        .subcategory-details {
            display: flex;
            align-items: center;
            background-color: var(--card-bg);
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            box-shadow: 0 2px 5px var(--card-shadow);
            transition: transform var(--transition-duration);
            overflow: hidden;
            border: 1px solid var(--bg-color);
        }

        .subcategory-details:hover {
            transform: scale(1.02);
        }

        .subcategory-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }

        .subcategory-text {
            flex-grow: 1;
            text-align: left;
        }

        .subcategory-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .size-price-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .size-price {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .price {
            color: var(--secondary-color);
            font-weight: bold;
        }

        @media (min-width: 768px) {
            .category-card {
                margin-bottom: 30px;
            }

            .category-image {
                height: 300px;
                width:300px;
            }

            .category-name {
                font-size: 1.5rem;
            }

            .subcategory-details {
                margin-bottom: 30px;
            }

            .subcategory-image {
                width: 100px;
                height: 100px;
            }

            .subcategory-name {
                font-size: 1.5rem;
            }

            .size-price {
                font-size: 1rem;
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .navbar-custom {
                padding: 5px 0;
            }

            .navbar-brand {
                font-size: 20px;
            }

            .navbar-logo {
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/restaurant_navbar.php'; ?>
    
    <div class="container">
        <h1 class="text-center mb-4">Categories</h1>

        <?php if ($categoriesResult->num_rows > 0): ?>

            <?php while ($category = $categoriesResult->fetch_assoc()): ?>

                <div class="category-card" onclick="toggleSubcategories('subcategory-container-<?php echo $category['id']; ?>')">
                    <img src="includes/uploads/<?php echo $restaurant_id; ?>/maincategory/<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="category-image">
                    <span class="category-name"><?php echo htmlspecialchars($category['name']); ?></span>
                </div>

                <div class="subcategory-container" id="subcategory-container-<?php echo $category['id']; ?>">

                <?php
                    $categoryId = $category['id'];
                    $subcategoriesQuery = "SELECT * FROM subcategories WHERE category_id = $categoryId";
                    $subcategoriesResult = $conn->query($subcategoriesQuery);

                    if ($subcategoriesResult->num_rows > 0): ?>
                        <?php while ($subcategory = $subcategoriesResult->fetch_assoc()): ?>

                            <div class="subcategory-details">
                                <div>
                                    <img src="includes/uploads/<?php echo $restaurant_id; ?>/subcategory/<?php echo htmlspecialchars($subcategory['image']); ?>" alt="<?php echo htmlspecialchars($subcategory['name']); ?>" class="subcategory-image">
                                </div>
                                
                                <div class="subcategory-text">
                                    <div class="subcategory-name align-baseline"><?php echo htmlspecialchars($subcategory['name']); ?></div>
                                    
                                    <!-- Display sizes and prices if they are not null or zero -->
                                    <div class="size-price-container">
                                        <?php if (!empty($subcategory['size1']) && !empty($subcategory['price1'])): ?>
                                            <div class="size-price">Size <?php echo htmlspecialchars($subcategory['size1']); ?> : Price Rs <?php echo htmlspecialchars($subcategory['price1']); ?></div>
                                        <?php endif; ?>

                                        <?php if (!empty($subcategory['size2']) && !empty($subcategory['price2'])): ?>
                                            <div class="size-price">Size <?php echo htmlspecialchars($subcategory['size2']); ?> : Price Rs <?php echo htmlspecialchars($subcategory['price2']); ?></div>
                                        <?php endif; ?>

                                        <?php if (!empty($subcategory['size3']) && !empty($subcategory['price3'])): ?>
                                            <div class="size-price">Size <?php echo htmlspecialchars($subcategory['size3']); ?> : Price Rs <?php echo htmlspecialchars($subcategory['price3']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <p>No subcategories found for this category.</p>
                    <?php endif; ?>

                </div>
            <?php endwhile; ?>

        <?php else: ?>
            <p>No categories found.</p>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSubcategories(id) {
            var container = document.getElementById(id);
            container.style.display = (container.style.display === "none" || container.style.display === "") ? "block" : "none";
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>





