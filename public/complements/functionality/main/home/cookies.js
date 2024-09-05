document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("modeToggle");
  const body = document.body;
  const imgElement = document.querySelector("#overlayNav .overlay-video img");
  const homeSection = document.querySelector(".home");
  const dashboardSection = document.querySelector(".dashboard");
  const loginImage = document.getElementById("loginImage");
  const registerImage = document.getElementById("registerImage");
  const navbar = document.getElementById("navbar");

  const initialBgColor = "transparent";
  const scrollBgColorLightMode = "#FCFCFC";
  const scrollBgColorDarkMode = "#151414";

  if (homeSection) {
    const cookieBanner = document.createElement("div");
    cookieBanner.className = "cookie-banner";
    cookieBanner.innerHTML = `
            <p>This website uses cookies. <a href="#" id="acceptCookies">Accept</a></p>
        `;
    document.body.appendChild(cookieBanner);

    const acceptCookiesButton = document.getElementById("acceptCookies");
    const cookiesAccepted = getCookie("cookiesAccepted");

    if (cookiesAccepted) {
      cookieBanner.style.display = "none";
      initializeMode();
      initializeNavbarColor(); // Inicializa el color del navbar solo si las cookies están aceptadas
    } else {
      cookieBanner.style.display = "block";
      acceptCookiesButton.addEventListener("click", function () {
        setCookie("cookiesAccepted", "true", 365);
        cookieBanner.style.display = "none";
        initializeMode();
        initializeNavbarColor(); // Inicializa el color del navbar solo si se aceptan las cookies
      });
    }
  } else {
    initializeMode();
  }

  function initializeMode() {
    const savedMode = getCookie("mode") || "dark";
    applyMode(savedMode);

    toggleButton.addEventListener("click", function () {
      const currentMode = body.classList.contains("light-mode")
        ? "dark"
        : "light";
      applyMode(currentMode);
      setCookie("mode", currentMode, 7);
    });
  }

  function initializeNavbarColor() {
    // Evento de desplazamiento para cambiar el color de fondo del navbar
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        navbar.style.backgroundColor = getScrollBgColor();
      } else {
        navbar.style.backgroundColor = initialBgColor;
      }
    });
  }

  function applyMode(mode) {
    if (mode === "light") {
      body.classList.add("light-mode");
      body.classList.remove("dark-mode");
      toggleButton.textContent = "Dark";
      imgElement.src = lightImage;
      if (homeSection) homeSection.classList.add("light-mode");
      if (dashboardSection) dashboardSection.classList.add("light-mode");
      if (loginImage) loginImage.src = loginLightImage;
      if (registerImage) registerImage.src = registerLightImage;
    } else {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");
      toggleButton.textContent = "Light";
      imgElement.src = darkImage;
      if (homeSection) homeSection.classList.remove("light-mode");
      if (dashboardSection) dashboardSection.classList.remove("light-mode");
      if (loginImage) loginImage.src = loginDarkImage;
      if (registerImage) registerImage.src = registerDarkImage;
    }
  }

  function getScrollBgColor() {
    return document.body.classList.contains("dark-mode")
      ? scrollBgColorDarkMode
      : scrollBgColorLightMode;
  }

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

  function getCookie(name) {
    return document.cookie
      .split("; ")
      .find((row) => row.startsWith(name + "="))
      ?.split("=")[1];
  }
});
