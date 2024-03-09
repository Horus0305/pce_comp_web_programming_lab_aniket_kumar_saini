<?php
include "D:/xampp/htdocs/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/chatPage/conn.php";

$name = "Happy";
$hob = $_POST['hobbies'];
$r = $_POST['req'];

try{
    $query1 = $pdo->prepare("INSERT INTO hob_req (username , hobbies, requirements) VALUES (:username, :hob, :req)");
    $query1->bindParam(':username',$name);
    $query1->bindParam(':hob',$hob);
    $query1->bindParam(':req',$r);
    $query1->execute();

    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>