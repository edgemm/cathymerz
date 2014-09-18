<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
global $data, $post;
?>
<!DOCTYPE HTML>
<!-- START html -->
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); echo ' class="ie ie8"';?>>
<![endif]-->
<!--[if !IE]>-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); 
if(is_admin_bar_showing()) {
	echo ' style="margin-top:28 !important; "';
}?>>
<!--<![endif]-->


<!-- START head -->
<head>

<?php if ( !is_404() ) print_meta_tags( get_the_ID() ); ?>

<?php add_favicon(); ?>

<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />

<?php if($data['hb_use_custom_typography']){ ?>
<!-- BEGIN Typography Styles from Theme Options -->
<style type="text/css">
	body, a, ul li a { font-family: <?php echo $data['hb_body_font']['face']; ?>; font-size: <?php echo $data['hb_body_font']['size']; ?> !important; color: <?php echo $data['hb_body_font']['color']; ?>; font-weight: <?php echo $data['hb_body_font']['style']; ?> !important; } 
	h1 { font-family: <?php echo $data['hb_h1_font']['face']; ?>; font-size: <?php echo $data['hb_h1_font']['size']; ?> !important; color: <?php echo $data['hb_h1_font']['color']; ?>; font-weight: <?php echo $data['hb_h1_font']['style']; ?> !important; }
	h2 { font-family: <?php echo $data['hb_h2_font']['face']; ?>; font-size: <?php echo $data['hb_h2_font']['size']; ?> !important; color: <?php echo $data['hb_h2_font']['color']; ?>; font-weight: <?php echo $data['hb_h2_font']['style']; ?> !important; }
	h3 { font-family: <?php echo $data['hb_h3_font']['face']; ?>; font-size: <?php echo $data['hb_h3_font']['size']; ?> !important; color: <?php echo $data['hb_h3_font']['color']; ?>; font-weight: <?php echo $data['hb_h3_font']['style']; ?> !important; }
	h4 { font-family: <?php echo $data['hb_h4_font']['face']; ?>; font-size: <?php echo $data['hb_h4_font']['size']; ?> !important; color: <?php echo $data['hb_h5_font']['color']; ?>; font-weight: <?php echo $data['hb_h5_font']['style']; ?> !important; }
	h5 { font-family: <?php echo $data['hb_h5_font']['face']; ?>; font-size: <?php echo $data['hb_h5_font']['size']; ?> !important; color: <?php echo $data['hb_h5_font']['color']; ?>; font-weight: <?php echo $data['hb_h5_font']['style']; ?> !important; }
	h6 { font-family: <?php echo $data['hb_h6_font']['face']; ?>; font-size: <?php echo $data['hb_h6_font']['size']; ?> !important; color: <?php echo $data['hb_h6_font']['color']; ?>; font-weight: <?php echo $data['hb_h6_font']['style']; ?> !important; }
	#nav li a{ font-family: <?php echo $data['hb_nav_font']['face']; ?>; font-size: <?php echo $data['hb_nav_font']['size']; ?> !important; color: <?php echo $data['hb_nav_font']['color']; ?>; font-weight: <?php echo $data['hb_nav_font']['style']; ?> !important; } 
	#footer, #footer ul, #main-sidebar, #mai-sidebar ul { font-family: <?php echo $data['hb_widget_font']['face']; ?>; font-size: <?php echo $data['hb_widget_font']['size']; ?> !important; color: <?php echo $data['hb_widget_font']['color']; ?>; font-weight: <?php echo $data['hb_widget_font']['style']; ?> !important; } 

<?php if( $data['hb_custom_font_import'] ) { echo $data['hb_custom_font_import']; } ?>

</style>
<!-- END Typography Styles -->
<?php } ?>


<!--[if IE]>	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome-ie7.css" type="text/css" media="all"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php include ( HBTHEMES_INCLUDES . '/theme-options-styles.php' ); ?>

<!-- Custom CSS -->
<?php if ( $data['hb_custom_css_field'] ) { ?>
<style type="text/css">
	<?php echo $data['hb_custom_css_field'] ; ?>
</style>
<?php } ?>
<!-- Custom CSS END -->

<?php wp_head(); ?>

</head>
<!-- END head -->


<?php $body_kikkey = "";
	if ( $data['hb_include_to_top'] ) 
		$body_kikkey = "kikkey-top";
?>
<!-- START body -->
<body <?php body_class($body_kikkey); ?>>

	<?php add_background_image ( get_the_ID() ); ?>

	<!-- START #wrapper -->

	<div id="wrapper" class="<?php 
		$space = "";
		if ( !is_page_title_enabled ( get_the_ID() ) ) {
			echo 'page-no-title'; 
			$space = " ";
		}
		$hb_page_sidebar_position = sanitize_title ( get_post_meta ( get_the_ID() , 'hb_page_sidebar_position' , true ) );
		if ( is_archive() || is_category() || is_tag() || is_search() || is_author() || is_attachment() ) {
			if ( strtolower ( $data['hb_archive_pages_sidebar_position'] ) != 'none' )
				$hb_page_sidebar_position = $data['hb_archive_pages_sidebar_position'];

		}
		
		if ( page_has_sidebar ( get_the_ID() ) ) echo $space.$hb_page_sidebar_position; 
	?>">

	<?php add_map_dropdown(); ?>
    
    

	<!-- START #content -->
	<div id="content">

<!-- START Header Call to Action SMC -->
<div class="container">
<div id="call-to-action-smc">    
<div class="tp-caption lfb start" data-x="794" data-y="286" data-speed="950" data-start="800" data-easing="easeInQuad" data-linktoslide="1" style="cursor: pointer; font-size: 16px; padding: 0px; margin: 0px; border: 0px; line-height: 22px; white-space: nowrap; opacity: 1; left: 794px; top: 380px; -webkit-transform: rotate(0deg); font-size:15px visibility: visible;"><a href="http://cathymerzinsurance.com/request-a-quote/" class="tp-button red large">REQUEST A QUOTE</a></div>
</div></div>
<!-- END Header Call to Action SMC -->

    

	<!-- START #content-inner -->
	<div id="content-inner" class="container clearfix">


    
   
	<?php add_theme_header(); ?>
	<?php add_theme_main_nav(); ?>
	<?php add_header_separator( get_the_ID() ); ?>
	
	<?php add_page_featured_image_slider( get_the_ID() ); ?>
	
	<!-- START #main-content -->
	<div id="main-content" class="clearfix" >
	
	<!-- START #main-inner-wrapper -->
	<div id="main-inner-wrapper" class="col-12 clearfix<?php if ( page_has_sidebar( get_the_ID() ) ) echo ' page-with-sidebar'; ?>">

	<?php add_page_title( get_the_ID() ); ?>

	<?php if ( !page_has_sidebar( get_the_ID() ) ) { ?>
	<!-- START #fullwidth-wrapper -->
	<div id="fullwidth-wrapper" class="section clearfix">
	<?php } else { ?>
	<!-- START #sidebar-page-wrapper-->
	<div id="sidebar-page-wrapper" class="clearfix">

	<!-- START #main-content-with-sidebar" -->
	<div id="main-content-with-sidebar" class="col-8">
	<?php } ?>
	
	<?php if ( get_post_meta ( get_the_ID() , 'hb_include_breadcrumbs' , true ) || is_archive() || is_search() ) hbthemes_breadcrumbs(); ?>