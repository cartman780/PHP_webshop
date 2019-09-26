<?php
	function inputfield($type, $label, $inputname, $placeholder, $inputdata, $inputErr){	
		
		echo 
		'<div>
		  <label class="inputLabel">'.$label.'</label>
		  <input class="inputField" type="'.$type.'" name="'.$inputname.'" placeholder="'.$placeholder.'" value="'.$inputdata.'"></input>
		  <div class="error">'.$inputErr.'</div>
		 </div>';
	}
?>