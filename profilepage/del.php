<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM user WHERE email='$email' AND password='$pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h1>ACCOUNT DELETED SUCCESSFULLY</h1>";
} else {
    echo "Invalid username or password";
}
$conn->close();
?>
