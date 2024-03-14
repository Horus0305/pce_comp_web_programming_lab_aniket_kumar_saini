<?php
include "../includes/base.php"
?>
    <link rel="stylesheet" href="css/match.css" />
    <div class="content">
      <div class="heading">MATCHES</div>
      <div class="matches">
      <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cosmicdestiny';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM male";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '

            <div class="match-card">
              <div class="image">
                <img class="sign" src="img/pisces.png" alt="sign" />
                <img class="photo" src="img/male-user.png" alt="photo" />
              </div>
              <div class="overview">
                <div class="basic-info">
                  <div class="basic1">
                    <h1 id="name">'.$row["name"].'</h1>
                    <p id="age">Age : '.$row["age"].'</p>
                    <p id="sunsign">SunSign : '.$row["sign"].'</p>
                    <p id="city">City : '.$row["city"].'</p>
                    <p id="work">Student</p>
                    <p id="chances">Compatibility : 97%</p>
                  </div>
                  <div class="basic2">
                    <h3>More about me</h3>
                    <p>'.$row["description"].'</p>    
                  </div>
                </div>
                <div class="openline">"'.$row["quote"].'"</div>
              </div>
              <div class="decision">
                <p>Send a Like !!</p>
                <div class="like-button">
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

    $conn->close();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
      </div>
    </div>
    <script src="js/match.js"></script>

