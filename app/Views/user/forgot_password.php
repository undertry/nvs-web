<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>

<body>
  <div class="container">

      <form method="post" action="<?= base_url('/sendemail'); ?>" class="form">
      <h2>Forgot Password</h2>
      <div class="form-inputs">
        <div class="form-label">
        <input name="email" type="email" id="email" placeholder="name@example.com" required>
        </div>
      <input type="submit" value="Send Code">
    </form>
      <p> <a href="<?= base_url('login'); ?>">Login</a> </p>
  </div>
</body>

</html>