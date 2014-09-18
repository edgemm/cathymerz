<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Archive
 
*/

global $data;
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } ?>

	<!-- BEGIN .sitemap-wrap -->
		<div id="sitemap-wrap" class="clearfix">

			<div class="sitemap-container col-4">
				<h2><?php _e('Latest 30 Posts' , 'hbthemes'); ?></h2>
				<?php  $args = array(
						'numberposts'     => 30,
						'offset'          => 0,
						'orderby'         => 'post_date',
						'order'           => 'DESC',
						'post_type'       => 'post',
						'post_status'     => 'publish' );
                ?>
				<?php $post_list = get_posts( $args ); ?>
				<ul>
				<?php foreach ( $post_list as $post_element) { 
				//echo '<li>'.$post_element->ID.'</li>';
					echo '<li><a href="'.get_permalink( $post_element->ID ).'" title="'.get_the_title( $post_element->ID ).'">'.get_the_title( $post_element->ID ).'</a></li>';
				} ?>
				</ul>
				
				<h2><?php _e('Archives by Month','hbthemes'); ?></h2>
	            <ul>
	                <?php wp_get_archives('type=monthly&limit=10'); ?>
	            </ul>

	            <h2><?php _e('Archives by Year','hbthemes'); ?></h2>
	            <ul>
	                <?php wp_get_archives('type=yearly&limit=10'); ?>
	            </ul>
			</div>

			<div class="sitemap-container col-4">
				<h2><?php _e('Browse by Format', 'hbthemes'); ?></h2>
				<ul>
					<li><a title="<?php _e('Aside Posts', 'hbthemes'); ?>" href="<?php echo get_post_format_link('aside'); ?>"><?php _e('Aside Posts', 'hbtheme'); ?></a></li>
					<li><a title="<?php _e('Link Posts', 'hbthemes'); ?>" href="<?php echo get_post_format_link('link'); ?>"><?php _e('Link Posts', 'hbtheme'); ?></a></li>
					<li><a title="<?php _e('Video Posts', 'hbthemes'); ?>" href="<?php echo get_post_format_link('video'); ?>"><?php _e('Video Posts', 'hbtheme'); ?></a></li>
					<li><a title="<?php _e('Gallery Posts', 'hbthemes'); ?>" href="<?php echo get_post_format_link('gallery'); ?>"><?php _e('Gallery Posts', 'hbtheme'); ?></a></li>
				</ul>
				
				<h2><?php _e('Browse by Categories' , 'hbthemes'); ?></h2>
				<?php $args = array(
                      'orderby'            => 'name',
                      'order'              => 'ASC',
                      'style'              => 'list',
                      'show_count'         => 0,
                      'hide_empty'         => 1,
                      'use_desc_for_title' => 1,
                      'child_of'           => 0,
                      'hierarchical'       => true,
                      'title_li'           => '',
                      'number'             => NULL
                    );
                ?>
				<ul><?php wp_list_categories( $args ); ?></ul>

                <h2><?php _e('Tags','hbthemes'); ?></h2>
	            <?php wp_tag_cloud(array(
	                'format' => 'list',
	                'smallest' => 12,
	                'largest' => 12,
	                'unit' => 'px',
	                'number' => 20,
	                'orderby'  => 'name',
	                'order' => 'ASC',
	                'taxonomy' => 'post_tag'
	                ));
	            ?>
			</div>

			<div class="sitemap-container col-4 last-column">
				<h2><?php _e('Pages' , 'hbthemes'); ?></h2>
				<ul><?php wp_list_pages("title_li="); ?></ul>
			</div>

		</div>
		<!-- END .sitemap-wrap -->
		
<?php endwhile; endif; ?>
<?php get_footer(); ?>