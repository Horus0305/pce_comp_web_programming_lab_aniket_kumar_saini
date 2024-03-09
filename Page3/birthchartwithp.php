<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 3</title>

    <link rel="stylesheet" href="/testAnimationLandingPage/bg.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="page3.css">
    <link rel="stylesheet" href="birthchart.css">
</head>

<body>
    <div class="main-con">
        <?php
        // Set the cURL POST fields for the first API call (Birth Chart)
        $postDataBirthChart = '{
            "year": 2022,
            "month": 8,
            "date": 11,
            "hours": 6,
            "minutes": 0,
            "seconds": 0,
            "latitude": 17.38333,
            "longitude": 78.4666,
            "timezone": 5.5,
            "config": {
                "observation_point": "topocentric",
                "ayanamsha": "lahiri"
            }
        }';

        $curlBirthChart = curl_init();

        curl_setopt_array($curlBirthChart, array(
            CURLOPT_URL => 'https://json.freeastrologyapi.com/horoscope-chart-url',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postDataBirthChart,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
            ),
        ));

        $responseBirthChart = curl_exec($curlBirthChart);

        curl_close($curlBirthChart);

        $horoscopeData = json_decode($responseBirthChart, true); // Decode JSON response for birth chart

        // Set the cURL POST fields for the second API call (Good Bad Times)
        $postDataGoodBadTimes = '{
            "year": 2022,
            "month": 8,
            "date": 11,
            "hours": 6,
            "minutes": 0,
            "seconds": 0,
            "latitude": 17.38333,
            "longitude": 78.4666,
            "timezone": 5.5,
            "config": {
                "observation_point": "topocentric",
                "ayanamsha": "lahiri"
            }
        }';

        $curlGoodBadTimes = curl_init();

        curl_setopt_array($curlGoodBadTimes, array(
            CURLOPT_URL => 'https://json.freeastrologyapi.com/good-bad-times',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postDataGoodBadTimes,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
            ),
        ));

        $responseGoodBadTimes = curl_exec($curlGoodBadTimes);

        curl_close($curlGoodBadTimes);

        $goodBadTimesData = json_decode($responseGoodBadTimes, true); // Decode JSON response for good-bad-times

        // Set the cURL POST fields for the third API call (Complete Panchang)
        $postDataPanchang = '{
            "year": 2022,
            "month": 8,
            "date": 11,
            "hours": 6,
            "minutes": 0,
            "seconds": 0,
            "latitude": 17.38333,
            "longitude": 78.4666,
            "timezone": 5.5,
            "config": {
                "observation_point": "topocentric",
                "ayanamsha": "lahiri"
            }
        }';

        $curlPanchang = curl_init();

        curl_setopt_array($curlPanchang, array(
            CURLOPT_URL => 'https://json.freeastrologyapi.com/complete-panchang',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postDataPanchang,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: ip1M6dWw2k3QqCJUrntXG8PIYzSH10L24LBdJ7pk'
            ),
        ));

        $responsePanchang = curl_exec($curlPanchang);

       

        $panchangData = json_decode($responsePanchang, true); // Decode JSON response for complete panchang

        // Decode the values inside the response data
        $abhijitData = json_decode($goodBadTimesData['abhijit_data'], true);
        $amritKaalData = json_decode($goodBadTimesData['amrit_kaal_data'], true);
        $brahmaMuhuratData = json_decode($goodBadTimesData['brahma_muhurat_data'], true);
        $rahuKaalData = json_decode($goodBadTimesData['rahu_kaalam_data'], true);
        $yamaGandamData = json_decode($goodBadTimesData['yama_gandam_data'], true);
        $gulikaKalamData = json_decode($goodBadTimesData['gulika_kalam_data'], true);
        $durMuhuratData = json_decode($goodBadTimesData['dur_muhurat_data'], true);
        $varjyamData = json_decode($goodBadTimesData['varjyam_data'], true);

        ?>
        <?php include 'D:\xaamo\htdocs\pce_comp_web_programming_lab_aniket_kumar_saini\includes\base.php' ?>

        <div class="cont" style="color: white;">
            <!-- Existing birth chart div -->
            <div class="divtriggerr" id="div1">
                <div class="text">
                    <div class="bigtext2">
                        <h2>Birthchart</h2>
                    </div>

                    <img src="<?php echo isset($horoscopeData['output']) ? $horoscopeData['output'] : ''; ?>" alt="Birthchart" id="birthchart">

                    <div class="about2">
                        <h3>Name: <?php echo isset($horoscopeData['name']) ? $horoscopeData['name'] : ''; ?></h3>
                        <p>Location: <?php echo isset($horoscopeData['location']) ? $horoscopeData['location'] : ''; ?></p>
                        <p>Date of Birth: <?php echo isset($horoscopeData['year']) ? $horoscopeData['year'] : '';
                                            echo isset($horoscopeData['month']) ? '-' . $horoscopeData['month'] : '';
                                            echo isset($horoscopeData['date']) ? '-' . $horoscopeData['date'] : ''; ?></p>
                        <p>Time of Birth: <?php echo isset($horoscopeData['hours']) ? $horoscopeData['hours'] : '';
                                            echo isset($horoscopeData['minutes']) ? ':' . $horoscopeData['minutes'] : ''; ?></p>
                        <ul>
                            <li>Latitude: <?php echo isset($horoscopeData['latitude']) ? $horoscopeData['latitude'] : ''; ?></li>
                            <li>Longitude: <?php echo isset($horoscopeData['longitude']) ? $horoscopeData['longitude'] : ''; ?></li>
                            <li>Timezone: <?php echo isset($horoscopeData['timezone']) ? $horoscopeData['timezone'] : ''; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Existing good-bad-times div -->
            <div class="divtriggerr" id="div2">
                <div class="text">
                    <div class="bigtext2">
                        <h2>Good Bad Times</h2>
                    </div>

                    <div class="about2">
                        <!-- Display information from the second API response -->
                        <p>Abhijit Starts At: <?php echo isset($abhijitData['starts_at']) ? $abhijitData['starts_at'] : ''; ?></p>
                        <p>Amrit Kaal Starts At: <?php echo isset($amritKaalData['starts_at']) ? $amritKaalData['starts_at'] : ''; ?></p>
                        <p>Brahma Muhurat Starts At: <?php echo isset($brahmaMuhuratData['starts_at']) ? $brahmaMuhuratData['starts_at'] : ''; ?></p>
                        <!-- Repeat for other elements... -->
                    </div>
                </div>
            </div>

            <!-- New div for Panchang details -->
            <div class="divtriggerr" id="div3">
    <div class="text">
        <div class="bigtext2">
            <h2>Panchang Details</h2>
        </div>

        <!-- Display Panchang details -->
        <p>Sunrise: <?php echo $panchangData['sun_rise'] ?? 'N/A'; ?></p>
        <p>Sunset: <?php echo $panchangData['sun_set'] ?? 'N/A'; ?></p>
        
        <p>Weekday: <?php echo $panchangData['weekday']['weekday_name'] ?? 'N/A'; ?></p>
        <p>Vedic Weekday: <?php echo $panchangData['weekday']['vedic_weekday_name'] ?? 'N/A'; ?></p>
        
        <p>Lunar Month: <?php echo $panchangData['lunar_month']['lunar_month_name'] ?? 'N/A'; ?></p>
        <p>Ritu: <?php echo $panchangData['ritu']['name'] ?? 'N/A'; ?></p>
        
        <p>Aayanam: <?php echo $panchangData['aayanam'] ?? 'N/A'; ?></p>
        
        <p>Tithi: <?php echo $panchangData['tithi']['name'] ?? 'N/A'; ?></p>
        
        <p>Nakshatra: <?php echo $panchangData['nakshatra']['name'] ?? 'N/A'; ?></p>
        
        <p>Yoga: <?php echo $panchangData['yoga']['1']['name'] ?? 'N/A'; ?></p>
        
        <p>Karana: <?php echo $panchangData['karana']['1']['name'] ?? 'N/A'; ?></p>

        <!-- Add more details as needed -->
    </div>
    <div class="divtriggerr" id="div3">
    <div class="text">
        <div class="bigtext2">
            <h2>Panchang Details</h2>
        </div>

       
        // Check if Panchang data is available
     
        <div class="divtriggerr" id="div3">
            <div class="text">
                <div class="bigtext2">
                    <h2>Panchang Details</h2>
                </div>
        
                <?php
                // Check if Panchang data is available
                if (!empty($panchangData)) {
                    echo '<p>';
                    echo 'As the radiant sun gracefully rises at ' . ($panchangData['sun_rise'] ?? 'N/A') . ', it heralds the beginning of a new day, infusing the surroundings with warmth and vitality. ';
                    
                    echo 'This day is blessed with the essence of ' . ($panchangData['weekday']['weekday_name'] ?? 'N/A') . ', symbolizing the start of a new week, while Vedic tradition recognizes it as ' . ($panchangData['weekday']['vedic_weekday_name'] ?? 'N/A') . '. ';
                    
                    echo 'The lunar month of ' . ($panchangData['lunar_month']['lunar_month_name'] ?? 'N/A') . ' unfolds its celestial beauty, specifically during the enchanting season of ' . ($panchangData['ritu']['name'] ?? 'N/A') . '. ';
                    
                    echo 'Aligned with the auspicious cycle, the sun follows its northern course during ' . ($panchangData['aayanam'] ?? 'N/A') . ', indicating a period of positive energy and growth. ';
                    
                    echo 'As the day progresses, the Tithi transitions to ' . ($panchangData['tithi']['name'] ?? 'N/A') . ' in the ' . ($panchangData['tithi']['paksha'] ?? 'N/A') . ' Paksha, completing at ' . ($panchangData['tithi']['completes_at'] ?? 'N/A') . '. ';
                    
                    echo 'The celestial canvas is adorned with the Nakshatra ' . ($panchangData['nakshatra']['name'] ?? 'N/A') . ', creating a celestial spectacle that began on ' . ($panchangData['nakshatra']['starts_at'] ?? 'N/A') . ' and concludes at ' . ($panchangData['nakshatra']['ends_at'] ?? 'N/A') . '. ';
                    
                    echo 'During this time, the Yoga unfolds with the serene essence of ' . ($panchangData['yoga']['1']['name'] ?? 'N/A') . ', completing at ' . ($panchangData['yoga']['1']['completion'] ?? 'N/A') . ', while the Karana progresses through ' . ($panchangData['karana']['1']['name'] ?? 'N/A') . ', completing at ' . ($panchangData['karana']['1']['completion'] ?? 'N/A') . '. ';
                    
                    // Additional details
                    echo 'The day is illuminated with the brilliance of ' . ($panchangData['sun_set'] ?? 'N/A') . ' as the sun gracefully sets, casting a serene ambiance. ';
                    
                    echo 'The ongoing lunar month, known as ' . ($panchangData['lunar_month']['lunar_month_full_name'] ?? 'N/A') . ', holds cultural and spiritual significance. ';
                    
                    echo 'This particular Tithi, ' . ($panchangData['tithi']['name'] ?? 'N/A') . ', in the ' . ($panchangData['tithi']['paksha'] ?? 'N/A') . ' Paksha, symbolizes the ' . ($panchangData['tithi']['left_precentage'] ?? 'N/A') . '% remaining of its duration. ';
                    
                    echo 'The Nakshatra ' . ($panchangData['nakshatra']['name'] ?? 'N/A') . ' envelops the celestial sphere, contributing to the divine energy experienced during this period. ';
                    
                    echo 'The ongoing Yoga, ' . ($panchangData['yoga']['2']['name'] ?? 'N/A') . ', will reach completion at ' . ($panchangData['yoga']['2']['completion'] ?? 'N/A') . ', further enhancing the spiritual atmosphere. ';
        
                    echo 'The Karana ' . ($panchangData['karana']['2']['name'] ?? 'N/A') . ' is in progress, with a completion time scheduled at ' . ($panchangData['karana']['2']['completion'] ?? 'N/A') . '. ';
                    
                    // Add more details as needed
        
                    echo '</p>';
                } else {
                    echo '<p>No Panchang data available.</p>';
                }
                ?>
            </div>
        </div>
        
</div>
</div>
        </div>
    </div>
</body>

</html>
