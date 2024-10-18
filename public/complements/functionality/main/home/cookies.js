document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-dark-mode");
  const body = document.body;
  const modeIcon = document.getElementById("mode-icon");

  // Cargar el modo guardado en cookies antes de inicializar
  initializeMode();

  // Inicializa el modo claro/oscuro
  function initializeMode() {
    const savedMode = getCookie("mode") || "dark"; // Modo por defecto "dark"
    applyMode(savedMode);

    toggleButton.addEventListener("click", function () {
      const currentMode = body.classList.contains("light-mode")
        ? "dark"
        : "light";
      applyMode(currentMode);
      setCookie("mode", currentMode, 7); // Guarda el modo en una cookie
    });
  }

  // Aplica el modo claro/oscuro
  function applyMode(mode) {
    if (mode === "light") {
      body.classList.add("light-mode");
      body.classList.remove("dark-mode");
      modeIcon.classList.replace("fa-sun", "fa-moon"); // Cambia el ícono de luna a sol
    } else {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");
      modeIcon.classList.replace("fa-moon", "fa-sun"); // Cambia el ícono de sol a luna
    }
    updateParticlesColor(mode); // Actualiza el color de las partículas si es necesario
    updateSphereColor(mode); //  Actualiza los colores de la esfera
  }

  // Función para crear cookies
  function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie =
      name +
      "=" +
      encodeURIComponent(value) +
      "; expires=" +
      expires +
      "; path=/";
  }

  // Función para obtener cookies
  function getCookie(name) {
    return document.cookie
      .split("; ")
      .find((row) => row.startsWith(name + "="))
      ?.split("=")[1];
  }
});
