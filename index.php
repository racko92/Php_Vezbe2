<?php 

	session_start();
	include 'header.php';


	echo '<main class="main">';


	echo "<h2>Welcome " . $_SESSION['firstName'] . "</h2>";

	echo '</main>';

	include 'footer.php'
 ?>