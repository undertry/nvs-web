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


</body>

</html>