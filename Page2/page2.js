var c1 = document.getElementById('c1'); 
var c2 = document.getElementById('c2'); 
var c3 = document.getElementById('c3'); 
var c4 = document.getElementById('c4');

var profileCon = document.querySelector('.profile-progress-con');

var completion = document.getElementById('completion_val');
var bar = document.getElementById('file');

function completion_status(status) {
if(completion.innerHTML != '100%'){

    if (status == "c1") {
        bar.value = 25;
        c1.style.backgroundColor = "lightgreen";
        completion.innerHTML = "25%";
    }
    
    if(status == "c2") {
        bar.value = 50;
        c2.style.backgroundColor = "lightgreen";
        completion.innerHTML = "50%";
    }
    
    if (status == "c3") {
        bar.value = 75;
        c3.style.backgroundColor = "lightgreen";
        completion.innerHTML = "75%";
    
    }
    
    if (status == "c4") {
        bar.value = 100;
        c4.style.backgroundColor = "lightgreen";
        completion.innerHTML = "100%";
    }
}

else{
    return ;
}

setTimeout(function() {
    if(completion.innerHTML == "100%"){
        profileCon.style.display = "none";
    }
}, 1000);



}