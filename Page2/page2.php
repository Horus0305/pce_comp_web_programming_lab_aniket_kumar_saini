<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>page 2</title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
  <link rel="stylesheet" href="page2.css" />
  <link rel="stylesheet" href="css/proCom.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <div class="main-con">

    <div onclick="show_burger()" class="hamburger">
      <i class="fi fi-rr-menu-burger menu"></i>
    </div>

    <div class="all-container">

      <div id="profile_picture_con" class="profile_picture_con">
        <section class="container">
          <header>Hobbies and Requirements</header>
          <i onclick="gaayab(this.id)" id="cross" class="fi fi-rr-cross cross"></i>
          <div class="form">
            <div id="img_con">

            </div>
            <input type="file" name="image" id="image" id="pro_img">
            <button onclick="pro_img_sub()">Submit</button>
          </div>
        </section>
      </div>

      <div class="profile-progress-con">
        <center>
          <h2>Profile Progress <span>📄</span></h2>
        </center>
        <center>
          <progress id="file" value="0" max="100"></progress>
        </center>

        <div class="completion-con">
          <div onclick="completion_status(this.id)" id="c1" class="com"></div>
          <div onclick="completion_status(this.id)" id="c2" class="com"></div>
          <div onclick="completion_status(this.id)" id="c3" class="com"></div>
          <div onclick="completion_status(this.id)" id="c4" class="com"></div>
        </div>

        <div class="completion-con2">
          <div class="stage">Profile_comp</div>
          <div class="stage">Profile_pic</div>
          <div class="stage">Zodiac_info</div>
          <div class="stage">Partner_req</div>
        </div>

        <center>
          <h6>Completed <span id="completion_val">0%</span></h6>
        </center>
      </div>

      <div class="img-con">
        <img class="horo-img" src="images/horo1.png" alt="img1" />
        <img class="horo-img horo2" src="images/horo2.png" alt="img2" />
      </div>

      <center>
        <div class="notify-info">
          <h2>Things you can Unlock after Profile Completion</h2>
        </div>
        <div class="down_arrow">
          <i id="arr1" class="fi fi-sr-angle-down down_arrow_img"></i>
          <i id="arr2" class="fi fi-sr-angle-down down_arrow_img"></i>
        </div>
      </center>

      <div class="notification">
        <div class="notify">
          <center>
            <h4 class="title">Cosmic Destiny Daily Horoscope 🦀</h4>
          </center>
          <div class="sign-con">
            <div class="sign-row-1">
              <div class="sign">
                <img src="images/signs/sign1.png" alt="sign1">
                <h5>Aries</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign5.png" alt="sign5">
                <h5>Taurus</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign9.png" alt="sign9">
                <h5>Gemini</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign2.png" alt="sign2">
                <h5>Cancer</h5>
              </div>
            </div>


            <div class="sign-row-2">

              <div class="sign">
                <img src="images/signs/sign6.png" alt="sign6">
                <h5 style="padding-left: 105px;">Leo</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign10.png" alt="sign10">
                <h5>Virgo</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign3.png" alt="sign3">
                <h5>Libra</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign7.png" alt="sign7">
                <h5>Scorpio</h5>
              </div>

            </div>

            <div class="sign-row-3">
              <div class="sign">
                <img src="images/signs/sign11.png" alt="sign11">
                <h5 style="padding-left: 70px;">Sagittarius</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign4.png" alt="sign4">
                <h5 style="padding-left: 70px;">Capricorn</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign8.png" alt="sign8">
                <h5>Aquarius</h5>
              </div>

              <div class="sign">
                <img src="images/signs/sign12.png" alt="sign12">
                <h5>Pisces</h5>
              </div>


            </div>
          </div>

          <div class="all-pro-con">
            <center>
              <div class="progress-con">
                <progress id="pro1" value="0" max="100"></progress>
                <progress id="pro2" value="0" max="100"></progress>
                <progress id="pro3" value="0" max="100"></progress>
              </div>
            </center>

            <div id="card1">
              <h2 class="title">Matches based on Birth-Chart</h2>
              <p class="para">
                "Matches based on Birth-Chart" typically refers to astrological compatibility between two individuals
                based on their birth charts, also known as natal charts. A birth chart is a diagrammatic representation
                of the positions of celestial bodies at the time of an individual's birth. It's primarily based on the
                individual's birth date, time, and place.
              </p>
            </div>
            <div id="card2" class="hidden">
              <h2 class="title">Location recommendation for dates</h2>
              <p class="para">
                Choosing a location for a date depends on various factors such as interests, preferences, budget, and
                the nature of the relationship. Here are some location recommendations for dates across different
                categories:
              </p>
            </div>
            <div id="card3" class="hidden">
              <h2 class="title">Daily Horoscope</h2>
              <p class="para">
                We provide a general daily horoscope based on astrological principles. However, it's important to
                remember that horoscopes are for entertainment purposes only and should not be taken as serious
                predictions. Here's a general daily horoscope for each zodiac sign:
              </p>
            </div>
          </div>
        </div>
      </div>

      <center>
        <div class="video-all-con">
          <h1
            style="font-family: sans-serif; margin:0px; font-size:2rem; background-color:white; color:black; border-radius:20px; width:90%; padding: 20px;">
            We Cosmic Destiny Promise you...🪐</h1>
          <div class="vid-con">
            <video width="100%" controls loop autoplay src="images/vid.mp4">
              <track label="English" kind="subtitles" srclang="en" src="eng.vtt" default>
              <track label="Hindi" kind="subtitles" srclang="mr" src="hin.vtt" default>
            </video>
          </div>
        </div>
      </center>

      <center>
        <header
          style="font-family: sans-serif; margin:0px; font-size:2rem; background-color:white; color:black; border-radius:20px; width:90%; padding: 20px; margin-top:40px; margin-bottom:40px;">
          Provide Good Dating places near you!!</header>
        <div id="map" style="width: 93%; height: 380px"></div>
      </center>

      <footer>
        <img src="images/logo.png" alt="logo" />

        <div class="nav">
          <a href="">Home</a>
          <a href="/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/chatPage/chat.php">Chat</a>
          <a href="">Matching</a>
        </div>
      </footer>
    </div>
  </div>
</body>
<script src="page2.js"></script>

<script>
  // Creating map options
  var mapOptions = {
    center: [19.026257904490755, 73.01864851115762],
    zoom: 12
  }

  // Creating a map object
  var map = new L.map('map', mapOptions);

  // Creating a Layer object
  var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

  // Adding layer to the map
  map.addLayer(layer);

  var markerData = [
    { location: [19.026257904490755, 73.01864851115762], name: "McDonald's" },
    { location: [19.07366885401678, 72.99771626362873], name: "McDonald's" },
    { location: [19.05059302863161, 73.00904552684088], name: "Dominos" },
    { location: [19.047635761932863, 73.02415134022735], name: "Cafe Martin" }
  ];
  markerData.forEach(function (data, index) {
    var marker = L.marker(data.location).addTo(map);
    marker.bindPopup("<div style='color:black';><b>" + data.name + "</b><br>This is " + data.name + ".</div>").openPopup();
  });

  var markerLocations = markerData.map(function (data) {
    return data.location;
  });
  var polyline = L.polyline(markerLocations, { color: 'red' }).addTo(map);
</script>

</html>