<?= $this->include('common-user/start.php'); ?>
<title>Sign Up</title>
</head>

<body>
  <!-- Mensaje de sesiones -->
  <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
  <?php endif; ?>
  <!-- Formulario de Registro -->
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
  <?= $this->include('common-user/end.php'); ?>