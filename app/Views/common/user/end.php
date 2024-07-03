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
    //   Funcion para validar la contraseña
    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const passwordCriteria = /^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/;

        if (!passwordCriteria.test(password)) {
            alert('La contraseña debe tener al menos 8 caracteres, 1 mayúscula y 1 caracter especial.');
            return false;
        }
        //   Si las contraseñas no coinciden se vacia los inputs de password
        if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            document.getElementById('password').value = '';
            document.getElementById('confirm_password').value = '';
            return false;
        }

        return true;
    }
    //   Mensaje de la contraseña no coincide
    <?php if (session()->getFlashdata('error') === 'Las contraseñas no coinciden.') : ?>
        document.getElementById('password').value = '';
        document.getElementById('confirm_password').value = '';
    <?php endif; ?>
</script>
</body>

</html>