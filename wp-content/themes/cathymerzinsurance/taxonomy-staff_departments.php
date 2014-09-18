<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
global $data, $wp_query;
?>

<?php get_header(); 

if ( get_query_var('paged') ) {
	   $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

if ( have_posts() ) : 

$post_count_staff = $wp_query->post_count;
$page_staff_size = 3;
$counter = 0;



while ( have_posts() ) : the_post() ;
	$counter++;
	$last_column_class = "";
		
	$thumb = get_post_thumbnail_id(); 
	$image = hb_resize( $thumb, '', 450, 301, true );
	$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( $post-> ID ), 'original') ;
		
	if ( $counter % $page_staff_size == 0 ) $last_column_class = " last-column";
	else $last_column_class = "";
	?>
		
	<div class="col-4 <?php echo $last_column_class ; ?>">
		
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
	<?php }
endwhile;
endif;
hb_pagination();
get_footer(); ?>