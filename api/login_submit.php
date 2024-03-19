<?php
session_start();
require("../includes/database_connect.php"); // Assuming this file includes your database connection

$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format');window.location.href = '../landingpage/login.html';</script>";
    exit;
}
$pass = sha1($_POST['password']); // Note: SHA-1 is not recommended for password hashing due to security vulnerabilities. Consider using more secure methods like bcrypt.

$gender = '';

function checkMale($email, $pass, $conn, &$gender) {
    $sql = "SELECT * FROM male WHERE email = :email AND pass = :pass";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $gender = 'male';
        return $row;
    }
    return false;
}

function checkFemale($email, $pass, $conn, &$gender) {
    $sql = "SELECT * FROM female WHERE email = :email AND pass = :pass";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $gender = 'female';
        return $row;
    }
    return false;
}

$row = checkFemale($email, $pass, $conn, $gender);
if (!$row) {
    $row = checkMale($email, $pass, $conn, $gender);
}

if ($row) {
    $_SESSION['id'] = $row['id']; // Assuming there's an 'id' column in your user tables
    $_SESSION['gender'] = $gender;
    $_SESSION['pass'] = $row['pass']; // This might not be necessary to store in the session
    $_SESSION['age'] = $row['age'];
    $_SESSION['sign'] = $row['sign'];
    $response = array("success" => true, "message" => "Login successful!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../profilepage/profile.php";</script>';
    exit; // Add exit after redirecting to prevent further execution
} else {
    $response = array("success" => false, "message" => "Incorrect Details!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/login.html";</script>';
    exit; // Add exit after redirecting to prevent further execution
}
