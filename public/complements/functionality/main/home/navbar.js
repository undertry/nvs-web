document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    var initialBgColor = 'transparent'; // Color de fondo inicial
    var scrollBgColorLightMode = '#FCFCFC'; // Color de fondo para el modo claro cuando se desplaza
    var scrollBgColorDarkMode = '#151414'; // Color de fondo para el modo oscuro cuando se desplaza

    // Función para obtener el color de fondo según el modo actual
    function getScrollBgColor() {
        if (document.body.classList.contains('dark-mode')) {
            return scrollBgColorDarkMode;
        } else {
            return scrollBgColorLightMode;
        }
    }

    // Evento de desplazamiento para cambiar el color de fondo del navbar
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) { // Cambia el valor según el desplazamiento que desees
            navbar.style.backgroundColor = getScrollBgColor();
        } else {
            navbar.style.backgroundColor = initialBgColor;
        }
    });

    // Toggle menú y clase close
    document.getElementById('menuToggle').addEventListener('click', function() {
        this.classList.toggle('close');
        document.getElementById('overlayNav').classList.toggle('active');
    });

    // Cambiar el color del navbar instantáneamente al cambiar de modo
    document.getElementById('modeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode'); // Cambia el modo

        // Cambia el color del navbar inmediatamente
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = getScrollBgColor();
        } else {
            navbar.style.backgroundColor = initialBgColor;
        }
    });
});
