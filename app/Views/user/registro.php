<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale:1.0">

		<title>Register</title>

	</head>

	<body>


		<div >

			<form method="post" action="<?= base_url(" register ");?>">


				<h2>Register</h2>
				<div>
				<div>
                        <input name="name" required type="text" id="name" placeholder="Your name">
					</div>
					<div>
                        <input name="email" required type="email" id="email" placeholder="name@example.com">
					</div>
					<div>
                        <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="password">
					</div>
				</div>

				<div>
					
					<a href="<?= base_url(" login ");?>">Already have an account?</a>
				</div>
				<input type="submit" value="Register">


			</form>
		</div>




	</body>


</html>