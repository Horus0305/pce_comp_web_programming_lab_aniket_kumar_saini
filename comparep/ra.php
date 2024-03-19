<?php 
session_start();
require("../includes/database_connect.php");

// Check if session variables are set
if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
  die("Missing session variables");
}

$gender = $_SESSION['gender'];
$id = $_SESSION['id'];

$stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Extract birth details from the database
$time_of_birth = $row['tob'];
$date = $row['dob'];
$lati = $row['latitude'];
$long = $row['longitude'];

// Split time_of_birth into hours, minutes, seconds
list($hours, $minutes, $seconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($year, $month, $day) = explode("-", $date);

// API request data
$request_data = [
    "female" => [
        "year" => (int)$year,
        "month" => (int)$month,
        "date" => (int)$day,
        "hours" => (int)$hours,
        "minutes" => (int)$minutes,
        "seconds" => (int)$seconds,
        "latitude" => (float)$lati,
        "longitude" => (float)$long,
        "timezone" => 5.5
    ],
    "male" => [
        "year" => 1984,
        "month" => 4,
        "date" => 3,
        "hours" => 9,
        "minutes" => 15,
        "seconds" => 31,
        "latitude" => 16.51667,
        "longitude" => 80.61667,
        "timezone" => 5.5
    ],
    "config" => [
        "observation_point" => "topocentric",
        "language" => "en",
        "ayanamsha" => "lahiri"
    ]
];

// Convert data to JSON
$request_json = json_encode($request_data);

// API Endpoint and Headers
$api_url = 'https://json.freeastrologyapi.com/match-making/ashtakoot-score';
$headers = [
    'Content-Type: application/json',
    'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
];

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $request_json,
  CURLOPT_HTTPHEADER => $headers,
));

// Execute cURL request
$response = curl_exec($curl);

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if output key exists in response
if (isset($data['output'])) {
    $output = $data['output'];
    // Process output here
    // For example, you can print it:
    print_r($output);
} else {
    // If 'output' key does not exist, there might be an error
    echo "Error: Unable to fetch data.";
}
?>
