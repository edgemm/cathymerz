<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

?>

<?php get_header(); ?>

<?php 
if (have_posts()) : while (have_posts()) : the_post();

	$add_about_author = get_post_meta ( get_the_ID() , 'hb_about_author' , true );
	
	print_blog_sidebar_post ( get_the_ID() );
	?>
	<!-- START .from-the-blog-meta -->
	<ul class="from-the-blog-meta clearfix">
		<li class="published print-tag"><?php the_tags(__('Tagged: ','hbthemes'), ', ', '') ?></li>
		
		<?php if ( comments_open() ) { ?>
			<li class="comment-count"><a href="<?php comments_link(); ?>" title="<?php _e( 'View comments.' , 'hbthemes' ); ?>" class="meta-post comment-count"><span class="icon"></span><?php comments_number('0','1','%');?></a></li>
		<?php } ?>
		
		<li class="like-count"><?php echo hb_printLikesSingle( get_the_ID() ); ?></li>
	</ul>
	<!-- END .from-the-blog-meta -->
	
	<div class="spacer"></div>
	
	<?php if ( $add_about_author == "on" ) { ?>
	
	<!-- BEGIN .about-the-author -->
	<div class="about-the-author">
		<div class="about-the-author-inner clearfix">
			<div class="about-image-wrapper">
				<a href="<?php echo get_author_posts_url ( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta('user_email') , 80); ?>
				</a>
			</div>
			
			<div class="about-the-author-text">
				<h6><?php _e('About the author', 'hbthemes'); ?></h6>
				<p><?php echo get_the_author_meta('description'); ?></p>
			</div>
		</div>
	</div>
	<!-- END .about-the-author -->
	
	<div class="spacer" style="height:5px"></div>
	<?php } ?>
	
	<?php
endwhile; 
endif;
?>

<?php get_footer(); ?>