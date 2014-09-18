<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Define Directories
define( 'HBTHEMES_INCLUDES' , get_template_directory() . '/includes' );
define ( 'HBTHEMES_FUNCTIONS' , get_template_directory() . '/functions' );
define( 'HBTHEMES_ADMIN' , get_template_directory() . '/admin' );
define  ( 'HBTHEMES_ROOT' , get_template_directory() );

// Define Names
define('SHORTNAME', 'hb');
define('THEMENAME', 'Aegaeus');
$shortname = SHORTNAME;
$themename = THEMENAME;
$themepath = get_template_directory_uri();

//Theme Setup
function hb_theme_setup() {
	global $shortname;
	global $themename;
	global $themepath;
	global $data;

	
	require_once ( HBTHEMES_INCLUDES . '/theme-styles.php' );
  	require_once ( HBTHEMES_INCLUDES . '/theme-scripts.php' ); 
  	
}
add_action( 'after_setup_theme', 'hb_theme_setup');

// Include Theme Options
require_once ( HBTHEMES_ADMIN . '/index.php' );

// Include Functions
include_once ( HBTHEMES_FUNCTIONS . '/meta-tags.php' );
include_once ( HBTHEMES_FUNCTIONS . '/favicon.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-dropdown.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-logo-socials.php' );
include_once ( HBTHEMES_FUNCTIONS . '/main-navigation.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-separator.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-sidebar-position.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-title.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-featured-image-slider.php' );
include_once ( HBTHEMES_FUNCTIONS . '/breadcrumbs.php' );
include_once ( HBTHEMES_FUNCTIONS . '/convert-string-to-array.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-filter.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-items.php' );
include_once ( HBTHEMES_FUNCTIONS . '/flexslider.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-details.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-related-posts.php' );
include_once ( HBTHEMES_FUNCTIONS . '/blog-grid.php' );
include_once ( HBTHEMES_FUNCTIONS . '/blog-sidebar.php' );
include_once ( HBTHEMES_FUNCTIONS . '/backstretch.php' );


if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
	require_once('includes/theme-metabox-class.php');
	require_once('includes/theme-metabox-usage.php');
	require_once('mce/shortcode-popup.php');
}

require_once ( HBTHEMES_INCLUDES . '/theme-widget-areas.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-shortcodes.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-post-types.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-taxonomies.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-likes.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-thumbnails-resize.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-pagination.php' );
//require_once ( HBTHEMES_ROOT . '/includes/revslider/revslider.php' ); 

include ( HBTHEMES_INCLUDES . '/widgets/widget-video.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-contact.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-infobox.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-flickr.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-pinterest.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-instagram.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-dribbble.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-twitter.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-testimonial.php' ); 	
include ( HBTHEMES_INCLUDES . '/widgets/widget-portfolio.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-recent-posts.php' ); 
/*	
	
	include ( HBTHEMES_INCLUDES . '/widgets/widget-newsletter.php' ); 
	include ( HBTHEMES_INCLUDES . '/widgets/widget-comments.php' ); */
	
// Register Menus
function hb_register_menu() {

  register_nav_menu('main-menu', __('Main Menu', 'hbthemes'));
  register_nav_menu('footer-menu', __('Footer Menu', 'hbthemes'));

}
add_action( 'init', 'hb_register_menu' );

// Add Supports
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats' , array( 'aside', 'link' , 'video' , 'gallery') );
add_theme_support( 'automatic-feed-links' );	
add_filter('widget_text', 'do_shortcode');

load_theme_textdomain( 'hbthemes', get_template_directory().'/languages' );

if ( ! isset( $content_width ) ){ $content_width = 990; }


// Contact 
add_action('wp_ajax_mail_action', 'sending_mail');
add_action('wp_ajax_nopriv_mail_action', 'sending_mail');

function sending_mail(){
		
		$theme = get_bloginfo('name');
		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$comments = $_POST['comments'];
		$name = $_POST['name'];

        $to = get_bloginfo('admin_email');
        $message = "Name: $name \n\nEmail: $email \n\nComments: $comments \n\nThis email has been sent from $theme"; 
		$headers = 'From: '.$name. "\r\n" . 'Reply-To: ' . $email;

        mail($to, $subject, $message, $headers);
}

// Get Current Template Function
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}
add_filter( 'template_include', 'var_template_include', 1000 );

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

// Add Media Upload and Thickbox styles and scripts
function admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');

function get_src_from_embedded_link( $embedded_link ) {
	$src_value = substr( $embedded_link , strpos( $embedded_link , 'src="') + 5 , strlen( $embedded_link ) );
	$src_value = substr( $src_value , 0 , strpos ( $src_value , '"' )  ) ;
	if ($src_value)
		return $src_value;
	return $embedded_link;
}

function get_action_for_form ( $embedded_link ) {
	$action_value = substr( $embedded_link , strpos( $embedded_link , 'action="') + 8 , strlen( $embedded_link ) );
	$action_value = substr( $action_value , 0 , strpos ( $action_value , '"' )  ) ;
	if ( $action_value )
		return $action_value;
	return $embedded_link; 
}

// Fixes Shortcodes empty paragraphs
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {  
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br />' => ']',
	);
	$content = strtr($content, $array);
	return $content;
}


// Tag Cloud Filter
function tag_cloud_filter($args = array()) {
 $args['smallest'] = 12;
 $args['largest'] = 24;
 $args['unit'] = 'px';
 return $args;
}
add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);


// Enable more post editor buttons
add_filter("mce_buttons_3", "enable_more_buttons");
function enable_more_buttons($buttons) {
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  return $buttons;
}

function my_formatTinyMCE( $init ) {

	$init['theme_advanced_buttons3_add'] = 'styleselect';
	$init['theme_advanced_styles'] = 'Plain List=prestyled;Plus List=prestyled list-plus;Star List=prestyled list-star;Minus List=prestyled list-minus;Cross List=prestyled list-cross;Check List=prestyled list-check';
	return $init;
}
add_filter( 'tiny_mce_before_init', 'my_formatTinyMCE' );

function hb_admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function hb_admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'hb_admin_scripts');
add_action('admin_print_styles', 'hb_admin_styles');

// Change Media Upload Button Text
add_filter("attribute_escape", "myfunction", 10, 2);
function myfunction($safe_text, $text) {
    return str_replace(__("Insert into Post", 'hbthemes'), __("Insert Image", 'hbthemes'), $text);
}

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
?>