<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/user.css'); ?>">
    <title>Sign Up</title>
	<!-- Estilos precargados para el Aviso de Mayuscula y Aviso de las Contraseñas no Coinciden-->
    <style>
      .message {
      position: fixed;
      top: 0;
      margin-top: 10px;
      left: 43%;
      width: 15%;
      border-radius: 10px;
      padding: 10px;
      text-align: center;
      z-index: 1000;
      box-sizing: border-box;
      }
      .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      }
      .success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      }
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
    <?php if (session()->getFlashdata('error')): ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <h1 class="header"><a href="<?= base_url('/'); ?>">NVS</a></h1>
    <div class="box">
      <form id="registerForm" method="post" action="<?= base_url('register'); ?>" class="form">
        <h2>Sign Up</h2>
        <div class="form-inputs">
          <div class="form-label">
            <input name="name" required type="text" id="name" placeholder="Your name" value="<?= old('name'); ?>">
          </div>
          <div class="form-label">
            <input name="email" required type="email" id="email" placeholder="name@example.com" value="<?= old('email'); ?>">
          </div>
          <div class="form-label">
            <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="password">
            <!-- Implementacion de Aviso de Mayuscula -->
			<div id="caps-lock-warning-password" class="caps-lock-warning">Caps Lock is on</div>
          </div>
          <div class="form-label">
            <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="confirm password">
            <!-- Implementacion de Aviso de Mayuscula -->
			<div id="caps-lock-warning-confirm-password" class="caps-lock-warning">Caps Lock is on</div>
          </div>
        </div>
        <div class="links">
          <a href="<?= base_url('login'); ?>">Already have an account?</a>
        </div>
        <input type="submit" value="Register">
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
      
      document.getElementById('confirm_password').addEventListener('keyup', function(event) {
          checkCapsLock(event, 'caps-lock-warning-confirm-password');
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
      <?php if (session()->getFlashdata('error') === 'Las contraseñas no coinciden.'): ?>
          document.getElementById('password').value = '';
          document.getElementById('confirm_password').value = '';
      <?php endif; ?>
    </script>
  </body>
</html>
