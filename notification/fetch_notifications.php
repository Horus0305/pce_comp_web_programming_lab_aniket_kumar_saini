<?php
// Connect to your database

$db = new PDO('sqlite:../database/baba.db');
$db->exec("PRAGMA foreign_keys = ON;");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn = $db;
// Fetch notifications from the database
$query = "SELECT * FROM notification ORDER BY id DESC";
$result = $db->query($query);


// Display notifications
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='notification'>Notification ID: " . $row['message'] . "</div>";
}

// Close database connection
$db = null; // or $db = NULL; depending on your preference
?>
