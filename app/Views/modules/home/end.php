<!-- scripts modules -->
<script src="<?php echo base_url('complements/functionality/main/home/navbar.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/scroll-animation.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/encryption.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/cursor.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/comments.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/faq.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>
<script>
const lightImage = "<?= base_url('complements/styles/images/polygon.jpg'); ?>";
const darkImage = "<?= base_url('complements/styles/images/lines.jpg'); ?>";
</script>
<!-- menu idioma -->
<script>
$(document).ready(function() {
    // Mostrar/ocultar el menú desplegable al hacer clic en el icono del globo
    $('.globe').on('click', function(event) {
        event.preventDefault();
        $('.dropdown-menu').toggle(); // Muestra u oculta el menú
    });

    // Cerrar el menú si se hace clic fuera de él
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown').length) {
            $('.dropdown-menu').hide(); // Oculta el menú si se hace clic fuera
        }
    });
});
</script>
<!-- scroll boton -->
<!-- Scroll button -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrollTopButton = document.querySelector('.scroll-to-top');
    let lastScrollY = 0;

    // Iniciar con la flecha diagonal
    scrollTopButton.innerHTML = '↘';

    // Asumiendo que estás inicializando smooth-scrollbar en un contenedor con id 'scroll-container'
    const scrollbar = Scrollbar.init(document.querySelector('#scroll-container'), {
        damping: 0.03,
    });

    // Escuchar el evento de desplazamiento desde el scrollbar
    scrollbar.addListener(function(status) {
        const currentScrollY = status.offset.y;

        if (currentScrollY > lastScrollY) {
            // Si el usuario scrollea hacia abajo
            scrollTopButton.classList.add('scrolled');

            // Cambiar el ícono a flecha hacia arriba
            scrollTopButton.innerHTML = ''; // Limpiar antes de agregar el icono
            scrollTopButton.classList.add('fa', 'fa-arrow-up');
        } else if (currentScrollY === 0) {
            // Si el usuario vuelve al top (posición inicial)
            scrollTopButton.classList.remove('scrolled');

            // Cambiar el ícono a flecha diagonal
            scrollTopButton.classList.remove('fa', 'fa-arrow-up');
            scrollTopButton.innerHTML = '↘'; // Volver a la flecha diagonal
        }

        // Actualizar la última posición de scroll
        lastScrollY = currentScrollY;
    });

    // Añadir evento clickeable al botón para hacer scroll hacia arriba
    scrollTopButton.addEventListener('click', function(e) {
        e.preventDefault(); // Evitar que el enlace redirija al principio

        // Desplazar hacia el top usando smooth-scrollbar
        scrollbar.scrollTo(0, 0, 600); // 600ms de animación
    });
});
</script>


<!-- subtext  -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const words = ['passionate', 'interested', 'curious', 'dedicated'];
    let currentIndex = 0;
    const dynamicWord = document.getElementById('dynamic-word');

    setInterval(() => {
        // Añadimos la clase de salida
        dynamicWord.classList.add('slide-out');

        setTimeout(() => {
            currentIndex = (currentIndex + 1) % words.length;
            dynamicWord.textContent = words[currentIndex];

            // Forzamos una actualización de estilo para reiniciar la animación
            dynamicWord.classList.remove('slide-out');
            dynamicWord.classList.add('slide-in');

            // Esperar para eliminar la clase slide-in después de la animación
            setTimeout(() => {
                dynamicWord.classList.remove('slide-in');
            }, 500); // Tiempo de la animación de entrada
        }, 500); // Tiempo de la animación de salida
    }, 3000); // Cambio de palabra cada 3 segundos
});
</script>
<!-- scrooll animation -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const homeSection = document.querySelector(".intro");
    const nextSection = document.querySelector(".next-section");

    const observerOptions = {
        root: null, // Observa respecto al viewport
        threshold: 0.1 // Se activa cuando el 10% de la siguiente sección esté visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                homeSection.classList.add("shrink");
            } else {
                homeSection.classList.remove("shrink");
            }
        });
    }, observerOptions);

    observer.observe(nextSection); // Observa la sección que sigue
});
</script>

<!-- modules/home/end.php -->
<script src="https://cdn.jsdelivr.net/npm/smooth-scrollbar@8.5.2/dist/smooth-scrollbar.js"></script>



<script>
document.addEventListener("DOMContentLoaded", function() {
    const scrollbar = Scrollbar.init(document.querySelector('#scroll-container'), {
        damping: 0.03, // Ajuste de suavidad
    });

    // Interceptar los clics en los enlaces del navbar
    document.querySelectorAll('nav ul.nav-list a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Comprobar si el enlace es a una sección interna (#)
            if (href.startsWith('#')) {
                e.preventDefault();

                // Obtener el ID de la sección objetivo desde el atributo href
                const targetId = href.substring(1); // Remover el '#'
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Desplazar usando la API de smooth-scrollbar
                    scrollbar.scrollIntoView(targetElement, {
                        damping: 0.07
                    });
                }
            } else {
                // Enlaces externos como login-animation o signup-animation permiten la redirección normal
                window.location.href = href;
            }
        });
    });
});
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>




</body>

</html>