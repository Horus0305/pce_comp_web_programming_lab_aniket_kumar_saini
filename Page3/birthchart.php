

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
                        <h3>Name: XYZ ALPHA</h3>
                        <p>Birth Location: Seawoods</p>
                        <p>Date of Birth: <?php echo isset($horoscopeData['year']) ? $postDataBirthChart['year'] : '';
                                            echo isset($postDataBirthChart['month']) ? '-' . $postDataBirthChart['month'] : '';
                                            echo isset($postDataBirthChart['date']) ? '-' . $postDataBirthChart['date'] : ''; ?></p>
                        <p>Time of Birth: <?php echo isset($postDataBirthChart['hours']) ? $postDataBirthChart['hours'] : '';
                                            echo isset($postDataBirthChart['minutes']) ? ':' . $postDataBirthChart['minutes'] : ''; ?></p>
                                            <p>Abhijit Starts At: <?php echo isset($abhijitData['starts_at']) ? $abhijitData['starts_at'] : ''; ?></p>
                        <p>Amrit Kaal Starts At: <?php echo isset($amritKaalData['starts_at']) ? $amritKaalData['starts_at'] : ''; ?></p>
                        
                        
                    </div>
                </div>
            </div>
            </div>
            


