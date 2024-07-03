<?= $this->include('common/user/start.php'); ?>
<title>Log In</title>
</head>

<body>
  <!-- Mensaje de sesiones -->
  <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
  <?php endif; ?>
  <!-- Formulario de Inicio de Sesion -->
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
        <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>
  <?= $this->include('common/user/end.php'); ?>