var password = document.getElementById("password"),
  confirm_password = document.getElementById("confirm_password");
var email = document.getElementById("email");
var fname = document.getElementById("f_name");
var lname = document.getElementById("l_name");

function validatePassword() {
  var passformat = /^(?=.*[A-Z])(?=.*[a-zA-Z0-9]).{8,}$/;

  if (password.value !== confirm_password.value) {
    password.setCustomValidity("Passwords Don't Match");
  } else if (!passformat.test(password.value)) {
    password.setCustomValidity(
      "Password should contain 1 uppercase and minimum 8 digits"
    );
  } else {
    password.setCustomValidity("");
  }
}

function validateEmail() {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (email.value == "") {
    email.setCustomValidity("Email is required for registration");
  } else if (email.value.match(mailformat)) {
    email.setCustomValidity("");
  } else {
    email.setCustomValidity("Please enter a valid email address");
  }
}

function validateFname() {
  var nameformat = /^[A-Za-z\s]+$/;
  if (fname.value == "") {
    fname.setCustomValidity("First name is required");
  } else if (fname.value.match(nameformat)) {
    fname.setCustomValidity("");
  } else {
    fname.setCustomValidity("First Name should contain only letters");
  }
}
function validateLname() {
  var nameformat = /^[A-Za-z\s]+$/;
  if (lname.value == "") {
    fname.setCustomValidity("Last name is required");
  } else if (fname.value.match(nameformat)) {
    lname.setCustomValidity("");
  } else {
    lname.setCustomValidity("Last Name should contain only letters");
  }
}

const eye = document.querySelector(".eye");

eye.addEventListener("click", () => {
  const pass = document.getElementById("password");
  if (pass.type === "password") {
    pass.type = "text";
    eye.src = "../img/eye.svg";
  } else {
    pass.type = "password";
    eye.src = "../img/eyeclose.svg";
  }
});

eye.addEventListener("click", () => {
  const pass = document.getElementById("confirm_password");
  if (pass.type === "password") {
    pass.type = "text";
    eye.src = "../img/eye.svg";
  } else {
    pass.type = "password";
    eye.src = "../img/eyeclose.svg";
  }
});
// const eyel = document.querySelector(".eyelogin");
// eyel.addEventListener("click", () => {
//   const passl = document.getElementById("password");
//   if (passl.type === "password") {
//     passl.type = "text";
//     eyel.src = "../img/eye.svg";
//   } else {
//     passl.type = "password";
//     eyel.src = "../img/eyeclose.svg";
//   }
// });
fname.onchange = validateFname;
lname.onchange = validateLname;
email.onchange = validateEmail;
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
