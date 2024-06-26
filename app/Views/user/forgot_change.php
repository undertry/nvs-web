<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>

<body>
  <div class="container">

  <form method="post" action="<?= base_url('password_change_forgot'); ?>" class="form">
      <h2>Change Password</h2>
      <div class="form-inputs">
        <div class="form-label">
          <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="password">
        </div>
        <div class="form-label">
          <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="confirm password">
        </div>
        <div class="form-label">
          <input name="codigo" required  type="text" id="codigo" placeholder="verification code">
        </div>
      </div>
      <input type="submit" value="Change Password">
    </form>

  </div>
  <script>
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
</body>

</html>