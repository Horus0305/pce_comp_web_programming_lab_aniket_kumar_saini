<?php
include "head_links.php";
?>
<link rel="website icon" type="png" href="../img/favicon.png" />

<div class="nav">
    <div class="emblem">
        <a href="../landingpage/main.html">
            <img class="logo" src="../img/favicon.png" alt="logo" />
        </a>
    </div>
    <div class="widgets">
        <div class="home">
            <a href="../homepage/match.php">
                <img src="../img/home.svg" alt="" />
            </a>
        </div>
        <div class="chat">
            <a href="../chatPage/chat.php">
                <img src="../img/chat.svg" alt="" />
            </a>
        </div>
        <div class="heart">
            <a href="../match-page/match.php">
                <img src="../img/heart.svg" alt="" />
            </a>
        </div>
    </div>
    <div class="notification">
        <img src="../img/notification.svg" alt="" id="modalactive" onclick="opcl()"/>
    </div>
    <div class="profile">
        <a href="../profilepage/profile.php">
            <img class="profileimg" src="../img/profile.jpg" alt="profile-img" />
        </a>
    </div>
</div>
<div id="modal">
    <div id="overlay">
        <img src="../img/cross.svg" alt="cancel" id="modalinactive" />
        <div class="container" id="notification-container">
            <h1>Push Notification</h1>
            <!-- Notifications will be fetched and displayed here via AJAX -->
        </div>
    </div>
</div>

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

// AJAX request to delete notification
function deleteNotification(id) {
    console.log("Deleting notification with ID:", id); // Log ID to console for debugging
    $.ajax({
        url: "delete_notification.php?id=" + id, // Pass ID as a query parameter
        type: "GET", // Use GET method
        success: function(response) {
            console.log("Notification deleted successfully");
            // Reload the page to fetch and display updated notifications
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error("Error deleting notification: " + error);
        }
    });
}

$(document).ready(function(){
    // Click event handler for cancel button
    $(".cancel-btn").click(function() {
        let id = $(this).data("id");
        deleteNotification(id);
    });
});

    // Function to fetch notifications via AJAX
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
                    response.forEach(function(notification) {
                        let notificationHTML = '<div class="notification_con">';
                        notificationHTML += '<i class="fi fi-rr-envelope-dot mess" style="color: black;"></i>';
                        notificationHTML += '<p class="noti" style="color: black;">' + notification.message + '</p>';
                        notificationHTML += '<button class="cancel-btn" data-id="' + notification.id + '">Cancel</button>';
                        notificationHTML += '</div>';
                        notificationsContainer.append(notificationHTML);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching notifications: " + error);
            }
        });
    }

    // Call fetchNotifications function on page load
    fetchNotifications();
    setInterval(fetchNotifications, 1000);

;

</script>


