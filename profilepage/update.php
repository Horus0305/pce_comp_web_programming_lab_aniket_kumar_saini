<?php
session_start(); 

$db_path = '../database/baba.db';

// Retrieve session ID
$id = $_SESSION['id'];
$gender = $_SESSION['gender'];

// Create a new PDO connection
try {
    $conn = new PDO('sqlite:' . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to calculate BMI
    function calculateBMI($weight_kg, $height_cm) {
        // Convert height from cm to meters
        $height_m = $height_cm / 100;

        // Calculate BMI
        $bmi = $weight_kg / ($height_m * $height_m);
        return $bmi;
    }

    function ageCalculator($dob){
        if(!empty($dob)){
            $birthdate = new DateTime($dob);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            return $age;
        }else{
            return 0;
        }
    }

    function getZodiacSign($date) {
        $dob = new DateTime($date);
        $month = (int)$dob->format('m');
        $day = (int)$dob->format('d');
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
            $start_date = DateTime::createFromFormat('m-d', $sign[1])->modify('-1 day');
            $end_date = DateTime::createFromFormat('m-d', $sign[2])->modify('+1 day');
            $check_date = DateTime::createFromFormat('m-d', $dateStr);

            if (($check_date >= $start_date) && ($check_date <= $end_date)) {
                return $sign[0];
            }
        }

        return "Invalid date";
    }

    function getLatLongFromAddress($address) {
        $api_url = "https://geocode.maps.co/search";
        $api_key = "65b1303f9d4df715521005atg495293";

        $params = [
            'q' => $address,
            'api_key' => $api_key
        ];

        $url = $api_url . '?' . http_build_query($params);
        $response = file_get_contents($url);

        if ($response !== false) {
            $data = json_decode($response, true);
            if (!empty($data) && is_array($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon']
                ];
            }
        }

        return null;
    }

    // Check if form data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $newweight = $_POST['weight'];
        $newheight = $_POST['height'];
        $newphoto = $_POST['photo'];
        $newnum = $_POST['number'];
        $newquote = $_POST['quote'];
        $newdescription = $_POST['description'];
        $newdob = $_POST['dob'];
        $newpob = $_POST['pob'];
        $newtob = $_POST['tob'];
        $newage = ageCalculator($newdob);
        $passw = $_POST['edpass'];
        $newcity = $_POST['city'];
        $newwork = $_POST['occupation'];
        $newsign = getZodiacSign($newdob);

        // Calculate new BMI
        $newbmi = calculateBMI($newweight, $newheight);

        $AddressInfo = getLatLongFromAddress($_POST['pob']);
        if ($AddressInfo === null) {
            echo '<div>Error: Unable to fetch latitude and longitude for female address.</div>';
            exit;
        }  
        else{
            $lat=$AddressInfo['latitude'];
            $long=$AddressInfo['longitude'];
            // Check if password matches session password
            if (sha1($passw) == $_SESSION['pass']) {
                // Update user information in the database
                $stmt = $conn->prepare("UPDATE $gender SET weight=:newweight, work=:newwork, sign=:newsign, city=:newcity, dob=:newdob, pob=:newpob, tob=:newtob, age=:newage, height=:newheight, photocontent=:newphoto, number=:newnum, bmi=:newbmi, quote=:newquote, description=:newdescription, latitude=:lat, longitude=:long WHERE id=:id");
                $stmt->bindParam(':newweight', $newweight);
                $stmt->bindParam(':newwork', $newwork);
                $stmt->bindParam(':newsign', $newsign);
                $stmt->bindParam(':newcity', $newcity);
                $stmt->bindParam(':newdob', $newdob);
                $stmt->bindParam(':newpob', $newpob);
                $stmt->bindParam(':newtob', $newtob);
                $stmt->bindParam(':newage', $newage);
                $stmt->bindParam(':newheight', $newheight);
                $stmt->bindParam(':newphoto', $newphoto);
                $stmt->bindParam(':newnum', $newnum);
                $stmt->bindParam(':newbmi', $newbmi);
                $stmt->bindParam(':newquote', $newquote);
                $stmt->bindParam(':newdescription', $newdescription);
                $stmt->bindParam(':lat', $lat);
                $stmt->bindParam(':long', $long);
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {
                    echo '<script>alert("Details updated successfully!!!");window.location.href = "../profilepage/profile.php";</script>';
                } else {
                    echo '<script>alert("Error updating record: ' . $conn->error . '");window.location.href = "../profilepage/profile.php";</script>';
                }
            } else {
                echo '<script>alert("Password is incorrect");window.location.href = "../profilepage/profile.php";</script>';
            }
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
// Close the database connection
$conn = null;
?>
