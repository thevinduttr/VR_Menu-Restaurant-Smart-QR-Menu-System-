<?php
// Include the database connection file
include 'includes/con_db.php';

session_start(); // Start the session

// Check if the user is logged in as an admin
if (!isset($_SESSION['userName'])) {
    echo "<script>alert('Please log in as an admin first.'); window.location.href='admin_login.php';</script>";
    exit;
}

// Fetch all registered restaurants
$stmt = $conn->prepare("SELECT * FROM registered_restaurants");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="container mt-4">
        <h2>Registered Restaurants</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Whatsapp Number</th>
                    <th>Bussiness Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Registered Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['restaurant_id']; ?></td>
                    <td><?php echo $row['firstName']; ?></td>
                    <td><?php echo $row['lastName']; ?></td>
                    <td><?php echo $row['phoneNumber']; ?></td>
                    <td><?php echo $row['whatsappNumber']; ?></td>
                    <td><?php echo $row['businessName']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['reg_date']; ?></td>
                    
                    <td class="action-buttons">
                        <a href="includes/edit_restaurant.php?id=<?php echo $row['restaurant_id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="includes/delete_restaurant.php?id=<?php echo $row['restaurant_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>

