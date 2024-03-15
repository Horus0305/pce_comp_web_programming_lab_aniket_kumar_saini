<?php
session_start();
require("../includes/database_connect.php");
$email = $_POST['email'];
$pass = sha1($_POST['password']);

$gender = '';

function checkMale($email, $pass, $conn, &$gender) {
    $sql = "SELECT * FROM male WHERE email = '$email' AND pass = '$pass'";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row['email'] == $email && $row['pass'] == $pass) {
            $gender = 'male';
            $response = array("success" => true, "message" => "Login successful!");
            echo '<script>alert("'.$response["message"].'");window.location.href = "../profilepage/profile.php";</script>';
            return $result;
        }
    }
    return;
}

function checkFemale($email, $pass, $conn, &$gender) {
    $sql = "SELECT * FROM female WHERE email = '$email' AND pass = '$pass'";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row['email'] == $email && $row['pass'] == $pass) {
            $gender = 'female';
            $response = array("success" => true, "message" => "Login successful!");
            echo '<script>alert("'.$response["message"].'");window.location.href = "../profilepage/profile.php";</script>';
            return $result;
        }
    }return;
}

$result = checkFemale($email, $pass, $conn, $gender);
if (!$result) {
    $result = checkMale($email, $pass, $conn, $gender);
}

if($result){
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id'] = $row['id'];
    $_SESSION['gender'] = $gender;
    $_SESSION['pass'] = $row['pass'];
}
else {
    $response = array("success" => false, "message" => "Incorrect Details!");
    echo '<script>alert("'.$response["message"].'");window.location.href = "../landingpage/login.html";</script>';
    return;
}
session_commit();
$conn = null;
?>