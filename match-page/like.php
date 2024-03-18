<?php
require("../includes/database_connect.php");
session_start();

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
    $stmt = $conn->prepare("INSERT INTO liketable (s_id, r_id) VALUES (:s_id, :r_id)");
    $stmt->bindParam(':s_id', $s_id);
    $stmt->bindParam(':r_id', $r_id);
    $stmt->execute();
    echo "Like added successfully";
}


?>
