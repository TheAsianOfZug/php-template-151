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
<h3>BattleShip - Passwort neu setzen</h3>

<form method="POST">
	<table>
		<tbody>
			<tr>
				<td><label for="password">Passwort: </label></td>
				<td><input type="password" name="email"/></td>
			</tr>
		</tbody>
	</table>
	<input type="submit" class="button" value="Passwort setzen" />
</form>
</div>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>