function updateParticlesColor(mode) {
    const particlesColor = mode === "light" ? "#000000" : "#ffffff";
    const lineLinkedColor = mode === "light" ? "#000000" : "#ffffff";
  
    const particles = window.pJSDom[0].pJS.particles;
  
    particles.color.value = particlesColor;
    particles.line_linked.color = lineLinkedColor;
  
    window.pJSDom[0].pJS.fn.particlesRefresh();
  }
  
  particlesJS("particles-js", {
    particles: {
      number: {
        value: 100,
      },
      color: {
        value: "#ffffff", 
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
        distance: 0,
        color: "#ffffff", 
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