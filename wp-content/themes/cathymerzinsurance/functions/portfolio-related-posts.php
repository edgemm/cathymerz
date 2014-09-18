<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which adds portfolio related posts
function portfolio_related_posts ( $post_id ) {
	global $data;

?>
<div class="clear"></div>
<div class="separator">
	<div class="separator-text">Related Projects</div>
</div>
<?php 
	// get portfolio categories and generate an array of their slugs
	$portfolio_terms = wp_get_post_terms( $post_id, 'portfolio_cats', array() );
	$portfolio_terms_slugs = array();

	if ( is_array ( $portfolio_terms ) ) {
		foreach ( $portfolio_terms as $portfolio_term ) {
			$portfolio_terms_slugs[] = $portfolio_term->slug;
		}
	}

	// create wp_query
	if ( !empty($portfolio_terms_slugs) ) {
		$loop = new WP_Query( array( 'post_type' => __('portfolio','hbthemes') , 'orderby' => 'rand', 'posts_per_page' => 4, 'tax_query' => array( array( 'taxonomy' => 'portfolio_cats', 'field' => 'slug', 'terms' => $portfolio_terms_slugs ) ) ) );
	} else {
		$loop = new WP_Query( array( 'post_type' => __('portfolio', 'hbthemes') , 'orderby' => 'rand', 'posts_per_page' => 4 ) );
	}

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		if ( sanitize_title ( get_the_title ( get_the_ID() ) ) != sanitize_title ( get_the_title ( $post_id ) ) ) {
			
			// get portfolio thumbnail
			$thumb = get_post_thumbnail_id( get_the_ID() );
			$image = hb_resize( $thumb, '', 480, 360, true );
			
			echo '<div class="col-3 from-the-portfolio-gal">';
			echo '<a href="' . get_permalink ( get_the_ID() ) . '" class="from-the-portfolio-sec-header">';
			echo '<img src="'.$image['url'].'"/>';
			

			// Overlay Data
			$term_list = wp_get_post_terms(get_the_ID(), 'portfolio_cats', array("fields" => "names"));
			$terms_h5 = implode ( " + " , $term_list );
			?>
			<!-- START .overlay-info -->
				<div class="overlay-info">
					<!-- START .overlay-inner -->
					<div class="overlay-inner">
						<!-- START .overlay-content -->
						<div class="overlay-content">
							<h2 class="portfolio-title"><?php echo get_the_title( get_the_ID() ); ?></h2>
							<h5><?php echo $terms_h5; ?></h5>
						</div>
						<!-- END .overlay-content -->
					</div>
					<!-- END .overlay-inner -->
				</div>
			<!-- END .overlay-info -->
		<?php
			echo '</a>';
			echo '</div>'; 
		}
	endwhile; endif;

	wp_reset_query();
}
?>