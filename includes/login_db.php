<?php
// Include the database connection file
include 'con_db.php';

// Function to sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    
    if ($email === "admin@vrm" && $password === "admin@vrm") {
        echo "<script>window.location.href='../admin_login.php';</script>";
        exit();
    }

    // Prepare a statement for user checking
    $stmt = $conn->prepare("SELECT * FROM registered_restaurants WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password matches
        if ($user['password'] === $password) {
            // Start session and set session variables
            session_start();
            $_SESSION['email'] = $email;

            // Set cookies for 30 days if 'Remember Me' is checked
            if (isset($_POST['rememberMe'])) {
                setcookie('user_email', $email, time() + (86400 * 30), "/");
                setcookie('user_password', $password, time() + (86400 * 30), "/");
            }

            // Login successful
            echo "<script>alert('Login successful!'); window.location.href='../dashboard.php';</script>";
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password.'); window.location.href='../login_page.php';</script>";
        }
    } else {
        // Email not registered
        echo "<script>alert('Email not registered.'); window.location.href='../login_page.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login_page.php");
    exit();
}
?>








