<html>
<?php $email = $_SESSION["email"];?>
<head>
<title>Battleship</title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
	<h1>BattleShip - Homepage</h1>
	
	<?php if( $email!= "") {?>
	<p>You're logged in as: <?php echo $email?>
		<a href="/logout" class="button">Logout</a>
	<?php
}
else
{
    ?>
	<a href="/register" class="button">Register</a> <a href="/login"
			class="button">Login</a>
	<?php }?>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>