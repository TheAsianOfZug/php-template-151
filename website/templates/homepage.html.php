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
	<h1>BattleShip - Homepage</h1>
	
	<?php if( $email!= "") {?>
	<p>You're logged in as: <?php echo $email?>
		<a href="/logout" class="button">Logout</a>
	<a href="/game" class="button">Create new Game</a>
	<?php
}
else
{
    ?>
    <p> Please log in or register! </p>
	<?php }?>
	</div>
</body>
<footer>
	<p>&copy; 2017 by Denis Huelin</p>
</footer>
</html>