<?php
	$exampleID = '"slider1"';
	if(!empty($arrSliders))
		$exampleID = '"'.$arrSliders[0]->getAlias().'"';
?>

	<div class='wrap rev_slider_wrap_admin'>

	<h2>
		Revolution Sliders
	</h2>

	<br>
	<?php if(empty($arrSliders)): ?>
		No Sliders Found
		<br>
	<?php else:
		 require self::getPathTemplate("sliders_list");	 		
	endif?>
	
	
	<br>
	<p>			
		<a class='button-primary' href='<?php echo $addNewLink?>'>Create New Slider</a>
	</p>
	 
	 <br>
	 
	<div>		
		<h3>How To Use:</h3>
		When inside a <strong>Page Template</strong> write the slider alias inside the slider field <em>(slider1 for example)</em>
	</div>
	
	<p></p>
	
	
	</div>
