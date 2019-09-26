<?php	
	function showLoginForm($loginData){
		include_once 'form.php';
		include_once 'dbConnection.php';
		echo '<form class="formulier" action="index.php" method="post">
		<input type="hidden" name="page" value="login">';
		
		inputfield('email', 'Email', 'email', 'Je huidige emailasres', $loginData["email"], $loginData["emailErr"]);
		inputfield('password', 'Password', 'password', 'What is your password?', $loginData["password"], $loginData["passwordErr"]);

		echo '<div class="error">'.$loginData['serverErr'].'</div>
		<button type="submit">Login</button>
		</form class="inputField">
		<?php } ?>';
	}
?>