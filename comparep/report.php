<?php
include "../includes/base.php"
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sqzrP8sP6mDHBbASmAkbXbZRspMz+LcN3OoW4xXV4yZ+zKWHl4G3JvHG6V1vWlwgqZCIS1a8X5EazbcTqSr7Aw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="css/report.css">
<div id="main">
    <div id="head">Compatibility Report</div>
    <div id="childcont">
        <div class="match-card">
            <div class="outercircle">
                <img src="img/male.jpg" class="innercircle">
            </div>
            <div class="name"><span class="wheat">Krishna</span></div>   
            <div class="details">
                <p><span class="wheat">Bio:</span> If it is to be its up to me </p>
                <p><i class="fa-regular fa-calendar-days"></i><span class="wheat">Date of Birth:</span> 1 January 2000</p>
                <p><span class="wheat">Age:</span> 28</p>
                <p><span class="wheat">Sign:</span> Leo</p>
                <p><span class="wheat">Location:</span> Kalyan</p>
                <p><span class="wheat">Height:</span> 175 cm</p>
                <p><span class="wheat">Weight:</span> 65 kg</p>
               
                
            </div>
        </div>
     
        <div class="match-card mid">
         <div id="mid-chart">
        <canvas id="Chart"></canvas></div>
        <p><span class="wheat">Match Score </span>32/36</p>
            <button>View Complete Report</button>
        </div>
      
        <div class="match-card">
            <div class="outercircle">
                <img src="img/female.jpg" class="innercircle">
            </div>
            <div class="name"><span class="wheat">Radha</span></div>   
            <div class="details">
                <p><span class="wheat">Bio:</span> If it is to be its up to me </p>
                <p><i class="fa-regular fa-calendar-days"></i><span class="wheat">Date of Birth:</span> 1 January 2000</p>
                <p><span class="wheat">Age:</span> 27</p>
                <p><span class="wheat">Sign:</span> Cancer</p>
                <p><span class="wheat">Location:</span> Kalyan</p>
                <p><span class="wheat">Height:</span> 170 cm</p>
                <p><span class="wheat">Weight:</span> 60 kg</p>
               
                
        </div>
     
    </div>
</div>


<script>
    // Data for the donut chart
    var data = {
   
        datasets: [{
            data: [85, 15],
            backgroundColor: ['wheat', 'white']
        }]
    };

    // Configuration options for the chart
    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    // Get the context of the canvas element we want to select
    var ctx = document.getElementById('Chart').getContext('2d');

    // Create the donut chart
    var myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });
</script>


<?php

?>
