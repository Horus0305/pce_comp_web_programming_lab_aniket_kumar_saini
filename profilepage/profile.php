<?php
session_start();
require("../includes/database_connect.php");
$gender = $_SESSION['gender'];
$id = $_SESSION['id'];
echo $gender;

if (!isset($_SESSION['gender']) || !isset($_SESSION['id'])) {
  die("Missing session variables");
}


$stmt = $db->prepare("SELECT * FROM $gender WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$v1 = "";
$v2 = "";
$v3 = "";
$v4 = "";
$v5 = "";
if ($row['name'] != NULL) {
  $v1 = "disabled";
}
if ($row['dob'] != NULL) {
  $v2 = "readonly='readonly' style='background-color: rgb(121, 125, 136)'";
}
if ($row['gender'] != NULL) {
  $v3 = "disabled";
}
if ($row['pob'] != NULL) {
  $v4 = "readonly='readonly' style='background-color: rgb(121, 125, 136)'";
}
if ($row['tob'] != NULL) {
  $v5 = "readonly='readonly' style='background-color: rgb(121, 125, 136)'";
}
session_commit();
$db = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="website icon" type="png" href="../landingpage/img/favicon.png" />
  <link rel="stylesheet" href="css/profile.css" />

  <title>My Profile</title>
</head>

<body>
  <div class="header">
    <a class="imgbtn" id="backbtn" href="">
      <img src="img/back-btn.png" /></a>
    <p id="heading">My Profile</p>
    <a class="imgbtn" id="logoutbtn" href="logout.php"><img src="img/log-out.png" /></a>
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
            <div class="row">
              <div class="col-md-3">
                <h5>Occupation</h5>
              </div>
              <div class="col-md-9 text-secondary">
                <?php
                echo $row["work"];
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

            <div class="row">
              <div class="col-md-3">
                <h5>Weight</h5>
              </div>
              <div class="col-md-9 text-secondary"><?php
                                                    echo $row["weight"];
                                                    ?> Kg</div>
            </div>
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
            <hr />
            <div class="row">
              <div class="col-md-3">
                <h5>Place of Birth</h5>
              </div>
              <div class="col-md-9 text-secondary"><?php
                                                    echo $row["pob"];
                                                    ?></div>
            </div>
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
      <form id="modalForm" action="update.php" method="post" enctype="multipart/form-data">
        <label for="fullname"><b>Full Name:</b></label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row["name"]; ?>" <?php echo $v1 ?> required /><br />

        <label for="dob"><b>Date of Birth:</b></label>
        <input type="date" id="dob" name="dob" value="<?php echo $row["dob"]; ?>" <?php echo $v2 ?>required /><br />

        <label for="pob"><b>Place of Birth:</b></label>
        <input type="text" id="pob" name="pob" value="<?php echo $row["pob"]; ?>" <?php echo $v4 ?> required /><br />

        <label for="tob"><b>Time of Birth:</b></label>
        <input type="time" id="tob" name="tob" value="<?php echo $row["tob"]; ?>" <?php echo $v5 ?> required /><br />

        <label for="gender"><b>Gender:</b></label>
        <input type="text" id="gender" name="gender" value="<?php echo ucfirst($row["gender"]); ?>" <?php echo $v3 ?> required /><br />

        <label for="city"><b>City:</b></label>
        <input type="text" id="city" name="city" value="<?php echo $row["city"]; ?>"/><br />

        <label for="city"><b>Occupation:</b></label>
        <input type="text" id="occupation" name="occupation" value="<?php echo $row["work"]; ?>"/><br />

        <label for="weight"><b>Weight:</b></label>
        <input type="number" id="weight" name="weight" value="<?php echo $row["weight"]; ?>" required /><br />

        <label for="height"><b>Height:</b></label>
        <input type="number" id="height" name="height" value="<?php echo $row["height"]; ?>" required /><br />

        <label for="photo"><b>Photo:</b></label>
        <input type="file" id="photo" name="photo"/><br />

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
    const validateCity = (city) => /^[a-zA-Z\s]+$/.test(placeOfBirth);
    const validateOccupation = (occupation) => /^[a-zA-Z\s]+$/.test(occupation);


    const form = document.getElementById('modalForm');
    const inputs = ['fullname', 'tob', 'dob', 'pob', 'weight', 'height', 'number', 'occupation'].map(id => document.getElementById(id));

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
        }else if (input.id === 'city') {
          if (!validatePlaceOfBirth(input.value)) {
            input.setCustomValidity('City should only contain characaters');
          } else {
            input.setCustomValidity('');
          }
        }else if (input.id === 'occupation') {
          if (!validateOccupation(input.value)) {
            input.setCustomValidity('Occupation should only contain characaters');
          } else {
            input.setCustomValidity('');
          }
        }
      });
    });
  </script>
</body>

</html>