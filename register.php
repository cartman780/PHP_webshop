<?php
	
	function showRegisterForm($data){
		include_once 'form.php';
		echo '<form class="formulier" action="index.php" method="post">
		<input type="hidden" name="page" value="register">';
		inputfield('text', 'Naam', 'name', 'Voor en achternaam', $data["name"], $data["nameErr"]);
		inputfield('email', 'Email', 'email', 'Je huidige emailasres', $data["email"], $data["emailErr"]);
		inputfield('password', 'Password', 'password', 'What is your password?', $data["password"], $data["passwordErr"]);
		inputfield('password', 'Repeat Password', 'repeatPassword', 'Tell me again', $data["repeatPassword"], $data["repeatPasswordErr"]);
		echo
		'<button type="submit">Register</button>
		</form class="inputField">';
	}

?>