<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale:1.0">
	<link rel="stylesheet" href="<?php echo base_url('complements/styles/user.css'); ?>">
	<title>Login</title>
</head>

<body>
	<h1 class="header"><a href="<?= base_url(''); ?>">NVS</a></h1>
	<div class="box">
		<form method="post" action="<?= base_url('login'); ?>" class="form">
			<h2>Log In</h2>
			<div class="form-inputs">
				<div class="form-label">
					<input name="email" type="email" id="email" placeholder="name@example.com" required>
				</div>
				<div class="form-label">
					<input name="password" type="password" id="password" placeholder="password" required>
				</div>
			</div>
			<div class="links">
				<a href="<?= base_url('register'); ?>">Sign up</a>
				<a href="<?= base_url('change_password'); ?>">Forgot password?</a>
				<a href="<?= base_url('logout'); ?>">logout</a>

			</div>
			<input type="submit" value="Login">
		</form>
	</div>
</body>

</html>