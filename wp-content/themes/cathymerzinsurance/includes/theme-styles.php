<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

function hb_styles_setup () {
	global $data;
	$theme_path = get_template_directory_uri();

	//Include Font Awesome
   	wp_register_style( 'hb_fontawesome_style', $theme_path . '/css/font-awesome.css', false, '1.0' ); 
	wp_enqueue_style( 'hb_fontawesome_style' );
	
	//Include JQuery FancyBox
   	wp_register_style( 'hb_fancybox_style', $theme_path . '/css/fancybox/fancybox.css', false, '1.0' ); 
	wp_enqueue_style( 'hb_fancybox_style' );

	//Include Flexslider
   	wp_register_style( 'hb_flexslider_style', $theme_path . '/css/flexslider.css', false, '1.0' ); 
	wp_enqueue_style( 'hb_flexslider_style' );

	// Animate
   	wp_register_style( 'hb_animate_style', $theme_path . '/css/animate.css', false, '1.0' ); 
	wp_enqueue_style( 'hb_animate_style' );
	
	// Add Responsive Style
	if ( $data['hb_enable_responsive'] ) {
		wp_register_style( 'hb_responsive_style', $theme_path . '/css/queries.css', false, '1.0' ); 
		wp_enqueue_style( 'hb_responsive_style' );
	}
}
add_action('wp_enqueue_scripts', 'hb_styles_setup');
?>