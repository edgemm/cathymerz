<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Testimonials
 
*/

global $data;
?>
<?php get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();

	$page_testimonial_size = (int) get_post_meta ( get_the_ID() , 'hb_staff_columns' , true );
	$page_testimonial_col_class = 'col-6';
	
	switch ( $page_testimonial_size ) {
		case 2 : $page_testimonial_col_class = 'col-6'; break;
		case 3 : $page_testimonial_col_class = 'col-4'; break;
		case 4 : $page_testimonial_col_class = 'col-3'; break;
	}
	
	
	$loop = new WP_Query( array( 'post_type' => __('testimonials' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );

	if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } ?>
	
	<!-- START .posts-grid -->
	<div class="posts-grid">
	
	<?php while ( $loop->have_posts() ) : $loop->the_post() ; 
	
		$testimonial_author = get_post_meta ( get_the_ID() , 'hb_testimonial_author' , true );
		$testimonial_author_info = get_post_meta ( get_the_ID() , 'hb_testimonial_author_info' , true );
		
		?>
		<div class="<?php echo $page_testimonial_col_class; ?> post">
		
			<!-- START .testimonial-box -->
			<div class="testimonial-box">
				<!-- START .testimonial-header -->
				<div class="testimonial-header">
					<div class="testimonial-content"><?php the_content(); ?></div>
					<span class="arrow-down"></span>
				</div>
				<!-- END .testimonial-header -->
				
				<!-- START .testimonial-footer -->
				<div class="testimonial-footer">
				<span><?php echo $testimonial_author; ?></span><?php if ( $testimonial_author_info ) { echo ', '.$testimonial_author_info; } ?>
				</div>
				<!-- END .testimonial-footer -->
			</div>
			<!-- END .testimonial-box -->
			
		</div>		
	<?php endwhile; ?>
	
	</div>
	<!-- END .posts-grid -->
	
	<?php wp_reset_query(); ?>
	
<?php endwhile; endif; ?>
<?php get_footer(); ?>