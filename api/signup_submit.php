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
    $sql_check_email = "SELECT COUNT(*) AS total FROM male WHERE email=:email UNION ALL SELECT COUNT(*) FROM female WHERE email=:email";
    $stmt_check_email = $db->prepare($sql_check_email);
    $stmt_check_email->bindParam(':email', $email);
    $stmt_check_email->execute();
    $row_counts = $stmt_check_email->fetchAll(PDO::FETCH_COLUMN);
    $total_records = array_sum($row_counts);
    
    if ($total_records > 0) {
        $response = array("success" => false, "message" => "This email id is already registered with us!");
        echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/signup.html";</script>';
    } else {
        // Insert new user into the appropriate gender table
        $sql_insert = "INSERT INTO $gender (name, email, pass, gender) VALUES (:name, :email, :password, :gender)";
        $stmt_insert = $db->prepare($sql_insert);
        $stmt_insert->bindParam(':name', $name);
        $stmt_insert->bindParam(':email', $email);
        $stmt_insert->bindParam(':password', $password);
        $stmt_insert->bindParam(':gender', $gender);
        $result_insert = $stmt_insert->execute();
        if (!$result_insert) {
            $response = array("success" => false, "message" => "Something went wrong!");
            echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/signup.html";</script>';
        } else {
            // If everything is successful, show success message
            $response = array("success" => true, "message" => "Your account has been created successfully!");
            echo '<script>alert("' . $response["message"] . '");window.location.href = "../landingpage/main.html";</script>';
        }
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Database Error: ' . $e->getMessage();
    // Log error for debugging
    error_log('Database Error: ' . $e->getMessage(), 0);
} catch (Exception $e) {
    // Handle other exceptions
    echo 'Error: ' . $e->getMessage();
    // Log error for debugging
    error_log('Error: ' . $e->getMessage(), 0);
} finally {
    // Close the database connection
    $db = null;
}
?>
