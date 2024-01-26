<?php

$server = new PDO('sqlite:celestial_connections.db');

if(isset($_POST["username"]) && isset($_POST["password"])){
    $name = $_POST["username"];
    $pass = $_POST["password"];

    $query = $server->query("SELECT * FROM user WHERE username=$name and pass=$pass");

    $result = $query->fetchALL(PDO::FETCH_ASSOC);

    if($result == 1){
        var_dump($result);
    }
}

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
</head>
<body>
    <form action="" method="post">
        <input name="username" type="text" placeholder="Username">
        <input name="password" type="text" placeholder="Password">
        <button>send</button>
    </form>
</body>
</html>