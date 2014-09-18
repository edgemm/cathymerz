<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
?>

<?php get_header(); ?>

<?php 
if (have_posts()) : 
	
	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	
	while (have_posts()) : the_post();
		$thumb = get_post_thumbnail_id(); 
		$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( get_the_ID() ), 'original') ;
				
		echo '<article class="search-entry clearfix">';
		
		if ( $thumb ) {
			$image = hb_resize( $thumb, '', 215, 140, true );
			echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="search-portfolio-thumb"><img src="'.$image['url'].'" /></a>';
		}
		
		$echo_title = get_the_title();
		if ( $echo_title == "" ) $echo_title = __('No Title' , 'hbthemes' );
		echo '<h4><a href="'.get_permalink().'" title="'.$echo_title.'">'.$echo_title.'</a></h4>';
	
		the_excerpt();
		
		echo '</article>';
		
	endwhile; 
	
	hb_pagination();

	
endif;
?>

<?php get_footer(); ?>