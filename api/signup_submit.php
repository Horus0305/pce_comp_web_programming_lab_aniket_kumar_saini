<?php
require("../includes/database_connect.php");

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$name = $f_name . " " . $l_name;
$email = $_POST['email'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$password = sha1($password);

$db = new PDO('sqlite:../database/cosmicdestiny.db');

$sql = "SELECT * FROM $gender WHERE email=:email";
$stmt = $db->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$row_count = $stmt->rowCount();
if ($row_count != 0) {
    $response = array("success" => false, "message" => "This email id is already registered with us!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/signup.html";</script>';
    return;
}

$sql = "INSERT INTO $gender (name, email, pass, gender) VALUES (:name, :email, :password, :gender)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':gender', $gender);
$result = $stmt->execute();
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/signup.html";</script>';
    return;
}

$response = array("success" => true, "message" => "Your account has been created successfully!");
echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/main.html";</script>';
$db = null;
?>