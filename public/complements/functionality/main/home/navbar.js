document.addEventListener('DOMContentLoaded', function() {

    const navbar = document.getElementById('navbar');
    const initialBgColor = window.getComputedStyle(navbar).backgroundColor;

    // Función para obtener el color del navbar según el scroll
    function getScrollBgColor() {
        return document.body.classList.contains('dark-mode') ? '#151414' : '#FCFCFC';
    }

    // Función para actualizar el color del navbar según el modo
    function updateNavbarColor() {
        navbar.style.backgroundColor = window.scrollY > 50 ? getScrollBgColor() : initialBgColor;
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
        updateNavbarColor();
    });

    // Cambiar el color del navbar al hacer scroll
    window.addEventListener('scroll', function() {
        updateNavbarColor();
    });

    // Inicializar el color del navbar según el modo actual al cargar la página
    updateNavbarColor();
});
