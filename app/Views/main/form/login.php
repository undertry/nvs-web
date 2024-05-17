<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" contable="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale:1.0">

		<title>Login</title>

	</head>

	<body>


		<div >

			<form method="post" action="<?= base_url(" login ");?>" class="form">


				<h2>log in</h2>
				<div>

					<div>
						<input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
					</div>
					<div>
						<input name="password" type="password" placeholder="password">
					</div>
				</div>

				<div>
					
					<a href="<?= base_url(" register ");?>">sign up</a>
                    <a href="<?= base_url(" test ");?>">test</a>
				</div>
				<input type="submit" value="Login">


			</form>
		</div>




	</body>


</html>