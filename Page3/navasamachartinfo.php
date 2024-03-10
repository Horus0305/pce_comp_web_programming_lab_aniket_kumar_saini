<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://json.freeastrologyapi.com/navamsa-chart-info',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "year": 2022,
    "month": 8,
    "date": 11,
    "hours": 6,
    "minutes": 0,
    "seconds": 0,
    "latitude": 17.38333,
    "longitude": 78.4666,
    "timezone": 5.5,
    "config": {
        "observation_point": "topocentric",
        "ayanamsha": "lahiri"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk '
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$jsonData=$response;

$decodedData = json_decode($jsonData, true);

// Check if decoding was successful
if ($decodedData !== null) {
    // Accessing the relevant part of the decoded data
    $planets = $decodedData['output'];

    // Group planet information by name
    $groupedPlanets = [];
    foreach ($planets as $planet) {
        $name = $planet['name'];
        $isRetro = $planet['isRetro'];
        $currentSign = $planet['current_sign'];

        // Group information by planet name
        $groupedPlanets[$name][] = [
            'Is Retrograde' => $isRetro,
            'Current Sign' => $currentSign,
        ];
    }

    // Output the grouped information in a literary style
    foreach ($groupedPlanets as $planetName => $planetInfo) {
        echo "For $planetName:\n";
        foreach ($planetInfo as $info) {
            echo "  - The planet is currently in sign {$info['Current Sign']}";
            echo $info['Is Retrograde'] == 'true' ? ", and it is retrograde.\n" : ".\n";
        }
        echo "\n";
    }
} else {
    // Handle decoding error
    echo "Error decoding JSON data.\n";
}
?>