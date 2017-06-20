<html>
<?php $email = $_SESSION["email"];?>
<head>
<title>Battleship</title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
<h3>LOGIN</h3>

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
	<a href="/forgotPassword">Forgot password</a>
	<input type="hidden" name="logincsrf" value="<? $logincsrf ?>"> 
	<input type="submit" value="Login" />
		<a href="/" class="button">Home</a>
</form>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>