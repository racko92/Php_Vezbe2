<?php 
	
	session_start();
	include 'header.php';

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

	if (isset($_POST) && !empty($_POST)) {
		
		if (empty($_POST['email'])) {

			echo "<p class=\"error\">Email cannot be empty.</p>";
			goto html;
		}
		else if (empty($_POST['password'])) {

			echo "<p class=\"error\">Password cannot be empty.</p>";
			goto html;
		}

		foreach($users as $value) {

			if ($_POST['email'] === $value[2] && $_POST['password'] === $value[3]) {
				$_SESSION = [
					'firstName' => $value[0],
					'lastName' => $value[1],
					'email' => $value[2]
				];
			header('Location:home.php');
			}
		}

		echo "<p class=\"error\">Invalid credentials! Please try again.</p>";

	} 
html:
?>
<main class="main">

	<h1>Login</h1>
	<form class="form" action="" method="POST">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password">
		</div>
		<div class="form-submit">
			<button type="submit">Login</button>
		</div>
	</form>
</main>


<?php 
	include 'footer.php'
 ?>