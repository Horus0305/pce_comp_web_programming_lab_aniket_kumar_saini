<?php
// Initialize error message variables for each input field
$nameError = "";
$phoneError = "";
$isFormSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "Addy";
    $name = isset($_POST["full_name"]) ? $_POST["full_name"] : "";
    $date = isset($_POST["birth_date"]) ? $_POST["birth_date"] : "";
    $phoneNumber = isset($_POST["number"]) ? $_POST["number"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $gender = "male";

    // Check for empty fields
    if (empty($name) || empty($date) || empty($phoneNumber) || empty($city) || empty($address)) {
        $nameError = "All fields are required. Please fill them out.";
    }

    // Check for existing username
    if ($username == "Addy") {
        $nameError = "Username already exists. Please choose a different username.";
    }

    // Check for existing phone number
    if ($phoneNumber == "1234567890") {
        $phoneError = "Phone number already exists. Please enter a different phone number.";
    }

    // If there are no errors, set form submitted flag to true
    if (empty($nameError) && empty($phoneError)) {
        $isFormSubmitted = true;
    }
}
?>

<!-- HTML Form -->
<link rel="stylesheet" href="css/proCom.css" />
<div id="profile_completion_popup" class="profile_completion_popup">
    <section class="container">
        <header>Profile Completion</header>
        <i onclick="gaayab(this.id)" id="cross" class="fi fi-rr-cross cross"></i>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-box">
                <label>Full Name <span id="name_error" class="error"><?php echo $nameError; ?></span></label>
                <input required="" id="fullName" name="full_name" placeholder="Enter full name" type="text">
            </div>
            <div class="column">
                <div id="phone" class="input-box">
                    <label>Phone Number <span id="phone_error" class="error"><?php echo $phoneError; ?></span></label>
                    <input required="" id="phoneNumber" name="number" placeholder="Enter phone number" type="tel">
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input id="birthDate" required="" name="birth_date" placeholder="Enter birth date" type="date">
                </div>
            </div>
            <div class="gender-box">
                <label>Gender</label>
                <div class="gender-option">
                    <div class="gender">
                        <input checked="" name="gender" id="check-male" type="radio">
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input name="gender" id="check-female" type="radio">
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input name="gender" id="check-other" type="radio">
                        <label for="check-other">Prefer not to say</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label>Address</label>
                <input name="address" id="address" required="" placeholder="Enter street address" type="text">
                <div class="column">
                    <div class="select-box">
                        <select>
                            <option hidden="">Country</option>
                            <option>India</option>
                            <option>USA</option>
                            <option>UK</option>
                            <option>Germany</option>
                            <option>Japan</option>
                        </select>
                    </div>
                    <input id="city" required="" name="city" placeholder="Enter your city" type="text">
                </div>
            </div>
            <button name="submit" type="submit">Submit</button>
        </form>
    </section>

    <?php
    if ($isFormSubmitted) {
        echo "<p>Form submitted successfully!</p>";
    } ?>

</div>
