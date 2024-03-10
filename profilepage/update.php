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
function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
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
    $newdob = $_POST['dob'];
    $gender = $_POST['gender'];
    $newpob = $_POST['pob'];
    $newtob = $_POST['tob'];
    $newage = ageCalculator($newdob);
    $passw = $_POST['edpass'];


    // Calculate new BMI
    $newbmi = calculateBMI($newweight, $newheight);

    // Check if password matches session password
    if (sha1($passw) == $_SESSION['pass']) {
        // Update user information in the database
        $sql = "UPDATE users SET weight='$newweight', dob='$newdob', pob='$newpob', gender='$gender', tob='$newtob', age='$newage', height='$newheight', photo='$newphoto', number='$newnum', bmi='$newbmi', quote='$newquote', description='$newdescription' WHERE uid=$id";

        // Execute the update query
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Details updated successfully!!!");window.location.href = "../profilepage/profile.php";</script>';
        } else {
            echo '<script>alert("Error updating record: . '$conn->error;'");window.location.href = "../profilepage/profile.php";</script>';
            // echo "Error updating record: " . $conn->error;
        }
    } else {
        echo '<script>alert("Password is incorrect");window.location.href = "../profilepage/profile.php";</script>';
    }
}

// Close the database connection
$conn->close();
?>
