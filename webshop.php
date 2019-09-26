<?php
	function showWebshop(){
		include_once 'product.php';
		
		echo '<div class="grid">';
		//foreach product
		showProductItem();
		echo '</div>';
	}
?>