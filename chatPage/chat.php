<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" type="text/css" href="chat.css">
    <link rel="website icon" type="png" href="../img/favicon.png" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="background:url('../img/bg.png');">

    <div class="main-con">



        <?php
        session_start();
        include '../includes/base.php';
        include '../includes/head_links.php';
        ?>
        <div class="all-con">

            <div id="message-con">
                <div class="nav2">
                    <a href="chat.php"><img src="img/profile.jpg" alt="profile_pic"></a>
                    <?php


                    $name = $_SESSION['name'];
                    echo '<li id="name">' . $name . '</li>';
                    ?>
                </div>

                <div class="main-message-con" id="main-message-con">

                    <?php

                    try {

                        $db_path = "../database/baba.db";

                        $pdo = new PDO("sqlite:" . $db_path);

                        $query2 = $pdo->prepare('SELECT message, date FROM chat WHERE username = :username');
                        $query2->bindValue(':username', $name, PDO::PARAM_STR);
                        $query2->execute();
                        $messages = $query2->fetchAll(PDO::FETCH_ASSOC);

                        $query3 = $pdo->prepare('SELECT DISTINCT male.name AS male_name, female.name AS female_name
                        FROM matchtable
                        JOIN male ON matchtable.male = male.id
                        JOIN female ON matchtable.female = female.id
                        WHERE male.name = :male_name OR female.name = :female_name');
                        $query3->bindValue(':male_name', $name, PDO::PARAM_STR);
                        $query3->bindValue(':female_name', $name, PDO::PARAM_STR);
                        $query3->execute();
                        $matchData = $query3->fetchAll(PDO::FETCH_ASSOC);

                        if ($matchData) {
                            foreach ($matchData as $data) {
                                if ($data['male_name'] === $name) {
                                    $name2 = $data['female_name'];
                                } else if ($data['female_name'] === $name) {
                                    $name2 = $data['male_name'];
                                }
                            }
                        } else {
                            echo '<div class="message" id="message">';
                            echo "<p> Hello error</p>";
                            echo '</div>';
                        }


                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                    $messages1 = [];
                    if ($messages) {
                        foreach ($messages as $message) {
                            $messages1[] = array(
                                'message' => htmlspecialchars($message['message']),
                                'date' => htmlspecialchars($message['date']),
                                'sender' => $name
                            );
                        }
                    }

                    // Fetch messages for the other user
                    $messages2 = [];
                    if ($name2) {
                        try {
                            $query4 = $pdo->prepare('SELECT message, date FROM chat WHERE username = :username');
                            $query4->bindValue(':username', $name2, PDO::PARAM_STR);
                            $query4->execute();
                            $messages2 = $query4->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "Error fetching messages for $name2: " . $e->getMessage();
                        }
                    }

                    $messages2Formatted = [];
                    foreach ($messages2 as $message) {
                        $messages2Formatted[] = array(
                            'message' => htmlspecialchars($message['message']),
                            'date' => htmlspecialchars($message['date']),
                            'sender' => $name2
                        );
                    }

                    // Combine messages from both users into a single array
                    $allMessages = array_merge($messages1, $messages2Formatted);

                    // Sort messages by date
                    usort($allMessages, function($a, $b) use ($name) {
                        // Compare dates and times
                        $dateComparison = strtotime($a['date']) - strtotime($b['date']);
                        if ($dateComparison == 0) { // If dates are same, prioritize messages from other user
                            if ($a['sender'] === $name) {
                                return 1; // Move $name's messages to the end
                            } elseif ($b['sender'] === $name) {
                                return -1; // Move other user's messages to the beginning
                            }
                        }
                        return $dateComparison; // Sort by date and time otherwise
                    });
                    

                    // Display messages
                    if ($allMessages) {
                        foreach ($allMessages as $message) {
                            if ($message['sender'] === $name) {
                                echo '<div class="message" id="message">';
                            } else {
                                echo '<div class="message2" id="message">';
                            }
                            echo '<p class="main_message">' . htmlspecialchars($message['message']) . '</p>';
                            echo '<label class="time">' . htmlspecialchars($message['date']) . '</label>';
                            echo '</div>';
                        }
                    } else {
                        // No messages
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