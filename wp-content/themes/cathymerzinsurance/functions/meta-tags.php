<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes custom SEO or default meta tag values
function print_meta_tags ( $post_id ) {
	global $data;

	$hb_seotools_title = get_the_title ( $post_id ) . ' &laquo; ' . get_bloginfo( 'name' );
	$hb_seotools_description = get_bloginfo ( 'description' );
	$hb_seotools_keywords = get_bloginfo ( 'name' );
	$hb_seotools_title_meta = '';
	$hb_seotools_description_meta = '';
	$hb_seotools_keywords_meta = '';
	
	if ( $data['hb_seo_enable'] ) {
		$data['hb_seo_title'] != "" ? $hb_seotools_title = $data['hb_seo_title'] : $hb_seotools_title = get_the_title ( $post_id ) . ' &laquo ' . get_bloginfo( 'name' );
		$data['hb_seo_description'] != "" ? $hb_seotools_description = $data['hb_seo_description'] :  $hb_seotools_title = get_bloginfo( 'description' );
		$data['hb_seo_keywords'] != "" ? $hb_seotools_keywords = $data['hb_seo_keywords'] : $hb_seotools_title = get_bloginfo ( 'name' );
	}

	if ( get_post_meta ( $post_id , 'hb_seotools_active' , true ) == "on" ) {
		if ( get_post_meta ( $post_id , 'hb_seotools_title' , true ) )
			$hb_seotools_title_meta = get_post_meta ( $post_id , 'hb_seotools_title' , true );
		if ( get_post_meta ( $post_id , 'hb_seotools_description' , true ) )
			$hb_seotools_description_meta = get_post_meta ( $post_id , 'hb_seotools_description' , true );
		if ( get_post_meta ( $post_id , 'hb_seotools_keywords' , true ) )
			$hb_seotools_keywords_meta = get_post_meta ( $post_id , 'hb_seotools_keywords' , true );
	}

	if ( $hb_seotools_title_meta != "" ) $hb_seotools_title = $hb_seotools_title_meta;
	if ( $hb_seotools_description_meta != "" ) $hb_seotools_description = $hb_seotools_description_meta;
	if ( $hb_seotools_keywords_meta != "" ) $hb_seotools_keywords = $hb_seotools_keywords_meta;
 
	$hb_charset = get_bloginfo( 'charset' );
	print "\t<!-- START meta -->\n";
	print "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"/>\n";
	print "\t<meta name=\"viewport\" content=\"width=device-width,initial-scale=1, maximum-scale=1\">\n";
	print "\t<meta charset=\"$hb_charset\" />\n";
	print "\t<meta name=\"keywords\" content=\"$hb_seotools_keywords\" />\n";
	print "\t<meta name=\"description\" content=\"$hb_seotools_description\" />\n";
	print "\t<title>$hb_seotools_title</title>\n";
	print "\t<!-- END meta -->\n";
}
?>