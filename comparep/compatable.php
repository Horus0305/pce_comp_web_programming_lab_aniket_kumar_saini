<?php
session_start();
include "../includes/base.php";

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="css/compatablerep.css" />
<div class="content">
  <div class="heading">Check Compatibility</div>


  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

    if (
      isset(
        $_POST['femaleDateTime'],
        $_POST['femaleAddress'],
        $_POST['femaleTimezone'],
        $_POST['maleDateTime'],
        $_POST['maleAddress'],
        $_POST['maleTimezone']
      )
    ) {


      function getLatLongFromAddress($address)
      {
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


      $femaleAddressInfo = getLatLongFromAddress($_POST['femaleAddress']);
      if ($femaleAddressInfo === null) {
        echo '<div>Error: Unable to fetch latitude and longitude for female address.</div>';
        exit;
      }
      sleep(1);

      $maleAddressInfo = getLatLongFromAddress($_POST['maleAddress']);
      if ($maleAddressInfo === null) {
        echo '<div>Error: Unable to fetch latitude and longitude for male address.</div>';
        exit;
      }


      $requestData = array(
        "female" => array(
          "year" => (int) date("Y", strtotime($_POST['femaleDateTime'])),
          "month" => (int) date("n", strtotime($_POST['femaleDateTime'])),
          "date" => (int) date("j", strtotime($_POST['femaleDateTime'])),
          "hours" => (int) date("G", strtotime($_POST['femaleDateTime'])),
          "minutes" => (int) date("i", strtotime($_POST['femaleDateTime'])),
          "seconds" => (int) date("s", strtotime($_POST['femaleDateTime'])),
          "latitude" => (float) $femaleAddressInfo['latitude'],
          "longitude" => (float) $femaleAddressInfo['longitude'],
          "timezone" => (float) $_POST['femaleTimezone']
        ),
        "male" => array(
          "year" => (int) date("Y", strtotime($_POST['maleDateTime'])),
          "month" => (int) date("n", strtotime($_POST['maleDateTime'])),
          "date" => (int) date("j", strtotime($_POST['maleDateTime'])),
          "hours" => (int) date("G", strtotime($_POST['maleDateTime'])),
          "minutes" => (int) date("i", strtotime($_POST['maleDateTime'])),
          "seconds" => (int) date("s", strtotime($_POST['maleDateTime'])),
          "latitude" => (float) $maleAddressInfo['latitude'],
          "longitude" => (float) $maleAddressInfo['longitude'],
          "timezone" => (float) $_POST['maleTimezone']
        ),
        "config" => array(
          "observation_point" => "topocentric",
          "language" => "te",
          "ayanamsha" => "lahiri"
        )
      );

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://json.freeastrologyapi.com/match-making/ashtakoot-score',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($requestData), // Convert array to JSON
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
        ),
      ));


      $response = curl_exec($curl);


      curl_close($curl);


      $responseData = json_decode($response, true);
    }
  }
  ?>
  <div id="maincont">
    <div id="childcont">
      <div class="match-card">

        <h2>Details Female:</h2>
        <form id="Forms" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">

          <label for="femaleName">Female Name:</label>
          <input type="text" id="femaleName" name="femaleName" required>
          <span id="femaleName-error" class="error-message"></span>
          <label for="femaleDateTime">Female Date and Time:</label>
          <input type="date" id="femaleDateTime" name="femaleDateTime" required>

          <label for="femaleAddress">Female Address:</label>
          <input type="text" id="femaleAddress" name="femaleAddress" required>

          <label for="femaleTimezone">Female Timezone:</label>
          <input type="text" id="femaleTimezone" name="femaleTimezone" required>
      </div>
      <div class="match-card">
        <h2>Details Male:</h2>
        <label for="maleName">Male Name:</label>
        <input type="text" id="maleName" name="maleName" required>
        <label for="maleDateTime">Male Date and Time:</label>
        <input type="date" id="maleDateTime" name="maleDateTime" required>

        <label for="maleAddress">Male Address:</label>
        <input type="text" id="maleAddress" name="maleAddress" required>

        <label for="maleTimezone">Male Timezone:</label>
        <input type="text" id="maleTimezone" name="maleTimezone" required>


      </div>
    </div>
    <div class="but">
      <button id="sub" type="submit" name="calculateScore">Calculate Ashtakoot Score</button>
      </form>
    </div>
  </div>

  <script>
const validateFullName = (fullName) => /^[a-zA-Z\s]+$/.test(fullName);
const validateDateOfBirth = (dateOfBirth) => new Date(dateOfBirth) <= new Date();
const calculateAge = (dateOfBirth) => Math.floor((new Date() - new Date(dateOfBirth)) / (1000 * 60 * 60 * 24 * 365));
const validateTimezone = (timezone) => !isNaN(timezone) && timezone >= -12 && timezone <= 14;
const validatePlaceOfBirth = (place) => /^[a-zA-Z]+$/.test(place);
const validateAddress = (address) => /^[a-zA-Z]+$/.test(address);

const form = document.getElementById('Forms');
const inputs = [
  'femaleName', 'femaleDateTime', 'femaleAddress', 'femaleTimezone',
  'maleName', 'maleDateTime', 'maleAddress', 'maleTimezone'
].map(id => document.getElementById(id));

