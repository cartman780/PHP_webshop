<?php

	//
	include 'sessionManager.php';
	$page = getRequestPage();
	$data = processRequest($page);
	showResponsePage($data);
	
	//Haalt de page uit de URL
	function getRequestPage(){
		$requested_type = $_SERVER['REQUEST_METHOD']; 
		if($requested_type == 'POST'){
			$requested_page = getPostVar('page', 'home');
		}else{
			$requested_page = getUrlVar('page', 'home');
		}
		return $requested_page;
	}
	
	//welke functies worden aangeroepen op de pagina's
	function processRequest($page) {
		$data['page'] = $page;
		switch($page) {
		case 'login':
			include_once 'loginValidation.php';
			$tempdata = validateLoginForm();
			$data = validateLogin($tempdata);
			break;	
		case 'logout':
			logOut();
			$data['page'] = 'home';
			break;
		case 'register':
			include_once 'dbConnection.php';	
			include_once 'registerValidation.php';	
			$tempdata = validateRegisterForm();
			$data = validateRegistration($tempdata);
			break;
		case 'contact':
			include_once 'contactValidation.php';
			$data = validateContactForm();
			if ($data["valid"]){
				$data['page'] = 'thanks';
			}else{
				$data['page'] = 'contact';
			}
			break;
		}
		$data['menu'] = array('home' => 'Home', 'about' => 'About', 'contact' => 'Contact', 'webshop' => 'webshop');
			if (isLoggedIn()) {
				$data['menu']['logout'] = 'Log-out '.getLoggedInUser();
			} else {
				$data['menu']['login'] = 'Log-in';
				$data['menu']['register'] = 'Register';
			}
		return $data;
	}
		
	//laadt de onderdelen van de pagina
	function showResponsePage($data){
		beginDocument();
		showHead($data['page']);
		showBody($data);
		endDocument();
	}
	
	function getArrayVar($key, $default=''){
		return isset($array[$key]) ? $array[$key] : $default;
	}
	
	function getPostVar($key, $default){
		$value = filter_input(INPUT_POST, $key);
		return isset($value) ? $value : $default;
	}
	
	//maakt van de key in de url een var
	function getUrlVar($key, $default=''){
		$value = filter_input(INPUT_GET, $key);
		return isset($value) ? $value : $default;
	}
	
	//Begin van de html pagina
	function beginDocument(){
		echo '<!DOCUMENTTYPE html>
		<html>';
	}
	
	//Head gedeelte html
	function showHead($page){
		echo '<head>
		<title>'.$page.' | Educom</title>
		<meta name = "author" conten = "Jeffrey"/>
		<link rel = "stylesheet" href = "style/style.css">
		</head>';
	}
	
	//Body gedeelte html
	function showBody($data){
		include_once 'menu.php';
		echo '<body>
		<div class="wrapper">';
		showHeader($data['page']);
		showMenu($data);
		showContent($data);
		showFooter();
		echo '</div>
		</body>';
	}
	
	//Laat de titel boven aan de pagina zien
	function showHeader($page){
		echo '<h1 class="pageTitle">'.$page.'</h1>';
//echo "<p>We are " . (isLoggedIn() ? "ingelogged" : "uitgelogged") . "</p>";
	}
	
/*
	//Login en register knopppen als je niet ingelogd bent
	function showLoginRegister($loginStatus){
		if(!isLoggedIn()){
			echo 
			'<li class="listItem"><a class="btn" href="index.php?page=login">Login</a></li>
			<li class="listItem"><a class="btn" href="index.php?page=register">Register</a></li>';
		}else{
			echo 
			'<li class="listItem"><a class="btn" href="index.php?page=logout">Logout '.getLoggedInUser().'</a></li>';
		}
	}
	
	//Menu gedeelte in de body
	function showMenu(){
		echo '<ul class="menu">
			<li class="listItem"><a class="btn" href="index.php?page=home">Home</a></li>
			<li class="listItem"><a class="btn" href="index.php?page=about">About</a></li>
			<li class="listItem"><a class="btn" href="index.php?page=contact">Contact</a></li>';
			showLoginRegister($_SESSION["loginStatus"]);
		'</ul>';
	}
*/
	
	//Foutmelding bij geen pagina gevonden
	function showError($page){
		echo
		'<p>Page '.$page.' not found.</p>';
	}
	
	//Welke content moet worden weergegeven in de body
	function showContent($data){
		switch($data['page']){
			case 'home':
				include_once 'home.php';
				showHomeContent();
				break;
			case 'about':
				include_once 'about.php';
				showAboutContent();
				break;
			case 'contact':
				include_once 'contact.php';
				showContactForm($data);
				break;
				
			case 'webshop':
				include_once 'webshop.php';
				showWebshop();
				break;
			case 'Thannks':
				include_once 'contact.php';
				showThanks($data);
				break;
			case 'login':
				include_once 'login.php';
				showLoginForm($data);
				break;
			case 'register':
				include_once 'register.php';
				showRegisterForm($data);
				break;
			default:
				showError($data['page']);
				break;
		}
	}
	
	//Footer gedeelt in de body
	function showFooter(){
		echo '<footer>';
//echo "<p>We are " . (isLoggedIn() ? "ingelogged" : "uitgelogged") . "</p>";

		echo '<p>&copy; 2019 Jeffrey van der Kruit</p>
		</footer>';
	}
	
	function endDocument(){
		echo '</body>
		</html>';
	}
?>