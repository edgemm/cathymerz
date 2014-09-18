<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes custom SEO or default meta tag values
function add_header_separator ( $page_id ) {
	$current_template = get_current_template(); 
	$hb_page_slider = get_post_meta( $page_id , 'hb_page_slider' , true );
	$flex_slider = get_post_meta ( $page_id , 'hb_portfolio_page_slider' , true );
	$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( $page_id ), 'original') ;
	$hb_map_link = get_post_meta ( $page_id , 'hb_contact_page_map' , true );
	$pf_video_link = get_post_meta ( $page_id , 'hb_portfolio_video_link' , true );

	if ( $current_template != "page-contact.php" ) $hb_map_link = "";
	
	$hb_page_title_enabled = get_post_meta ( $page_id , 'hb_page_title_enable' , true );
	
	if ( is_404() || is_search() || is_archive() ) {
		print '<div id="header-separator" class="separator"></div>';
	} else if ( $current_template == 'page-contact.php' ) {
		if ( $hb_map_link == "" ) 
			print '<div id="header-separator" class="separator"></div>';
	} else if ( is_page() || is_home() ) {		
		if ( !$hb_page_slider && !$full_thumb  && $flex_slider == __('None' , 'hbthemes' ) ) 
			print '<div id="header-separator" class="separator"></div>';
	} else if ( is_single() ) {
		
		if ( is_singular ( __('portfolio' , 'hbthemes') ) ) {
			if ( $flex_slider == __('None' , 'hbthemes' ) && $pf_video_link == '' && $full_thumb == '' ) {				
				print '<div id="header-separator" class="separator"></div>';
			}
		}
		else {
			
			if ( !$hb_page_slider )
			print '<div id="header-separator" class="separator"></div>';
		}
	}
}
?>