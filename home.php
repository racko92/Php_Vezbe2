<?php 

	session_start();
	include 'navigation.php';


	echo '<main class="main">';
	$filename = "users.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));

	$usersRaw = explode("\n", $contents);
	$users = array();

	foreach ($usersRaw as $value) {

		if (isset($value) && $value != "") {
			$users[] = explode(";", $value);
		}

	}

	echo "<br><h1>All users</h1>";

	foreach($users as $key => $user) {
		echo "<br>User: " . $key . "<br>";

		echo "First Name: " . $user[0] . "<br>";
		echo "Last Name: " . $user[1] . "<br>";

		echo "<br>";
	}

	echo '</main>';

 ?>

<?php 
	include 'footer.php';
?>