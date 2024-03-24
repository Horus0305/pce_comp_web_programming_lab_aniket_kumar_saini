var c1 = document.getElementById('c1');
var c2 = document.getElementById('c2');
var c3 = document.getElementById('c3');
var c4 = document.getElementById('c4');

var scale;

var FullName = document.getElementById('fullName');
var PhoneNumber = document.getElementById('phoneNumber');

var proCompCon = document.getElementById("profile_completion_popup");
var reqCompCon = document.getElementById("partner_requirements_con");
var pro_pic_con = document.getElementById("profile_picture_con");

var all = document.querySelector(".all-container");

var profileCon = document.querySelector('.profile-progress-con');

var completion = document.getElementById('completion_val');
var bar = document.getElementById('file');

var interval = 50;



function completion_status() {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'datasend.php', true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            scale = xhr.responseText;
            console.log(scale);
        } else {
            console.error('Request failed with status:', xhr.status);
        }
    };
    xhr.send();

    if (completion.innerHTML != '100%') {

        if (scale === 123 || scale === "123") {
            bar.value = 25;
            c1.style.backgroundColor = "lightgreen";
            completion.innerHTML = "25%";
        }

        else if (scale === 23 || scale === "23") {
            bar.value = 50;
            c2.style.backgroundColor = "lightgreen";
            c1.style.backgroundColor = "lightgreen";
            completion.innerHTML = "50%";
        }

        else if (scale === 3 || scale === "3") {
            bar.value = 75;
            c3.style.backgroundColor = "lightgreen";
            c2.style.backgroundColor = "lightgreen";
            c1.style.backgroundColor = "lightgreen";
            completion.innerHTML = "75%";
        }

        else if (scale === 4 || scale === "4"){
            bar.value = 100;
            c4.style.backgroundColor = "lightgreen";
            c3.style.backgroundColor = "lightgreen";
            c2.style.backgroundColor = "lightgreen";
            c1.style.backgroundColor = "lightgreen";
            completion.innerHTML = "100%";
            window.location.href = "../Page3/birthchart.php";
        }
    } else {
        return;
    }
}

completion_status();
setInterval(completion_status, 3000);


function show_burger() {
    let sideBar = document.querySelector(".side-bar");
    let burger = document.querySelector(".hamburger");
    let burger_logo = document.querySelector(".menu");

    if (sideBar.style.display === "" || sideBar.style.display === "none") {
        sideBar.style.display = "block";
        sideBar.style.position = "absolute";
        sideBar.style.width = "15%";
        sideBar.style.top = "50px";
        sideBar.style.backgroundColor = "black";

        burger_logo.classList.remove("fi-rr-menu-burger");
        burger_logo.classList.add("fi-rr-cross");
    }

    else {
        sideBar.style.display = "none";
        burger_logo.classList.remove("fi-rr-cross");
        burger_logo.classList.add("fi-rr-menu-burger");
    }
}

var progressBars = [
    document.getElementById('pro1'),
    document.getElementById('pro2'),
    document.getElementById('pro3')
];

var cards = [
    document.getElementById('card1'),
    document.getElementById('card2'),
    document.getElementById('card3')
];

var currentCardIndex = 0;

function incrementProgress(index) {
    if (progressBars[index].value < progressBars[index].max) {
        progressBars[index].value++;
        setTimeout(function () {
            incrementProgress(index);
        }, 50);
    } else {
        progressBars[index].value = 0;
        showNextCard();
    }
}

function showNextCard() {
    cards[currentCardIndex].classList.add('hidden');

    currentCardIndex++;

    if (currentCardIndex >= cards.length) {
        currentCardIndex = 0;
    }


    cards[currentCardIndex].classList.remove('hidden');

    incrementProgress(currentCardIndex);
}

incrementProgress(0);