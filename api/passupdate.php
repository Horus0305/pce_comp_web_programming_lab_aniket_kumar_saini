<?php
session_start();
$reset_email = $_SESSION['reset_email'];
$gender = $_SESSION['gender'];
try {
    require("../includes/database_connect.php");
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
if (!isset($_SESSION['reset_email']) && !isset($_SESSION['gender'])) {
    header("Location: ../landingpage/forgot.html");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        echo '<script>alert("New password must contain at least one uppercase letter, one lowercase letter, and be at least 8 characters long.");
        window.location.href = "../landingpage/chngpass.html";</script>';
        exit();
    }
    if ($password !== $confirm_password) {
        echo '<script>alert("Password Mismatched."); window.location.href = "../landingpage/chngpass.html";</script>';
        exit();
    }
    $hashed_password = sha1($password);
    $statement = $db->prepare('UPDATE ' . $gender . ' SET pass = :hashed_password WHERE email = :reset_email');
    $statement->bindValue(':hashed_password', $hashed_password);
    $statement->bindValue(':reset_email', $reset_email);
    $result = $statement->execute();
    if ($result) {
        echo '<script>alert("Password Updated."); window.location.href = "../landingpage/main.html";</script>';
        session_destroy();
        exit();
    } else {
        echo '<script>alert("Password Not Updated !! Please try again later."); window.location.href = "../landingpage/main.html";</script>';
        session_destroy();
        exit();
    }
} else {
    header("Location: ../landingpage/main.html");
    exit();
}
?>
