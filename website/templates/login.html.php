<html>
<?php $email = $_SESSION["email"];?>
<head>
<title>Battleship</title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
	<ul class="navBar">
		<li><a href="/">Home</a></li>
		<li><a href="/login">Login</a></li>
		<li><a href="/register">Register</a></li>
	</ul>
	<div class="mainContent">
		<h3>BattleShip - Login</h3>

		<form method="POST">
			<table>
				<tbody>
					<tr>
						<td><label for="email">Email: </label></td>
						<td><input type="email" name="email"
							value="<?= (isset($email)) ? $email : '' ?>" /></td>
					</tr>
					<tr>
						<td><label for="password">Password: </label></td>
						<td><input type="password" name="password" /></td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" name="logincsrf" value="<? $logincsrf ?>"> <input
				type="submit" class="button" value="Login"/>
				<a href="/forgotPassword">Forgot Password</a>
		</form>
	</div>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>