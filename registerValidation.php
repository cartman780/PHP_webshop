<?php
	function validateRegisterForm(){
		$name = $email = $password = $repeatPassword = '';
		$nameErr = $emailErr = $passwordErr = $repeatPasswordErr = "";
		$valid = false;
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			var_dump($_POST);
			if(empty($_POST['name'])) { 
				$nameErr="Name can not be empty"; 
			} else {
				$name = $_POST['name']; 
			}
			if(empty($_POST['email'])) { 
				$emailErr="Email can not be empty"; 
			} else {
				$email = $_POST['email']; 
			}
			if(empty($_POST['password'])) { 
				$passwordErr="Password can not be empty"; 
			} else {
				$password = $_POST['password']; 
			}
			if(empty($_POST['repeatPassword'])) { 
				$repeatPasswordErr="Repeat password can not be empty"; 
				if($repeatPassword != $password){
				$repeatPasswordErr="Repeat password must be same as password";
				}
			} else {
				$repeatPassword = $_POST['repeatPassword']; 
			}
			if (empty($nameErr) && empty($emailErr) && empty($passwordErr)&& empty($repeatPasswordErr)){
				$valid=true;
			}else{
				$valid = false;
			}
		}
		
		return array('name' => $name, 'email' => $email, 'password' => $password, 'repeatPassword' => $repeatPassword, 'valid' => $valid, 'nameErr' => $nameErr, 'emailErr' => $emailErr, 'passwordErr' => $passwordErr, 'repeatPasswordErr' => $repeatPasswordErr, 'page' => 'register');	
	}
	

	function emailTaken($email){
		include_once 'userRepository.php';
		$exist = findUserByEmail($email) != null;
		echo $exist;
		return $exist;
	}
	
	function validateRegistration($data){
//echo 'je bent bij validateRegistration';
			if ($data["valid"]){
				if (emailTaken($data['email'])) {
					$data['emailErr'] = 'Email already in use';
				} else {
					addUser($data);
					$data['page'] = 'login';
				}
			}
		return $data;
	}
?>