<?php 
	include 'header.php';
?>

<main class="main">

	<form class="form" method="POST">
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
<?php 	
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

			if(!isset($value) || $value == ""){
				echo("Field " . $key . " cannot be empty!" . "<br>");
				die();
			}
			foreach($oldUsers as $value){
				if($_POST['email'] == $value[2]){
					echo("Email \"" . $_POST['email'] . "\" is taken! Select another email adress!");
					die();
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

		header('Location: home.php');

	}



?>


</main>
<?php 
	include 'footer.php'
 ?>