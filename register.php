<?php 	

	session_start();
	include 'header.php';

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
				echo("<p class=\"error\">Field " . $key . " cannot be empty!" . "</p><br>");
				goto html;
			}

			foreach($oldUsers as $value){
				if($_POST['email'] === $value[2]){
					echo("<p class=\"error\">Email \"" . $_POST['email'] . "\" is taken! Select another email adress!</p>");
					goto html;

				}
			}
		}
	}
	if(!empty($_POST)){
		file_put_contents("users.txt", $users . "\n", FILE_APPEND);

		$_SESSION = [
					'firstName' => $_POST['firstName'],
					'lastName' => $_POST['lastName'],
					'email' => $_POST['email']
				];

		header('Location:home.php');

	}
html:
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
		<div class="form-submit">
			<button type="submit">Register</button>
		</div>
	</form>
</main>
<?php 
	include 'footer.php'
 ?>