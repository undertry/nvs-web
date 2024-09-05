document.querySelectorAll(".faq-question").forEach((item) => {
  item.addEventListener("click", () => {
    const parent = item.parentElement;
    parent.classList.toggle("active");

    // Para cerrar las otras respuestas cuando se abre una nueva
    document.querySelectorAll(".faq-item").forEach((otherItem) => {
      if (otherItem !== parent) {
        otherItem.classList.remove("active");
      }
    });
  });
});
