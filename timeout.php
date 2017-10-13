<?php 
	
	session_start();
	
	echo "<p style=\"text-align: center\">You need to wait " . (strtotime($_SESSION['timeout']) - strtotime(date('H:i:s'))) . " more seconds before being able to login again</p>";
	

	if ($_SESSION['timeout'] < date('H:i:s')) {
		session_destroy();
		header('Location:login.php');
	}

?>