<?php 
	session_start();

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

			$error = "<p class=\"error\">Email cannot be empty.</p>";
		}
		else if (empty($_POST['password'])) {

			$error = "<p class=\"error\">Password cannot be empty.</p>";
		}

		if (empty($error)){

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

		$error = "<p class=\"error\">Invalid credentials! Please try again.</p>";
		}


	} 
?>
<?php
	include "./navigation.php";
	if(!empty($error)){
		echo $error;
	}
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