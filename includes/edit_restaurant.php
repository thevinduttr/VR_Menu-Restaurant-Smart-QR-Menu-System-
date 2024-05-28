<?php
// Include the database connection file
include 'con_db.php';

session_start(); // Start the session

// Check if the user is logged in as an admin
if (!isset($_SESSION['userName'])) {
    echo "<script>alert('Please log in as an admin first.'); window.location.href='../admin_login.php';</script>";
    exit;
}

// Check if the restaurant ID is set in the URL
if (!isset($_GET['id'])) {
    echo "<script>alert('No restaurant selected.'); window.location.href='../admin_dashboard.php';</script>";
    exit;
}

$restaurantId = $_GET['id'];

// Fetch restaurant details
$stmt = $conn->prepare("SELECT * FROM registered_restaurants WHERE restaurant_id = ?");
$stmt->bind_param("i", $restaurantId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo "<script>alert('Restaurant not found.'); window.location.href='../admin_dashboard.php';</script>";
    exit;
}

$restaurantData = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize POST data
    // Implement your validation and sanitation here
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $whatsappNumber = $_POST['whatsappNumber'];
    $businessName = $_POST['businessName'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Remember to hash the password

    // Update restaurant details in the database
    $updateStmt = $conn->prepare("UPDATE registered_restaurants SET firstName=?, lastName=?, phoneNumber=?, whatsappNumber=?, businessName=?, email=?, password=? WHERE restaurant_id=?");
    $updateStmt->bind_param("sssssssi", $firstName, $lastName, $phoneNumber, $whatsappNumber, $businessName, $email, $password, $restaurantId);
    $updateStmt->execute();
    $updateStmt->close();

    echo "<script>alert('Restaurant details updated successfully.'); window.location.href='../admin_dashboard.php';</script>";
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Restaurant Details</h2>
        <form action="edit_restaurant.php?id=<?php echo $restaurantId; ?>" method="post">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $restaurantData['firstName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $restaurantData['lastName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $restaurantData['phoneNumber']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="whatsappNumber" class="form-label">Whatsapp Number</label>
                <input type="tel" class="form-control" id="whatsappNumber" name="whatsappNumber" value="<?php echo $restaurantData['whatsappNumber']; ?>">
            </div>
            <div class="mb-3">
                <label for="businessName" class="form-label">Business Name</label>
                <input type="text" class="form-control" id="businessName" name="businessName" value="<?php echo $restaurantData['businessName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $restaurantData['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $restaurantData['password']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
