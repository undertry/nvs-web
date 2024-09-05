// Función para verificar si la tecla de Bloq Mayus está activada
function checkCapsLock(event, warningElementId) {
  const warningElement = document.getElementById(warningElementId);
  const isCapsLockOn =
    event.getModifierState && event.getModifierState("CapsLock");
  if (warningElement) {
    // Nuevo: Verificamos si el elemento existe
    warningElement.classList.toggle("active", isCapsLockOn);
  }
}

// Verificamos si el campo 'password' existe antes de agregarle el event listener
if (document.getElementById("password")) {
  // Nuevo: Se asegura de que 'password' exista
  document
    .getElementById("password")
    .addEventListener("keyup", function (event) {
      checkCapsLock(event, "caps-lock-warning-password");
    });
}

// Verificamos si el campo 'confirm_password' existe antes de agregarle el event listener
if (document.getElementById("confirm_password")) {
  // Nuevo: Se asegura de que 'confirm_password' exista
  document
    .getElementById("confirm_password")
    .addEventListener("keyup", function (event) {
      checkCapsLock(event, "caps-lock-warning-password");
    });
}

// Función para mostrar/ocultar la contraseña
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

//   Funcion para validar la contraseña
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
  //   Si las contraseñas no coinciden se vacia los inputs de password
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

  // Muestra el popup cuando se hace clic en el campo de contraseña
  passwordField.addEventListener("focus", function () {
    passwordPopup.classList.add("active");
  });

  // Cierra el popup cuando se hace clic fuera del popup
  window.addEventListener("click", function (e) {
    if (e.target !== passwordPopup && e.target !== passwordField) {
      passwordPopup.classList.remove("active");
    }
  });
});
