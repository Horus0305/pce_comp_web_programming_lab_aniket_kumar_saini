<?php
session_start();
require_once("../includes/database_connect.php");

// Get id from URL parameter
$id = isset($_GET['id']) ? $_GET['id'] : "";

if (!empty($id)) {
    // Prepare and execute SQL query to fetch image content
    $stmt = $db->prepare("SELECT photocontent FROM male WHERE id=:id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Check if the image content is available
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Output appropriate headers
        header("Content-Type: image/png"); // Assuming images are PNG format
        
        // Output the image content
        echo $row['photocontent'];

    } else {
        // If no image content is available, output a default image
        // Change this to any default image you want to display
        readfile("./img/male-user.png");
    }
} else {
    // If id is missing, output a default image
    readfile("./img/male-user.png");
}

// Close the database connection
$db = null;
?>
