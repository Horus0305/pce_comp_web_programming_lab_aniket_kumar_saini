

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthchart</title>

    <link rel="stylesheet" href="/testAnimationLandingPage/bg.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="page3.css">
    <link rel="stylesheet" href="birthchart.css">
</head>

<body>
    <div class="main-con">
        <?php





session_start();
require("../includes/database_connect.php");

// Check if session variables are set
if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
  die("Missing session variables");
}


$gender = $_SESSION['gender'];
$id = $_SESSION['id'];


if($gender=="male"){


$stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$male = $stmt->fetch(PDO::FETCH_ASSOC);

$time_of_birth = $male['tob'];
$date = $male['dob'];
$malelati = $male['latitude'];
$malelong = $male['longitude'];
$name=$male['name'];
// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $date);


$postDataBirthChart = array(
    "year" => (int)$maleyear,
    "month" => (int)$malemonth,
    "date" => (int)$maleday,
    "hours" => (int)$malehours,
    "minutes" => (int)$maleminutes,
    "seconds" => (int)$maleseconds,
    "latitude" => (float)$malelati,
    "longitude" => (float)$malelong,
    "timezone" => 5.5,
    "config" => array(
        "observation_point" => "topocentric",
        "ayanamsha" => "lahiri"
    )
);








}


if($gender=="female"){


    $stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$female = $stmt->fetch(PDO::FETCH_ASSOC);

$time_of_birth = $female['tob'];
$date = $female['dob'];
$lati = $female['latitude'];
$long = $female['longitude'];
$name=$female['name'];
// Split time_of_birth into hours, minutes, seconds
list($femalehours, $femaleminutes, $femaleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($femaleyear, $femalemonth, $femaleday) = explode("-", $date);

$postDataBirthChart = array(
    "year" => (int)$femaleyear,
    "month" => (int)$femalemonth,
    "date" => (int)$femaleday,
    "hours" => (int)$femalehours,
    "minutes" => (int)$femaleminutes,
    "seconds" => (int)$femaleseconds,
    "latitude" => (float)$lati,
    "longitude" => (float)$long,
    "timezone" => 5.5,
    "config" => array(
        "observation_point" => "topocentric",
        "ayanamsha" => "lahiri"
    )
);



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




        $curlBirthChart = curl_init();

        curl_setopt_array($curlBirthChart, array(
            CURLOPT_URL => 'https://json.freeastrologyapi.com/horoscope-chart-url',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postDataBirthChart),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
            ),
        ));

        $responseBirthChart = curl_exec($curlBirthChart);

        curl_close($curlBirthChart);

        $horoscopeData = json_decode($responseBirthChart, true); // Decode JSON response for birth chart

      
        ?>
        <?php include '../includes/base.php' ?>

        <div class="cont" style="color: white;">
            <!-- Existing birth chart div -->
            <div class="divtriggerr" id="div1">
                <div class="text">
                    <div class="bigtext2">
                        <h2>Birthchart</h2>
                    </div>

                    <img src="<?php echo isset($horoscopeData['output']) ? $horoscopeData['output'] : ''; ?>" alt="Birthchart" id="birthchart">

                    <div class="about2">
                        <h3>Name: <?php echo $name ?></h3>
                        <p>Birth Location: Seawoods</p>
                        <p>Date of Birth: <?php echo $date ;?></p>
                        <p>Time of Birth: <?php echo $time_of_birth;  ?></p>
                                           
                       
                                            

                                            <button id="downloadButton">Download Birth Chart</button>
                        
                    </div>

                </div>
            </div>
            </div>
            <head>

            <script>
    document.addEventListener('DOMContentLoaded', function () {
        function downloadSVG() {
            var svg = document.getElementById("birthchart");
            var serializer = new XMLSerializer();
            var source = serializer.serializeToString(svg);

            if (!source.match(/^<svg[^>]+xmlns="http:\/\/www\.w3\.org\/2000\/svg"/)) {
                source = source.replace(/^<svg/, '<svg xmlns="http://www.w3.org/2000/svg"');
            }
            if (!source.match(/^<svg[^>]+"http:\/\/www\.w3\.org\/1999\/xlink"/)) {
                source = source.replace(/^<svg/, '<svg xmlns:xlink="http://www.w3.org/1999/xlink"');
            }

            var url = "data:image/svg+xml;charset=utf-8," + encodeURIComponent(source);

            // Create a hidden link element for download
            var downloadLink = document.createElement('a');
            downloadLink.href = url;
            downloadLink.download = '<?php echo $name ?>_birthchart.svg'; // Changed from $row["name"] to $name
            downloadLink.style.display = 'none'; // Hide the link

            // Add the link to the document body
            document.body.appendChild(downloadLink);

            // Trigger the click event on the link to start the download
            downloadLink.click();

            // Remove the link from the document body
            document.body.removeChild(downloadLink);
        }

        // Assuming you have a button with the id "downloadButton"
        var button = document.getElementById("downloadButton");

        // Attach the downloadSVG function to the button click event
        button.addEventListener('click', downloadSVG);
    });
</script>


