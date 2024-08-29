document.addEventListener('DOMContentLoaded', function() {

    const navbar = document.getElementById('navbar');
    const initialBgColor = window.getComputedStyle(navbar).backgroundColor;

    // Función para obtener el color del navbar según el scroll
    function getScrollBgColor() {
        if (document.body.classList.contains('dark-mode')) {
            return '#151414'; // Color para el modo oscuro
        } else {
            return '#FCFCFC'; // Color para el modo claro
        }
    }

    // Toggle menú y clase close
    document.getElementById('menuToggle').addEventListener('click', function() {
        this.classList.toggle('close');
        document.getElementById('overlayNav').classList.toggle('active');
    });

    // Cambiar el color del navbar instantáneamente al cambiar de modo
    document.getElementById('modeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode'); // Cambia el modo

        // Cambia el color del navbar inmediatamente sin importar el scroll
        navbar.style.backgroundColor = getScrollBgColor();
    });

    // Cambiar el color del navbar al hacer scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = getScrollBgColor();
        } else {
            navbar.style.backgroundColor = initialBgColor;
        }
    });
});
