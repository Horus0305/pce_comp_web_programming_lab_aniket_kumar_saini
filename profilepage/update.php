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
            array("Aries", "04-14", "05-14"), // Mesha
            array("Taurus", "05-15", "06-15"), // Vrishabha
            array("Gemini", "06-16", "07-15"), // Mithuna
            array("Cancer", "07-16", "08-15"), // Karka
            array("Leo", "08-16", "09-15"), // Simha
            array("Virgo", "09-16", "10-15"), // Kanya
            array("Libra", "10-16", "11-15"), // Tula
            array("Scorpio", "11-16", "12-15"), // Vrischika
            array("Sagittarius", "12-16", "01-13"), // Dhanu
            array("Capricorn", "01-14", "02-12"), // Makara
            array("Aquarius", "02-13", "03-13"), // Kumbha
            array("Pisces", "03-14", "04-13") // Meena
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
        $newphoto = $_FILES['photo'];
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
        if ($newphoto['error'] !== UPLOAD_ERR_OK) {
            echo '<script>alert("Error uploading file");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }
    
        // Validate file type (optional)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($newphoto['type'], $allowedTypes)) {
            echo '<script>alert("Invalid file type");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }
        $newphotoContent = file_get_contents($newphoto['tmp_name']);
        // Validate password
        if (empty($passw)) {
            echo '<script>alert("Password cannot be empty");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }

        // Validate date of birth
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $newdob)) {
            echo '<script>alert("Invalid date of birth format");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }

        // Validate height and weight
        if (!is_numeric($newheight) || !is_numeric($newweight) || $newheight <= 0 || $newweight <= 0) {
            echo '<script>alert("Invalid height or weight");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }

        // Validate phone number
        if (!preg_match('/^\d{10}$/', $newnum)) {
            echo '<script>alert("Invalid phone number");window.location.href = "../profilepage/profile.php";</script>';
            exit;
        }

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
                $stmt->bindParam(':newphoto', $newphotoContent, PDO::PARAM_LOB);
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
                    echo '<script>alert("Error updating record:");window.location.href = "../profilepage/profile.php";</script>';
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
