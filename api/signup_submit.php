<?php
require("../includes/database_connect.php");

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$name = $f_name . " " . $l_name;
$email = $_POST['email'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$password = sha1($password); // You should consider using more secure hashing algorithms, such as bcrypt

try {
    $db_path = '../database/baba.db';
    $db = new PDO('sqlite:' . $db_path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the email already exists
    $sql = "SELECT * FROM $gender WHERE email=:email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row_count = $stmt->rowCount();
    if ($row_count != 0) {
        $response = array("success" => false, "message" => "This email id is already registered with us!");
        echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/signup.html";</script>';
        return;
    }

    // Insert new user into the database
    $sql = "INSERT INTO $gender (name, email, pass, gender) VALUES (:name, :email, :password, :gender)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':gender', $gender);
    $result = $stmt->execute();
    if (!$result) {
        $response = array("success" => false, "message" => "Something went wrong!");
        echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/signup.html";</script>';
        return;
    }

    $response = array("success" => true, "message" => "Your account has been created successfully!");
    echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/main.html";</script>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
$db = null; // Close the database connection
?>
