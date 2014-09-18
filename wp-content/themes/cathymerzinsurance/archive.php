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
	
	if ( is_tag() ) {	
		if ( tag_description() ) {
			echo tag_description();
			echo '<div class="separator"></div>';
		}
	} else if ( is_category() ) {
		if ( category_description() ) {
			echo category_description();
			echo '<div class="separator"></div>';	
		}
	} else if ( is_author() ){
		if ( get_the_author_meta ('description') ) {
			the_author_meta ( 'description' );
			echo '<div class="separator"></div>';
		}
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
		echo '<h4>';
		
		if ( !has_post_format ('aside') && !has_post_format('link') )
			echo '<a href="'.get_permalink().'" title="'.$echo_title.'">';
		
		echo $echo_title;
		
		if ( !has_post_format ('aside') && !has_post_format('link') )
			echo '</a>';
			
		echo '</h4>';
	
		the_excerpt();
		
		echo '</article>';
		
	endwhile; 
	
	hb_pagination();
	
endif;
?>

<?php get_footer(); ?>