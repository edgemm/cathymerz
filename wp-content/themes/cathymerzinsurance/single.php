<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
?>
<?php
if( is_singular ( __('flexslider','hbthemes') ) ||
 	is_singular ( __('staff','hbthemes') ) ||
	is_singular ( __('testimonials' , 'hbthemes') ) ) {
	wp_redirect(home_url()); exit;
} 
?>

<?php get_header(); ?>
<?php 
if(is_singular('post')) { 
	get_template_part ( 'single' , 'blog' );
} else if ( is_singular ( __('portfolio','hbthemes') ) ) { 
	get_template_part ( 'single' , 'portfolio' );
} 
?>
<?php get_footer(); ?>