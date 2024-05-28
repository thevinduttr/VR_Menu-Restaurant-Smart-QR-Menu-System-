<?php
include 'includes/con_db.php'; // Adjust this path as necessary

session_start();

// Redirect if not logged in
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    header("Location: login_page.php");
    exit;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE['user_email'];

$stmt = $conn->prepare("SELECT restaurant_id FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Restaurant not found.");
}

$row = $result->fetch_assoc();
$restaurant_id = $row['restaurant_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_theme = $_POST['theme'];
    $updateStmt = $conn->prepare("REPLACE INTO theme (restaurant_id, selected_theme) VALUES (?, ?)");
    $updateStmt->bind_param("is", $restaurant_id, $selected_theme);
    $updateStmt->execute();
    $updateStmt->close();
}

$currentThemeStmt = $conn->prepare("SELECT selected_theme FROM theme WHERE restaurant_id = ?");
$currentThemeStmt->bind_param("i", $restaurant_id);
$currentThemeStmt->execute();
$currentThemeResult = $currentThemeStmt->get_result();
$currentTheme = $currentThemeResult->num_rows > 0 ? $currentThemeResult->fetch_assoc()['selected_theme'] : '';

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Choose Menu Theme</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
            color: #2c3e50; /* Dark blue-gray color */
            font-size: 2.8rem; /* Larger font size */
        }

        form {
            max-width: 550px;
            margin: auto;
            background-color: #ffffff;
            padding: 45px;
            border-radius: 18px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
            border: 1px solid #e0e0e0; /* Light gray border */
        }

        .form-check {
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 18px;
            border: 1px solid #d1d1d1; /* Light gray border */
            border-radius: 12px;
            background-color: #f9f9f9; /* Very light gray background */
            transition: background-color 0.2s, box-shadow 0.2s;
        }

        .form-check:hover {
            background-color: #f0f0f0; /* Slightly darker on hover */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .form-check-input {
            margin-top: 0;
        }

        label {
            margin-left: 15px;
            font-weight: 600;
            color: #343a40; /* Dark gray color */
        }

        button {
            margin-top: 35px;
            width: 100%;
            background-color: #17a2b8; /* Bootstrap info color */
            border: none;
            border-radius: 6px;
            padding: 16px;
            font-size: 1.2rem;
            color: #fff; /* White text color */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #138496; /* Darker blue on hover */
        }

        .theme-preview {
            text-align: center;
            margin-top: 25px;
        }

        .theme-preview img {
            width: 200px; /* Adjusted image size */
            height: 390px;
        }
    </style>
</head>

<body>
    <?php include 'includes/restaurant_navbar.php' ?>
    <div class="container">
        <h1>Choose Your Menu Theme</h1>
        <form action="" method="post">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme1" value="theme01"
                        <?php echo $currentTheme === 'theme01' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="theme1">Standard Theme (Only Text)</label>
                </div>
                <div class="theme-preview">
                    <img src="img/themes/theme01.png" alt="Standard Theme Preview">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme2" value="theme02"
                        <?php echo $currentTheme === 'theme02' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="theme2">Premium Theme (With Images)</label>
                </div>
                <div class="theme-preview">
                    <img src="img/themes/theme02.png" alt="Premium Theme Preview">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme3" value="theme03"
                        <?php echo $currentTheme === 'theme03' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="theme3">Dark Theme (With Subcategory Images)</label>
                </div>
                <div class="theme-preview">
                    <img src="img/themes/theme03.png" alt="Dark Theme Preview">
                </div>
            </div>
            <button type="submit">Save Theme</button>
        </form>
    </div>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
