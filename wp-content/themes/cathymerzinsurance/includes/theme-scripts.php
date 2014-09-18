<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

function hb_scripts_setup () {

	global $data;
	
	if(!is_admin()){
		$theme_path = get_template_directory_uri();

		wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
   		wp_enqueue_script( 'jquery' );

   		//Include Gmap
		wp_register_script( 'hb_jquery_gmap', $theme_path . '/scripts/libs/jquery-gmap/jquery.gmap.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_gmap' );

   		//Include JQuery Easing
   		wp_register_script( 'hb_jquery_easing', $theme_path . '/scripts/libs/jquery-easing/jquery.easing.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_easing' );

		//Include JQuery Easing
   		wp_register_script( 'hb_jquery_flex', $theme_path . '/scripts/libs/jquery-flexslider/jquery.flexslider.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_flex' );

		//Include JQuery hbstreams
   		wp_register_script( 'hb_jquery_hbstreams', $theme_path . '/scripts/libs/jquery-hbstreams/jquery.hbstreams.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_hbstreams' );

		//Include JQuery SuperSubs
		wp_register_script( 'hb_jquery_supersubs', $theme_path . '/scripts/libs/jquery-superfish/jquery.supersubs.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_supersubs' );
		
		//Include Superfish
		wp_register_script( 'hb_jquery_superfish', $theme_path . '/scripts/libs/jquery-superfish/jquery.superfish.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_superfish' );

		//Include JQuery Backstretch
		wp_register_script( 'hb_jquery_backstretch', $theme_path . '/scripts/libs/jquery-backstretch/jquery.backstretch.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_backstretch' );
		
		//Include JQuery Validate
		wp_register_script( 'hb_jquery_validate', $theme_path . '/scripts/libs/jquery-validate/jquery.validate.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_validate' );

		//Include JQuery Isotope
		wp_register_script( 'hb_jquery_isotope', $theme_path . '/scripts/libs/jquery-isotope/jquery.isotope.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_isotope' );

		//Include JQuery Tipsy
		wp_register_script( 'hb_jquery_tipsy', $theme_path . '/scripts/libs/jquery-tipsy/jquery.tipsy.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_tipsy' );

		//Include JQuery Tweet
		wp_register_script( 'hb_jquery_tweet', $theme_path . '/scripts/libs/jquery-tweet/jquery.tweet.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_tweet' );

		//Include JQuery FitVids
		wp_register_script( 'hb_jquery_fitvids', $theme_path . '/scripts/libs/jquery-fitvids/jquery.fitvids.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_fitvids' );
		
		//Include JQuery FancyBox
   		wp_register_script( 'hb_jquery_fancybox', $theme_path . '/css/fancybox/jquery.fancybox-1.3.4.pack.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_fancybox' );
		
		//Include JQuery Custom
   		wp_register_script( 'hb_jquery_custom', $theme_path . '/scripts/jquery.custom.js', false, '1.0' ); 
		wp_enqueue_script( 'hb_jquery_custom' );

		// Contact Form
		wp_enqueue_script( 'my-ajax-request', get_template_directory_uri() .'/scripts/ajax.js', array( 'jquery' ) );	
		wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		
		wp_enqueue_script( "comment-reply" );
	}
	
}
add_action('wp_enqueue_scripts', 'hb_scripts_setup');
?>