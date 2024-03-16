<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cosmicdestiny";

// Retrieve session ID
$id = $_SESSION['id'];
$gender = $_SESSION['gender'];

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



function getLatLongFromAddress($address) {
    $api_url = "https://geocode.maps.co/search";
    $api_key = "65b1303f9d4df715521005atg495293";

    $params = [
        'q' => $address,
        'api_key' => $api_key
    ];

    $url = $api_url . '?' . http_build_query($params);
    $response = file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);
        if (!empty($data) && is_array($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
            return [
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ];
        }
    }

    return null;
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
    $newpob = $_POST['pob'];
    $newtob = $_POST['tob'];
    $newage = ageCalculator($newdob);
    $passw = $_POST['edpass'];
    $newcity = $_POST['city'];
    $newwork = $_POST['occupation'];


    // Calculate new BMI
    $newbmi = calculateBMI($newweight, $newheight);


    $AddressInfo = getLatLongFromAddress($_POST['pob']);
if ($AddressInfo === null) {
    echo '<div>Error: Unable to fetch latitude and longitude for female address.</div>';
    exit;
}  
else{


    $lat=$AddressInfo['latitude'];
    $long=$AddressInfo['longitude'];
    // Check if password matches session password
    if (sha1($passw) == $_SESSION['pass']) {
        // Update user information in the database
        $sql = "UPDATE $gender SET weight='$newweight', work='$newwork',city = '$newcity', dob='$newdob', pob='$newpob', tob='$newtob', age='$newage', height='$newheight', photocontent='$newphoto', number='$newnum', bmi='$newbmi', quote='$newquote', description='$newdescription',latitude='$lat',longitude='$long' WHERE id=$id";

        // Execute the update query
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Details updated successfully!!!");window.location.href = "../profilepage/profile.php";</script>';
        } else {
            echo '<script>alert("Error updating record: ' . $conn->error . '");window.location.href = "../profilepage/profile.php";</script>';
            // echo "Error updating record: " . $conn->error;
        }
    } else {
        echo '<script>alert("Password is incorrect");window.location.href = "../profilepage/profile.php";</script>';
    }}
}

// Close the database connection
$conn->close();
?>
