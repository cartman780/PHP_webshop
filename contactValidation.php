<?php
	function validateContactForm(){
		$name = $email = $msg = '';
		$nameErr = $emailErr = $msgErr = "";
		$valid = false;
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			//var_dump($_POST);
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
			if(empty($_POST['msg'])) { 
				$msgErr="Message can not be empty"; 
			} else {
				$msg = $_POST['msg']; 
			}
			if (empty($nameErr) && empty($emailErr) && empty($msgErr)){
				$valid=true;
			}else{
				$valid = false;
			}
		}
		return array('name' => $name, 'email' => $email, 'msg' => $msg, 'valid' => $valid, 'nameErr' => $nameErr, 'emailErr' => $emailErr, 'msgErr' => $msgErr);
	}
?>