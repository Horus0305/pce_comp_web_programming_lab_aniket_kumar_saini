var input = document.getElementById('in');
var current_Date;
var currentTime;


function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}

function clock() {
    var currentDate = new Date();

    var year = currentDate.getFullYear(); // Get the year (e.g., 2024)
    var month = currentDate.getMonth() + 1; // Get the month (0-11, add 1 to get 1-12)
    var day = currentDate.getDate(); // Get the day of the month (1-31)
    var hours = currentDate.getHours(); // Get the hours (0-23)
    var minutes = currentDate.getMinutes(); // Get the minutes (0-59)
    var seconds = currentDate.getSeconds(); // Get the seconds (0-59)

    current_Date = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    console.log(currentDate);
    return currentDate;
}

function clock2() {
    var currentDate2 = new Date();

    var hours = currentDate2.getHours();
    var minutes = currentDate2.getMinutes();

    currentTime = hours + ':' + minutes;

    return currentTime;
}


$(document).ready(function () {
    setInterval(function () {
        $("#main-message-con").load(location.href + " #message");
    }, 1000);
});

setInterval(function () {
    var mainMessageCon = document.getElementById('message-con');
    mainMessageCon.scrollTop = mainMessageCon.scrollHeight;
}, 3000);



$("#main-message-con").load(location.href + " #message", function () {
    var mainMessageCon = document.getElementById('message-con');
    mainMessageCon.scrollTop = mainMessageCon.scrollHeight;
});


function send_btn() {
    if (input.value == "") {
        return 0;
    }

    else {
        send();
    }
    document.getElementById('in').value = '';
}

function message_send(event) {
    if (event.key === 'Enter') {
        event.preventDefault();

        if (input.value == "") {
            return 0;
        }

        else {
            send();
        }
        document.getElementById('in').value = '';
    }
}



function send() {
    let username = document.getElementById('name').textContent;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'message.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("Message send in message.php");
            window.location.reload();
        }
    };
    var data = 'message=' + encodeURIComponent(input.value) + '&time=' + encodeURIComponent(current_Date) + '&name=' + encodeURIComponent(username)+ '&time2=' + encodeURIComponent(currentTime);
    xhr.send(data);
}

setInterval(clock, 1000);

setInterval(clock2, 1000);


function show_emojis() {

    var emojis = document.getElementById('emojis');

    if (emojis.style.display === "none" || emojis.style.display === "") {
        emojis.style.display = "block";
    }

    else if (emojis.style.display === "block") {
        emojis.style.display = "none";
    }
}

function emo(emoji) {
    document.getElementById("in").value += document.getElementById(emoji).innerHTML;
}