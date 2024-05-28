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
$categoriesStmt = $conn->prepare("SELECT * FROM categories WHERE restaurant_id = ?");
$categoriesStmt->bind_param("i", $restaurant_id);
$categoriesStmt->execute();
$categoriesResult = $categoriesStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            font-family: 'Arial', sans-serif;
            color: #fff;
            margin-top: 50px;
        }

        .section-title h2 {
            color: #f8f9fa;
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .section-title p {
            color: #a2a2a2;
            text-align: center;
        }

        .menu {
            padding: 60px 0;
        }

        .menu-item {
            margin-bottom: 30px;
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-img {
            border-radius: 50%;
            width: 90px; /* Fixed size */
            height: 90px; /* Fixed size */
            object-fit: cover;
            margin-right: 20px;
        }

        .menu-content {
            display: flex;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .details {
            margin-top: 10px;
        }

        .details a {
            font-size: 0.9rem;
            color: #f8f9fa;
            text-transform: uppercase;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .menu-ingredients {
            color: #a2a2a2;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        #menu-filters {
            display: flex;
            overflow-x: auto;
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
            scrollbar-width: thin;
            scrollbar-color: #343a40 #121212;
        }

        #menu-filters::-webkit-scrollbar {
            height: 12px;
        }

        #menu-filters::-webkit-scrollbar-track {
            background: #121212;
        }

        #menu-filters::-webkit-scrollbar-thumb {
            background-color: #343a40;
            border-radius: 20px;
            border: 3px solid #121212;
        }

        #menu-filters li {
            padding: 10px 25px;
            font-size: 1rem;
            font-weight: 600;
            color: #a2a2a2;
            cursor: pointer;
            margin: 0 10px;
            border-radius: 25px;
            background-color: #333;
            white-space: nowrap;
            transition: background-color 0.3s;
        }

        #menu-filters li:hover,
        #menu-filters li.filter-active {
            background-color: #007bff;
            color: #fff;
        }

        .menu-container {
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .menu-img {
                margin-right: 0;
                margin-bottom: 15px;
                padding-right:3px;
            }

            .menu-content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                text-align: center;
                padding-right:5px;
                padding-left:5px;
            }

            .details {
                margin-top: 0;
                
            }

            .menu-ingredients {
                margin-top: 0;
                text-align: left;
                padding-left:7px;
            }
        }
    </style>
</head>

<body>

    <section id="menu" class="menu section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Menu</h2>
                <p>Check Our Tasty Menu</p>
            </div>

            <ul id="menu-filters">
                <li class="filter-active" data-filter="*">All</li>
                <?php foreach ($categoriesResult as $category): ?>
                    <li data-filter=".category-<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="row menu-container">
                <?php foreach ($categoriesResult as $category): ?>
                    <?php
                    $categoryId = $category['id'];
                    $subcategoriesStmt = $conn->prepare("SELECT * FROM subcategories WHERE category_id = ?");
                    $subcategoriesStmt->bind_param("i", $categoryId);
                    $subcategoriesStmt->execute();
                    $subcategoriesResult = $subcategoriesStmt->get_result();

                    while ($subcategory = $subcategoriesResult->fetch_assoc()):
                        $imageUrl = "includes/uploads/{$restaurant_id}/subcategory/" . htmlspecialchars($subcategory['image']);
                    ?>
                        <div class="col-lg-4 menu-item category-<?php echo $category['id']; ?>">
                            <div class="menu-content">
                                <img src="<?php echo $imageUrl; ?>" class="menu-img" alt="">
                                <div class="details">
                                    <a href="#"><?php echo htmlspecialchars($subcategory['name']); ?></a>
                                </div>
                                <div class="menu-ingredients">
                                    <?php for ($i = 1; $i <= 3; $i++): ?>
                                        <?php if (!empty($subcategory["size$i"]) && !empty($subcategory["price$i"])): ?>
                                            <div><span><?php echo htmlspecialchars($subcategory["size$i"]); ?>:</span> $<?php echo htmlspecialchars($subcategory["price$i"]); ?></div>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for filtering menu items
        const menuFilters = document.querySelectorAll('#menu-filters li');
        const menuItems = document.querySelectorAll('.menu-item');

        menuFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                let selectedFilter = this.getAttribute('data-filter');
                menuItems.forEach(item => {
                    if (selectedFilter === '*' || item.classList.contains(selectedFilter.slice(1))) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

                menuFilters.forEach(filter => {
                    filter.classList.remove('filter-active');
                });

                this.classList.add('filter-active');
            });
        });
    </script>
</body>

</html>
<?php $conn->close(); ?>
