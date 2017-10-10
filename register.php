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
</main>

<?php 
	include 'footer.php'
 ?>