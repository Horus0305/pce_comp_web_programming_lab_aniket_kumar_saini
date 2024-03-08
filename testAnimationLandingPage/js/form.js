var password = document.getElementById("password"),
  confirm_password = document.getElementById("confirm_password");

function validatePassword() {
  if (password.value != confirm_password.value) {
    // alert("Passwords do not match!! Please try again");
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity("");
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

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
