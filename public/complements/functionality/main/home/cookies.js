document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-dark-mode");
  const body = document.body;
  const modeIcon = document.getElementById("mode-icon");
  const languageLinks = document.querySelectorAll(".dropdown-menu li a");
  const languageLabel = document.querySelector(".language-label");

  // Cargar el modo y el idioma guardados en cookies antes de inicializar
  const savedLanguage = getCookie("language") || "en"; // Idioma por defecto "en"
  applyLanguage(savedLanguage); // Aplica el idioma al cargar la página
  languageLabel.textContent = savedLanguage.toUpperCase(); // Actualiza el texto del botón

  initializeMode();
  initializeLanguage();

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
      modeIcon.classList.replace("fa-moon", "fa-sun"); // Cambia el ícono de luna a sol
    } else {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");
      modeIcon.classList.replace("fa-sun", "fa-moon"); // Cambia el ícono de sol a luna
    }
    updateParticlesColor(mode); // Actualiza el color de las partículas si es necesario
  }

  // Inicializa el idioma
  function initializeLanguage() {
    const savedLanguage = getCookie("language") || "en"; // Idioma por defecto "en"
    applyLanguage(savedLanguage);

    // Cambia el texto del botón según el idioma guardado
    languageLabel.textContent = savedLanguage.toUpperCase();

    // Listener para cuando el usuario haga clic en un idioma del menú
    languageLinks.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const selectedLanguage = this.getAttribute("data-lang");
        setCookie("language", selectedLanguage, 7); // Guarda el idioma seleccionado en una cookie
        location.reload(); // Recarga la página para aplicar el nuevo idioma
      });
    });
  }

  // Aplica el idioma a la página cargando el archivo de traducción correspondiente
  function applyLanguage(language) {
    console.log("Idioma seleccionado:", language); // Verifica en consola el idioma seleccionado

    // Carga el archivo de traducción correspondiente al idioma seleccionado
    fetch(`complements/functionality/main/home/translations-${language}.json`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al cargar el archivo de traducción");
        }
        return response.json();
      })
      .then((translations) => {
        // Aplica las traducciones a los elementos con data-i18n
        document.querySelectorAll("[data-i18n]").forEach((element) => {
          const keys = element.getAttribute("data-i18n").split(".");
          let translation = translations;
          keys.forEach((key) => {
            translation = translation[key] || translation; // Evita que se quiebre si no encuentra la traducción
          });

          // Si la traducción existe, la aplica
          if (translation) {
            element.innerHTML = translation;
          } else {
            console.warn(`No se encontró la traducción para ${keys.join(".")}`);
          }
        });
      })
      .catch((error) => {
        console.error("Error al aplicar el idioma:", error);
      });

    // Actualiza el label del idioma en el botón
    languageLabel.textContent = language.toUpperCase();
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
