var c1 = document.getElementById('c1');
var c2 = document.getElementById('c2');
var c3 = document.getElementById('c3');
var c4 = document.getElementById('c4');


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



function completion_status(status) {
    if (completion.innerHTML != '100%') {

        if (status == "c1" && completion.innerHTML == "0%") {
            proCompCon.style.display = "block";
        }

        if (status == "c2" && completion.innerHTML == "0%") {
            pro_pic_con.style.display = "block";
            bar.value = 50;
            c2.style.backgroundColor = "lightgreen";
            completion.innerHTML = "50%";
        }

        if (status == "c3" && completion.innerHTML == "50%") {
            bar.value = 75;
            c3.style.backgroundColor = "lightgreen";
            completion.innerHTML = "75%";
        }

        if (status == "c4" && completion.innerHTML == "75%") {
            reqCompCon.style.display = "block";
        }
    } else {
        return;
    }
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
        }
    };
    var data = 'hobbies=' + encodeURIComponent(hobbies.value) + '&req=' + encodeURIComponent(req.value);
    xhr.send(data);

    bar.value = 100;
    c4.style.backgroundColor = "lightgreen";
    completion.innerHTML = "100%";

    all.style.display = "none";
    profileCon.style.display = "none";
}

function pro_img_sub(){
    var fileInput = document.getElementById('image');
    var imageFile ;
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('file', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'pics.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('File uploaded successfully.');
            imageFile = xhr.responseText;
            var img_con = document.getElementById('img_con');
            img_con.innerHTML = imageFile;
            img_con.style.borderRadius = '10px';
        } else {
            console.log('Error uploading file.');
        }
    };
    xhr.send(formData);



    
}

function profile_sub() {

    var nameError = document.getElementById('name_error');
    var phoneError = document.getElementById('phone_error');
    var nameRegex = /^[a-zA-Z\s]+$/;
    var phoneRegex = /^\d{10}$/;

    if (!nameRegex.test(FullName.value)) {
        nameError.style.display = 'block';
    }

    else if (!phoneRegex.test(PhoneNumber.value)) {
        phoneError.style.display = 'block';
    }

    else {

        var fullName = document.getElementById("fullName");
        var phoneNumber = document.getElementById("phoneNumber");
        var birthDate = document.getElementById("birthDate");
        var address = document.getElementById("address");
        var city = document.getElementById("city");

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'datacon.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("Message send in datacon.php");
                console.log(xhr.responseText);
            }
        };

        var data = 'fullName=' + encodeURIComponent(fullName.value) + '&phoneNumber=' + encodeURIComponent(phoneNumber.value) + '&birthDate=' + encodeURIComponent(birthDate.value) + '&address=' + encodeURIComponent(address.value) + '&city=' + encodeURIComponent(city.value);
        xhr.send(data);

        var con = document.getElementById("profile_completion_popup"); 
        con.style.display = "none";
        bar.value = 25;
        c1.style.backgroundColor = "lightgreen";
        completion.innerHTML = "25%";
    }
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
        var pro_pic = document.getElementById("profile_picture_con");
        proCon.style.display = "none";
        reqCon.style.display = "none";
        pro_pic.style.display = "none";
    }
}