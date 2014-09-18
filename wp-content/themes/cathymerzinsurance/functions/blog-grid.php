<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which prints a grid blog post
function print_blog_grid_post ( $post_id ) {
	$post_format = get_post_format ( $post_id );

	$output = '';

	switch ( $post_format ) {
		
		case 'aside' :
			$output .= print_aside_grid_post( $post_id );
		break;

		case 'gallery' :
			$output .= print_gallery_grid_post( $post_id );
		break;

		case 'video' :
			$output .= print_video_grid_post( $post_id );
		break;

		case 'link' :
			$output .= print_link_grid_post( $post_id );
		break;

		default :
			$output .= print_image_grid_post( $post_id );
		break;
	}

	return $output;	
}


// Print Aside Grid Post
function print_aside_grid_post( $post_id ) {
	
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );
	
	$output = '<!-- BEGIN .blog-post aside -->';
	$output .= '<div class="post blog-post col-4 link-post">';
	$output .= '<span class="service-arrow">:</span>';
	$output .= '<!-- START .blog-post-excerpt -->';
	$output .= '<div class="blog-post-excerpt">';
	$output .= do_shortcode ( get_the_content() );
	$output .= '</div>';
	$output .= '<!-- END .blog-post-excerpt -->';
	$output .= '</div>';
	$output .= '<!-- END .blgo-post-aside -->';
	
	wp_reset_postdata();

	return $output;
}

// Print Link Grid Post
function print_link_grid_post( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );
	$post_link = get_post_meta ( $post_id , 'hb_link_post_link' , true );
	
	$output = '<!-- START .link-post -->';
	$output .= '<div class="post blog-post col-4 link-post">';
	$output .= '<span class="service-arrow">e</span>';
	$output .= '<!-- START .blog-post-excerpt -->';
	$output .= '<div class="blog-post-excerpt">';
	$output .= '<h2><a href="' . $post_link . '">' . $post_link . '</a></h2>';
	$output .= do_shortcode ( get_the_content() );
	$output .= '</div>';
	$output .= '<!-- END .blog-post-excerpt -->';
	$output .= '</div>';
	$output .= '<!-- END .link-post -->';             
	
	wp_reset_postdata();

	return $output;
}

// Print Image Grid Post 
function print_image_grid_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	$output = '';

	// get featured image
	$thumb = get_post_thumbnail_id( $post_id ); 
	$full_thumb = wp_get_attachment_image_src ( $thumb , 'original' , false );

	$class = "image-post";
	if ( !$thumb ) $class="no-image-post";

	$output .= '<!-- BEGIN .image-post -->';
	$output .= '<div class="post blog-post col-4 ' . $class . '">';
		
	if ( $thumb ) {
 		$output .= '<a href="' . get_permalink() . '" class="post-featured-image">';
		$output .= '<img src="' . $full_thumb[0] . '" alt="' . get_the_title() . '" />';
		$output .= '</a>';
	}

	$output .= blog_post_excerpt ( $post_id , $thumb );

	$output .= blog_post_meta ( $post_id );

	$output .= '</div>';
	$output .= '<!-- END .image-post -->';
	wp_reset_postdata();

	return $output;
}

// Print Video Grid Post
function print_video_grid_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );

	$video_link = get_post_meta ( $post_id , 'hb_video_post_link' , true );
	
	$class = 'video-post';
	if ( !$video_link ) $class="no-image-post";

	$output = '';
	$output .= '<!-- START .blog-post video -->';
	$output .= '<div class="post blog-post col-4 ' . $class . '">';

	if ( $video_link ) {
		$output .= '<div class="fitVids">';
		$output .= clear_iframe ( $video_link );
		$output .= '</div>';
	}

	$output .= blog_post_excerpt( $post_id , $video_link != "" );

	$output .= blog_post_meta ( $post_id );
	$output .= '</div>';
	$output .= '<!-- END .blog-post video -->';
	
	wp_reset_postdata();

	return $output;
}

// Print Gallery Grid Post
function print_gallery_grid_post ( $post_id ) {
	global $post;
	$post = get_post ( $post_id );
	$post_slider = get_post_meta ( $post_id , 'hb_gallery_post_slider' , true );
	setup_postdata ( $post );

	$class = "gallery-post";
	if ( $post_slider == __("None","hbthemes") ) $class="no-image-post";

	$output = '';
	$output .= '<!-- START .blog-post gallery -->';
	$output .= '<div class="post blog-post col-4 ' . $class . '">';

	if ( $post_slider != __("None" ,"hbthemes") ) {
		$output .= putFlexSlider ( $post_slider ); 
	}

	$output .= blog_post_excerpt( $post_id , $post_slider != __("None" ,"hbthemes") );	

	$output .= blog_post_meta ( $post_id );

	$output .= '</div>';
	$output .= '<!-- END .blog-post gallery -->';
	
	wp_reset_postdata();

	return $output; 
}


// Print blog post excerpt
function blog_post_excerpt ( $post_id , $has_arrow ) {
	global $post;
	$post = get_post ( $post_id );
	setup_postdata ( $post );
	$output = '';
	$output .= '<!-- START .blog-post-excerpt -->';
	$output .= '<div class="blog-post-excerpt">';
	if ( $has_arrow ) {
		$output .= 	'<span class="arrow-up"></span>';
	}
	$output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
	$output .= get_the_excerpt();
	$output .= '</div>';
	$output .= '<!-- END .blog-post-excerpt -->';
	
	wp_reset_postdata(); 

	return $output;
}

// Print blog post meta
function blog_post_meta ( $post_id ) {
	global $post, $data;
	$post = get_post ( $post_id );
	setup_postdata ( $post );
	$output = '';
	$output .= '<!-- START .blog-post-meta -->';
	$output .= '<div class="blog-post-meta clearfix">';
	$output .= '<a class="meta-post post-date">' . get_the_time( 'jS F Y' ) . '</a>';
			
	if ( $data['hb_include_like']) {
		$output .= '<div class="like-count-sec meta-post post-likes">';
		$output .= hb_printLikesSingle( $post_id );
		$output .= '</div>';
	}
			
	$output .= '<div class="from-the-blog-meta">';
	if ( comments_open() )
		$output .= '<a href="' . get_comments_link ( get_the_ID() ) . '" title="' . __( 'View comments.' , 'hbthemes' ) . '" class="meta-post comment-count"><span class="icon"></span>' . get_comments_number( get_the_ID() ) . '</a>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<!-- END .blog-post-meta -->';

	wp_reset_postdata();

	return $output;
}
?>