<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale:1.0">
  <link rel="stylesheet" href="<?php echo base_url('complements/styles/user.css'); ?>">
  <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
  <title>Log In</title>
  <!-- Estilos precargados para el Aviso de Mayuscula -->
  <style>
    .caps-lock-warning {
      display: none;
      margin-top: 5px;
      padding: 5px;
      background-color: #ffc107;
      color: #000;
      text-align: center;
      font-size: 12px;
      border: 1px solid #ffa000;
      border-radius: 3px;
    }

    .caps-lock-warning.active {
      display: block;
    }
  </style>
</head>

<body>
  <!-- Mensaje de sesiones -->
  <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
  <?php endif; ?>
  <h1 class="header"><a href="<?= base_url('/'); ?>">NVS</a></h1>
  <div class="box">
    <form method="post" action="<?= base_url('login'); ?>" class="form">
      <h2>Log In</h2>
      <div class="form-inputs">
        <div class="form-label">
          <input name="email" type="email" id="email" placeholder="name@example.com" required>
        </div>
        <div class="form-label">
          <input name="password" type="password" id="password" placeholder="password" required>
          <!-- Implementacion de Aviso de Mayuscula -->
          <div id="caps-lock-warning-password" class="caps-lock-warning">Caps Lock is on</div>
        </div>
      </div>
      <div class="links">
        <a href="<?= base_url('register'); ?>">Sign up</a>
        <a href="<?= base_url('change_password'); ?>">Forgot password?</a>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>
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
  </script>
</body>

</html>