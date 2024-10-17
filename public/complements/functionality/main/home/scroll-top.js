document.addEventListener("DOMContentLoaded", function () {
  const scrollTopButton = document.querySelector(".scroll-to-top");
  let lastScrollY = 0;

  // Iniciar con la flecha diagonal
  scrollTopButton.innerHTML = "↘";

  // Asumiendo que estás inicializando smooth-scrollbar en un contenedor con id 'scroll-container'
  const scrollbar = Scrollbar.init(
    document.querySelector("#scroll-container"),
    {
      damping: 0.03,
    }
  );

  // Escuchar el evento de desplazamiento desde el scrollbar
  scrollbar.addListener(function (status) {
    const currentScrollY = status.offset.y;

    if (currentScrollY > lastScrollY) {
      // Si el usuario scrollea hacia abajo
      scrollTopButton.classList.add("scrolled");

      // Cambiar el ícono a flecha hacia arriba
      scrollTopButton.innerHTML = ""; // Limpiar antes de agregar el icono
      scrollTopButton.classList.add("fa", "fa-arrow-up");
    } else if (currentScrollY === 0) {
      // Si el usuario vuelve al top (posición inicial)
      scrollTopButton.classList.remove("scrolled");

      // Cambiar el ícono a flecha diagonal
      scrollTopButton.classList.remove("fa", "fa-arrow-up");
      scrollTopButton.innerHTML = "↘"; // Volver a la flecha diagonal
    }

    // Actualizar la última posición de scroll
    lastScrollY = currentScrollY;
  });

  // Añadir evento clickeable al botón para hacer scroll hacia arriba
  scrollTopButton.addEventListener("click", function (e) {
    e.preventDefault(); // Evitar que el enlace redirija al principio

    // Desplazar hacia el top usando smooth-scrollbar
    scrollbar.scrollTo(0, 0, 600); // 600ms de animación
  });
});
