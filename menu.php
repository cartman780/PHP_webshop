<?php
	function showMenu($data){
		echo '<ul class="menu">';
		foreach($data['menu'] as $link => $label) {
			showMenuItem($link, $label);
		}
		echo '</ul>';
	}
	
	function showMenuItem($link, $label){
		echo '<li class="listItem"><a class="btn" href="index.php?page='.$link.'">'.$label.'</a></li>';
	}
?>