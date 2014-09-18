<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
/*
 
Template Name: Contact Page
 
*/
global $data;

?>
<?php get_header(); ?>

<?php 
if (have_posts()) :
while (have_posts()) : the_post();

$hb_sidebar_position = sanitize_title ( get_post_meta ( get_the_ID() , 'hb_page_sidebar_position' , true ) );

if ( $hb_sidebar_position != __( 'none' , 'hbthemes' ) ) {

	the_content();
	echo '<div class="separator"><div class="separator-icon"><div class="icon-comments-alt"></div></div></div>';
	include ( HBTHEMES_INCLUDES . '/contact-form.php' );

} else {
	
	echo '<div class="section no-margin">';
	echo '<div class="col-6 no-margin">';
	the_content();
	echo '</div>';
	
	echo '<div class="col-6 no-margin last-column">';
	include ( HBTHEMES_INCLUDES . '/contact-form.php' );
	echo '</div>';
	echo '</div>';
}

endwhile;
endif; ?>

<?php get_footer(); ?>