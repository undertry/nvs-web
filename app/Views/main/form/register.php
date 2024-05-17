<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" contable="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale:1.0">

		<title>Register</title>

	</head>

	<body>


		<div >

			<form method="post" action="<?= base_url(" register ");?>" class="form">


				<h2>Register</h2>
				<div>
				<div>
						<input name="name" type="name" class="form-control" placeholder="name">
					</div>
					<div>
						<input name="email" type="email" class="form-control" placeholder="name@example.com">
					</div>
					<div>
						<input name="password" type="password" placeholder="password">
					</div>
				</div>

				<div>
					
					<a href="<?= base_url(" login ");?>">you already have an account?</a>
				</div>
				<input type="submit" value="Register">


			</form>
		</div>




	</body>


</html>