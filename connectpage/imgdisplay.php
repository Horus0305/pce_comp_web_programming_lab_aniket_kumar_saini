<?php
session_start(); // Start the session
$gender = $_SESSION['gender'];
$id = $_SESSION['id'];
$matchgender = ($gender == 'male') ? 'female' : 'male';
$id = $_GET['id'];


// Now, continue with fetching the image from the database
// Establish connection to the database
require_once("../includes/database_connect.php");

// Fetch image content from the database
$stmt = $db->prepare("SELECT photocontent FROM $matchgender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // Using user_id from session
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the image content is available
if ($row && $row['photocontent'] !== null) {
    // Output appropriate headers
    header("Content-Type: image/png"); // Adjust the content type based on the image type you're storing
    
    // Output the image content
    echo $row['photocontent'];
} else {
    // If no image content is available, output a default image
    // You can change this to any default image you want to display
    readfile("./img/male-user.png");
}

// Close the database connection
$db = null;
?>
