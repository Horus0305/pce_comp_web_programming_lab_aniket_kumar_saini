<?php
include "../includes/base.php"
?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var formSubmitted = false;

    document.getElementById('Forms').addEventListener('submit', function (event) {
      formSubmitted = true;

      // Validate Female Details
      var femaleValidations = [
        validateField('femaleName', 'Female Name is required.'),
        validateRegex('femaleName', /^[a-zA-Z\s]+$/, 'Female Name should only contain letters and spaces.'),
        validateField('femaleDateTime', 'Female Date and Time is required.'),
        validateField('femaleAddress', 'Female Address is required.'),
        validateRegex('femaleAddress', /^[a-zA-Z0-9\s]+$/, 'Female Address should not contain special characters except white spaces.'),
        validateField('femaleTimezone', 'Female Timezone is required.'),
        validateRange('femaleTimezone', -12, 14, 'Female Timezone should be between -12 and 14.')
      ];

      // Validate Male Details
      var maleValidations = [
        validateField('maleName', 'Male Name is required.'),
        validateRegex('maleName', /^[a-zA-Z\s]+$/, 'Male Name should only contain letters and spaces.'),
        validateField('maleDateTime', 'Male Date and Time is required.'),
        validateField('maleAddress', 'Male Address is required.'),
        validateRegex('maleAddress', /^[a-zA-Z0-9\s]+$/, 'Male Address should not contain special characters except white spaces.'),
        validateField('maleTimezone', 'Male Timezone is required.'),
        validateRange('maleTimezone', -12, 14, 'Male Timezone should be between -12 and 14.')
      ];

      if (femaleValidations.some(validation => !validation) || maleValidations.some(validation => !validation)) {
        event.preventDefault();
        return false;
      }

      return true;
    });

    function validateField(fieldId, errorMessage) {
      var fieldValue = document.querySelector('#' + fieldId).value.trim();
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (fieldValue === '') {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function validateRegex(fieldId, regex, errorMessage) {
      var fieldValue = document.querySelector('#' + fieldId).value.trim();
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (!regex.test(fieldValue)) {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function validateRange(fieldId, min, max, errorMessage) {
      var fieldValue = parseFloat(document.querySelector('#' + fieldId).value);
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (isNaN(fieldValue) || fieldValue < min || fieldValue > max) {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function clearErrorMessage(fieldId) {
      var errorElement = document.querySelector('#' + fieldId + ' + span.error-message');
      if (errorElement) {
        errorElement.textContent = '';
      }
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="css/match.css" />
<div class="content">
  <div class="heading">Check Compatibility</div>


  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        if (
            isset(
                $_POST['femaleDateTime'], $_POST['femaleAddress'], $_POST['femaleTimezone'],
                $_POST['maleDateTime'], $_POST['maleAddress'], $_POST['maleTimezone']
            )
        ) {

   
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
            <form id="Forms" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       
                <label for="femaleName">Female Name:</label>
                <input type="text" id="femaleName" name="femaleName" >
                <span id="femaleName-error" class="error-message"></span>
                <label for="femaleDateTime">Female Date and Time:</label>
                <input type="datetime-local" id="femaleDateTime" name="femaleDateTime" >

                <label for="femaleAddress">Female Address:</label>
                <input type="text" id="femaleAddress" name="femaleAddress">

                <label for="femaleTimezone">Female Timezone:</label>
                <input type="text" id="femaleTimezone" name="femaleTimezone" >
</div>      <div class="match-card"> 
        <h2>Details Male:</h2>       
        <label for="maleName">Male Name:</label>
                <input type="text" id="maleName" name="maleName">
                <label for="maleDateTime">Male Date and Time:</label>
                <input type="datetime-local" id="maleDateTime" name="maleDateTime" >

                <label for="maleAddress">Male Address:</label>
                <input type="text" id="maleAddress" name="maleAddress">

                <label for="maleTimezone">Male Timezone:</label>
                <input type="text" id="maleTimezone" name="maleTimezone">

                
                </div>
 </div>
                <div class="but">
                <button type="submit" name="calculateScore">Calculate Ashtakoot Score</button>
            </form>
            </div>
        </div>
        <script>
  document.addEventListener('DOMContentLoaded', function () {
    var formSubmitted = false;

    document.getElementById('Forms').addEventListener('submit', function (event) {
      formSubmitted = true;

      // Validate Female Details
      var femaleValidations = [
        validateField('femaleName', 'Female Name is required.'),
        validateRegex('femaleName', /^[a-zA-Z\s]+$/, 'Female Name should only contain letters and spaces.'),
        validateField('femaleDateTime', 'Female Date and Time is required.'),
        validateField('femaleAddress', 'Female Address is required.'),
        validateRegex('femaleAddress', /^[a-zA-Z0-9\s]+$/, 'Female Address should not contain special characters except white spaces.'),
        validateField('femaleTimezone', 'Female Timezone is required.'),
        validateRange('femaleTimezone', -12, 14, 'Female Timezone should be between -12 and 14.')
      ];

      // Validate Male Details
      var maleValidations = [
        validateField('maleName', 'Male Name is required.'),
        validateRegex('maleName', /^[a-zA-Z\s]+$/, 'Male Name should only contain letters and spaces.'),
        validateField('maleDateTime', 'Male Date and Time is required.'),
        validateField('maleAddress', 'Male Address is required.'),
        validateRegex('maleAddress', /^[a-zA-Z0-9\s]+$/, 'Male Address should not contain special characters except white spaces.'),
        validateField('maleTimezone', 'Male Timezone is required.'),
        validateRange('maleTimezone', -12, 14, 'Male Timezone should be between -12 and 14.')
      ];

      if (femaleValidations.some(validation => !validation) || maleValidations.some(validation => !validation)) {
        event.preventDefault();
        return false;
      }

      return true;
    });

    function validateField(fieldId, errorMessage) {
      var fieldValue = document.querySelector('#' + fieldId).value.trim();
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (fieldValue === '') {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function validateRegex(fieldId, regex, errorMessage) {
      var fieldValue = document.querySelector('#' + fieldId).value.trim();
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (!regex.test(fieldValue)) {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function validateRange(fieldId, min, max, errorMessage) {
      var fieldValue = parseFloat(document.querySelector('#' + fieldId).value);
      var fieldElement = document.querySelector('#' + fieldId);

      if (formSubmitted) {
        if (isNaN(fieldValue) || fieldValue < min || fieldValue > max) {
          fieldElement.setCustomValidity(errorMessage);
          return false;
        } else {
          fieldElement.setCustomValidity('');
          clearErrorMessage(fieldId);
          return true;
        }
      }

      return true;
    }

    function clearErrorMessage(fieldId) {
      var errorElement = document.querySelector('#' + fieldId + '-error');
      if (errorElement) {
        errorElement.textContent = '';
      }
    }
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($responseData['output']['total_score'])) {
        $totalScore = $responseData['output']['total_score'];


        $dbHost = "localhost";
        $dbName = "astrology";
        $dbUser = "root";
        $dbPassword = "";

        
        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName,8111);

  
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


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
                $totalScore
            )";

  
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
