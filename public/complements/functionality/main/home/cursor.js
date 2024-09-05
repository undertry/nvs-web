document.addEventListener("DOMContentLoaded", function () {
  const cursor = document.querySelector(".cursor");

  let targetX = 0;
  let targetY = 0;

  document.addEventListener("mousemove", function (e) {
    targetX = e.pageX - cursor.offsetWidth / 2;
    targetY = e.pageY - cursor.offsetHeight / 2;
  });

  function updateCursor() {
    const currentX = parseFloat(cursor.style.left || 0);
    const currentY = parseFloat(cursor.style.top || 0);

    const dx = targetX - currentX;
    const dy = targetY - currentY;

    cursor.style.left = `${currentX + dx * 0.1}px`; // Ajusta el factor de suavidad aquí
    cursor.style.top = `${currentY + dy * 0.1}px`; // Ajusta el factor de suavidad aquí

    requestAnimationFrame(updateCursor);
  }

  updateCursor();
});
