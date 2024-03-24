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
            <!-- Fetch and display notifications -->
            <?php
            try {
                // Connect to your database
                $db = new PDO('sqlite:../database/baba.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch notifications from the database
                $query = "SELECT * FROM notification ORDER BY id DESC";
                $result = $db->query($query);

                // Display notifications
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="notification_con">';
                    echo '<i class="fi fi-rr-envelope-dot mess" style="color: black;"></i>';
                    echo '<p class="noti" style="color: black;">' . htmlspecialchars($row['message']) . '</p>';
                    // Add cancel button with data-id attribute containing notification id
                    echo '<button class="cancel-btn" data-id="' . $row['id'] . '">Cancel</button>';
                    echo '</div>';
                }

                // Close the database connection
                $db = null;
            } catch (PDOException $e) {
                echo "Database Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
            success: function (response) {
                console.log("Notification deleted successfully");
                // Reload the page to fetch and display updated notifications
                location.reload();
            },
            error: function (xhr, status, error) {
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
</script>
