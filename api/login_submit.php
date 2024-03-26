<?php
session_start();
require("../includes/database_connect.php"); // Assuming this file includes your database connection

$email = $_POST['email'];
$password = $_POST['password'];

// Function to validate password format
function validatePassword($password) {
    // Check if the password has at least one uppercase letter, one lowercase letter, and minimum 8 characters
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format');window.location.href = '../landingpage/login.html';</script>";
    exit;
}

if (!validatePassword($password)) {
    echo "<script>alert('Password must contain at least one uppercase letter, one lowercase letter, and be at least 8 characters long.');window.location.href = '../landingpage/login.html';</script>";
    exit;
}

$pass = sha1($password); // Note: SHA-1 is not recommended for password hashing due to security vulnerabilities. Consider using more secure methods like bcrypt.

$gender = '';

// Function to check if email exists in the database
function emailExists($email, $conn) {
    $sql = "SELECT COUNT(*) FROM male WHERE email = :email UNION ALL SELECT COUNT(*) FROM female WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return array_sum($result) > 0;
}

// Function to check if the user is male
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

// Function to check if the user is female
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

// Check if email exists in the database
if (!emailExists($email, $conn)) {
    $response = array("success" => false, "message" => "Email not found!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/login.html";</script>';
    exit; // Add exit after redirecting to prevent further execution
}

$row = checkFemale($email, $pass, $conn, $gender);
if (!$row) {
    $row = checkMale($email, $pass, $conn, $gender);
}

if ($row) {
    $_SESSION['id'] = $row['id']; // Assuming there's an 'id' column in your user tables
    $_SESSION['name'] = $row['name'];
    $_SESSION['gender'] = $gender;
    $_SESSION['pass'] = $row['pass']; // This might not be necessary to store in the session
    $_SESSION['age'] = $row['age'];
    $_SESSION['sign'] = $row['sign'];
    $response = array("success" => true, "message" => "Login successful!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../Page2/page2.php";</script>';
    exit; // Add exit after redirecting to prevent further execution
} else {
    $response = array("success" => false, "message" => "Incorrect Details!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/login.html";</script>';
    exit; // Add exit after redirecting to prevent further execution
}
?>
