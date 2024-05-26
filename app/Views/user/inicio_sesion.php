<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale:1.0">


		<title>Login</title>

	</head>

	<body>


		<div >

			<form method="post" action="<?= base_url(" login ");?>">


				<h2>log in</h2>
				<div>

					<div>
                        <input name="email" type="email" id="email" placeholder="name@example.com">
					</div>
					<div>
                        <input name="password" type="password" id="password" placeholder="password">
					</div>
				</div>

				<div>
					
					<a href="<?= base_url(" register ");?>">Sign up</a>
					<a href="<?= base_url(" change_password ");?>">Forgot password?</a>
				</div>
				<input type="submit" value="Login">


			</form>
		</div>




	</body>
