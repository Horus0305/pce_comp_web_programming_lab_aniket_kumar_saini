<?php
//include "../includes/base.php"                                      //uncomment this for navbar and bg
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset(
        $_POST['femaleDateTime'], $_POST['femaleAddress'], $_POST['femaleTimezone'],
        $_POST['maleDateTime'], $_POST['maleAddress'], $_POST['maleTimezone']
    )) {

   
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

        if (isset($responseData['output']['total_score'])) {
     
            echo '<div>Ashtakoot Score: ' . $responseData['output']['total_score'] . '/36</div>';
        } else {
            echo '<div>Error: Unable to retrieve the total score from the API response.</div>';}
    } else {
        
        echo '<div>Error: All required fields must be provided.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ashtakoot Score Calculator</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h2>Female Details:</h2>
  <label for="femaleDateTime">Date and Time:</label>
  <input type="datetime-local" id="femaleDateTime" name="femaleDateTime" required>

  <label for="femaleAddress">Address:</label>
  <input type="text" id="femaleAddress" name="femaleAddress" required>

  <label for="femaleTimezone">Timezone:</label>
  <input type="text" id="femaleTimezone" name="femaleTimezone" required>

  <h2>Male Details:</h2>
  <label for="maleDateTime">Date and Time:</label>
  <input type="datetime-local" id="maleDateTime" name="maleDateTime" required>

  <label for="maleAddress">Address:</label>
  <input type="text" id="maleAddress" name="maleAddress" required>

  <label for="maleTimezone">Timezone:</label>
  <input type="text" id="maleTimezone" name="maleTimezone" required>

  <button type="submit">Calculate Ashtakoot Score</button>
</form>

</body>
</html>
