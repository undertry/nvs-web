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
<script>
let lastScrollY = window.scrollY;

document.addEventListener('DOMContentLoaded', function() {
    const scrollTopButton = document.querySelector('.scroll-to-top');
    const scrollIcon = scrollTopButton.querySelector('i');

    // Iniciar con la flecha diagonal
    scrollTopButton.innerHTML = '↘';

    document.addEventListener('scroll', function() {
        // Detectar si el usuario ha scrolleado
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            // Si el usuario scrollea hacia abajo
            scrollTopButton.classList.add('scrolled');

            // Cambiar el ícono a flecha hacia abajo
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
});
</script>

<!-- subtext  -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const words = ['passionate', 'interested', 'curious', 'dedicated'];
    let currentIndex = 0;
    const dynamicWord = document.getElementById('dynamic-word');

    setInterval(() => {
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
    }, 1900); // Cambio de palabra cada 3 segundos
});
</script>



</body>

</html>