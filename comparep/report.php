<?php
include "../includes/base.php"
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sqzrP8sP6mDHBbASmAkbXbZRspMz+LcN3OoW4xXV4yZ+zKWHl4G3JvHG6V1vWlwgqZCIS1a8X5EazbcTqSr7Aw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

// Split time_of_birth into hours, minutes, seconds
list($malehours, $maleminutes, $maleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($maleyear, $malemonth, $maleday) = explode("-", $date);









$stmt = $db->prepare("SELECT * FROM female WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$female = $stmt->fetch(PDO::FETCH_ASSOC);


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

$time_of_birth = $female['tob'];
$date = $female['dob'];
$lati = $female['latitude'];
$long = $female['longitude'];

// Split time_of_birth into hours, minutes, seconds
list($femalehours, $femaleminutes, $femaleseconds) = array_pad(explode(":", $time_of_birth), 3, '0');
// Split date into year, month, day
list($femaleyear, $femalemonth, $femaleday) = explode("-", $date);









$stmt = $db->prepare("SELECT * FROM male WHERE id=:2");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
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


      $totalscore=$output["total_score"];
    


?>




<link rel="stylesheet" href="css/report.css">
<div id="main">
    <div id="head">Compatibility Report</div>
    <div id="childcont">
        <div class="match-card">
            <div class="outercircle">
                <img src="img/male.jpg" class="innercircle">
            </div>
            <div class="name"><span class="wheat"><?php echo $male["name"] ;?></span></div>   
            <div class="details">
                <p><span class="wheat">Bio:</span> <?php echo $male["name"] ;?></p>
                <p><i class="fa-regular fa-calendar-days"></i><span class="wheat">Date of Birth:</span> <?php echo $male["dob"] ;?></p>
                <p><span class="wheat">Age:</span> <?php echo $male["age"] ;?> </p>
                <p><span class="wheat">Sign:</span>  <?php echo $male["sign"] ;?></p>
                <p><span class="wheat">Location:</span>  <?php echo $male["city"] ;?></p>
                <p><span class="wheat">BMI:</span>  <?php echo $male["bmi"] ;?></p>
               
               
                
            </div>
        </div>
     
        <div class="match-card mid">
         <div id="mid-chart">
        <canvas id="Chart"></canvas></div>
        <p><span class="wheat">Match Score </span><?php echo $totalscore;?>/36</p>
            <button onclick="window.location.href='./reportpage2.php'">View Complete Report</button>
        </div>
      
        <div class="match-card">
            <div class="outercircle">
                <img src="img/female.jpg" class="innercircle">
            </div>
            <div class="name"><span class="wheat">Radha</span></div>   
            <div class="details">
            <p><span class="wheat">Bio:</span> <?php echo $female["name"] ;?></p>
                <p><i class="fa-regular fa-calendar-days"></i><span class="wheat">Date of Birth:</span> <?php echo $female["dob"] ;?></p>
                <p><span class="wheat">Age:</span> <?php echo $female["age"] ;?> </p>
                <p><span class="wheat">Sign:</span>  <?php echo $female["sign"] ;?></p>
                <p><span class="wheat">Location:</span>  <?php echo $female["city"] ;?></p>
                <p><span class="wheat">BMI:</span>  <?php echo $female["bmi"] ;?></p>
               
        </div>
     
    </div>
</div>


<script>
    // Data for the donut chart
    var data = {
   
        datasets: [{
            data: [85, 15],
            backgroundColor: ['wheat', 'white']
        }]
    };

    // Configuration options for the chart
    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    // Get the context of the canvas element we want to select
    var ctx = document.getElementById('Chart').getContext('2d');

    // Create the donut chart
    var myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });
</script>


<?php

?>
