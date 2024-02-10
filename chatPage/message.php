<?php
// error_reporting(0);

$pdo = new PDO("sqlite:celestial_connections.db");

$query = $pdo->query("SELECT username FROM chat ");

$result = $query->fetchAll(PDO::FETCH_ASSOC);

$name = $result[0]["username"];

// echo $_SERVER["REQUEST_METHOD"];

$mess = $_POST["message"];
$time = $_POST["time"];
echo $mess;

$query1 = $pdo->prepare("INSERT INTO chat (username , message, date) VALUES (:username, :mess, :date)");
$query1->bindParam(':username',$name);
$query1->bindParam(':mess',$mess);
$query1->bindParam(':date',$time);

$query1->execute();
?>