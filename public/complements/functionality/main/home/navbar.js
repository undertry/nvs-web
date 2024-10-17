document.addEventListener("DOMContentLoaded", function () {
  const scrollbar = Scrollbar.init(
    document.querySelector("#scroll-container"),
    {
      damping: 0.03, // Ajuste de suavidad
    }
  );

  // Interceptar los clics en los enlaces del navbar
  document.querySelectorAll("nav ul.nav-list a").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");

      // Comprobar si el enlace es a una sección interna (#)
      if (href.startsWith("#")) {
        e.preventDefault();

        // Obtener el ID de la sección objetivo desde el atributo href
        const targetId = href.substring(1); // Remover el '#'
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          // Desplazar usando la API de smooth-scrollbar
          scrollbar.scrollIntoView(targetElement, {
            damping: 0.07,
          });
        }
      } else {
        // Enlaces externos como login-animation o signup-animation permiten la redirección normal
        window.location.href = href;
      }
    });
  });
});
