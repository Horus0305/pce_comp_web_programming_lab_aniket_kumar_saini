<?php
require("../includes/database_connect.php");

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$name = $f_name . " " . $l_name;
$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo '<script>alert("'.$response["message"].'");</script>';
    return;
}

$row_count = mysqli_num_rows($result);
if ($row_count != 0) {
    $response = array("success" => false, "message" => "This email id is already registered with us!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../testAnimationLandingPage/signup.html";</script>';
    return;
}

$sql = "INSERT INTO users (name, email, pass) VALUES ( '$name', '$email', '$password')";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../testAnimationLandingPage/signup.html";</script>';
    return;
}

$response = array("success" => true, "message" => "Your account has been created successfully!");
echo '<script>alert("'.$response["message"].'");window.location.href = "../testAnimationLandingPage/main.html";</script>';
mysqli_close($conn);