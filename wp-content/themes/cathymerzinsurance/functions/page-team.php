<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Staff
 
*/

global $data;
?>
<?php get_header();


if ( have_posts() ) : while ( have_posts() ) : the_post();

	$page_staff_department_temp = get_post_meta ( get_the_ID() , 'hb_staff_department_include' , true );
	$page_staff_department = string_to_array_names_categories($page_staff_department_temp);
		
	$page_staff_size = (int) get_post_meta ( get_the_ID() , 'hb_staff_columns' , true );
	$page_staff_col_class = 'col-6';
	
	switch ( $page_staff_size ) {
		case 2 : $page_staff_col_class = 'col-6'; break;
		case 3 : $page_staff_col_class = 'col-4'; break;
		case 4 : $page_staff_col_class = 'col-3'; break;
	}
	
	if( $page_staff_department_temp ) {
		$loop = new WP_Query( array( 'post_type' => __('staff' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'staff_departments', 'field' => 'slug', 'terms' => $page_staff_department ) ) ) );
	} else  {
		$loop = new WP_Query( array( 'post_type' => __('staff' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );
	}
	
	$post_count_staff = $loop->post_count;

	if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } ?>
	
	<?php $counter = 0; ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post() ; 
		$counter++;
		$last_column_class = "";
		
		$thumb = get_post_thumbnail_id(); 
		$image = hb_resize( $thumb, '', 450, 301, true );
		$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( $post-> ID ), 'original') ;
		
		if ( $counter % $page_staff_size == 0 ) $last_column_class = " last-column";
		else $last_column_class = "";
		?>
		
		<div class="<?php echo $page_staff_col_class . $last_column_class ; ?>">
		
			<!-- START .team-member-box -->
			<div class="team-member-box">
			
				<a href="<?php echo $full_thumb[0]; ?>" class="fancybox"><img class="team-member-img" src="<?php echo $image['url']; ?>"/></a>
			
				<!-- START .team-member-description -->
				<div class="team-member-description">
				
					<!-- START .team-header-info -->
					<div class="team-header-info clearfix">
					
						<!-- START .team-header-name -->
						<div class="team-name">
							<h4 class="team-member-name"><?php the_title(); ?></h4>
							<p class="team-position"><?php echo get_post_meta ( get_the_ID() , 'hb_team_member_position' , true ); ?></p>
						</div>
						<!-- END .team-name -->
					
						<!-- START .social-list -->
						<div class="social-list clearfix">
							<ul class="social">
							<?php $social_links = get_staff_social_links ( get_the_ID() ); 
								if ( !empty ( $social_links ) ) {
									foreach ( $social_links as $soc_network => $soc_link) {
										echo '<li><a class="' . $soc_network . '" href="' . $soc_link . '" target="_blank"></a></li>';
									}
								}
							?>
							</ul>
						</div>
						<!-- END .social-list -->
					
					</div>
					<!-- END .team-header-info -->
				
					<!-- START .team-member-content -->
					<div class="team-member-content">
						<?php the_content(); ?>
					</div>
					<!-- END .team-member-content -->
				
				</div>
				<!-- END .team-member-description -->
			
			</div>
			<!-- END .team-member-box -->
		
		</div>
		
		
		<?php if ( $counter % $page_staff_size == 0  && $counter != $post_count_staff ) { ?>
			<div class="clear"></div>
			<div class="spacer"></div>
		<?php } else if ( $counter == $post_count_staff ) { ?>
			<div class="clear"></div>
		<?php } ?>
		
	<?php endwhile; ?>	
	
	<?php hb_pagination(); ?>
		
	<?php wp_reset_query(); ?>
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>