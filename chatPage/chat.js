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
    let message;
    let username = document.getElementById('name').textContent;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'message.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            message = xhr.responseText;
            var outputContainer = document.getElementById('message-con');
            var name = document.getElementById('name');

            var message_con = document.createElement("div");
            var newParagraph = document.createElement('p');
            var time_label = document.createElement('label');

            message_con.style.padding = "10px 15px";

            message_con.classList.add('message');
            time_label.classList.add("time");
            newParagraph.classList.add("main_message");

            newParagraph.textContent = username + ": " + message;
            time_label.textContent = currentTime;

            message_con.appendChild(newParagraph);
            message_con.appendChild(time_label);
            outputContainer.appendChild(message_con);
        }
    };
    var data = 'message=' + encodeURIComponent(input.value) + '&time=' + encodeURIComponent(currentTime) + '&name=' + encodeURIComponent(username);
    xhr.send(data);


}

setInterval(clock, 1000);


function show_emojis() {
    emojis.style.display = "block";
}

function emo(emoji) {
    document.getElementById("in").value += document.getElementById(emoji).innerHTML;
}