<?php
require("../includes/database_connect.php");
session_start();
$matchgender = '';
$gender = $_SESSION['gender'];
if ($gender == 'male') {
  $matchgender = 'female';
} else {
  $matchgender = 'male';
}

$s_id = $_POST['disliker'];
$r_id = $_POST['disliked'];


function deleteEntriesAndResetMatches($conn, $s_id, $r_id, $gender, $matchgender) {
    // Delete entries from the liketable
    $delete_sql = "DELETE FROM liketable WHERE (s_id = :s_id AND r_id = :r_id) OR (s_id = :r_id AND r_id = :s_id)";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bindParam(':s_id', $s_id);
    $delete_stmt->bindParam(':r_id', $r_id);
    $delete_stmt->execute();

    // Reset matched column in male and female tables
    $reset_sql = "UPDATE $gender SET matched = 0 WHERE id = :s_id";
    $reset_stmt = $conn->prepare($reset_sql);
    $reset_stmt->bindParam(':s_id', $s_id);
    $reset_stmt->execute();

    $reset_sql = "UPDATE $matchgender SET matched = 0 WHERE id = :r_id";
    $reset_stmt = $conn->prepare($reset_sql);
    $reset_stmt->bindParam(':r_id', $r_id);
    $reset_stmt->execute();

    // Set matched column to 0 in matchtable
    $reset_matchtable_sql = "UPDATE matchtable SET matched = 0 WHERE ($gender = :s_id AND $matchgender = :r_id) OR ($gender = :r_id AND $matchgender = :s_id)";
    $reset_matchtable_stmt = $conn->prepare($reset_matchtable_sql);
    $reset_matchtable_stmt->bindParam(':s_id', $s_id);
    $reset_matchtable_stmt->bindParam(':r_id', $r_id);
    $reset_matchtable_stmt->execute();
}
deleteEntriesAndResetMatches($conn, $s_id, $r_id, $gender, $matchgender);
?>
