<?php
session_start();
    session_destroy();
    echo '<script>alert("You have been logged out successfully.");</script>';
    echo '<meta http-equiv="refresh" content="1;url=../landingpage/main.html">';
?>