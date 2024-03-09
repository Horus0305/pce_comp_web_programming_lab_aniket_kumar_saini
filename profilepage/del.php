<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cosmicdestiny";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = "soumedumanna1232gmail.com";
$pass = "1234567890";

$sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["uid"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
        // You can print other columns similarly
    }
} else {
    echo "0 results";
}
// if ($result->num_rows > 0) {
//     echo "<h1>ACCOUNT DELETED SUCCESSFULLY</h1><br/>$row['name']";
// } else {
//     echo "Invalid username or password";
// }
$conn->close();
?>
