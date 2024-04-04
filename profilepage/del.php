<?php
session_start();

// Connect to SQLite database using PDO
try {
    $db = new PDO('sqlite:../database/baba.db');
} catch (PDOException $e) {
    echo '<script>alert("Error connecting to the database: ' . $e->getMessage() . '"); window.location.href = "./profile.php";</script>';
    exit();
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data (sanitize them if needed)
    $email = $_POST['email'];
    $password = sha1($_POST['password']); // Assuming password is stored as SHA1 hash in the database
    
    // Escape special characters in the email and password to prevent SQL injection
    $email = $db->quote($email);
    $password = $db->quote($password);

    // Retrieve gender from session
    $gender = $_SESSION['gender'];

    // Construct the SQL query
    $sql = "DELETE FROM $gender WHERE email=$email AND pass=$password";

    // Execute the delete query
    $result = $db->exec($sql);

    if ($result !== false) {
        if ($result > 0) {
            echo '<script>alert("Account deleted successfully!"); window.location.href = "../landingpage/main.html";</script>';
        } else {
            echo '<script>alert("Invalid email and password."); window.location.href = "./profile.php";</script>';
        }
    } else {
        echo '<script>alert("Error deleting account: ' . $db->errorInfo()[2] . '"); window.location.href = "./profile.php";</script>';
    }
}

// Close the database connection
$db = null;
?>
