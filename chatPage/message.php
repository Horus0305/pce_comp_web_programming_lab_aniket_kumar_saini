<?php
// error_reporting(0);
$db_path = "../database/baba.db";
$pdo = new PDO("sqlite:" .$db_path);

$mess = $_POST["message"];
$time = $_POST["time"];
$name = $_POST["name"];
$time2 = $_POST["time2"];

//storing data into database.
try{
    $query1 = $pdo->prepare("INSERT INTO chat (username , message, date, date2) VALUES (:username, :mess, :date, :date2)");
    $query1->bindParam(':username',$name);
    $query1->bindParam(':mess',$mess);
    $query1->bindParam(':date',$time);
    $query1->bindParam(':date2',$time2);
    $query1->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>