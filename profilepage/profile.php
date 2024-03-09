<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cosmicdestiny";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$pass = $_SESSION['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['id'] = $row['uid'];
$_SESSION['pass'] = $row['pass'];
$v1 = "";
$v2 = "";
$v3 = "";
$v4 = "";
$v5 = "";
if ($row['name'] != NULL) {
  $v1 = "disabled";
}
if ($row['dob'] != NULL) {
  $v2 = "readonly='readonly'";
}
if ($row['gender'] != NULL) {
  $v3 = "disabled";
}
if ($row['pob'] != NULL) {
  $v4 = "readonly='readonly'";
}
if ($row['tob'] != NULL) {
  $v5 = "readonly='readonly'";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/profile.css" />
  <title>My Profile</title>
</head>

<body>
  <div class="header">
    <a class="imgbtn" id="backbtn" href="">
      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAATlJREFUaEPt2NENwjAMBFB7E9gENoFNYBJgEhiFTQxBqoSqNnFsN71K4bM04Z4diSRMG//wxvNTB6zdwd6B3gFnBfoSGhdQRHbM/HYWVj08tAMiciCiJxFdmfmiTuF4MQzwF36I0wQRApgIPyD2Sy8nNyAT/sjML8fqUA11AdYOn4RmAEJ4MwAlvAmAFL4agBa+CoAYXg1ADa8CIIcvAtDDZwGZ8Kp/yOiX+Ls7nJpz8iFa+F+lKwEnIrpFV9EzXxUg/ZCIQCGqARlEOm09Wh1YSl0rbuZmOgGDKALQO6ECICPUAFREFQARUQ1AQ5gASAgzAAXhAiAg3IACIt0NLXpPGgKYQZyZ+V7aCni/DwOMEE3CF09klups+nrdAvaOCV1C3jCW8R1gqVrkmN6ByGpa5uodsFQtcswHw7mlMdLGDtIAAAAASUVORK5CYII=" /></a>
    <p id="heading">My Profile</p>
    <a class="imgbtn" id="logoutbtn" href=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAZpJREFUaEPtWYFtAjEMtDcpmzBKmaTtJLBJRymbuH8oVCEfcMg73zdyJMRLEMd3PieOn8n5YOf+UwD47whGBF4qAiLyRkQfRLQnIjxbjDMR4XNgZnzfDDMJJed/LDx+YGNXgrAEcJyYeh8M4IuZP/M1LAHIYOdh/szMu1UA8ESVBSARuSGmtGuyCBzVFuoFo9kNAFdmNaYiAomByIGUsEdmPuSycCGhdNriwNqXodw8ABFBffN9Zd1qn9eSWyOmaRsVEZQIYP5vuAEgItUaZ/MAcr3XwrxpAKXeNZ0u+V0j4ukcqOl9iYPa3BEAUG/jVrXKMAeQDipcB7FlWl0L75IxBEALCG1hq/A9nQNFeYAI4AyYScoFgKxUnuWFKwA1SbkDUIJwV8xlcrrkRdne0JKtN6k1u03FXMvi2kItNmr/0ewGgExaD/s3EYHEQFzq70lBSzYPEkJrfXTxN7S5u0Z7/VS2cyy30dEl+Ix9yNIMQFZqIBIAYymn0+QrXm6Me8XUm6RL55lGYKkzPfMDQA9rlnMiApZs9tj6BV6fG0CJal3uAAAAAElFTkSuQmCC" /></a>
  </div>
  <div class="top">
    <div class="row">
      <div class="col-md-4 mt-1">
        <div class="card text-center sidebar">
          <div class="card-body">
            <!-- <img
                src="img/pisces.png"
                class="rounded-circle sign"
                width="150"
              /> -->
            <img src="img/male-user.png" class="rounded-circle photo" width="150" />
            <div class="mt-3">
              <h3><?php
                  echo $row["name"];
                  ?></h3>
              <div class="col">
                <button id="editpfbtn" onclick="">Edit Profile</button>
                <button id="delacbtn" onclick="">Delete Account</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-body" style="text-align: center; width: 100%;">
            <?php
            echo $row["description"];
            ?>
          </div>
        </div>
        <div class="card-body">
          <div class="card-body" style="text-align: center; width: 100%; font-size: 1.5rem;">
            <i><?php
                echo $row["quote"];
                ?></i>
          </div>
        </div>
      </div>
      <div class="col-md-8 mt-1">
        <div class="card mb-3 content">
          <!-- <h1 class="m-3 pt-3">Basic Information</h1> -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <h5>Full Name</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["name"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Age</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["age"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Email</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["email"];
                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <h5>Phone</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["number"];
                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <h5>City</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["pob"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Gender</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["gender"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Height</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["height"];
                ?>
                cm</div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Weight</h5>
              </div>
              <div class="col-md-9 text-secondary"><?php
                                                    echo $row["weight"];
                                                    ?> Kg</div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Place of Birth</h5>
              </div>
              <div class="col-md-9 text-secondary"><?php
                                                    echo $row["pob"];
                                                    ?></div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Date of Birth</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["dob"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Time of Birth</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["tob"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Sun Sign</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["sign"];
                ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>BMI</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["bmi"];
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="deleteModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span id="delclose">&times;</span>
      <h2>Confirm Your Identity</h2>
      <form id="loginForm" action="del.php" method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required /><br /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required /><br /><br />
        <input type="submit" value="Submit" />
      </form>
    </div>
  </div>

  <div id="editModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div id="edclose">&times;</div>
      <form id="modalForm" action="update.php" method="post">
        <label for="fullname"><b>Full Name:</b></label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row["name"]; ?>" <?php echo $v1 ?> required /><br />

        <label for="dob"><b>Date of Birth:</b></label>
        <input type="date" id="dob" name="dob" value="<?php echo $row["dob"]; ?>" <?php echo $v2 ?>required /><br />

        <label for="pob"><b>Place of Birth:</b></label>
        <input type="text" id="pob" name="pob" value="<?php echo $row["pob"]; ?>" <?php echo $v4 ?> required /><br />

        <label for="tob"><b>Time of Birth:</b></label>
        <input type="time" id="tob" name="tob" value="<?php echo $row["tob"]; ?>" <?php echo $v5 ?> required /><br />

        <label for="gender"><b>Gender:</b></label>
        <select id="gender" name="gender" value="Male" <?php echo $v3 ?> required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select><br />

        <label for="weight"><b>Weight:</b></label>
        <input type="number" id="weight" name="weight" value="<?php echo $row["weight"]; ?>" required /><br />

        <label for="height"><b>Height:</b></label>
        <input type="number" id="height" name="height" value="<?php echo $row["height"]; ?>" required /><br />

        <label for="photo"><b>Photo:</b></label>
        <input type="file" id="photo" name="photo" accept="image/*" /><br />

        <!-- <label for="email"><b>Email:</b></label>
        <input type="email" id="email" name="email" value="<?php echo $row["email"]; ?>" required /><br /> -->

        <label for="number"><b>Number:</b></label>
        <input type="tel" id="number" name="number" value="<?php echo $row["number"]; ?>" required />

        <label for="onelinequote"><b>One Liner:</b></label>
        <input type="text" id="onelinequote" name="quote" value="<?php echo $row["quote"]; ?>" required />

        <label for="description"><b>Short Description About Yourself:</b></label>
        <textarea type="text" id="description" name="description" required rows="7"><?php echo $row["description"]; ?></textarea>

        <label for="password"><b>Password</b></label>
        <input type="password" id="edpass" name="edpass" required />

        <input type="submit" value="Update" />
      </form>
    </div>
  </div>
  <script>
    // Get the modals
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("deleteModal");
    const body = document.getElementsByTagName("body")[0];

    // Get the buttons that opens the modals
    const editBtn = document.getElementById("editpfbtn");
    const deleteBtn = document.getElementById("delacbtn");

    // Get the <span> elements that closes the modals
    const editSpan = document.getElementById("edclose");
    const deleteSpan = document.getElementById("delclose");

    editBtn.addEventListener("click", function() {
      editModal.style.display = "block";
      body.style.overflow = "hidden";
    });

    deleteBtn.addEventListener("click", function() {
      deleteModal.style.display = "block";
      body.style.overflow = "hidden";
    });

    editSpan.addEventListener("click", function() {
      editModal.style.display = "none";
      body.style.overflow = "";
    });

    deleteSpan.addEventListener("click", function() {
      deleteModal.style.display = "none";
      body.style.overflow = "";
    });

    window.addEventListener("click", function(event) {
      if (event.target == editModal) {
        editModal.style.display = "none";
        body.style.overflow = "";
      }
      if (event.target == deleteModal) {
        deleteModal.style.display = "none";
        body.style.overflow = "";
      }
    });
  </script>
  <script>
    const validateFullName = (fullName) => /^[a-zA-Z\s]+$/.test(fullName);
    const validateTimeOfBirth = (timeOfBirth) => /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(timeOfBirth);
    const validateDateOfBirth = (dateOfBirth) => new Date(dateOfBirth) <= new Date();
    const calculateAge = (dateOfBirth) => Math.floor((new Date() - new Date(dateOfBirth)) / (1000 * 60 * 60 * 24 * 365));
    const validateWeight = (weight) => !isNaN(weight) && weight > 0 && weight < 1000;
    const validateHeight = (height) => !isNaN(height) && height > 0 && height < 300;
    const validatePhoneNumber = (number) => /^\d{10}$/.test(number);
    const validatePlaceOfBirth = (placeOfBirth) => /^[a-zA-Z\s]+$/.test(placeOfBirth);


    const form = document.getElementById('modalForm');
    const inputs = ['fullname', 'tob', 'dob', 'pob', 'weight', 'height', 'number'].map(id => document.getElementById(id));

    form.addEventListener('submit', (event) => {
      inputs.forEach(input => {
        if (!input.checkValidity()) {
          event.preventDefault();
          return;
        }
      });
    });

    inputs.forEach(input => {
      input.addEventListener('input', () => {
        if (input.id === 'dob') {
          if (validateDateOfBirth(input.value)) {
            const age = calculateAge(input.value);
            if (age < 18) {
              input.setCustomValidity('You must be at least 18 years old');
            } else {
              input.setCustomValidity('');
            }
          } else {
            input.setCustomValidity('Date of birth cannot be a date in the future');
          }
        } else if (input.id === 'tob') {
          if (!validateTimeOfBirth(input.value)) {
            input.setCustomValidity('Time of birth should be in HH:MM format');
          } else {
            input.setCustomValidity('');
          }
        } else if (input.id === 'fullname') {
          if (!validateFullName(input.value)) {
            input.setCustomValidity('Full name should only contain characters');
          } else {
            input.setCustomValidity('');
          }
        } else if (input.id === 'number') {
          if (!validatePhoneNumber(input.value)) {
            input.setCustomValidity('Phone number should be a 10-digit number');
          } else {
            input.setCustomValidity('');
          }
        } else if (input.id === 'height') {
          if (!validateHeight(input.value)) {
            input.setCustomValidity('Height should be a number between 1 and 300');
          } else {
            input.setCustomValidity('');
          }
        } else if (input.id === 'weight') {
          if (!validateWeight(input.value)) {
            input.setCustomValidity('Weight should be a number between 1 and 1000');
          } else {
            input.setCustomValidity('');
          }
        } else if (input.id === 'pob') {
          if (!validatePlaceOfBirth(input.value)) {
            input.setCustomValidity('Place of Birth should only contain characaters');
          } else {
            input.setCustomValidity('');
          }
        }
      });
    });
  </script>
</body>

</html>