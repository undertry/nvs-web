<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
  <title>En Mantenimiento</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .container {
      text-align: center;
    }

    h1 {
      font-size: 2.5rem;
      color: #333;
    }

    p {
      font-size: 1.2rem;
      color: #666;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php if (session('user')) : ?>
      <form method="post" action="<?= base_url('password_change'); ?>" class="form">
      <h2>Change Password</h2>
      <div class="form-inputs">
        <div class="form-label">
          <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="password">
        </div>
        <div class="form-label">
          <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="confirm password">
        </div>
      </div>
      <input type="submit" value="Change_password">
    </form>
    <?php else : ?>
      <p> <a href="<?= base_url('login'); ?>">Login</a> </p>
    <?php endif; ?>

  </div>
</body>

</html>

