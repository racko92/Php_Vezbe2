<?php 	

	session_start();


	$rawUsers = explode("\n", file_get_contents('users.txt'));
	$oldUser = array();

	foreach($rawUsers as $value){
		$oldUsers[] = explode(";", $value);
	}

	if(isset($_POST) && !empty($_POST)){

		foreach ($_POST as $key => $value){

			if(!isset($value) || $value === ""){
				$error = ("<p class=\"error\">Field " . $key . " cannot be empty!" . "</p><br>");
			}

			foreach($oldUsers as $value){
				if($_POST['email'] === $value[2]){
					$error = ("<p class=\"error\">Email \"" . $_POST['email'] . "\" is taken! Select another email adress!</p>");
				}
			}

			if($_POST['captcha'] !== $_SESSION['captcha'] && isset($_POST['captcha'])) {
				$error = ("<p class=\"error\">Wrong captcha!</p>");
			}
			else{
				unset($_POST['captcha']);
			}

		}
	}
	if(!empty($_POST) && empty($error)){

		$password = $_POST['password'];
		$_POST['password'] = crypt($password);
		
		$users = implode(array_filter($_POST,function($num){
			return $num;
		}),";");

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
			    	unset($_SESSION['captcha']);
					$_SESSION['captcha'] = $randomString;
			    }

			?>
			<label for="captcha" >Captcha: </label>
			<div class="captcha" onselectstart="return false"><?php echo $_SESSION['captcha']; ?></div>
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