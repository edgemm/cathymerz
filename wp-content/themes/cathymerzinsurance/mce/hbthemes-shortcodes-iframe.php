<?php
/* FindWPConfig - searching for a root of wp */
function FindWPConfig($directory){
	global $confroot;
	foreach(glob($directory."/*") as $f){
		if (basename($f) == 'wp-config.php' ){
			$confroot = str_replace("\\", "/", dirname($f));
			return true;
		}
		if (is_dir($f)){
		$newdir = dirname(dirname($f));
		}
	}
	if (isset($newdir) && $newdir != $directory){
		if (FindWPConfig($newdir)){
			return false;
		}	
	}
	return false;
}
if (!isset($table_prefix)){
	global $confroot;
	FindWPConfig(dirname(dirname(__FILE__)));
	include_once $confroot."/wp-load.php";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Shortcode Generator' , 'hbthemes'); ?></title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="<?php echo get_site_url(); ?>/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="css/shortcode_tinymce.css" />

<script>
<?php
$current_user = wp_get_current_user();
$nameofuser = $current_user->user_login;
?>
 jQuery(document).ready(function($){
	 
	//select shortcode
	$("#shortcode-select").change(function () {
		  var shortcodeSelectVal = "";
		  var shortcodeSelectText = "";
		  $("#shortcode-select option:selected").each(function () {
				shortcodeSelectVal += $(this).val();
				shortcodeSelectText += $(this).text();
			  });
			  if( shortcodeSelectVal != 'default') {
				$('#selected-shortcode').load('shortcodes/'+shortcodeSelectVal+'.php', function(){
					$('.shortcode-editor-title').text(shortcodeSelectText + ' Editor');
				});
			  } else {
			  	$('#selected-shortcode').text("<?php _e('Select a shortcode from the list above and the options will appear here.', 'hbthemes'); ?> ").addClass('padding-bottom');
				$('.shortcode-editor-title').text(<?php echo "' Howdy " . $nameofuser . " '"; ?>);
			  }
		})
		.trigger('change');
	
 });
</script>
    
</head>
<body>

<div id="hbthemes-shortcodes-popup">

	<h2 id="shortcode-selector-title"><?php _e('Select a Shortcode', 'hbthemes'); ?></h2>

	<div id="select-shortcode">
    	<div id="select-shortcode-inner">
    
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<select name="shortcode-select" id="shortcode-select" size="1">
               		<option value="default" selected="selected">Shortcodes</option>
					<option value="accordion">Accordion</option>
					<option value="animation">Animation</option>
					<option value="blockquote">Blockquote</option>
					<option value="from-blog">Blog</option>
					<option value="button">Button</option>
					<option value="callout">Callout</option>
					<option value="circle-column">Circle Column</option>
					<option value="color-focus">Color Focus</option>
					<option value="column">Column</option>
					<option value="clear">Clear</option>
					<option value="dropcap">Dropcap</option>
					<option value="flexslider">Flex Slider</option>
					<option value="focus-sep-text">Focus Separator Text</option>
					<option value="fullwidth-boxes">Fullwidth Boxes</option>
					<option value="gallery">Gallery</option>
					<option value="heading">Heading</option>
					<option value="icon-column">Icon Column</option>
					<option value="icon">Icon</option>
					<option value="image">Image</option>
					<option value="infobox">Infobox</option>
					<option value="list">List</option>
					<option value="map">Map</option>
					<option value="screen">Media Screen</option>
					<option value="newsletter">Newsletter</option>
					<option value="from-portfolio">Portfolio</option>
					<option value="pricing-table">Pricing Table</option>             
					<option value="read-more-button">Read More Type Button</option>             
					<option value="section">Section</option>             
					<option value="separator">Separator</option>             
					<option value="separator-shortcode">Separator with Shortcode</option>             
					<option value="service">Service Boxes</option>             
					<option value="service2">Service Type 2 Boxes</option>             
					<option value="social">Socials</option>             
					<option value="spacer">Spacer</option>             
					<option value="staff">Staff</option>             
					<option value="tab">Tab</option>             
					<option value="testimonial">Testimonial</option>             
					<option value="title-description">Title Description</option>             
					<option value="toggle">Toggle</option>             
					<option value="tooltip">Tooltip</option>             
					<option value="video">Video</option>             
				</select>
			</div>
		</form>
        </div>
        <!-- /select-shortcode-inner -->
	</div>
    <!-- /select-shortcode-wrap -->
    
    <h2 class="shortcode-editor-title"></h2>
	<div id="shortcode-editor">
    	<div id="shortcode-editor-inner" class="clearfix">
			<div id="selected-shortcode"></div>
		</div>
        <!-- /shortcode-dialog-inner -->
	</div>
    <!-- /shortcode-dialog -->
    
    
</div>
<!-- /hbthemes-shortcodes-popup -->

</body>
</html>