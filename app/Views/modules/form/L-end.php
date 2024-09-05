<script>
// Funcion para verificar si la tecla de Bloq Mayus esta activada
function checkCapsLock(event, warningElementId) {
    const warningElement = document.getElementById(warningElementId);
    const isCapsLockOn = event.getModifierState && event.getModifierState('CapsLock');
    warningElement.classList.toggle('active', isCapsLockOn);
}

document.getElementById('password').addEventListener('keyup', function(event) {
    checkCapsLock(event, 'caps-lock-warning-password');
});
document.getElementById('confirm_password').addEventListener('keyup', function(event) {
    checkCapsLock(event, 'caps-lock-warning-password');
});
//   Funcion para validar la contraseña
function validatePassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const passwordCriteria = /^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/;

    if (!passwordCriteria.test(password)) {
        alert('The password must have at least 8 characters, 1 uppercase letter, and 1 special character.');
        return false;
    }
    //   Si las contraseñas no coinciden se vacia los inputs de password
    if (password !== confirmPassword) {
        alert('The passwords do not match.');
        document.getElementById('password').value = '';
        document.getElementById('confirm_password').value = '';
        return false;
    }

    return true;
}
//   Mensaje de la contraseña no coincide
<?php if (session()->getFlashdata('error') === 'The passwords do not match.') : ?>
document.getElementById('password').value = '';
document.getElementById('confirm_password').value = '';
<?php endif; ?>
</script>
<!-- libreria de jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Funcion para mostrar la contraseña
$(document).ready(function() {
    $('.toggle-password').click(function() {
        $(this).toggleClass('show-password');
        var input = $($(this).attr('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).html('<i class="fa-solid fa-eye"></i>');
        } else {
            input.attr('type', 'password');
            $(this).html('<i class="fa-solid fa-eye-slash"></i>');
        }
    });
});
</script>
<script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>
<script src="<?php echo base_url('complements/functionality/main/home/navbar.js'); ?>"></script>

<script>
const lightImage = "<?= base_url('complements/styles/images/blacky.png'); ?>";
const darkImage = "<?= base_url('complements/styles/images/corner.jpg'); ?>";
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const cursor = document.querySelector(".cursor");

    let targetX = 0;
    let targetY = 0;

    document.addEventListener("mousemove", function(e) {
        targetX = e.pageX - cursor.offsetWidth / 2;
        targetY = e.pageY - cursor.offsetHeight / 2;
    });

    function updateCursor() {
        const currentX = parseFloat(cursor.style.left || 0);
        const currentY = parseFloat(cursor.style.top || 0);

        const dx = targetX - currentX;
        const dy = targetY - currentY;

        cursor.style.left = `${currentX + dx * 0.1}px`; // Ajusta el factor de suavidad aquí
        cursor.style.top = `${currentY + dy * 0.1}px`; // Ajusta el factor de suavidad aquí

        requestAnimationFrame(updateCursor);
    }

    updateCursor();
});
</script>

<script>
const loginLightImage = "<?= base_url('complements/styles/images/trasparent.jpg'); ?>";
const loginDarkImage = "<?= base_url('complements/styles/images/alone1.jpg'); ?>";
</script>
</body>

</html>