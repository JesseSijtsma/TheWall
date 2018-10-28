<?php
if (isset($_COOKIE['userid'])) {
	header('Location: ../home.html '); // home page behind LOCATION!!!!!
}

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="wrapper">
			<form class="form" action="inlogpoort.php" method="post">
				<i class="fa fa-user"></i>
				<input type="text" name="username" placeholder="username"><br>
				<i class="fa fa-lock"></i>
				<input type="password" name="password" placeholder="password"><br>
				<button class="button1" type="submit" name="submit">Login?</button>
				<button class="button1" type="submit" name="submit"><a href="register.php">Register?</a></button>
			</form>
		</div>
	</body>
</html>
