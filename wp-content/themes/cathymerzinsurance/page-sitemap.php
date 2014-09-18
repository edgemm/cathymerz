<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Sitemap
 
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
				<h2><?php _e('Pages' , 'hbthemes'); ?></h2>
				<?php $args = array(
						'depth'        => 0,
						'show_date'    => '',
						'date_format'  => get_option('date_format'),
						'child_of'     => 0,
						'exclude'      => '',
						'include'      => '',
						'title_li'     => '',
						'echo'         => 1,
						'authors'      => '',
						'sort_column'  => 'menu_order, post_title',
						'link_before'  => '',
						'link_after'   => '',
						'walker'       => '',
						'post_type'    => 'page',
						'post_status'  => 'publish' 
					);?>
				<ul><?php wp_list_pages($args); ?></ul>
			</div>

			<div class="sitemap-container col-4">
				<h2><?php _e('Blog Categories' , 'hbthemes'); ?></h2>
				<?php $args = array(
                      'orderby'            => 'name',
                      'order'              => 'ASC',
                      'style'              => 'list',
                      'show_count'         => 0,
                      'hide_empty'         => 1,
                      'use_desc_for_title' => 1,
                      'child_of'           => 0,
                      'hierarchical'       => false,
                      'title_li'           => '',
                      'number'             => NULL
                    );
                ?>
				<ul><?php wp_list_categories( $args ); ?></ul>

				<h2><?php _e('Portfolio Categories','hbthemes'); ?></h2>
		            <?php $port_args = array(
		                'taxonomy' => 'portfolio_cats',
		                'orderby' => 'name',
		                'order' => 'ASC',
		                'style' => 'list',
		                'show_count' => 0,
		                'hide_empty' => 1,
		                'use_desc_for_title' => 1,
		                'child_of' => 0,
		                'hierarchical' => false,
		                'title_li' => '',
		                'number' => NULL
		              );
		            ?> 
	            <ul>
	                <?php wp_list_categories( $port_args ); ?>
	            </ul>
			</div>

			<div class="sitemap-container col-4 last-column">
				
				<h2><?php _e('Feeds','hbthemes'); ?></h2>
                <ul>  
                    <li><a title="<?php _e( 'Main RSS' , 'hbthemes'); ?>" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e( 'Main RSS' , 'hbthemes'); ?></a></li>  
                    <li><a title="<?php _e('Comments Feed' , 'hbthemes'); ?>" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments Feed' , 'hbthemes'); ?></a></li>  
                </ul>

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

	            <h2><?php _e('Archives by Month','hbthemes'); ?></h2>
	            <ul>
	                <?php wp_get_archives('type=monthly&limit=10'); ?>
	            </ul>

	            <h2><?php _e('Archives by Year','hbthemes'); ?></h2>
	            <ul>
	                <?php wp_get_archives('type=yearly&limit=10'); ?>
	            </ul>

			</div>

		</div>
		<!-- END .sitemap-wrap -->
		
<?php endwhile; endif; ?>
<?php get_footer(); ?>