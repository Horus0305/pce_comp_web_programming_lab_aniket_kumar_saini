<?php
include "../includes/base.php"
<<<<<<< HEAD
?>
 <?php





=======
    ?>
<?php
>>>>>>> bc671874836b3173f07c22ca7e77947cfb502ff5
session_start();
require("../includes/database_connect.php");

<<<<<<< HEAD
// Check if session variables are set
if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
  die("Missing session variables");
=======
$conn = new mysqli($servername, $username, $password, $dbname, 8111);

if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
>>>>>>> bc671874836b3173f07c22ca7e77947cfb502ff5
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

// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $date);


$postDataBirthChart = '{
 
        "year" : (int)$maleyear,
        "month" : (int)$malemonth,
        "date" : (int)$maleday,
        "hours" : (int)$malehours,
        "minutes" : (int)$maleminutes,
        "seconds": (int)$maleseconds,
        "latitude" : (float)$malelati,
        "longitude" : (float)$malelong,
        "timezone" : 5.5,
        "config": {
            "observation_point": "topocentric",
            "ayanamsha": "lahiri"
        }}'
;








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

// Split time_of_birth into hours, minutes, seconds
list($femalehours, $femaleminutes, $femaleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($femaleyear, $femalemonth, $femaleday) = explode("-", $date);




$stmt = $db->prepare("SELECT male FROM matchtable WHERE $gender=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$matchid= $row['male'];





$stmt = $db->prepare("SELECT * FROM male WHERE id=:id");
$stmt->bindParam(':id', $matchid, PDO::PARAM_INT);
$stmt->execute();
$male = $stmt->fetch(PDO::FETCH_ASSOC);




$time_of_birth = $male['tob'];
$maledate = $male['dob'];
$malelati = $male['latitude'];
$malelong = $male['longitude'];

// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $maledate);







    }
    
   
$gender = $_SESSION['gender'];
$id = $_SESSION['id'];

$postDataBirthChart = '{
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
}';


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
        if (!empty ($data) && is_array($data) && isset ($data[0]['lat']) && isset ($data[0]['lon'])) {
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
    CURLOPT_POSTFIELDS => $postDataBirthChart,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
    ),
)
);

$responseBirthChart = curl_exec($curlBirthChart);

curl_close($curlBirthChart);

$horoscopeData = json_decode($responseBirthChart, true); // Decode JSON response for birth chart


?>

<link rel="stylesheet" href="css/match.css" />
<div class="content">

    <div class="matches">
        <div class="match-card" id="card1">
            <div class="head">
                Daily Horoscope
            </div>
            <img src="img\horo1.png" alt="horologo" id="horoimg">

            <div class="card-content">
                <?php
                $sign = 'leo';
                $url = "https://ohmanda.com/api/horoscope/$sign";
                $response = file_get_contents($url);
                $horoscopeData = json_decode($response, true);
                ?>
                <p id='ptext'>
                    <?php echo $horoscopeData['horoscope']; ?>
                </p>
            </div>

        </div>
        <div class="match-card">
            <div class="head">
                Birth Chart

            </div>

            <button class="downloadButton" style="background: #5E5DF0;
  border-radius: 999px;
  box-shadow: #a2a2d6 0 10px 20px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  margin-left: 5px;
  font-size: 10px;
  font-weight: 700;
  line-height: 15px;
  opacity: 1;
  outline: 0 solid transparent;
  padding: 8px 18px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: fit-content;
  word-break: break-word;
  border: 0;">Download Birth Chart</button>
        </div>
    </div>
</div>
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
            downloadLink.download = '<?php echo $row["name"] ?>birthchart.svg';

            // Trigger the click event on the link to start the download
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        // Assuming you have a button with the id "downloadButton"
        var button = document.getElementById("downloadButton");

        // Attach the downloadSVG function to the button click event
        button.addEventListener('click', downloadSVG);

    });
</script>