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
</body>

</html>