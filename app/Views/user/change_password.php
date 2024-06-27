<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
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
      max-width: 400px;
      width: 100%;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      h2 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
      }
      .form-input {
      margin-bottom: 15px;
      text-align: left;
      }
      .form-input label {
      display: block;
      font-size: 1rem;
      margin-bottom: 5px;
      color: #555;
      }
      .form-input input[type="password"] {
      width: 100%;
      padding: 5px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      transition: border-color 0.3s ease;
      }
      .form-input input[type="password"]:focus {
      outline: none;
      border-color: #3366ff;
      }
      .form-input input[type="submit"] {
      background-color: #3366ff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      }
      .form-input input[type="submit"]:hover {
      background-color: #254BFF;
      }
      /* mensaje de alerta */
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
    <div class="container">
      <?php if (session('user')) : ?>
      <form method="post" action="<?= base_url('password_change'); ?>" class="form" onsubmit="return validatePassword()">
        <h2>Cambiar Contraseña</h2>
        <div class="form-input">
          <label for="password">Contraseña Actual</label>
          <input name="actual_password" required pattern=".{8,}" type="password" id="actual_password" placeholder="Ingrese su contraseña actual">
        </div>
        <div class="form-input">
          <label for="password">Nueva Contraseña</label>
          <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="Ingrese su nueva contraseña">
        </div>
        <div class="form-input">
          <label for="confirm_password">Confirmar Contraseña</label>
          <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="Confirme su nueva contraseña">
        </div>
        <div class="form-input">
          <input type="submit" value="Cambiar Contraseña">
        </div>
      </form>
      <?php else : ?>
      <p><a href="<?= base_url('login'); ?>">Iniciar sesión</a></p>
      <?php endif; ?>
    </div>
  </body>
</html>
