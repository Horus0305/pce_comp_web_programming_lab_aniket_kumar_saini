<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page 2</title>
    <link rel="stylesheet" href="/testAnimationLandingPage/bg.css">
    <link rel="stylesheet" href="page3.css">
</head>

<body>
    <div class="main-con">
        <div class="side-bar">

            <div class="logo-con">
                <img class="logo" src="/testAnimationLandingPage/img/logo.png" alt="logo">
            </div>

            <div class="elements">
                <a class="anchor ele" href="#"><i class="fi fi-rr-home"></i></a>
                <a class="anchor ele" href="/chatPage/chat.html"><i class="fi fi-rr-comment-alt ele"></i></a>
                <a class="anchor ele" href="#"><i class="fi fi-rr-heart ele"></i></a>
            </div>

            <div class="profile-con">
                <a class="anchor ele" href="#"><i class="fi fi-rr-bell ele noti"></i></a>
                <a class="anchor" href="#"><img class="profile_img" src="/Page2/images/profile.jpg" alt="profile-img"></a>
            </div>
        </div>
        <div class="divtrigger" id="div1">
        <?php
                $sign = 'leo';
                $url = "https://ohmanda.com/api/horoscope/$sign";
                $response = file_get_contents($url);
                $horoscopeData = json_decode($response, true);
                ?>
            <div class="text">
              <div class="bigtext2"><h2>Daily Horoscope for <?php echo ucfirst($sign); ?></h2></div>
              <figure class="snip1401">
                
        
            
     
                <img src="images/horo2.png" alt="daily horoscope" id="horoimage" />
                <figcaption>
                  <!-- <h3>Cosmic Destiny</h3> -->
                  <p>
                  <?php echo $horoscopeData['horoscope']; ?></p>
                  </p>
                </figcaption>
                <i class="ion-ios-home-outline"></i>
                <a href="signup.html"></a>
              </figure>
              <div class="about2">
                
              </div>
            </div>
          </div>
        
    </div>
</body>
<script src="page3.js"></script>

</html>