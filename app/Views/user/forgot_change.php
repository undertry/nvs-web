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
      <input type="submit" value="Change_password">
    </form>

  </div>
</body>

</html>