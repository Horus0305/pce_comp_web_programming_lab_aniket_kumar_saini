<?php
try {
    // Connect to your database
    $db = new PDO('sqlite:../database/baba.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch notifications from the database
    $query = "SELECT * FROM notification ORDER BY id DESC";
    $result = $db->query($query);

    // Initialize an array to store notifications
    $notifications = [];

    // Fetch notifications into the array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $notifications[] = $row;
    }

    // Close the database connection
    $db = null;

    // Send JSON response with notifications data
    header('Content-Type: application/json');
    echo json_encode($notifications);
} catch (PDOException $e) {
    // Handle database error
    echo json_encode(['error' => 'Database Error: ' . $e->getMessage()]);
}
?>
