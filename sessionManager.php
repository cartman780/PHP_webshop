<?php
	//start de sessie en zet globaal de loginStatus
	session_start();
	
	//Zet de ingevoerde inlognaam in de sessie
	function loginUser($userName){
		$_SESSION["userName"] = $userName;
	}
	
	//test of je ingelogd bent
	function isLoggedIn(){
		return isset($_SESSION["userName"]);
	}
	
	//geeft de naam die ingelogd is.
	function getLoggedInUser(){
		if(isLoggedIn()){
			return $_SESSION["userName"];
		}else{
			return "guest";
		}
	}
	
	//Haalt de naam weg en zonder naam kan je niet ingelogd zijn
	function logOut(){
		unset($_SESSION["userName"]);
	}
?>