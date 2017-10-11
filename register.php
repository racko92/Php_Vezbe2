<?php 	

	session_start();

	$users = implode(array_filter($_POST,function($num){
		return $num;
	}),";");
	$rawUsers = explode("\n", file_get_contents('users.txt'));
	$oldUser = array();

	foreach($rawUsers as $value){
		$oldUsers[] = explode(";", $value);
	}

	if(isset($_POST)){
		foreach ($_POST as $key => $value){

			if(!isset($value) || $value === ""){
				$error = ("<p class=\"error\">Field " . $key . " cannot be empty!" . "</p><br>");
			}

			foreach($oldUsers as $value){
				if($_POST['email'] === $value[2]){
					$error = ("<p class=\"error\">Email \"" . $_POST['email'] . "\" is taken! Select another email adress!</p>");
				}
			}

			if($_POST['captcha'] !== $_SESSION['captcha']) {
				$error = ("<p class=\"error\">Wrong captcha!</p>");
			}

		}
	}
	if(!empty($_POST) && empty($error)){
		file_put_contents("users.txt", $users . "\n", FILE_APPEND);
		session_unset();
		$_SESSION = [
					'firstName' => $_POST['firstName'],
					'lastName' => $_POST['lastName'],
					'email' => $_POST['email']
				];

		header('Location:home.php');
	}

	include 'navigation.php';

	if(isset($error)){
		echo $error;
	}

?>
<main class="main">

	<h1>Registration</h1>
	<form class="form" action="" method="POST">
		<div class="form-group">
			<label for="firstName">First Name</label>
			<input type="text" name="firstName">
		</div>
		<div class="form-group">
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password">
		</div>
		<div class="form-group">
			<?php

			    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < 6; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    if(empty($_SESSION['captcha'])){
			    	 $_SESSION['captcha'] = $randomString;
			    }
			    if(isset($_SESSION['captcha'])){
			    	session_unset();
					$_SESSION['captcha'] = $randomString;
			    }

			?>
			<label for="captcha"><?php echo "Captcha: " . $_SESSION['captcha']; ?></label>
			<input type="text" name="captcha">
		</div>
		<div class="form-submit">
			<button type="submit">Register</button>
		</div>
	</form>
</main>
<?php 
	include 'footer.php'
 ?>