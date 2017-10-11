<?php 
	include 'header.php';

?>

<main class="main">
	<form class="form" method="POST">
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
		
		foreach($users as $value) {

			if($_POST['email'] == $value[2] && $_POST['password'] == $value[3]) {
				$_SESSION = [
					'firstName' => $value[0],
					'lastName' => $value[1],
					'email' => $value[2]
				];


			header('Location: home.php');
			}

		}
	} 

?>


<?php 
	include 'footer.php'
 ?>