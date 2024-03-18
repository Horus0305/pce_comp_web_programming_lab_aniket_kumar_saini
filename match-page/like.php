<?php
require("../includes/database_connect.php");
session_start();
$matchgender = '';
if ($_SESSION['gender'] == 'male') {
  $matchgender = 'female';
} else {
  $matchgender = 'male';
}

$s_id = $_POST['likesender'];
$r_id = $_POST['likereceiver'];

// Check if the like exists from s_id to r_id
$stmt2 = $conn->prepare("SELECT * FROM liketable WHERE s_id = :r_id AND r_id = :s_id");
$stmt2->bindParam(':r_id', $r_id);
$stmt2->bindParam(':s_id', $s_id);
$stmt2->execute();
$reciprocalLikeExists = $stmt2->fetch();

if ($reciprocalLikeExists) {
    // If both likes exist, delete both entries from liketable
    $stmtDelete = $conn->prepare("DELETE FROM liketable WHERE (s_id = :s_id AND r_id = :r_id) OR (s_id = :r_id AND r_id = :s_id)");
    $stmtDelete->bindParam(':s_id', $s_id);
    $stmtDelete->bindParam(':r_id', $r_id);
    $stmtDelete->execute();

    // Add a new entry to matchtable with matched set to 1
    $stmtInsert = $conn->prepare("INSERT INTO matchtable (u1, u2, matched) VALUES (:s_id, :r_id, 1)");
    $stmtInsert->bindParam(':s_id', $s_id);
    $stmtInsert->bindParam(':r_id', $r_id);
    $stmtInsert->execute();

    echo "Matched!";
}
else{
    $stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM liketable WHERE (s_id = :s_id AND r_id = :r_id) OR (s_id = :r_id AND r_id = :s_id)");
    $stmt->bindParam(':s_id', $s_id);
    $stmt->bindParam(':r_id', $r_id);
    $stmt->execute();
    $like_count = $stmt->fetch(PDO::FETCH_ASSOC)['like_count']; 

    if ($like_count > 0) {
        
        $delete_stmt = $conn->prepare("DELETE FROM liketable WHERE (s_id = :s_id AND r_id = :r_id) OR (s_id = :r_id AND r_id = :s_id)");
        $delete_stmt->bindParam(':s_id', $s_id);
        $delete_stmt->bindParam(':r_id', $r_id);
        $delete_stmt->execute();
        echo "Like removed successfully";
    } else {
        // Insert a new like record
        $insert_sql = "INSERT INTO liketable (s_id, r_id) VALUES (:s_id, :r_id)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bindParam(':s_id', $s_id);
        $insert_stmt->bindParam(':r_id', $r_id);
        $insert_stmt->execute();
        echo "Like added successfully";
    }
}
?>
