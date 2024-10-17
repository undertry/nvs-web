// Función optimizada para actualizar los colores sin reiniciar las partículas
function updateParticlesColor(mode) {
  const particlesColor = mode === "light" ? "#000000" : "#ffffff";
  const lineLinkedColor = mode === "light" ? "#000000" : "#ffffff";

  // Acceder directamente al objeto global de particles.js para cambiar los colores
  const particles = window.pJSDom[0].pJS.particles;

  // Cambiar color de las partículas y las líneas
  particles.color.value = particlesColor;
  particles.line_linked.color = lineLinkedColor;

  // Aplicar los cambios visuales inmediatamente
  window.pJSDom[0].pJS.fn.particlesRefresh();
}

// Inicializa las partículas
particlesJS("particles-js", {
  particles: {
    number: {
      value: 100,
    },
    color: {
      value: "#ffffff", // Color inicial, será actualizado dinámicamente
    },
    shape: {
      type: "circle",
    },
    opacity: {
      value: 0.5,
      random: false,
    },
    size: {
      value: 3,
      random: true,
    },
    line_linked: {
      enable: true,
      distance: 150,
      color: "#ffffff", // Color inicial, será actualizado dinámicamente
      opacity: 0.4,
      width: 1,
    },
    move: {
      speed: 1,
      random: true,
      direction: "none",
      out_mode: "out",
    },
  },
  interactivity: {
    events: {
      onhover: {
        enable: true,
        mode: "grab",
      },
      onclick: {
        enable: true,
        mode: "push",
      },
    },
  },
  retina_detect: true,
});
