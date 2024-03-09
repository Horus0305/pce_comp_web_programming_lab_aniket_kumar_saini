<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cosmicdestiny";

// Retrieve session ID
$id = $_SESSION['id'];

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate BMI
function calculateBMI($weight_kg, $height_cm) {
    // Convert height from cm to meters
    $height_m = $height_cm / 100;

    // Calculate BMI
    $bmi = $weight_kg / ($height_m * $height_m);
    return $bmi;
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $newweight = $_POST['weight'];
    $newheight = $_POST['height'];
    $newphoto = $_POST['photo'];
    $newnum = $_POST['number'];
    $newquote = $_POST['quote'];
    $newdescription = $_POST['description'];
    $passw = $_POST['edpass'];
    echo $passw . "\n" . $_SESSION['pass'];

    // Calculate new BMI
    $newbmi = calculateBMI($newweight, $newheight);

    // Check if password matches session password
    if ($passw == $_SESSION['pass']) {
        // Update user information in the database
        $sql = "UPDATE users SET weight='$newweight', height='$newheight', photo='$newphoto', number='$newnum', bmi='$newbmi', quote='$newquote', description='$newdescription' WHERE uid=$id";

        // Execute the update query
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid password";
    }
}

// Close the database connection
$conn->close();
?>
