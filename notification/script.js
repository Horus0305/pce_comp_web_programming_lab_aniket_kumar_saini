$(document).ready(function () {
    // Function to fetch notifications
    function fetchNotifications() {
        $.ajax({
            url: 'fetch_notifications.php',
            type: 'GET',
            success: function (response) {
                $('#notifications').html(response);
            }
        });
    }

    // Call fetchNotifications initially
    fetchNotifications();

    // Set interval to update notifications every 5 seconds
    setInterval(fetchNotifications, 1);
});