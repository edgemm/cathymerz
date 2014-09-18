<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
/*
 
Template Name: Blog
 
*/
global $data;

?>
<?php get_header(); ?>

<?php 
if (have_posts()) :
while (have_posts()) : the_post();

	$exclude_cats = get_post_meta ( get_the_ID() , 'hb_exclude_from_blog_categories' , true );
	$exclude_string = '';
	
	if ( $exclude_cats ) { 
		$exclude_cats = string_to_array_names_categories ( $exclude_cats );
		if ( !empty( $exclude_cats ) ) {
			foreach ( $exclude_cats as $caat ) { 
				$exclude_string .= ',-'.get_cat_ID ( $caat ); 
			}
		}
		$exclude_string = substr ( $exclude_string , 1 );
	}
	
	
	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	
	// Content
	if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } 

	query_posts( 'post_type=post&paged='.$paged.'&cat='.$exclude_string );
	
	
	if ( have_posts() ) :
		?>
		<!-- START .blog-wrapper -->
		<div class="blog-wrapper clearfix">
		<?php
		while ( have_posts () ) : the_post(); 
			print_blog_sidebar_post( get_the_ID() );
		endwhile;
		
		
		?>
		</div>
		<!-- END .blog-wrapper -->
		<?php 
	endif;
	
	hb_pagination();

	wp_reset_query();

endwhile;
endif; ?>

<?php get_footer(); ?>