document.addEventListener("DOMContentLoaded", () => {
  const words = ["passionate", "interested", "curious", "dedicated"];
  let currentIndex = 0;
  const dynamicWord = document.getElementById("dynamic-word");

  setInterval(() => {

    dynamicWord.classList.add("slide-out");

    setTimeout(() => {
      currentIndex = (currentIndex + 1) % words.length;
      dynamicWord.textContent = words[currentIndex];
      dynamicWord.classList.remove("slide-out");
      dynamicWord.classList.add("slide-in");
      setTimeout(() => {
        dynamicWord.classList.remove("slide-in");
      }, 500); 
    }, 500); 
  }, 3000); 
});