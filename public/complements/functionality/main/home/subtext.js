document.addEventListener("DOMContentLoaded", () => {
  const words = ["passionate", "interested", "curious", "dedicated"];
  let currentIndex = 0;
  const dynamicWord = document.getElementById("dynamic-word");

  setInterval(() => {
    // Añadimos la clase de salida
    dynamicWord.classList.add("slide-out");

    setTimeout(() => {
      currentIndex = (currentIndex + 1) % words.length;
      dynamicWord.textContent = words[currentIndex];

      // Forzamos una actualización de estilo para reiniciar la animación
      dynamicWord.classList.remove("slide-out");
      dynamicWord.classList.add("slide-in");

      // Esperar para eliminar la clase slide-in después de la animación
      setTimeout(() => {
        dynamicWord.classList.remove("slide-in");
      }, 500); // Tiempo de la animación de entrada
    }, 500); // Tiempo de la animación de salida
  }, 3000); // Cambio de palabra cada 3 segundos
});
