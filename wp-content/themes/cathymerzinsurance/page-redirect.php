<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Redirect Page
 
*/

global $data;

$hb_redirect_link = get_post_meta ( get_the_ID() , 'hb_redirect_link' , true );
$hb_redirect_time = $data['hb_redirect_time'];
$hb_redirect_title = $data['hb_redirect_title'];
$hb_redirect_subtitle = $data['hb_redirect_subtitle'];
$hb_redirect_icon = $data['hb_redirect_icon'];

?>
<?php get_header(); ?>

<input type="hidden" id="redirect-link" value="<?php echo $hb_redirect_link; ?>"/>
<input type="hidden" id="redirect-timeout" value="<?php echo $hb_redirect_time; ?>"/>

<div class="page-not-found-box">
	<h2 class="aligncenter"><?php echo $hb_redirect_title; ?></h2>
	<h3 class="aligncenter focus-heading"><?php echo $hb_redirect_subtitle; ?></h3>
			
	<div class="separator">
		<div class="separator-icon"><span class='<?php echo $hb_redirect_icon; ?>'></span></div>
	</div>
			
	<div class="clearfix aligncenter">
       	<p><?php 
			echo '<p>';
			_e('You will be redirected to ', 'hbthemes');
			echo '<span id="redirect-span">' . $hb_redirect_link . '</span>' ;
			_e ( ' in ' , 'hbthemes' );
			echo '<span id="redirect-timeout-value">NaN</span>';
			_e ( ' seconds. ' , 'hbthemes' ); 
		?>
		</p>
	</div>	           
</div>
		
<script type="text/javascript">
	jQuery(document).ready(function () {
		var linkvalue = jQuery('#redirect-link').val();
		var timeout = jQuery('#redirect-timeout').val();
		var timeoutInt = parseInt(timeout);
				
		jQuery('#redirect-timeout-value').html(timeout);
				
		$(function(){
		  var count = timeoutInt;
		  countdown = setInterval(function(){
			jQuery('#redirect-timeout-value').html(count);
			if (count <= 0) {
				window.location = linkvalue;
			}
			count--;
		  }, 1000);
		});
				
	});
</script>               
<?php get_footer(); ?>