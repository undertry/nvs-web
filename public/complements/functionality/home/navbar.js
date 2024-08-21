document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    var initialBgColor = 'transparent'; // Color de fondo inicial
    var scrollBgColor = '#151414'; // Color de fondo cuando se desplaza

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) { // Cambia el valor según el desplazamiento que desees
            navbar.style.backgroundColor = scrollBgColor;
        } else {
            navbar.style.backgroundColor = initialBgColor;
        }
    });

    // Toggle menu and close class
    document.getElementById('menuToggle').addEventListener('click', function() {
        this.classList.toggle('close');
        document.getElementById('overlayNav').classList.toggle('active');
    });
})