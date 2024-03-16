<?php

function getZodiacSign($date) {
    $dob = new DateTime($date);
    $month = (int)$dob->format('m');
    $day = (int)$dob->format('d');

    // Zodiac sign dates
    $zodiacSigns = array(
        array("Aquarius", "01-20", "02-18"),
        array("Pisces", "02-19", "03-20"),
        array("Aries", "03-21", "04-19"),
        array("Taurus", "04-20", "05-20"),
        array("Gemini", "05-21", "06-20"),
        array("Cancer", "06-21", "07-22"),
        array("Leo", "07-23", "08-22"),
        array("Virgo", "08-23", "09-22"),
        array("Libra", "09-23", "10-22"),
        array("Scorpio", "10-23", "11-21"),
        array("Sagittarius", "11-22", "12-21"),
        array("Capricorn", "12-22", "01-19")
    );

    $dateStr = sprintf("%02d-%02d", $month, $day);

    foreach ($zodiacSigns as $sign) {
        $start_date = DateTime::createFromFormat('m-d', $sign[1]);
        $end_date = DateTime::createFromFormat('m-d', $sign[2]);
        $check_date = DateTime::createFromFormat('m-d', $dateStr);

        if (($check_date >= $start_date) && ($check_date <= $end_date)) {
            return $sign[0];
        }
    }

    return "Invalid date";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if date of birth is set
    if (isset($_POST['dob'])) {
        $dateOfBirth = $_POST['dob'];
        $zodiacSign = getZodiacSign($dateOfBirth);
        echo "Your Zodiac sign is: $zodiacSign";
    } else {
        echo "Date of birth is not set!";
    }
}
?>
