<?php
session_start();
include "../includes/base.php";
require ("../includes/database_connect.php");
?>
<link rel="stylesheet" href="css/match.css" />
<div class="content">
  <div class="heading">MATCHES</div>
  <div class="matches">
<?php
    $matchgender = '';
    $gender = $_SESSION['gender'];
    $id = $_SESSION['id'];
    $matchgender = ($gender == 'male') ? 'female' : 'male';
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
      $ismatched_sql = "SELECT matched FROM matchtable WHERE $gender = $id AND matched = 1";
      $ismatched_result = $conn->query($ismatched_sql);
      $isMatched = $ismatched_result->fetch(PDO::FETCH_ASSOC);
      if ($isMatched) {
        echo "if block";
        // If matched, display the matched user's card
        $match_sql = "SELECT * FROM $matchgender WHERE id = (SELECT $matchgender FROM matchtable WHERE ($gender = $id OR $matchgender = $id) AND matched = 1)";
        $match_result = $conn->query($match_sql);
        $row = $match_result->fetch(PDO::FETCH_ASSOC);

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
                <div class="like-button liked dislike" >
                    <div class="heart-bg">
                    <div class="heart-icon liked" onclick="sendDislike(' . $_SESSION['id'] . ', ' . $row["id"] . ')"></div>
                    </div>
                </div>
            </div>
            </div>
            <a style="text-decoration:None;" href="../comparep/report.php"><div class="compreport">Click here to see the complete Compatibility Report</div></a>
            ';
      } else {
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
        $compatibleSigns = isset ($compatibility[$currentSunSign]) ? $compatibility[$currentSunSign] : array();

        $minAge = $currentUserAge - 5;
        $maxAge = $currentUserAge + 5;


        $sql = "SELECT *
                FROM $matchgender
                WHERE sign IN (" . implode(',', array_fill(0, count($compatibleSigns), '?')) . ")
                AND age BETWEEN ? AND ?
                AND NOT EXISTS (
                SELECT 1
                FROM matchtable
                WHERE ($gender = ? AND $matchgender = $matchgender.id)
                AND matched = 0
            )";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        foreach ($compatibleSigns as $index => $sign) {
          $stmt->bindValue($index + 1, $sign, PDO::PARAM_STR);
        }
        $stmt->bindValue(count($compatibleSigns) + 1, $minAge, PDO::PARAM_INT);
        $stmt->bindValue(count($compatibleSigns) + 2, $maxAge, PDO::PARAM_INT);
        $stmt->bindValue(count($compatibleSigns) + 3, $id, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) == 0) {
          echo "Currently there are no Users compatible with you, Please be patient.";
        } else {
          foreach ($rows as $row) {
            $like_sql = "SELECT COUNT(*) AS like_count FROM liketable WHERE (s_id = id AND r_id = {$row['id']})";
            $like_result = $conn->query($like_sql);
            $like_row = $like_result->fetch(PDO::FETCH_ASSOC);
            $liked_class = $like_row['like_count'] > 0 ? ' liked' : ''; // Add 'liked' class if there's a like or match record
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
                <div class="like-button' . $liked_class . '" onclick="sendLike(' . $_SESSION['id'] . ', ' . $row["id"] . ')">
                    <div class="heart-bg">
                        <div class="heart-icon"></div>
                    </div>
                </div>
            </div>
        </div>';
          }
        }
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
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Handle success response
          console.log(xhr.responseText);
          // If the like was successful, update the like button style
          var likeButton = document.querySelector('.like-button');
          if (likeButton) {
            likeButton.classList.add('liked');
          }
        } else {
          // Handle error response
          console.error('Request failed: ' + xhr.status);
        }
      }
    };
    xhr.send("likesender=" + likerUserId + "&likereceiver=" + likedUserId);
    location.reload();
  }

  function sendDislike(likerUserId, dislikedUserId) {
    var isConfirmed = confirm("Are you sure you want to break the Match ?");
    if (isConfirmed) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "dislike.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Handle success response
            console.log(xhr.responseText);
            // If the dislike was successful, remove the like button style
            var likeButton = document.querySelector('.like-button');
            if (likeButton) {
              likeButton.classList.remove('liked');
            }
          } else {
            // Handle error response
            console.error('Request failed: ' + xhr.status);
          }
        }
      };
      xhr.send("disliker=" + likerUserId + "&disliked=" + dislikedUserId);
      location.reload();
    }
  }
</script>