<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page 2</title>
   
    <link rel="stylesheet" href="/testAnimationLandingPage/bg.css">
    <link rel="stylesheet" href="page3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

<body>
    <div class="main-con">
       <?php include 'D:\xaamo\htdocs\pce_comp_web_programming_lab_aniket_kumar_saini\includes\base.php'?>

      
        <div class="cont">
        
        <div class="divtrigger" id="div1">
      
            <div class="text">
            <!--<?php
                $sign = 'leo';
                $url = "https://ohmanda.com/api/horoscope/$signs";
                $response = file_get_contents($url);
                $horoscopeData = json_decode($response, true);
                ?>-->
              <div class="bigtext2"><h2>Daily Horoscope for <?php echo ucfirst($sign);?></h2></div>
              <figure class="snip1401">
                
        
            
     
                <img src="images/horo1.png" alt="daily horoscope" id="horoimage" />
                <figcaption>
                
                <p id='ptext' ><?php echo $horoscopeData['horoscope']; ?>
                  </p>
                </figcaption>
                <i class="ion-ios-home-outline"></i>
                <a href="signup.html"></a>
              </figure>
              <div class="about2">
                
              </div>
            </div>
          </div>

          
          <div class="divtrigger" id="div2">
      
            <div class="text">
              <div class="bigtext2"><h2>Notifications         <i class="fa-solid fa-bell"></i></h2> </div>
           
            <div class="allnotif">
                
        

                
              
                  <p>You found a match with XYZ <button class="checkoutbut">Check Out</button> </p>
                  <p>Checkout Your Birthchart <button class="checkoutbut">Check Out</button> </p>
                  <p>Daily Horoscope <button class="checkoutbut">Check Out</button> </p>
                  <p>You found a match with XYZ <button class="checkoutbut">Check Out</button> </p>
            </div>
            <div class="downarrow" id="downarrow1"><i class="fa-regular fa-circle-down"></i></div>
            <div  id="downarrow2"><i class="fa-regular fa-circle-down"></i></div>
          </div>
        
        </div>
        </div>

</body>
<script src="page3.js"></script>

</html>