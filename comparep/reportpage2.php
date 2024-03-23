<?php
include "../includes/base.php";

?>

        
   
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


$name = $male['name'];
$namepart=explode(" ", $name);
$malefirstname=$namepart[0];

// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $date);


$stmt = $db->prepare("SELECT female FROM matchtable WHERE $gender=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$matchid= $row['female'];






$stmt = $db->prepare("SELECT * FROM female WHERE id=:id");
$stmt->bindParam(':id', $matchid, PDO::PARAM_INT);
$stmt->execute();
$female = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $female['name'];
$namepart=explode(" ", $name);
$femalefirstname=$namepart[0];

$time_of_birth = $female['tob'];
$femaledate = $female['dob'];
$femalelati = $female['latitude'];
$femalelong = $female['longitude'];

// Split time_of_birth into hours, minutes, seconds
list($femalehours, $femaleminutes, $femaleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($femaleyear, $femalemonth, $femaleday) = explode("-", $date);








}


if($gender=="female"){


    $stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$female = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $female['name'];
$namepart=explode(" ", $name);
$femalefirstname=$namepart[0];
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

$name = $male['name'];
$namepart=explode(" ", $name);
$malefirstname=$namepart[0];


$time_of_birth = $male['tob'];
$maledate = $male['dob'];
$malelati = $male['latitude'];
$malelong = $male['longitude'];

// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $maledate);







    }
    $request_data = [
        "female" => [
            "year" => (int)$femaleyear,
            "month" => (int)$femalemonth,
            "date" => (int)$femaleday,
            "hours" => (int)$femalehours,
            "minutes" => (int)$femaleminutes,
            "seconds" => (int)$femaleseconds,
            "latitude" => (float)$femalelati,
            "longitude" => (float)$femalelong,
            "timezone" => 5.5
        ],
        "male" => [
            "year" => (int)$maleyear,
            "month" => (int)$malemonth,
            "date" => (int)$maleday,
            "hours" => (int)$malehours,
            "minutes" => (int)$maleminutes,
            "seconds" => (int)$maleseconds,
            "latitude" => (float)$malelati,
            "longitude" => (float)$malelong,
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


// Check if the 'output' key exists in the response
if (isset($data['output'])) 
    $output = $data['output'];

   
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sqzrP8sP6mDHBbASmAkbXbZRspMz+LcN3OoW4xXV4yZ+zKWHl4G3JvHG6V1vWlwgqZCIS1a8X5EazbcTqSr7Aw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="css/reportpage2.css">
<div id="main">
    <div id="head"><?php echo ucfirst($femalefirstname) ?><img src="img\hearticon.png" alt="hearticon" id="heart-icon"> <?php echo ucfirst($malefirstname) ?></div>
    <div id="childcont">
<!-- HTML for the table --> 
<table class="rwd-table">
  <tbody>
    <tr>
      <th>Guna</th>
      <th>Bride</th>
      <th>Groom</th>
      <th>Score</th>
      <th>Max Score</th>
      <th>Area of Life</th>
    </tr>
    <tr>
      <td data-th="Parameter">Varna</td>
      <td data-th="Bride"><?php echo isset($output['varna_kootam']['bride']['varnam_name']) ? $output['varna_kootam']['bride']['varnam_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['varna_kootam']['groom']['varnam_name']) ? $output['varna_kootam']['groom']['varnam_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['varna_kootam']['score']) ? $output['varna_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['varna_kootam']['out_of']) ? $output['varna_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Work</td>
    </tr>
    <tr>
      <td data-th="Parameter">Vasya</td>
      <td data-th="Bride"><?php echo isset($output['vasya_kootam']['bride']['bride_kootam_name']) ? $output['vasya_kootam']['bride']['bride_kootam_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['vasya_kootam']['groom']['groom_kootam_name']) ? $output['vasya_kootam']['groom']['groom_kootam_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['vasya_kootam']['score']) ? $output['vasya_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['vasya_kootam']['out_of']) ? $output['vasya_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Dominance</td>
     </tr>
    <tr>
      <td data-th="Parameter">Tara</td>
      <td data-th="Bride"><?php echo isset($output['tara_kootam']['bride']['star_name']) ? $output['tara_kootam']['bride']['star_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['tara_kootam']['groom']['star_name']) ? $output['tara_kootam']['groom']['star_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['tara_kootam']['score']) ? $output['tara_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['tara_kootam']['out_of']) ? $output['tara_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Destiny</td>
    </tr>
    <tr>
      <td data-th="Parameter">Yoni</td>
      <td data-th="Bride"><?php echo isset($output['yoni_kootam']['bride']['yoni']) ? $output['yoni_kootam']['bride']['yoni'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['yoni_kootam']['groom']['yoni']) ? $output['yoni_kootam']['groom']['yoni'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['yoni_kootam']['score']) ? $output['yoni_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['yoni_kootam']['out_of']) ? $output['yoni_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Mentality</td>
    </tr>
    <tr>
      <td data-th="Parameter">Graha Maitri</td>
      <td data-th="Bride"><?php echo isset($output['graha_maitri_kootam']['bride']['moon_sign_lord_name']) ? $output['graha_maitri_kootam']['bride']['moon_sign_lord_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['graha_maitri_kootam']['groom']['moon_sign_lord_name']) ? $output['graha_maitri_kootam']['groom']['moon_sign_lord_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['graha_maitri_kootam']['score']) ? $output['graha_maitri_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['graha_maitri_kootam']['out_of']) ? $output['graha_maitri_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Compatibility</td>
    </tr>
    <tr>
      <td data-th="Parameter">Gana</td>
      <td data-th="Bride"><?php echo isset($output['gana_kootam']['bride']['bride_nadi_name']) ? $output['gana_kootam']['bride']['bride_nadi_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['gana_kootam']['groom']['groom_nadi_name']) ? $output['gana_kootam']['groom']['groom_nadi_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['gana_kootam']['score']) ? $output['gana_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['gana_kootam']['out_of']) ? $output['gana_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Guna level</td>  
    </tr>
    <tr>
      <td data-th="Parameter">Rasi</td>
      <td data-th="Bride"><?php echo isset($output['rasi_kootam']['bride']['moon_sign_name']) ? $output['rasi_kootam']['bride']['moon_sign_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['rasi_kootam']['groom']['moon_sign_name']) ? $output['rasi_kootam']['groom']['moon_sign_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['rasi_kootam']['score']) ? $output['rasi_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['rasi_kootam']['out_of']) ? $output['rasi_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Love</td>
    </tr>
    <tr>
      <td data-th="Parameter">Nadi</td>
      <td data-th="Bride"><?php echo isset($output['nadi_kootam']['bride']['nadi_name']) ? $output['nadi_kootam']['bride']['nadi_name'] : ''; ?></td>
      <td data-th="Groom"><?php echo isset($output['nadi_kootam']['groom']['nadi_name']) ? $output['nadi_kootam']['groom']['nadi_name'] : ''; ?></td>
      <td data-th="Score"><?php echo isset($output['nadi_kootam']['score']) ? $output['nadi_kootam']['score'] : ''; ?></td>
      <td data-th="Max Score"><?php echo isset($output['nadi_kootam']['out_of']) ? $output['nadi_kootam']['out_of'] : ''; ?></td>
      <td data-th="Area of Life">Health</td>
    </tr>
    <tr>
      <td data-th="Parameter" style="color:#f8af28">Total</td>
      <td data-th="Bride"></td>
      <td data-th="Groom"></td>
      <td data-th="Score" style="color:#f8af28"><?php echo isset($output['total_score']) ? $output['total_score'] : ''; ?></td>
      <td data-th="Max Score" style="color:#f8af28">36</td>
      <td data-th="Area of Life"></td>
    </tr>
  </tbody>
</table>





