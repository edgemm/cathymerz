<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */


// Function which includes a featured image or a slider.
function add_page_featured_image_slider ( $post_id ) {
	global $data;
	
	// get vars
	$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( $post_id ), 'original') ;
	$slider = get_post_meta ( $post_id , 'hb_page_slider' , true );
	$flex_slider = get_post_meta ( $post_id , 'hb_portfolio_page_slider' , true );
	$hb_map_link = get_post_meta ( $post_id , 'hb_contact_page_map' , true );
	$pf_video_link = get_post_meta ( $post_id , 'hb_portfolio_video_link' , true );

	if ( get_current_template() == 'page-contact.php' ) {
		$slider = "";
		$flex_slider = __("None" , 'hbthemes');
		$full_thumb = "";
	} else {
		$hb_map_link = "";
	}

	if ( is_singular ( 'post' ) ) 
		$full_thumb = "";
		
	if ( is_archive() || is_category() || is_tag() || is_search() || is_author() || is_tax() ) {
		$slider = "";
		$flex_slider = __("None" , 'hbthemes');
		$full_thumb = "";
		$hb_map_link = "";
	}
	if ( is_attachment() ) {
		$slider = "";
		$flex_slider = __("None" , 'hbthemes');
		$hb_map_link = "";
		$full_thumb = wp_get_attachment_image_src ( $post_id , 'original');
	}


	
	if ( $pf_video_link || $slider || $full_thumb || $hb_map_link || $flex_slider != __('None', 'hbthemes')) {
		print '<div id="slider-section" class="clearfix">';
		
		if ( $slider ) {
			putRevSlider ( $slider );
			print '<div id="shadow-top"></div>';
		} else if ( sanitize_title ( $flex_slider ) != "none" && $flex_slider != "" ) {
			print putFlexSlider ( $flex_slider );
			print '<div id="shadow-top"></div>';
			wp_reset_query();
		} else if ( $pf_video_link && is_singular ( __('portfolio' , 'hbthemes') ) ) {
			print '<div style="width:100%" class="fitVids">';
			print clear_iframe ( $pf_video_link );
			print '</div>';
			print '<div id="shadow-top"></div>';
		} else if ( $full_thumb ) {
			print "\n<img src=\"$full_thumb[0]\" class=\"featured-image\">\n";
			print '<div id="shadow-top"></div>';
		} else if ( $hb_map_link ) { 
			print '<iframe width="990" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'. get_src_from_embedded_link ( $hb_map_link ) . '"></iframe>';
		}
		
		
		print '</div>';
	}
}

?>