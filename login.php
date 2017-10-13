<?php 
	session_start();

	const LOGIN_TIMES = 2;

	if (!isset($_SESSION['invalid'])) {
		$_SESSION['invalid'] = LOGIN_TIMES;
	}

	if($_SESSION['invalid'] <= 0){

		$_SESSION['timeout'] = date('H:i:s', time() + 30);
	}


	if($_SESSION['timeout'] > date('H:i:s')){

			header('Location:timeout.php');
	}

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
			$error[] = "<p class=\"error\">Email cannot be empty.</p>";
		}
		else if (empty($_POST['password'])) {
			$error[] = "<p class=\"error\">Password cannot be empty.</p>";
		}

		if (empty($error)){

			$password = $_POST['password'];

			foreach($users as $value) {

				if ($_POST['email'] === $value[2] && crypt($password, $value[3]) === $value[3]) {
					$_SESSION = [
						'firstName' => $value[0],
						'lastName' => $value[1],
						'email' => $value[2]
					];
				header('Location:home.php');
				}
			}

		$error[] = "<p class=\"error\">Invalid credentials! Please try again.</p>";
		}
	} 

	include "navigation.php";

	if(!empty($error)){


		$error[] =  "<p class=\"error\">" . $_SESSION['invalid'] . " tries left. You will have to wait 5 minutes before trying again!</p>";
		$_SESSION['invalid']--;		

		foreach($error as $value){
			echo $value;
		}
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
	include 'footer.php';
 ?>