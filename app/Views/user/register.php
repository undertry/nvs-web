<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/user.css'); ?>">
    <title>Register</title>
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
    <?php if (session()->getFlashdata('error')): ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <h1 class="header"><a href="<?= base_url(''); ?>">NVS</a></h1>
    <div class="box">
      <form method="post" action="<?= base_url('register'); ?>" class="form">
        <h2>Sign Up</h2>
        <div class="form-inputs">
          <div class="form-label">
            <input name="name" required type="text" id="name" placeholder="Your name">
          </div>
          <div class="form-label">
            <input name="email" required type="email" id="email" placeholder="name@example.com">
          </div>
          <div class="form-label">
            <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="password">
            <div id="caps-lock-warning-password" class="caps-lock-warning">Caps Lock is on</div>
          </div>
          <div class="form-label">
            <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="confirm password">
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
      function checkCapsLock(event, warningElementId) {
          const warningElement = document.getElementById(warningElementId);
          const isCapsLockOn = event.getModifierState && event.getModifierState('CapsLock');
          warningElement.classList.toggle('active', isCapsLockOn);
      }
      
      document.getElementById('password').addEventListener('keyup', function(event) {
          checkCapsLock(event, 'caps-lock-warning-password');
      });
      
      document.getElementById('password').addEventListener('keydown', function(event) {
          checkCapsLock(event, 'caps-lock-warning-password');
      });
      
      document.getElementById('confirm_password').addEventListener('keyup', function(event) {
          checkCapsLock(event, 'caps-lock-warning-confirm-password');
      });
      
      document.getElementById('confirm_password').addEventListener('keydown', function(event) {
          checkCapsLock(event, 'caps-lock-warning-confirm-password');
      });
    </script>
  </body>
</html>
