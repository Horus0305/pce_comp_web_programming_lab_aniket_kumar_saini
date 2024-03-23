<?php
session_start();
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
    
    // Check in the 'male' table
    $stmt_male = $db->prepare("SELECT * FROM male WHERE email = :email");
    $stmt_male->bindParam(':email', $email);
    $stmt_male->execute();
    $user_male = $stmt_male->fetch(PDO::FETCH_ASSOC);

    // Check in the 'female' table
    $stmt_female = $db->prepare("SELECT * FROM female WHERE email = :email");
    $stmt_female->bindParam(':email', $email);
    $stmt_female->execute();
    $user_female = $stmt_female->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists in either table
    if ($user_male) {
        $_SESSION['reset_email'] = $email;
        $_SESSION['gender'] = 'male';
        sendMail($send_to_email, $verification_otp);
?>
        <script>
            var otp = prompt("Please enter the 6-digit OTP sent to your email:");
            if (otp === "<?php echo $verification_otp ?>") {
                alert("OTP is verified. You can proceed to reset your password.");
                window.location.href = "../landingpage/chngpass.html";
                
            } else {
                alert("OTP is incorrect. Please try again.");
            }
        </script>
<?php
        exit;
    } elseif ($user_female) {
        $_SESSION['reset_email'] = $email;
        $_SESSION['gender'] = 'female';
        sendMail($send_to_email, $verification_otp);
?>
        <script>
            var otp = prompt("Please enter the 6-digit OTP sent to your email:");
            if (otp === "<?php echo $verification_otp ?>") {
                alert("OTP is verified. You can proceed to reset your password.");
                window.location.href = "../landingpage/chngpass.html";
                
            } else {
                alert("OTP is incorrect. Please try again.");
            }
        </script>
<?php
        exit;
    } else {
        echo '<script>alert("User not found. Please check your email and try again."); window.location.href = "../landingpage/forgot.html";</script>';
        exit;
    }
}
?>
