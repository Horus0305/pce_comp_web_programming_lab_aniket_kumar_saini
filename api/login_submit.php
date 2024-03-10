<?php
session_start();
require("../includes/database_connect.php");

$email = $_POST['email'];
$pass = sha1($_POST['password']);
$sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../testAnimationLandingPage/login.html";</script>';
    return;
}

$row_count = mysqli_num_rows($result);
if ($row_count == 0) {
    $response = array("success" => false, "message" => "Login failed! Invalid email or password.");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../testAnimationLandingPage/login.html";</script>';
    return;
}

$row = mysqli_fetch_assoc($result);
$_SESSION['email'] = $row['email'];
$_SESSION['password'] = $row['pass'];
session_commit();
$response = array("success" => true, "message" => "Login successful!");
echo '<script>alert("'.$response["message"].'");window.location.href = "../profilepage/profile.php";</script>';
mysqli_close($conn);