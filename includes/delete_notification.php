<script>console.log($_GET['id']);</script>

<?php


try {
    // Connect to the database
    $db = new PDO('sqlite:../database/baba.db');
    $db->exec("PRAGMA foreign_keys = ON;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if notification id is provided
    if (isset($_GET['id'])) {
        // Sanitize the input
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare and execute SQL query to delete notification
        $query = "DELETE FROM notification WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        // Check if any rows were affected (i.e., if the deletion was successful)
        $rowsAffected = $statement->rowCount();
        if ($rowsAffected > 0) {
            echo "Notification deleted successfully.";
        } else {
            echo "Notification with ID $id not found.";
        }
    } else {
        echo "Notification ID not provided.";
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
// Close the database connection
$db = null;
?>
