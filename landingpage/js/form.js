const password = document.getElementById("password");
const confirm_password = document.getElementById("confirm_password");
const email = document.getElementById("email");
const fname = document.getElementById("f_name");
const lname = document.getElementById("l_name");

function validatePassword() {
  const passformat = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

  if (password.value !== confirm_password.value) {
    password.setCustomValidity("Passwords Don't Match");
  } else if (!passformat.test(password.value)) {
    password.setCustomValidity(
      "Password should contain at least 1 uppercase, 1 lowercase, and 1 digit"
    );
  } else {
    password.setCustomValidity("");
  }
}

function validateEmail() {
  const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (email.value === "") {
    email.setCustomValidity("Email is required for registration");
  } else if (email.value.match(mailformat)) {
    email.setCustomValidity("");
  } else {
    email.setCustomValidity("Please enter a valid email address");
  }
}

function validateName(input, name) {
  const nameformat = /^[A-Za-z\s]+$/;
  const minLength = 2;

  if (input.value.length < minLength) {
    input.setCustomValidity(
      `${name} should be at least ${minLength} characters long`
    );
  } else if (input.value === "") {
    input.setCustomValidity(`${name} is required`);
  } else if (input.value.match(nameformat)) {
    input.setCustomValidity("");
  } else {
    input.setCustomValidity(`${name} should contain only letters`);
  }
}

function checkValidity(event) {
  const currentInput = event.target;
  const nextInput = currentInput.nextElementSibling;

  if (currentInput.checkValidity()) {
    if (nextInput) {
      nextInput.focus();
    }
  } else {
    event.preventDefault();
  }
}

fname.addEventListener("input", (event) => validateName(fname, "First name"));
lname.addEventListener("input", (event) => validateName(lname, "Last name"));
email.addEventListener("input", validateEmail);
password.addEventListener("input", validatePassword);
confirm_password.addEventListener("input", validatePassword);

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("blur", checkValidity);
});
const eye = document.querySelector(".eye");

eye.addEventListener("click", () => {
  const pass = document.getElementById("password");
  const passl = document.getElementById("confirm_password");

  if (pass.type === "password") {
    pass.type = "text";
    passl.type = "text";
    eye.src = "../img/eye.svg";
  } else {
    pass.type = "password";
    passl.type = "password";
    eye.src = "../img/eyeclose.svg";
  }
});
