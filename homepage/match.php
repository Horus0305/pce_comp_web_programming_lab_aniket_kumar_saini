<?php
session_start();
include "../includes/base.php";
require("../includes/database_connect.php");

// Check if session variables are set
if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
    die("Missing session variables");
}

$gender = $_SESSION['gender'];
$id = $_SESSION['id'];



// Fetch user's sign based on gender
$stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if (!$stmt->execute()) {
    die("Failed to fetch user data.");
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User data not found.");
}

$sign = strtolower($user['sign']);

// Fetch horoscope based on user's sign
$stmt = $db->prepare("SELECT * FROM horoscopes WHERE sign=:sign");
$stmt->bindParam(':sign', $sign, PDO::PARAM_STR);
if (!$stmt->execute()) {
    die("Failed to fetch horoscope data.");
}
else{
$horoscope = $stmt->fetch(PDO::FETCH_ASSOC); 
}
?>

<link rel="stylesheet" href="css/match.css" />
<div class="content">
    <div class="matches">
        <div class="match-card" id="card1">
            <div class="head" style = "font-weight:bold">
                Daily Horoscope
            </div>
            <img src=<?php echo "../landingpage/img/signs/".$sign.".svg"?> alt="horologo" id="horoimg">
            <div class="card-content">
                <p id='ptext' style = "text-align:center">
                    <?php echo $horoscope['horoscope']; ?>
                </p>
            </div>
        </div>
        <div class="match-card">
            <div class="head" style = "font-size:1.5rem">
                

            "Unlock cosmic insights with our dynamic matchmaking birth chart tool."        
            </div>


        <a href="../Page3/birthchart.php" ><button class="downloadButton" style="background: #9239e6;width:100%;height:100px
  border-radius: 999px;
  box-shadow: #a2a2d640 0 15px 15px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  margin-left: 5px;
  margin-top:10px;
  font-size: 15px;
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
  border: 0;">View Birth Chart</button></a>
        </div>
    </div>
</div>

