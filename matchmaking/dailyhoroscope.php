<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home3</title>
   
</head>
<body>


    <section id="dailyhoroscope">
        <div class="container">
            <?php
                $sign = 'leo';
                $url = "https://ohmanda.com/api/horoscope/$sign";
                $response = file_get_contents($url);
                $horoscopeData = json_decode($response, true);
            ?>
        
            <h2>Daily Horoscope for <?php echo ucfirst($sign); ?></h2>
            <p><?php echo $horoscopeData['horoscope']; ?></p>
        </div>
        <br>
    </section>

    
        <br>

    </section>
<hr>

    <section id="notifysec">
        <div class="notification">
            <div id="notifytext">
                You found a match
            </div>

            <button class="but1" type="button">
                Check out!!
            </button>

        </div>


    </section>


    
</body>
</html>