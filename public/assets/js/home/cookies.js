document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-dark-mode");
  const body = document.body;
  const modeIcon = document.getElementById("mode-icon");
  const wallpaperImage = document.querySelector(".wallpaper img");

  initializeMode();

  function initializeMode() {
    const savedMode = getCookie("mode") || "dark";
    applyMode(savedMode);

    toggleButton.addEventListener("click", function () {
      const currentMode = body.classList.contains("light-mode") ?
        "dark" :
        "light";
      applyMode(currentMode);
      setCookie("mode", currentMode, 7); 
    });
  }

  function applyMode(mode) {
    if (mode === "light") {
      body.classList.add("light-mode");
      body.classList.remove("dark-mode");
      modeIcon.classList.replace("fa-sun", "fa-moon"); 

      if (wallpaperImage) {
        wallpaperImage.src = "complements/styles/images/wallhaven-1kjr83.jpg"; 
      }
    } 
      else {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");
      modeIcon.classList.replace("fa-moon", "fa-sun");

      if (wallpaperImage) {
        wallpaperImage.src = "complements/styles/images/wallhaven-p9p59j.png";
      }
    }

    if (typeof updateParticlesColor === "function") {
      updateParticlesColor(mode);
    }

    if (typeof updateSphereColor === "function") {
      updateSphereColor(mode); 
    }
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