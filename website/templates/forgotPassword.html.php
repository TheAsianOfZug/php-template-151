<html>
<?php $email = $_SESSION["email"];?>
<head>
<title>Battleship</title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
<h3>FORGOT PASSWORD</h3>

<form method="POST">
	<table>
		<tbody>
			<tr>
				<td><label for="email">Email: </label></td>
				<td><input type="email" name="email"/></td>
			</tr>
		</tbody>
	</table>
	<input type="submit" value="Send Mail" />
		<a href="/" class="button">Home</a>
</form>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>