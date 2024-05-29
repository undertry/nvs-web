<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale:1.0">
	<link rel="stylesheet" href="<?php echo base_url('complements/styles/user.css'); ?>">
	<title>Register</title>
</head>

<body>
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
				</div>
			</div>
			<div class="links">
				<a href="<?= base_url('login'); ?>">Already have an account?</a>
			</div>
			<input type="submit" value="Register">
		</form>
	</div>
</body>

</html>