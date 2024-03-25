<!-- push_notification.php -->

<?php
// Connect to your database
$db = new PDO('sqlite:../database/baba.db');
$db->exec("PRAGMA foreign_keys = ON;");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare the SQL statement to insert a notification
$query = "INSERT INTO notification (message) VALUES ('New notification')";
$stmt = $db->prepare($query);

// Execute the SQL statement
$stmt->execute();

// Close the database connection
$db = null; // or $db = NULL; depending on your preference

// Redirect back to the index page after pushing the notification
header("Location: index.php");
exit();
?>
