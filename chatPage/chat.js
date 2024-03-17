var input = document.getElementById('in');
var currentTime;


function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}

function disappear() {
    if (input.value === 'Message...') {
        input.value = '';
    }
    else {
        return 0;
    }
}

function clock() {
    let time = new Date();

    let hours = time.getHours();
    let min = time.getMinutes();

    currentTime = padZero(hours) + ":" + padZero(min);

    return currentTime;
}

$(document).ready(function () {
    setInterval( function() {
        $("#main-message-con").load(location.href + " #message");
    }, 1000 );
});

setInterval( function() {
    var mainMessageCon = document.getElementById('message-con');
    mainMessageCon.scrollTop = mainMessageCon.scrollHeight;
}, 3000 );



$("#main-message-con").load(location.href + " #message", function() {
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
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("Message send in message.php");
            window.location.reload();
        }
    };
    var data = 'message=' + encodeURIComponent(input.value) + '&time=' + encodeURIComponent(currentTime) + '&name=' + encodeURIComponent(username);
    xhr.send(data);
}

setInterval(clock, 1000);


function show_emojis() {

    var emojis = document.getElementById('emojis');

    if (emojis.style.display === "none" || emojis.style.display === ""){
        emojis.style.display = "block";
    }

    else if (emojis.style.display === "block"){
        emojis.style.display = "none";
    }
}

function emo(emoji) {
    document.getElementById("in").value += document.getElementById(emoji).innerHTML;
}