<?php
	function showThanks($data){
		echo
		'<p>Your name is: '.$data['name'].
		'<p>Your email is: '.$data['email'].
		'<p>You said: '.$data['msg'];
	}
	
	function showContactForm($data){
		include_once 'form.php';
		echo 
		'<form class="formulier" action="index.php" method="post">
		<input type="hidden" name="page" value="contact">'
		.inputfield('text', 'Naam', 'name', 'Voor en achternaam', $data["name"], $data["nameErr"])
		.inputfield('email', 'Email', 'email', 'Your email address', $data['email'], $data['emailErr']).
		
/*
		 <div>
		  <label class="inputLabel">Naam</label>
		  <input class="inputField" type="text" name="name" placeholder="Voor en achternaam" value="'.$data['name'].'"></input>
		  <div class="error">'.$data['nameErr'].'</div>
		 </div>
		 <div>
		  <label class="inputLabel">Email</label>
		  <input class="inputField" type="email" name="email" placeholder="Je huidige emailadres" value="'.$data['email'].'"></input>
		  <div class="error">'.$data['emailErr'].'</div>
		 </div>
*/
		'<div>
		  <label class="inputLabel">Whatsup?</label>
		  <textarea name="msg" placeholder="Wat heb je me te vertellen?" value="'.$data['msg'].'"></textarea>
		  <div class="error">'.$data['msgErr'].'</div>
		 </div>

		<button type="submit">Verzenden</button>
		</form class="inputField">';
	}

?>