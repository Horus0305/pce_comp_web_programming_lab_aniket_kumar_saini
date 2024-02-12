<?php
// error_reporting(0);

$pdo = new PDO("sqlite:celestial_connections.db");

$mess = $_POST["message"];
$time = $_POST["time"];
$name = $_POST["name"];
echo $mess;

//storing data into database.
$query1 = $pdo->prepare("INSERT INTO chat (username , message, date) VALUES (:username, :mess, :date)");
$query1->bindParam(':username',$name);
$query1->bindParam(':mess',$mess);
$query1->bindParam(':date',$time);
$query1->execute();

//displaying the stored data according to the data.
// $query2 = $pdo->prepare('SELECT * FROM chat WHERE username = :username');
// $query2->bindValue(':username', $name, 3);


?>