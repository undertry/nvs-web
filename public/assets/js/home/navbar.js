document.addEventListener("DOMContentLoaded", function () {
  const scrollbar = Scrollbar.init(
    document.querySelector("#scroll-container"), {
      damping: 0.03, 
    }
  );

  document.querySelectorAll("nav ul.nav-list a").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");

      if (href.startsWith("#")) {
        e.preventDefault();

        const targetId = href.substring(1); 
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          scrollbar.scrollIntoView(targetElement, {
            damping: 0.07,
          });
        }
      } else {
        window.location.href = href;
      }
    });
  });
});