form.addEventListener('submit', (event) => {
  inputs.forEach(input => {
    if (!input.checkValidity()) {
      event.preventDefault();
      return;
    }
  });
});

inputs.forEach(input => {
  input.addEventListener('input', () => {
    if (input.id === 'femaleDateTime' || input.id === 'maleDateTime') {
      const date = new Date(input.value);
      if (!validateDateOfBirth(input.value)) {
        input.setCustomValidity('Date of birth cannot be a date in the future');
      } else if (calculateAge(input.value) < 18) {
        input.setCustomValidity('You must be at least 18 years old');
      } else {
        input.setCustomValidity('');
      }
    } else if (input.id === 'femaleTimezone' || input.id === 'maleTimezone') {
      if (!validateTimezone(input.value)) {
        input.setCustomValidity('Timezone should be between -12 to 14');
      } else {
        input.setCustomValidity('');
      }
    } else if (input.id === 'femaleName' || input.id === 'maleName') {
      if (!validateFullName(input.value)) {
        input.setCustomValidity('Full name should only contain characters');
      } else {
        input.setCustomValidity('');
      }
    } else if (input.id === 'femaleAddress' || input.id === 'maleAddress') {
      if (!validateAddress(input.value)) {
        input.setCustomValidity('Address should only contain characters');
      } else {
        input.setCustomValidity('');
      }
    }
  });
});
  </script> 








  <?php

  if (isset($responseData['output']['total_score'])) {
    echo '<div>Ashtakoot Score: ' . $responseData['output']['total_score'] . '/36</div>';
    echo '<canvas id="ashtakootChart" style:"width="15%" height="15%""></canvas>';
    echo '<script>
            var ctx = document.getElementById("ashtakootChart").getContext("2d");
            var data = {
                labels: ["Total Score", "Remaining Score"],
                datasets: [{
                    data: [' . $responseData['output']['total_score'] . ', ' . (36 - $responseData['output']['total_score']) . '],
                    backgroundColor: ["#36A2EB", "#FFCE56"]
                }]
            };
            var options = {
                responsive: true,
                cutoutPercentage: 60// Adjust the cutoutPercentage to control the size of the center hole
            };
            var myDoughnutChart = new Chart(ctx, {
                type: "doughnut",
                data: data,
                options: options
            });
          </script>';
  }

  
function validateInput($input, $fieldName) {
  if (empty($input)) {
      echo "<script>alert('Error: $fieldName is required.');</script>";
      return false;
  }
  if ($fieldName == 'Female Name' || $fieldName == 'Male Name') {
      if (!preg_match('/^[a-zA-Z\s]{1,30}$/', $input)) {
        echo "<script>alert('Error: $fieldName should only contain alphabetic characters and have a maximum length of 30 characters.');</script>";
          return false;
      }
  }

  if ($fieldName == 'Female Timezone' || $fieldName == 'Male Timezone') {
      if (!is_numeric($input) || $input < -14 || $input > 12) {
          echo "<script>alert('Error: $fieldName should be between -14 and 12');</script>";
          return false;
      }
  }


  if ($fieldName == 'Female Date and Time' || $fieldName == 'Male Date and Time') {
      if (strtotime($input) > time()) {
          echo "<script>alert('Error: $fieldName cannot be a date in the future";
          return false;
      }
  }
  return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($responseData['output']['total_score'])) {
    $method = "AES-256-CBC";
    $key = "encryptionKey123";
    $options = 0;
    $iv = '1234567891011121';

    $totalScore= openssl_encrypt($responseData['output']['total_score'], $method, $key, $options,$iv);

    
  
      $dbHost = "localhost";
      $dbName = "astrology";
      $dbUser = "root";
      $dbPassword = "";
      $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      $fields = array(
          'femaleName' => 'Female Name',
          'femaleDateTime' => 'Female Date and Time',
          'femaleAddress' => 'Female Address',
          'femaleTimezone' => 'Female Timezone',
          'maleName' => 'Male Name',
          'maleDateTime' => 'Male Date and Time',
          'maleAddress' => 'Male Address',
          'maleTimezone' => 'Male Timezone'
      );
      $valid = true;
      foreach ($fields as $fieldName => $fieldLabel) {
          if (!isset($_POST[$fieldName]) || !validateInput($_POST[$fieldName], $fieldLabel)) {
              $valid = false;
          }
      }

      if ($valid) {
          $sql = "INSERT INTO compatibility_data 
              (femaleName, femaleDateTime, femaleAddress, femaleTimezone,
              maleName, maleDateTime, maleAddress, maleTimezone, totalScore)
              VALUES (
                  '{$_POST['femaleName']}',
                  '{$_POST['femaleDateTime']}',
                  '{$_POST['femaleAddress']}',
                  '{$_POST['femaleTimezone']}',
                  '{$_POST['maleName']}',
                  '{$_POST['maleDateTime']}',
                  '{$_POST['maleAddress']}',
                  '{$_POST['maleTimezone']}',
                  '$totalScore'
              )";

          if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }



$method = "AES-256-CBC";
$key = "encryptionKey123";
$options = 0;
$iv = '1234567891011121';

$decryptedData = openssl_decrypt($totalScore, $method, $key, $options, $iv);


echo "Encrypted Score: ". $totalScore. "\n";
echo "Decrypted Data: ". $decryptedData;

          mysqli_close($conn);
      }
  }
}
  ?>