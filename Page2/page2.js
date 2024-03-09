var c1 = document.getElementById('c1');
var c2 = document.getElementById('c2');
var c3 = document.getElementById('c3');
var c4 = document.getElementById('c4');


var fullName = document.getElementById('fullName');
var phoneNumber = document.getElementById('phoneNumber');

var proCompCon = document.getElementById("profile_completion_popup");
var reqCompCon = document.getElementById("partner_requirements_con");

var all = document.querySelector(".all-container");

var profileCon = document.querySelector('.profile-progress-con');

var completion = document.getElementById('completion_val');
var bar = document.getElementById('file');

var interval = 50;

function profile_comp() {
    var nameError = document.getElementById('name_error');
    var phoneError = document.getElementById('phone_error');
    var nameRegex = /^[a-zA-Z\s]+$/;
    var phoneRegex = /^\d{10}$/;

    if (!nameRegex.test(fullName.value)){
        nameError.style.display = 'block';
        document.getElementById('pro_form').addEventListener('submit', function (event) {
            event.preventDefault();
        });
    }

    else if (!phoneRegex.test(phoneNumber.value)){
        phoneError.style.display = 'block';
        document.getElementById('pro_form').addEventListener('submit', function (event) {
            event.preventDefault();
        });
    }

    else {
        nameError.style.display = 'none';
        alert("Done");
        document.getElementById('pro_form').submit();
    }
}



function completion_status(status) {
    if (completion.innerHTML != '100%') {

        if (status == "c1" && completion.innerHTML == "0%") {
            proCompCon.style.display = "block";


            // bar.value = 25;
            // c1.style.backgroundColor = "lightgreen";
            // completion.innerHTML = "25%";
        }

        if (status == "c2" && completion.innerHTML == "25%") {
            bar.value = 50;
            c2.style.backgroundColor = "lightgreen";
            completion.innerHTML = "50%";
        }

        if (status == "c3" && completion.innerHTML == "50%") {
            bar.value = 75;
            c3.style.backgroundColor = "lightgreen";
            completion.innerHTML = "75%";
        }

        if (status == "c4" && completion.innerHTML == "0%") {
            reqCompCon.style.display = "block";

            // bar.value = 100;
            // c4.style.backgroundColor = "lightgreen";
            // completion.innerHTML = "100%";
        }
    } else {
        return;
    }

    setTimeout(function () {
        if (completion.innerHTML == "100%") {
            all.style.display = "none";
            profileCon.style.display = "none";
        }
    }, 1000);
}

function hob_sub() {
    var hobbies = document.getElementById("hobbies");
    var req = document.getElementById("req");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'datacon.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("Message send in datacon.php");
            window.location.reload();
        }
    };
    var data = 'hobbies=' + encodeURIComponent(hobbies.value) + '&req=' + encodeURIComponent(req.value);
    xhr.send(data);

    bar.value = 100;
    c4.style.backgroundColor = "lightgreen";
    completion.innerHTML = "100%";
}

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

function gaayab(ham) {
    if (ham === "cross") {
        var proCon = document.getElementById("profile_completion_popup");
        var reqCon = document.getElementById("partner_requirements_con");
        proCon.style.display = "none";
        reqCon.style.display = "none";
    }
}