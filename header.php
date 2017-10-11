<!DOCTYPE html>
<html>
<head>
	<title>PHP Vezbe 2</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<nav class="nav">


			<?php 

				if(!empty($_SESSION)) {
					echo '<a href="logout.php">Logout</a>';
					echo "<a class=\"deactivated\" href=\"#\">User: " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</a>";
				}
				else {
					echo '<a href="login.php">Login</a>';
					echo '<a href="register.php">Register</a>';	
				}

			?>
		</nav>
	</header>