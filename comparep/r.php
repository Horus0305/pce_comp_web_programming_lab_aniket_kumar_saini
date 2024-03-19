<?php 
session_start();
require("../includes/database_connect.php");
$gender = $_SESSION['gender'];
$id = $_SESSION['id'];


if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
  die("Missing session variables");
}
$matchgender = '';
    session_start();
    if ($_SESSION['gender'] == 'male') {
      $matchgender = 'female';
    } else {
      $matchgender = 'male';
    }

    

$stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$time_of_birth = $row['tob'];
$time_parts = explode(":", $time_of_birth);

// Ensure we have all parts
if(count($time_parts) < 3) {
    // Fill missing parts with zeros
    for($i = count($time_parts); $i < 3; $i++) {
        $time_parts[$i] = '0';
    }
}

$hours = $time_parts[0];
$minutes = $time_parts[1];
$seconds = $time_parts[2];

echo "Hours: $hours, Minutes: $minutes, Seconds: $seconds";



$date=$row['dob'];
$datepart= explode("-", $date);
$year=$datepart[0];
$month=$datepart[1];
$day=$datepart[2];

echo "day:$day month:$month year:$year";

$lati=$row['latitude'];
$long=$row['longitude'];
echo "latitude $lati";
echo "longitude $long"
?>