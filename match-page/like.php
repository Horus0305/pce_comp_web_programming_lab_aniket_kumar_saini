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

$s_id = $_POST['likesender'];
$r_id = $_POST['likereceiver'];

function checkSameLike($s_id, $r_id, $conn){
  $stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM liketable WHERE (s_id = :s_id AND r_id = :r_id)");
  $stmt->bindParam(':s_id', $s_id);
  $stmt->bindParam(':r_id', $r_id);
  $stmt->execute();
  $like_count = $stmt->fetch(PDO::FETCH_ASSOC)['like_count']; 
  return $like_count > 0;
}
function checkReciprocalLike($s_id, $r_id, $conn, $gender, $matchgender){
    $stmt2 = $conn->prepare("SELECT * FROM liketable WHERE s_id = :r_id AND r_id = :s_id");
    $stmt2->bindParam(':r_id', $r_id);
    $stmt2->bindParam(':s_id', $s_id);
    $stmt2->execute();
    $reciprocalLikeExists = $stmt2->fetch();

    if ($reciprocalLikeExists) {
        // Add a new entry to matchtable with matched set to 1
        $stmtInsert = $conn->prepare("INSERT INTO matchtable ($gender, $matchgender, matched) VALUES (:s_id, :r_id, 1)");
        $stmtInsert->bindParam(':s_id', $s_id);
        $stmtInsert->bindParam(':r_id', $r_id);
        $stmtInsert->execute();

        // Update the matched value in male and female tables
        $stmtUpdate = $conn->prepare("UPDATE $gender SET matched = 1 WHERE id = :s_id");        
        $stmtUpdate->bindParam(':s_id', $s_id);
        $stmtUpdate->execute();
        $stmtUpdate = $conn->prepare("UPDATE $matchgender SET matched = 1 WHERE id = :r_id");
        $stmtUpdate->bindParam(':r_id', $r_id);
        $stmtUpdate->execute();
        
        return true;
    }
    return false;
}
function insertLike($s_id, $r_id, $conn, $gender, $matchgender) {
  $insert_sql = "INSERT INTO liketable (s_id, r_id) VALUES (:s_id, :r_id)";
  $insert_stmt = $conn->prepare($insert_sql);
  $insert_stmt->bindParam(':s_id', $s_id);
  $insert_stmt->bindParam(':r_id', $r_id);
  
  // Execute the insertion
  $inserted = $insert_stmt->execute();
  
  if ($inserted) {
      // Check if a reciprocal like exists
      $reciprocalLikeExists = checkReciprocalLike($s_id, $r_id, $conn, $gender, $matchgender);
      
      // Return true if the like was inserted and a reciprocal like exists
      return $reciprocalLikeExists;
  } else {
      // Return false if the like insertion failed
      return false;
  }
}


function deleteLike($s_id, $r_id, $conn) {
  $delete_stmt = $conn->prepare("DELETE FROM liketable WHERE (s_id = :s_id AND r_id = :r_id) OR (s_id = :r_id AND r_id = :s_id)");
  $delete_stmt->bindParam(':s_id', $s_id, PDO::PARAM_INT);
  $delete_stmt->bindParam(':r_id', $r_id, PDO::PARAM_INT);
  $delete_stmt->execute();
  return $delete_stmt->rowCount() > 0;
}

if(!checkSameLike($s_id, $r_id, $conn)){
  insertLike($s_id, $r_id, $conn, $gender,$matchgender);
}else{
  deleteLike($s_id, $r_id, $conn);
}

?>
