<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes custom SEO or default meta tag values
function add_page_title ( $post_id ) {
	
	global $wp_query;
	$page_title  = '';
	$page_description  = '';
	
	if ( is_search() ) {	
		$page_title = __('Search Complete' , 'hbthemes');		
		$page_description = __('We found ' , 'hbthemes') . $wp_query->found_posts . __( ' results.' , 'hbthemes' );	
	
	} else if ( is_archive() ) {
		if (is_month())
			$page_title = __('Archive for ','hbthemes') . get_the_time('F, Y');
		if (is_year())
			$page_title = __('Archive for ','hbthemes') . get_the_time('Y');
		if (is_tag())
			$page_title = __('Posts Tagged &quot;','hbthemes') . single_tag_title("", false) . __('&quot','hbthemes');
		if (is_category())
			$page_title = __() . single_cat_title("", false) . __();
		if (is_author()) {
			$cur_auth = $wp_query->get_queried_object();
			$page_title = __("Posts by ",'hbthemes') . $cur_auth->nickname;
		} 
		if ( is_tax('portfolio_cats') )
			$page_title = __('Portfolio Category &quot;','hbthemes') . single_cat_title("", false) . __('&quot','hbthemes');
		if ( is_tax('portfolio_skills') ) 
			$page_title = __('Portfolio Skill &quot;','hbthemes') . single_cat_title("", false) . __('&quot','hbthemes');
		if ( is_tax('staff_departments') )
			$page_title = __('Staff Department &quot;','hbthemes') . single_cat_title("", false) . __('&quot','hbthemes');
		if ( is_tax( 'post_format' ) ) {
			if (has_post_format('aside'))
				$page_title = "Archive for Aside posts";
			if (has_post_format('link'))
				$page_title = "Archive for Link posts";
			if (has_post_format('video'))
				$page_title = "Archive for Video posts";
			if (get_post_format() == '' )
				$page_title = "Archive for Image posts";
			if (has_post_format('gallery'))
				$page_title = "Archive for Gallery posts";
		}
		$page_description = __('We found ' , 'hbthemes') . $wp_query->found_posts . __( ' results.' , 'hbthemes' );	
	} else if ( is_page() || is_single() ) {
		$page_title = get_post_meta ( $post_id , 'hb_page_custom_title' , true );
		$page_description = get_post_meta ( $post_id , 'hb_page_custom_description' , true );
	} 
	
	else {	if ( $page_title == "" ) $page_title = get_the_title ( $post_id ); }
	
	if ( $page_title ) {
		print "<div id=\"page-title\" class=\"focus-slogan-text\">\n";
		print "<div class=\"wrapper-30\">\n";
		print "<h1>$page_title</h1>\n";
			
		if ( $page_description ) 
			print "<h4>$page_description</h4>\n";
			
		print "</div>\n";
		print "</div>\n";
	}
}

function is_page_title_enabled ( $post_id ) {
		
	if ( is_archive() || is_category() || is_tag() || is_search() || is_author() ) {
		return true;
	}
	
	if ( get_post_meta ( $post_id , 'hb_page_title_enable' , true ) ) return true;	
	
	return false;
}
?>