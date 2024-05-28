<?php
session_start();

// Check connection
include("con_db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    // Prepare and execute the query for db_admin table
    $stmt_admin = $conn->prepare("SELECT * FROM db_admin WHERE userName = ? AND password = ?");
    $stmt_admin->bind_param("ss", $userName, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    // Check if a matching record is found in db_admin table
    if ($result_admin->num_rows == 1) {
        // Successful login for admin, store userName in session
        $_SESSION['userName'] = $userName;
        header("Location: ../admin_dashboard.php");
        exit();
    } else {
        // If not found in db_admin, check in db_manager table
        $stmt_manager = $conn->prepare("SELECT * FROM database_manager WHERE userName = ? AND password = ?");
        $stmt_manager->bind_param("ss", $userName, $password);
        $stmt_manager->execute();
        $result_manager = $stmt_manager->get_result();

        // Check if a matching record is found in db_manager table
        if ($result_manager->num_rows == 1) {
            // Successful login for manager, store userName in session
            $_SESSION['userName'] = $userName;
            header("Location: ../manager_dashboard.php");
            exit();
        } else {
            // If not found in both tables, display error message
            echo "<script type='text/javascript'> alert('Please Enter Valid Information')</script>";
            echo "<script>window.location.href = '../admin_login.php';</script>";
        }

        $stmt_manager->close();
    }

    $stmt_admin->close();
}
?>





