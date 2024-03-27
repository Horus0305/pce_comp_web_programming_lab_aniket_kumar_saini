<?php
include ("../includes/database_connect.php");
require_once 'Faker-master/src/autoload.php';

// Function to calculate latitude and longitude from city name
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

    return "";
}
function getRandomIndianCity() {
    $indianCities = [
        'Mumbai',
        'Delhi',
        'Bangalore',
        'Hyderabad',
        'Chennai',
        'Kolkata',
        'Ahmedabad',
        'Pune',
        'Jaipur',
        'Surat',
        'Punjab',
        'Kanpur',
        'Kalyan',
        'Seawoods',
        'Noida',
        'Nashik',
        // Add more cities as needed
    ];
    if (!empty($indianCities)) {
        // Select and return a random city from the array
        return $indianCities[array_rand($indianCities)];
    } else {
        // Return null if the array is empty
        return null;
    }
}
// Generate and insert fake data
$faker = Faker\Factory::create();
$faker->locale('en_IN');

for ($i = 0; $i < 5; $i++) {
    $name = $faker->firstNameMale . ' ' . $faker->lastName;
    $email = $faker->unique()->email;
    $password = sha1($faker->password);
    $gender = 'male';
    $number = $faker->numerify('##########');
    $city = getRandomIndianCity();
    $work = $faker->jobTitle;
    $dob = $faker->date('Y-m-d');
    $age = ageCalculator($dob);
    $pob = $city;
    $tob = $faker->time('H:i:s');
    $coords = getLatLongFromAddress($city);
    sleep(5);
    $latitude = $coords['latitude'] ?? null;
    $longitude = $coords['longitude'] ?? null;
    $height = $faker->numberBetween(150, 190);
    $weight = $faker->randomFloat(2, 40, 80);
    $bmi = $weight / (($height / 100) * ($height / 100));
    $sign = getZodiacSign($dob);
    $quote = $faker->sentence;
    $description = $faker->paragraph;

    $query = "INSERT INTO male (name, email, pass, age, gender, number, city, work, dob, pob, tob, latitude, longitude, height, weight, bmi, sign, quote, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$name, $email, $password, $age, $gender, $number, $city, $work, $dob, $pob, $tob, $latitude, $longitude, $height, $weight, $bmi, $sign, $quote, $description]);
}

// $conn->close();

echo "Fake data inserted successfully.";
?>
