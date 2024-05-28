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
    // Retrieve and sanitize user inputs
    $firstName = sanitizeInput($_POST["firstName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $phoneNumber = sanitizeInput($_POST["phoneNumber"]);
    $whatsappNumber = sanitizeInput($_POST["whatsappNumber"]);
    $businessName = sanitizeInput($_POST["businessName"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]); // Storing as entered

    // Prepare a statement for email checking
    $stmt = $conn->prepare("SELECT * FROM registered_restaurants WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, handle accordingly
        echo "Email address already registered.";
    } else {
        // Prepare a statement for data insertion
        $insertStmt = $conn->prepare("INSERT INTO registered_restaurants (firstName, lastName, phoneNumber, whatsappNumber, businessName, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssssss", $firstName, $lastName, $phoneNumber, $whatsappNumber, $businessName, $email, $password);

        if ($insertStmt->execute()) {
            // Registration successful
            echo "<script>alert('Registration successful!'); window.location.href='../login_page.php';</script>";
        } else {
            // Registration failed
            echo "Error: " . $insertStmt->error;
        }

        // Close the insert statement
        $insertStmt->close();
    }

    // Close the initial statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect for invalid requests
    header("Location: registration_page.php");
    exit();
}
?>







 

