var alert = document.querySelector(".alert");
var msalert = document.querySelector(".msalert");
var message1alert = document.querySelector(".message1alert");
var message2alert = document.querySelector(".message2alert");
var message3alert = document.querySelector(".message3alert");
var message4alert = document.querySelector(".message4alert");

alert.style.display = "none";
msalert.style.display = "none";
message1alert.style.display = "none";
message2alert.style.display = "none";
message3alert.style.display = "none";
message4alert.style.display = "none";


function showAlert() {
    alert.style.display = "flex";
}

function showmessage1Alert() {
    message1alert.style.display = "flex";
}

function showmessage2Alert() {
    message2alert.style.display = "flex";
}

function showmessage3Alert() {
    message3alert.style.display = "flex";
}

function showmessage4Alert() {
    message4alert.style.display = "flex";
}






function showSuccessfulyAlert() {
    msalert.style.display = "flex";
}



function hideAlert() {
    alert.style.display = "none";
}