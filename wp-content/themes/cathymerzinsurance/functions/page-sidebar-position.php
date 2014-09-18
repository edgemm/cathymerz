<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes custom SEO or default meta tag values
function page_has_sidebar ( $post_id ) {
	$hb_page_sidebar = get_post_meta ( $post_id , 'hb_page_sidebar_position' , true );
	$page_template = get_current_template();
	
	global $data;
	if ( is_404() )
		return false;
	if ( $page_template == 'page-archive.php' || $page_template == 'page-sitemap.php' || $page_template == 'page-tour.php' )
		return false;
	if ( $page_template == 'page-blog-grid.php' )
		return false;
	if ( is_singular ( 'portfolio') ) 
		return false;
	if ( is_archive() || is_category() || is_tag() || is_search() || is_author() ) {
		if ( is_tax() ) 
			return false;
		if ( sanitize_title ( $data['hb_archive_pages_sidebar_position'] ) != 'none' )
			return true;
		return false;
	} if ( is_attachment() ) return false;
	return sanitize_title ( $hb_page_sidebar ) != "none";
}

?>