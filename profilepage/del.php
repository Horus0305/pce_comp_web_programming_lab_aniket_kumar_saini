<?php
session_start();
require_once("../includes/database_connect.php");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data (sanitize them if needed)
    $email = $_POST['email'];
    $password = sha1($_POST['password']); // Assuming password is stored as SHA1 hash in the database
    
    // Escape special characters in the email and password to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Retrieve gender from session
    $gender = $_SESSION['gender'];

    // Construct the SQL query
    $sql = "DELETE FROM $gender WHERE email='$email' AND pass='$password'";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo '<script>alert("Account deleted successfully!"); window.location.href = "../landingpage/main.html";</script>';
        } else {
            echo '<script>alert("Invalid email and password."); window.location.href = "./profile.php";</script>';
        }
    } else {
        echo '<script>alert("Error deleting account: ' . $conn->error . '"); window.location.href = "./profile.php";</script>';
    }
}

// Close the database connection
$conn->close();
?>
