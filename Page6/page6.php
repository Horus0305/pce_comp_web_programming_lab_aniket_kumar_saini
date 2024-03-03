<?php

$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'https://json.freeastrologyapi.com/match-making/ashtakoot-score',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "female":{
            "year": 1984,
			"month": 7,
			"date": 30,
			"hours": 11,
			"minutes": 10,
			"seconds": 0,
			"latitude": 16.16667,
			"longitude": 81.1333,
			"timezone": 5.5
    },
    "male":{
			"year": 1984,
			"month": 4,
			"date": 3,
			"hours": 9,
			"minutes": 15,
			"seconds": 31,
			"latitude": 16.51667,
			"longitude": 80.61667,
			"timezone": 5.5
    },
    "config": {
        "observation_point": "topocentric",
        "language": "te",
        "ayanamsha": "lahiri"
    }
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'x-api-key: 50XtwIwAuD2hSWOeVHo5w4qsAVTBtnsO8vBWW8qc'
        ),
    )
);

$response = curl_exec($curl);
// echo json_encode($response);
curl_close($curl);

$data = json_decode($response, true);

$varnaScore = $data['output']['varna_kootam']['score'];
$taraScore = $data['output']['tara_kootam']['score'];
$grahaMaitriScore = $data['output']['graha_maitri_kootam']['score'];
$totalScore = $data['output']['total_score'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Report</title>
    <link rel="stylesheet" href="page6.css">
</head>

<body>
    <div class="navbar">
        <img class="img" src="img/logo.png" alt="logo">

        <div class="profile-img">
            <img class="pro-img" src="img/profile.jpg" alt="profile-img">
        </div>
    </div>

    <div class="details-con">
        <div class="back-con">
            <a style="text-decoration:none;"
                href="/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/Page2/page2.php"><i
                    class="fi fi-rr-angle-left back"></i></a>
        </div>

        <div class="main-details-con">

            <div id="pro-circle">

                <div id="progress">

                </div>

                <div class="score-con">
                    <?php
                    echo '<h2 class="head">Total Matching Score: ' . $totalScore . '/36</h2>';
                    ?>
                </div>
            </div>

            <div class="ele-con">
                <div class="chart">
                    <select id="charts_opt">
                        <option value="bar">Bar chart</option>
                        <option value="line">Line chart</option>
                        <option value="pie">Pie chart</option>
                    </select>
                    <canvas id="myChart"></canvas>
                </div>

                <div class="elements-main-con">
                    <div class="card">
                        <label class="card1" href="#">
                            <p>Other Scores: </p>
                            <?php
                            echo '<p class="small">Varna Kootam Score: ' . $varnaScore . '</p>';
                            echo '<p class="small">Tara Kootam Score: ' . $taraScore . '</p>';
                            echo '<p class="small">Graha Maitri Kootam Score: ' . $grahaMaitriScore . '</p>';
                            ?>
                        </label>
                    </div>
                </div>

                <div class="data-con">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus at a fuga quia optio, quos odit
                    dolorumalias provident hic dolores voluptas.</p>
            </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    var varnaScore = '<?php echo $varnaScore ?>';
    var taraScore = '<?php echo $taraScore ?>';
    var grahaMaitriScore = '<?php echo $grahaMaitriScore ?>';

    var chartTypeSelector = document.getElementById('charts_opt');
    var ctx = document.getElementById('myChart').getContext('2d');

    var chartType = chartTypeSelector.value;

    var chartData = {

        labels: ['varna score', 'tara score', 'graha maitriScore'],
        datasets: [{
            label: 'All score Analysis',
            data: [varnaScore, taraScore, grahaMaitriScore],
            borderWidth: 1
        }]
    };

    var myChart = new Chart(ctx, {
        type: chartType,
        data: chartData
    });

    chartTypeSelector.addEventListener('change', function () {
        chartType = this.value;

        myChart.destroy();

        myChart = new Chart(ctx, {
            type: chartType,
            data: chartData
        });
    });

</script>

<script src="page6.js"></script>

</html>