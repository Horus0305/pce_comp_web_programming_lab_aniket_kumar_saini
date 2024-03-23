<?php
try {
    require("../includes/database_connect.php");
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
error_reporting(0);
include "connection.php";
require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
$send_to_email = $_POST["email"];
$verification_otp = random_int(100000, 999999);

function sendMail($send_to, $otp) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "cosmicdestiny24@gmail.com";
    $mail->Password = "ewyvykzhgdvmipnr";
    $mail->setFrom("cosmicdestiny24@gmail.com", "Cosmic");
    $mail->addAddress($send_to);
    $mail->Subject = "Password Reset";
    $mail->Body = "Hello, Cosmic User\nYou can reset your password with the help of following OTP !\n OTP --> {$otp}.";
    $mail->send();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $stmt = $db->prepare("SELECT * FROM male WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        sendMail($send_to_email, $verification_otp);
        echo '<script>alert("OTP is sent to ' . $email . ', Click OK to enter OTP.");</script>';
        exit;
    } else {
        echo '<script>alert("User not found. Please check your email and try again."); window.location.href = "../profilepage/profile.php";</script>';
        exit;
    }
}
?>














