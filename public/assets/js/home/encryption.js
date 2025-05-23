document.addEventListener("DOMContentLoaded", function () {
  const title = document.querySelector(".title-animate");

  const revealText = (element, finalText, speed = 100) => {
    let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    let textArray = finalText.split("");
    let currentIndex = 0;

    let interval = setInterval(() => {
      textArray = textArray.map((char, index) => {
        if (index <= currentIndex) {
          return finalText[index];
        }
        return chars[Math.floor(Math.random() * chars.length)];
      });

      element.textContent = textArray.join("");

      if (currentIndex < textArray.length) {
        currentIndex++;
      } else {
        clearInterval(interval);
      }
    }, speed);
  };

  const savedLanguage = getCookie("language") || "en"; 

  if (savedLanguage === "es") {
    title.style.opacity = 1;
    revealText(title, "ESCANER DE VULNERABILIDAD DE RED", 85);
  } else {
    title.style.opacity = 1;
    revealText(title, "NETWORK VULNERABILITY SCANNER", 85);
  }

  function getCookie(name) {
    return document.cookie
      .split("; ")
      .find((row) => row.startsWith(name + "="))
      ?.split("=")[1];
  }
});