document.addEventListener("DOMContentLoaded", function () {
  const scrollTopButton = document.querySelector(".scroll-to-top");
  let lastScrollY = 0;

  scrollTopButton.innerHTML = "↘";

  const scrollbar = Scrollbar.init(
    document.querySelector("#scroll-container"), {
      damping: 0.03,
    }
  );

  scrollbar.addListener(function (status) {
    const currentScrollY = status.offset.y;

    if (currentScrollY > lastScrollY) {
      scrollTopButton.classList.add("scrolled");
      scrollTopButton.innerHTML = ""; 
      scrollTopButton.classList.add("fa", "fa-arrow-up");
    } else if (currentScrollY === 0) {
      scrollTopButton.classList.remove("scrolled");
      scrollTopButton.classList.remove("fa", "fa-arrow-up");
      scrollTopButton.innerHTML = "↘";
    }

    lastScrollY = currentScrollY;
  });

  scrollTopButton.addEventListener("click", function (e) {
    e.preventDefault(); 

    scrollbar.scrollTo(0, 0, 600); 
  });
});