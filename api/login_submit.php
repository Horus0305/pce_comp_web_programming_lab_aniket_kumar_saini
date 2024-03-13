<?php
session_start();
require("../includes/database_connect.php");
$email = $_POST['email'];
$pass = sha1($_POST['password']);

$gender='';

function checkmale($email, $pass,$conn){
    $sql = "SELECT * FROM male WHERE email='$email' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $gender='male';
        $response = array("success" => true, "message" => "Login successful!");
        echo '<script>alert("'.$response["message"].'");window.location.href = "../profilepage/profile.php";</script>';
        return $result;
    }
    
}

function checkfemale($email, $pass,$conn){
    $sql = "SELECT * FROM female WHERE email='$email' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $gender='female';
        $response = array("success" => true, "message" => "Login successful!");
        echo '<script>alert("'.$response["message"].'");window.location.href = "../profilepage/profile.php";</script>';
        return $result;
    }
}

$result = checkfemale($email, $pass, $conn);
if (!$result) {
    $result = checkmale($email, $pass, $conn);
}
else{
    $response = array("success" => false, "message" => "Login M failed! Invalid email or password.");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/login.html";</script>';
}

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['gender'] = $row['gender'];
    // $_SESSION['email'] = $row['email'];
    $_SESSION['pass'] = $row['pass'];
    
} else {
    $response = array("success" => false, "message" => "User does not exist!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/login.html";</script>';
    return;
}
session_commit();
mysqli_close($conn);
?>
