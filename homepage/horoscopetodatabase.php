<?php
// Set up SQLite database connection
require("../includes/database_connect.php");

// Create table to store horoscope data
try {
    $db->exec("CREATE TABLE IF NOT EXISTS horoscopes (
        id INTEGER PRIMARY KEY,
        sign TEXT,
        horoscope TEXT
    )");
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Function to insert horoscope data into the table
function insertHoroscope($db, $sign, $horoscope) {
    try {
        $stmt = $db->prepare("INSERT INTO horoscopes (sign, horoscope) VALUES (?, ?)");
        $stmt->execute([$sign, $horoscope]);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Array of all 12 horoscope signs
$signs = ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];

// Loop through each sign, fetch data and insert into the table
foreach ($signs as $sign) {
    $url = "https://ohmanda.com/api/horoscope/$sign";
    $response = file_get_contents($url);
    $horoscopeData = json_decode($response, true);
    $horoscope = $horoscopeData['horoscope'];
    insertHoroscope($db, $sign, $horoscope);
}

echo "Horoscope data inserted successfully!";
?>
