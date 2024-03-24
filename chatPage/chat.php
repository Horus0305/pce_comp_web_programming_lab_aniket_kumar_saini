<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" type="text/css" href="chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="background:url('img/bg.jpg');">

    <div class="main-con">
        <div class="side-bar">
            <div class="logo-con">
                <img class="logo" src="img/logo.png" alt="logo">
            </div>

            <div class="elements">
                <a class="anchor ele"
                    href="/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/Page2/page2.php"><i
                        class="fi fi-rr-home"></i></a>
                <a class="anchor ele"
                    href="/WP_miniPro/pce_comp_web_programming_lab_aniket_kumar_saini/chatPage/chat.php"><i
                        class="fi fi-rr-comment-alt ele"></i></a>
                <a class="anchor ele" href="#"><i class="fi fi-rr-heart ele"></i></a>
            </div>

            <div class="profile-con">
                <a class="anchor ele" href="#"><i class="fi fi-rr-bell ele noti"></i></a>
                <a class="anchor" href="#"><img class="profile_img" src="img/profile.jpg" alt="profile-img"></a>
            </div>
        </div>

        <div class="all-con">

            <div id="message-con">
                <div class="nav">
                    <a href="chat.php"><img src="img/profile.jpg" alt="profile_pic"></a>
                    <?php
                    session_start();

                    $name = $_SESSION['name'];
                    echo '<li id="name">' . $name . '</li>';
                    ?>
                </div>

                <div class="main-message-con" id="main-message-con">

                    <?php

                    try {

                        $db_path = "../database/baba.db";

                        $pdo = new PDO("sqlite:" .$db_path);

                        $query2 = $pdo->prepare('SELECT message, date FROM chat WHERE username = :username');
                        $query2->bindValue(':username', $name, PDO::PARAM_STR);
                        $query2->execute();
                        $messages = $query2->fetchAll(PDO::FETCH_ASSOC);

                        $query3 = $pdo->prepare('SELECT male.name AS male_name, female.name AS female_name
                        FROM matchtable
                        JOIN male_data ON matchtable.male = male_data.id
                        JOIN female_data ON matchtable.female = female_data.id;
                        ');

                        $stmt = $query3->execute();

                        if ($stmt){
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $maleName = $row['male_name'];
                                $femaleName = $row['female_name'];
                                echo "Male Name: $maleName, Female Name: $femaleName <br>";
                            }
                        }

                        else {
                            echo "Error: " . $pdo->errorInfo()[2];
                        }


                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }


                    if ($messages) {
                        foreach ($messages as $message) {
                            echo '<div class="message" id="message">';
                            echo '<p class="main_message">' . htmlspecialchars($message['message']) . '</p>';
                            echo '<label class="time">' . htmlspecialchars($message['date']) . '</label>';
                            echo '</div>';
                        }
                    } else {
                        //no
                    }
                    ?>

                </div>

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
            </div>

            <div class="send-con">
                <div class="logos">
                    <i class="fi fi-rr-smile logo2" onclick="show_emojis()"></i>
                    <input onclick="disappear()" id="in" name="message" type="text" value="Message..."
                        onkeydown="message_send(event)">
                    <i class="fi fi-rs-rocket-lunch logo2 send_btn" id="send" onclick="send()"></i>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="chat.js"></script>

</html>