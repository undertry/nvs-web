function checkCapsLock(event, warningElementId) {
  const warningElement = document.getElementById(warningElementId);
  const isCapsLockOn =
    event.getModifierState && event.getModifierState("CapsLock");
  if (warningElement) {
    warningElement.classList.toggle("active", isCapsLockOn);
  }
}

if (document.getElementById("password")) {
  document
    .getElementById("password")
    .addEventListener("keyup", function (event) {
      checkCapsLock(event, "caps-lock-warning-password");
    });
}

if (document.getElementById("confirm_password")) {
  document
    .getElementById("confirm_password")
    .addEventListener("keyup", function (event) {
      checkCapsLock(event, "caps-lock-warning-password");
    });
}

$(document).ready(function () {
  $(".toggle-password").click(function () {
    $(this).toggleClass("show-password");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") === "password") {
      input.attr("type", "text");
      $(this).html('<i class="fa-solid fa-eye"></i>');
    } else {
      input.attr("type", "password");
      $(this).html('<i class="fa-solid fa-eye-slash"></i>');
    }
  });
});

function validatePassword() {
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm_password").value;
  const passwordCriteria = /^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/;

  if (!passwordCriteria.test(password)) {
    alert(
      "The password must have at least 8 characters, 1 uppercase letter, and 1 special character."
    );
    return false;
  }

  if (password !== confirmPassword) {
    alert("The passwords do not match.");
    document.getElementById("password").value = "";
    document.getElementById("confirm_password").value = "";
    return false;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.getElementById("password");
  const passwordPopup = document.getElementById("passwordPopup");

  passwordField.addEventListener("focus", function () {
    passwordPopup.classList.add("active");
  });

  window.addEventListener("click", function (e) {
    if (e.target !== passwordPopup && e.target !== passwordField) {
      passwordPopup.classList.remove("active");
    }
  });
});

document.getElementById('password').addEventListener('input', function () {
  const password = this.value;
  const lengthRequirement = document.getElementById('length');
  const uppercaseRequirement = document.getElementById('uppercase');
  const specialRequirement = document.getElementById('special');

  if (password.length >= 8) {
    lengthRequirement.classList.add('valid');
    lengthRequirement.classList.remove('invalid');
  } else {
    lengthRequirement.classList.add('invalid');
    lengthRequirement.classList.remove('valid');
  }

  if (/[A-Z]/.test(password)) {
    uppercaseRequirement.classList.add('valid');
    uppercaseRequirement.classList.remove('invalid');
  } else {
    uppercaseRequirement.classList.add('invalid');
    uppercaseRequirement.classList.remove('valid');
  }

  if (/[!@#$&*]/.test(password)) {
    specialRequirement.classList.add('valid');
    specialRequirement.classList.remove('invalid');
  } else {
    specialRequirement.classList.add('invalid');
    specialRequirement.classList.remove('valid');
  }
});