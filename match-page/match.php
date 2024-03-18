<?php
include "../includes/base.php";
require("../includes/database_connect.php");
?>
<link rel="stylesheet" href="css/match.css" />
<div class="content">
  <div class="heading">MATCHES</div>
  <div class="matches">
    <?php
    $matchgender = '';
    session_start();
    if ($_SESSION['gender'] == 'male') {
      $matchgender = 'female';
    } else {
      $matchgender = 'male';
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function interpretBMI($bmi)
    {
      if ($bmi < 18.5) {
        return "Underweight";
      } elseif ($bmi >= 18.5 && $bmi < 23) {
        return "Normal weight (Healthy BMI)";
      } elseif ($bmi >= 23 && $bmi < 25) {
        return "Overweight (Potential risk)";
      } elseif ($bmi >= 25 && $bmi < 30) {
        return "Overweight (Increased risk)";
      } elseif ($bmi >= 30 && $bmi < 35) {
        return "Obese (Moderate risk)";
      } elseif ($bmi >= 35 && $bmi < 40) {
        return "Obese (High risk)";
      } elseif ($bmi >= 40) {
        return "Obese (Very high risk)";
      } else {
        return "Invalid BMI";
      }
    }

    try {

      $currentUserAge = $_SESSION['age'];

      $compatibility = array(
        "Aries" => array("Leo", "Sagittarius", "Gemini", "Aquarius"),
        "Taurus" => array("Virgo", "Capricorn", "Pisces", "Cancer"),
        "Gemini" => array("Libra", "Aquarius", "Aries", "Leo"),
        "Cancer" => array("Scorpio", "Pisces", "Taurus", "Virgo"),
        "Leo" => array("Sagittarius", "Aries", "Gemini", "Libra"),
        "Virgo" => array("Capricorn", "Taurus", "Cancer", "Scorpio"),
        "Libra" => array("Aquarius", "Gemini", "Leo", "Sagittarius"),
        "Scorpio" => array("Pisces", "Cancer", "Virgo", "Capricorn"),
        "Sagittarius" => array("Aries", "Leo", "Libra", "Aquarius"),
        "Capricorn" => array("Taurus", "Virgo", "Scorpio", "Pisces"),
        "Aquarius" => array("Gemini", "Libra", "Sagittarius", "Aries"),
        "Pisces" => array("Cancer", "Scorpio", "Capricorn", "Taurus")
      );

      $currentSunSign = $_SESSION['sign'];
      $compatibleSigns = isset($compatibility[$currentSunSign]) ? $compatibility[$currentSunSign] : array();

      $minAge = $currentUserAge - 5;
      $maxAge = $currentUserAge + 5;

      // Construct SQL query
      $sql = "SELECT * FROM $matchgender WHERE sign IN ('" . implode("', '", $compatibleSigns) . "') AND age BETWEEN $minAge AND $maxAge";

      $result = $conn->query($sql);

      if ($result !== false) {
        // Output data of each row
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          echo '
            <div class="match-card">
              <div class="image">
                <img class="sign" src="img/pisces.png" alt="sign" />
                <img class="photo" src="img/male-user.png" alt="photo" />
              </div>
              <div class="overview">
                <div class="basic-info">
                  <div class="basic1">
                    <h1 id="name">' . $row["name"] . '</h1>
                    <p id="age">Age : ' . $row["age"] . '</p>
                    <p id="sunsign">SunSign : ' . $row["sign"] . '</p>
                    <p id="city">City : ' . $row["city"] . '</p>
                    <p id="work">Physique :' . interpretBMI($row['bmi']) . '</p>
                    <p id="work">' . $row["work"] . '</p>
                  </div>
                  <div class="basic2">
                    <h3>More about me</h3>
                    <p>' . $row["description"] . '</p>    
                  </div>
                </div>
                <div class="openline">"' . $row["quote"] . '"</div>
              </div>
              <div class="decision">
                <p>Send a Like !!</p>
                <div class="like-button" onclick="sendLike(' . $_SESSION['id'] . ', ' . $row["id"] . ')">
                  <div class="heart-bg">
                    <div class="heart-icon"></div>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
      } else {
        echo "0 results";
      }

      $conn = null; // Close the connection
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
    ?>
  </div>
</div>
<script src="js/match.js"></script>
<script>
  function sendLike(likerUserId, likedUserId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "like.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Handle success response
          console.log(xhr.responseText);
        } else {
          // Handle error response
          console.error('Request failed: ' + xhr.status);
        }
      }
    };
    xhr.send("likesender=" + likerUserId + "&likereceiver=" + likedUserId);
  }
</script>
