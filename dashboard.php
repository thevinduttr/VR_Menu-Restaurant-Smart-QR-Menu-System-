<?php
// Include the database connection file
include 'includes/con_db.php';

session_start(); // Start the session at the beginning

// Check if the user is logged in either via session or cookies
if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login_page.php';</script>";
    exit;
}

// Fetch user's data from session or cookie
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '');

$stmt = $conn->prepare("SELECT * FROM registered_restaurants WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found.'); window.location.href='login_page.php';</script>";
    exit;
}

$logoExists = !empty($userData['logo']);

// Handling File Upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["logo"])) {
    $target_dir = "includes/uploads/logo/";
    $fileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $userData['restaurant_id'] . '.' . $fileType;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["logo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href='dashboard.php';</script>";
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            // Update database with logo path
            $updateStmt = $conn->prepare("UPDATE registered_restaurants SET logo = ? WHERE email = ?");
            $logoPath = $userData['restaurant_id'] . '.' . $fileType;
            $updateStmt->bind_param("ss", $logoPath, $email);
            $updateStmt->execute();
            $updateStmt->close();
            echo "<script>alert('Logo uploaded successfully.'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href='dashboard.php';</script>";
        }
    }
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .dashboard-header {
            background: #495057;  /* Fallback for older browsers */
            background: -webkit-linear-gradient(to right, #1c92d2, #f2fcfe);
            background: linear-gradient(to right, #1c92d2, #f2fcfe);
            color: #fff;
            padding: 20px 0;
            text-align: center;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .dashboard-content {
            margin-top: 40px;
            padding: 20px;
        }

        .details-box {
            margin-bottom: 25px;
            padding: 25px;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .details-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: #17a2b8;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .icon {
            font-size: 1.7rem;
            margin-right: 10px;
            color: #17a2b8;
        }

        .lead {
            font-size: 1.1rem;
            color: #6c757d;
        }

        /* Custom Styles for Vertical Navbar */
        .page-content {
            margin-left: 250px; /* space for the navbar */
            padding: 20px;
        }

        .logo-preview img {
            max-width: 200px; /* Set the maximum width of the logo */
            height: auto; /* Maintain the aspect ratio */
        }

        .upload-form {
            margin-top: 20px;
            border: 2px dashed #17a2b8;
            padding: 20px;
            border-radius: 15px;
        }

        .upload-form h3 {
            color: #17a2b8;
        }

        .upload-form input[type="file"] {
            margin-top: 10px;
        }

        @media (max-width: 992px) {
            .page-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/restaurant_navbar.php'; ?>

    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome to <?php echo $userData['businessName']; ?>'s Dashboard</h1>
        </div>

        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="fas fa-id-card icon"></i>Restaurant ID</h5>
                        <p class="lead"><?php echo $userData['restaurant_id']; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="fas fa-user icon"></i>First Name</h5>
                        <p class="lead"><?php echo $userData['firstName']; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="fas fa-user icon"></i>Last Name</h5>
                        <p class="lead"><?php echo $userData['lastName']; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="fas fa-phone icon"></i>Phone Number</h5>
                        <p class="lead"><?php echo $userData['phoneNumber']; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="fab fa-whatsapp icon"></i>WhatsApp Number</h5>
                        <p class="lead"><?php echo $userData['whatsappNumber']; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="details-box">
                        <h5 class="card-title"><i class="far fa-envelope icon"></i>Email</h5>
                        <p class="lead"><?php echo $userData['email']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!$logoExists): ?>
            <!-- Logo Upload Form -->
            <div class="upload-form">
                <h3>Upload Logo</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="logo" id="logo" class="form-control">
                    <input type="submit" value="Upload Image" name="submit" class="btn btn-primary mt-3">
                </form>
            </div>
        <?php else: ?>
            <!-- Logo Preview -->
            <div class="logo-preview mt-3">
                <h3>Logo</h3>
                <img src="includes/uploads/logo/<?php echo $userData['logo']; ?>" alt="Restaurant Logo" class="img-fluid">
            </div>
        <?php endif; ?>
    </div>

    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>
</html>



