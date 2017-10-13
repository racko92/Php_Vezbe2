<?php 

	session_start();
	include 'navigation.php';


	echo '<main class="main">';

	if(!empty($_SESSION['firstName'])){
		echo "<h2>Welcome " . $_SESSION['firstName'] . "</h2>";	
	}
	else{
		echo "<h2>Welcome guest</h2>";
	}

	echo '</main>';

	include 'footer.php';

 ?>