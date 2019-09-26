<?php
	
	function validateLoginForm(){
	
	$password = $email = $serverErr = '';
	$passwordErr = $emailErr = "";
	$valid = false;
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if(empty($_POST['email'])) { 
			$emailErr="Email can not be empty"; 
		} else {
			$email = $_POST['email']; 
		}
		if(empty($_POST['password'])) { 
			$passwordErr="Password required"; 
		} else {
			$password = $_POST['password']; 
		}
		if (empty($passwordErr) && empty($emailErr)){
			$valid=true;
		}else{
		$valid = false;
		}
	}
	return array('password' => $password, 'email' => $email, 'valid' => $valid, 'passwordErr' => $passwordErr, 'emailErr' => $emailErr, 'page' => 'login', 'serverErr' => $serverErr);
	}
	
	//checkt op basis van de email of de password klopt.
	function authenticateUser($email, $password){
		include_once 'userRepository.php';	
		try{
			$user = findUserByEmail($email);		
			//als er geen array is bestaat de user niet
			if($user==null){
				return array("result"=> "USER_UNKNOWN");
			}else{
				//bestaat de array wel, dan check je of het password klopt
				if($password == $user["password"]){
					//als alles klopt krijg je een OK en maakt hij van de array naam een variabele
					return array("result"=> "OK", "user" => $user);
				}else{
					//foutmelding verkeerd password
					return array("result"=> "WRONG_PASSWORD");
				}
			}
		}
		catch(exception $e){
			echo "authentication failed ".$e->getMessage();
			return array("result"=> "SERVER_ERROR", "serverErr" => $serverErr);
		}
	}
	
	function validateLogin($data){
			if ($data["valid"]){
				$result = authenticateUser($data['email'], $data['password']);
//var_dump($result); /* JH: Debug code, verwijderen, TIP zet dit soort regels tegen de linker kantlijn zodat ze opvallen */
				switch($result['result']){
					case "USER_UNKNOWN":
						$data['emailErr'] = "User not known";
						break;
					case "WRONG_PASSWORD":
						$data['passwordErr'] = "Password does not match";
						break;
					case "OK":
						$user = $result['user'];
						loginUser($user['name']);
						// show home
						$data['page'] = "home";
						break;
					case "SERVER_ERROR":
						$data['serverErr'] = "Oh oh spaghettio, something went very wrong!";
						break;
					default:
						break;
				}
			}
//var_dump($data);
			return $data;
	}
?>