<?php

$pdo = new PDO("sqlite:celestial_connections.db");

$query = $pdo->query("SELECT username FROM chat");

$result = $query->fetchAll(PDO::FETCH_ASSOC);

// foreach($result as $row => $result)
//     {
//         $name = $result["username"];
//     }

$name = $result[0]["username"];
$name = json_encode($name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" type="text/css" href="chat.css">
</head>

<body>

    <div class="main-con">
        <div class="side-bar">
            <div class="logo-con">
                <img class="logo" src="/testAnimationLandingPage/img/logo.png" alt="logo">
            </div>

            <div class="elements">
                <a class="anchor ele" href="/Page2/page2.html"><i class="fi fi-rr-home"></i></a>
                <a class="anchor ele" href="/chatPage/chat.html"><i class="fi fi-rr-comment-alt ele"></i></a>
                <a class="anchor ele" href="#"><i class="fi fi-rr-heart ele"></i></a>
            </div>

            <div class="profile-con">
                <a class="anchor ele" href="#"><i class="fi fi-rr-bell ele noti"></i></a>
                <a class="anchor" href="#"><img class="profile_img" src="/chatPage/img/profile.jpg"
                        alt="profile-img"></a>
            </div>
        </div>

        <div class="all-con">

            <div id="message-con">
                <div class="nav">
                    <a href="#"><img src="/chatPage/img/profile.jpg" alt="profile_pic"></a>
                    <li id="name"><?php print $name ?></li>
                </div>
            </div>
            <div class="send-con">
                <div class="emojis-con" id="emojis">
                    <span onclick="emo(this.id)" id="e1" class="emojis">&#128525;</span>
                    <span onclick="emo(this.id)" id="e2" class="emojis">&#128149;</span>
                    <span onclick="emo(this.id)" id="e3" class="emojis">&#128077;</span>
                    <span onclick="emo(this.id)" id="e4" class="emojis">&#128293;</span>
                    <span onclick="emo(this.id)" id="e5" class="emojis">&#128517;</span>
                    <span onclick="emo(this.id)" id="e6" class="emojis">&#128151;</span>
                    <span onclick="emo(this.id)" id="e7" class="emojis">&#128516;</span>
                    <span onclick="emo(this.id)" id="e8" class="emojis">&#128514;</span>
                </div>
                <div class="logos">
                    <i class="fi fi-rr-smile logo2" onclick="show_emojis()"></i>
                    <i class="fi fi-rr-add-image logo2"></i>
                    <input onclick="disappear()" id="in" type="text" value="Message..." onkeydown="message_send(event)">
                    <i onclick="send_btn()" class="fi fi-rr-paper-plane logo2 send"></i>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="chat.js"></script>
</html>