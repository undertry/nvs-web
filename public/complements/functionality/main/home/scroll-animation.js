// Scroll animation
document.addEventListener("DOMContentLoaded", function () {
  const homeSection = document.querySelector(".intro");
  const nextSection = document.querySelector(".next-section");

  const observerOptions = {
    root: null, // Observa respecto al viewport
    threshold: 0.1, // Se activa cuando el 10% de la siguiente sección esté visible
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        homeSection.classList.add("shrink");
      } else {
        homeSection.classList.remove("shrink");
      }
    });
  }, observerOptions);

  observer.observe(nextSection); // Observa la sección que sigue
});
// animation intro text
document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".hidden");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  });

  elements.forEach((element) => {
    observer.observe(element);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Obtén todos los elementos con la clase 'text hidden'
  const elements = document.querySelectorAll(".text.hidden");

  // Configura el IntersectionObserver
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          entry.target.classList.remove("hidden"); // Elimina la clase hidden cuando se vuelve visible
          observer.unobserve(entry.target); // Deja de observar el elemento después de la animación
        }
      });
    },
    {
      threshold: 0.1, // Ajusta el umbral según tus necesidades
    }
  );

  elements.forEach((element) => {
    observer.observe(element); // Empieza a observar los elementos
  });
});
