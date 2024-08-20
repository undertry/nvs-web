document.addEventListener("DOMContentLoaded", function() {
    const cursor = document.querySelector(".cursor");

    document.addEventListener("mousemove", function(e) {
        const x = e.pageX - cursor.offsetWidth / 2;
        const y = e.pageY - cursor.offsetHeight / 2;

        cursor.style.transform = `translate(${x}px, ${y}px)`;
    });
});