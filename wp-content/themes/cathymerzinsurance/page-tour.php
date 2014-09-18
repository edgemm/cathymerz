<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Tour Page
 
*/

global $data, $post;
?>
<?php get_header(); ?>  

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$tour_position =  get_post_meta ( get_the_ID() , 'hb_tour_position' , true );
	
	if ( $tour_position == __( 'Right Tour' , 'hbthemes' ) )
		$tour_position = " ".sanitize_title ( $tour_position ) . ' clearfix';
	else
		$tour_position = " ".sanitize_title ( $tour_position );

	if( $post->post_parent )
		$children = wp_list_pages( 'sort_column=menu_order&exclude=$page_exclusions&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1' );
	else
		$children = wp_list_pages( 'sort_column=menu_order&exclude=$page_exclusions&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
	
	if ( $children ) : ?>
		<div class="hb-tour<?php echo $tour_position; ?>">
			<ul class="tab-select"><?php echo $children; ?></ul>
		
			<div class="tour-content col-9 no-margin">
				<?php the_content(); ?>
			</div>
		</div>
		
	<?php endif; ?>	
		
<?php endwhile; endif; ?>

<?php get_footer(); ?>