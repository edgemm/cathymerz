<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which adds background images
function add_background_image ( $post_id ) {
	global $data;
	
	if ( !is_404() && !is_archive() && !is_search() && !is_tax() && !is_author() && !is_tag() && !is_category() ) {
	
		$background_image = get_post_meta ( $post_id , 'hb_background_image_sep' , true );
		$background_texture = get_post_meta ( $post_id , 'hb_background_texture_sep' , true );
		if ( $background_image ) { ?>
			
			<script>
				jQuery.backstretch("<?php echo $background_image; ?>");
			</script>		
		<?php  return; } else if ( $background_texture ) { ?>
			<style type="text/css">
				body 
					{ 
						background-image: url("<?php echo $background_texture; ?>") !important;
					}
			</style>
		<?php return; }
		
	}
	
	if ( $data['hb_default_background'] ) { ?>
		<script>
			jQuery.backstretch("<?php echo $data['hb_default_background']; ?>");
		</script>
	<?php } else if ( $data['hb_background_tiles_images'] ) { ?>
		<style type="text/css">
			body 
				{ 
					background-image: url("<?php echo $data['hb_background_tiles_images']; ?>") !important;
				}
		</style>
	<?php } 
	if ( $data['hb_plain_bg'] ) { ?>
		<style type="text/css">
			body 
				{ 
					background-image: none !important;
					background-color: <?php echo $data['hb_plain_bg_color']; ?> !important;
				}
		</style>
		<?php }
}
?>