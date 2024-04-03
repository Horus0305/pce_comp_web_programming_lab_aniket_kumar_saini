<?php
include "head_links.php";
?>
<link rel="website icon" type="png" href="../img/favicon.png" />
<div id="preloader">
  <div id="loader"></div>
</div>
<div class="nav">
    <div class="emblem">
        <a href="../landingpage/main.html">
            <img class="logo" src="../img/favicon.png" alt="logo" />
        </a>
    </div>
    <div class="widgets">
        <div class="home">
            <a href="../homepage/match.php">
                <img class="navigationimg" src="../img/home.svg" alt="" />
            </a>
        </div>
        <?php

        $name = $_SESSION['name'];

        $db_path = "../database/baba.db";

        $pdo = new PDO("sqlite:" . $db_path);



        $query3 = $pdo->prepare('SELECT DISTINCT male.name AS male_name, female.name AS female_name
        FROM matchtable
        JOIN male ON matchtable.male = male.id
        JOIN female ON matchtable.female = female.id
        WHERE male.name = :male_name OR female.name = :female_name AND matchtable.matched = 1');
        $query3->bindValue(':male_name', $name, PDO::PARAM_STR);
        $query3->bindValue(':female_name', $name, PDO::PARAM_STR);
        $query3->execute();
        $matchData = $query3->fetchAll(PDO::FETCH_ASSOC);

        if ($matchData){

?>
        

        <div class="chat">
            <a href="../chatPage/chat.php">
                <img class="navigationimg"src="../img/connect.svg" alt="" />
            </a>
        </div>
        <?php }?>
        <div class="heart">
            <a href="../match-page/match.php">
                <img class="navigationimg" src="../img/heart.svg" alt="" />
            </a>
        </div>
    </div>
    <div class="notification">
        <img class="navigationimg" src="../img/notification.svg" alt="" id="modalactive" onclick="opcl()"/>
    </div>
    <div class="profile">
        <a href="../profilepage/profile.php">
            <img class="profileimg" src="../profilepage/display.php" alt="profile-img" />
        </a>
    </div>
</div>
<div id="modal">
    <div id="overlay">
        <img src="../img/cross.svg" alt="cancel" id="modalinactive" />
        <div class="container" id="notification-container">

            <h1>Notification</h1>
          
            <?php
            // Get current date and time
            $currentDateTime = date("Y-m-d H:i:s");

            try {
                $gender = $_SESSION['gender'];
                $id = $_SESSION['id'];

                // Connect to your database
                $db = new PDO('sqlite:../database/baba.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Determine the column name based on the session gender
                $column = ($_SESSION['gender'] == 'male') ? 'male' : 'female';

                // Fetch notifications from the database
                $query = "SELECT * FROM matchtable WHERE $column = :id AND matched = '1'";
                $statement = $db->prepare($query);
                $statement->execute(array(':id' => $id));

                // Display notifications
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="notification_con">';
                    echo '<i class="fi fi-rr-envelope-dot mess" style="color: black;"></i>';
                    echo '<p class="noti" style="color: black;">You found a match</p>';
                  
                    // Add a link to the destination page with the appropriate URL
                    echo '<a href="../comparep/report.php"><button style=" background-color:wheat;
                    color:black;
                    width: 100%;
                    height:6%;
                    border-radius: 10px;
                    font-size: 1.2rem;">Checkout</button></a>';
                    echo '</div>';
                }
                
                // Close the statement
                $statement = null;

                // Close the database connection
                $db = null;
            } catch (PDOException $e) {
                echo "Database Error: " . $e->getMessage();
            }
          

            session_abort();
            ?>
            <p id="current-date-time" style="        position: absolute;
        bottom: 0;
        color:black;
        background-color: wheat; /* Set background color to wheat */
        padding: 5px; /* Add some padding for better visibility */
        width: 95%;
        margin-right:25px; /* Ensure it spans the entire width */
        text-align: center;
        border-radius:10px; /* Center align the text */
    }
 ">Current</p>

        </div>
    </div>
</div>

        
   
    </div>
</div>
<script>
    $(window).on("load", function () {
      $("#preloader").fadeOut("slow");
    });
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
// Function to fetch notifications via AJAX
// Call fetchNotifications function on page load


function opcl() {
    let modal = document.getElementById("modal");
    if (modal.style.display === "none" || modal.style.display === "") {
        modal.style.display = "block";
    } else {
        modal.style.display = "none";
    }
}

let close = document.getElementById("modalinactive");
close.addEventListener("click", () => {
    document.getElementById("modal").style.display = "none";
});

window.addEventListener("keydown", (event) => {
    if (event.code === "Escape") {
        document.getElementById("modal").style.display = "none";
    }
});

function fetchNotifications() {
    $.ajax({
        url: "fetch_notification.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Process the fetched notifications
            if (response.error) {
                console.error("Error fetching notifications: " + response.error);
            } else {
                // Display notifications
                let notificationsContainer = $("#notification-container");
                notificationsContainer.empty(); // Clear previous notifications
                if (response.notifications) { // Check if notifications property exists
                    response.notifications.forEach(function(notification) {
                        let notificationHTML = '<div class="notification_con">';
                        notificationHTML += '<i class="fi fi-rr-envelope-dot mess" style="color: black;"></i>';
                        notificationHTML += '<p class="noti" style="color: black;">' + notification.message + '</p>';
                        notificationHTML += '<button class="cancel-btn" id="' + notification.id + '">Cancel</button>';
                        notificationHTML += '</div>';
                        notificationsContainer.append(notificationHTML);
                    });
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching notifications: " + error);
        }
    });}

    // Call fetchNotifications function on page load
    fetchNotifications();
    setInterval(fetchNotifications, 1000);

    // Click event handler for cancel button (using event delegation)
    $(document).on("click", ".cancel-btn", function() {
        console.log("Cancelling notification ");
        let id = $(this).attr("id"); // Use attr("id") to get the ID of the clicked button
        deleteNotification(id);
    });

    // AJAX request to delete notification
    function deleteNotification(id) {
        console.log("Deleting notification with ID:", id); // Log ID to console for debugging
        $.ajax({
            url: "delete_notification.php",
            type: "POST", // Change the method to POST
            data: { id: id }, // Pass ID in the request body
            success: function(response) {
                console.log("Notification deleted successfully");
                // Reload the page to fetch and display updated notifications
       
            },
            error: function(xhr, status, error) {
                console.error("Error deleting notification: " + error);
            }
        });
    }
    function updateCurrentDateTime() {
    var currentDate = new Date();
    var day = currentDate.getDate();
    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    var monthIndex = currentDate.getMonth();
    var year = currentDate.getFullYear();
    
    // Get hours, minutes, and seconds
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();
    var seconds = currentDate.getSeconds();
    
    // Convert hours to 12-hour format
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (0 hours)

    // Ensure minutes and seconds are formatted with leading zeros if less than 10
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    var formattedTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;

    var formattedDate = day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' + formattedTime;
    document.getElementById("current-date-time").textContent = "Date and Time: " + formattedDate;
}

    // Call the function immediately to display the initial date and time
    updateCurrentDateTime();

    // Call the function every second to update the date and time continuously
    setInterval(updateCurrentDateTime, 1000);
</script>



