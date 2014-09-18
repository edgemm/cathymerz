<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which prints blog sidebar posts
function print_blog_sidebar_post ( $post_id ) {
	wp_reset_postdata();
	?>
	<!-- BEGIN .blog-post-sec -->
	<div class="blog-post-sec clearfix">
	<?php 
	$post_format = get_post_format ( $post_id );
	switch ( $post_format ) {
		
		case 'aside' :
			print_aside_sidebar_post( $post_id );
		break;

		case 'gallery' :
			print_gallery_sidebar_post( $post_id );
		break;

		case 'video' :
			print_video_sidebar_post( $post_id );
		break;

		case 'link' :
			print_link_sidebar_post( $post_id );
		break;

		default :
			print_image_sidebar_post( $post_id );
		break;
	}
	?>
	</div>
	<!-- END .blog-post-sec -->
	
	<?php if ( is_single () ) { ?>
		<div class="separator" id="blog-content-separator"></div>
	<?php } else { ?>
		<div class="separator"></div>
	<?php }
}

function print_aside_sidebar_post( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	print_blog_header ( $post_id );
	?>

	<div class="blog-excerpt">
	<?php the_content(); ?>
	</div>

	<?php
	wp_reset_postdata();
}

function print_link_sidebar_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	print_blog_header ( $post_id );
	?>

	<div class="blog-excerpt">
	<?php the_content(); ?>
	</div>

	<?php
	wp_reset_postdata();
}

function print_gallery_sidebar_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	$gallery_post = get_post_meta ( $post_id , 'hb_gallery_post_slider' , true );

	print_blog_header ( $post_id );
	?>

	<?php if ( $gallery_post != __("None","hbthemes") ) { ?>
		<div class="blog-slider-post">
			<?php echo putFlexSlider ( $gallery_post ); ?>
		</div>		
	<?php } 

	$post = get_post ( $post_id );
	setup_postdata ( $post );

	?>

	<div class="blog-excerpt">
	<?php if ( is_single() ) { the_content (); } else { the_excerpt(); } ?>
	</div>
	
	
	<?php if ( !is_single() ) { ?>
	<a href="<?php the_permalink();?>" class="read-more-button"><?php _e('Read more<span class="icon-chevron-right"></span>' , 'hbthemes' ); ?></a>
	<?php }
	
	wp_reset_postdata();
}

function print_video_sidebar_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	$video_link = clear_iframe ( get_post_meta ( $post_id , 'hb_video_post_link' , true ) );

	print_blog_header ( $post_id );
	?>

	<?php if ( $video_link ) { ?>
		<div class="blog-slider-post fitVids">
			<?php echo $video_link; ?>
		</div>		
	<?php }	?>

	<div class="blog-excerpt">
	<?php if ( is_single() ) { the_content (); } else { the_excerpt(); } ?>
	</div>
	
	
	<?php if ( !is_single() ) { ?>
	<a href="<?php the_permalink();?>" class="read-more-button"><?php _e('Read more<span class="icon-chevron-right"></span>' , 'hbthemes' ); ?></a>
	<?php }
	
	wp_reset_postdata();
}

function print_image_sidebar_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	// get featured image
	$thumb = get_post_thumbnail_id( $post_id ); 
	$full_thumb = wp_get_attachment_image_src ( $thumb , 'original' , false );

	print_blog_header ( $post_id );
	?>

	<?php if ( $thumb ) { ?>
		<?php if ( is_single() ) { ?>
		<a href="<?php echo $full_thumb[0]; ?>" class="post-featured-image fancybox"><img src="<?php echo $full_thumb[0]; ?>" alt="<?php the_title(); ?>" /></a>

		<?php } else { ?>
		<a href="<?php the_permalink(); ?>" class="post-featured-image"><img src="<?php echo $full_thumb[0]; ?>" alt="<?php the_title(); ?>" /></a>

		<?php } ?>
	<?php } ?>

	<div class="blog-excerpt">
	<?php if ( is_single() ) { the_content (); } else { the_excerpt(); } ?>
	</div>
	
	
	<?php if ( !is_single() ) { ?>
	<a href="<?php the_permalink();?>" class="read-more-button"><?php _e('Read more<span class="icon-chevron-right"></span>' , 'hbthemes' ); ?></a>
	<?php }
	
	wp_reset_postdata();
}

function print_blog_header ( $post_id ) {
	
	$post_format = get_post_format ( $post_id );
	$link_format_link = get_post_meta ( $post_id , 'hb_link_post_link' , true );

	?>
	<!-- START .blog-head -->
	<div class="blog-head clearfix">
		<!-- START .blog-meta-info -->
		<div class="blog-meta-info">
			<span class="post-date"><?php the_time('j'); ?></span>
			<br/>
			<span class="post-month"><?php the_time('M'); ?></span>
		</div>
		<!-- END .blog-meta-info -->

		<!-- START .blog-meta-title -->
		<div class="blog-meta-title">
			<h2><?php 
				if ( $post_format == "aside" ) { ?>
				<a><?php the_title(); ?></a>
				<?php } else if ( $post_format == 'link' ) { ?>
				<a href="<?php echo $link_format_link; ?>"><?php echo $link_format_link; ?></a>
				<?php } else { ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php }
			?></h2>
			<div class="separator"></div>
			<div class="blog-meta-details">

				<?php 
				// Author
				_e ('Posted by ', 'hbthemes' ); 
				the_author_posts_link();

				// Categories
				_e ( ' in ' , 'hbthemes'); 
				$i=0; 
				$catArray = get_the_category ( get_the_ID() );
				foreach ( $catArray as $tempCat) {
					$i++;
					echo '<a href="'.get_category_link( $tempCat->cat_ID ).'">'.$tempCat->cat_name.'</a>';
					if ( $i < count($catArray) ) echo ', ';
				} 

				// Comments
				
				if ( $post_format != 'aside' && $post_format != 'link' && comments_open() ) {
					echo ' with ';
					echo '<a href="';
					comments_link(); 
					echo '">';
					comments_number('0 comments','1 comment','% comments');
					echo '</a>';
				} ?>.

			</div>
		</div>
		<!-- END .blog-meta-title -->
	</div>
	<!-- END .blog-head -->
	<?php
}
?>