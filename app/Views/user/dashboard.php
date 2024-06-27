<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/dashboard.css'); ?>">
    <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
    <title>Dashboard</title>
  </head>
  <body>
    <nav>
      <h1 class="header"><a href="<?= base_url('/'); ?>">NVS</a></h1>
      <ul>
        <li>
          <a href="#menu">Menu</a>
          <ul class="dropdown">
            <li><a href="<?= base_url('/history'); ?>">History</a></li>
            <li><a href="<?= base_url('/change_password'); ?>">Change password</a></li>
            <li><a href="<?= base_url('/logout'); ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div class="profile-container">
      <h1>Perfil de Usuario</h1>
      <div class="profile-info">
        <p><strong>Name:</strong> <?= session('user')->name; ?></p>
        <p><strong>Email:</strong> <?= session('user')->email; ?></p>
        <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
      </div>
    </div>
  </body>
</html>
