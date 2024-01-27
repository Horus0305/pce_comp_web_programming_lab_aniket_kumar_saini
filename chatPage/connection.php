<?php

$pdo = new PDO("sqlite:celestial_connections.db");

$query = $pdo->query("SELECT * FROM chat");

$result = $query->fetchAll(PDO::FETCH_ASSOC);

// var_dump($result);

foreach($result as $row => $result)
{
    echo   $result["username"]  ;
}
?>
