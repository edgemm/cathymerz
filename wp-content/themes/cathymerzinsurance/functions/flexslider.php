<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which add flex slider
function putFlexSlider ( $slider_name ) { 

	$slides = array();
	$slides = getFlexSlides ( $slider_name );
	$unique_class = "flexslider_".rand(0,20000);

	$output = '<!-- START .flexslider -->';
	$output .= '<div class="flexslider ' . $unique_class . '">';

	$output .= putFlexSlides ( $slides );

	$output .= '</div>';
	$output .= '<!-- END .flexslider -->';

	$output .= putFlexJS ( $unique_class );

	return $output;
}


function getFlexSlides ( $slider_name ) {
	$flex_slides = array();
	$loop = new WP_Query( array( 'post_type' => __('flexslider','hbthemes'), 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );
	while ( $loop->have_posts() ) : $loop->the_post(); 	

		// get name of the slide parent slider
		$slide_attached_slider = get_post_meta ( get_the_ID() , 'hb_flexslider' , true );
		
		// check if it's same
		if($slide_attached_slider == $slider_name ) {
			$slide_id = get_the_ID();
			array_push($flex_slides, $slide_id );
		}

	endwhile;

	//wp_reset_query();
	return $flex_slides;
}


function putFlexJS( $unique_class ) {
	$output = '<script type="text/javascript">';

	$output .= 'jQuery(document).ready ( function() { ';
	$output .= 'if (jQuery(".' . $unique_class . '").length ){ ';
	$output .= 'jQuery(".' . $unique_class . '").fitVids().flexslider(); ';
	$output .= '}';
	$output .= '});';

	$output .= '</script>';
	return $output;
}

function clear_iframe ( $video_link ) {
	$post = strpos ( $video_link , '</iframe>');
	if ( $post ) {
		$video_link = substr ( $video_link , 0 , $post + 9 );
		return $video_link;
	}
	return false;
}

function putFlexSlides ( $slides ) {
	$rand_num = rand(0,20000);

	$output = '<ul class="slides clearfix">';
	if ( is_array ( $slides ) ) {
		foreach ($slides as $slide) {
			$slide_post = get_post($slide);
			$slide_image = get_post_meta ( $slide , 'hb_image_slider_uploaded_image' , true );
			$slide_video = get_post_meta ( $slide , 'hb_image_slider_video' , true );
			$slide_link = get_post_meta ( $slide , 'hb_image_slider_link' , true );
			$slide_caption = get_post_meta ( $slide , 'hb_image_slider_caption_text' , true );
						
			$output .= '<li>';
						
			if ( $slide_image ) {
				$output .= '<a href="'.$slide_image.'" class="fancybox" rel="single_portfolio_'.$rand_num.'">';
				$output .= '<img src="' . $slide_image . '" />';
				$output .= '</a>';
			} else if ( $slide_video ) {
				$output .= clear_iframe ( $slide_video );
			}
						
			$output .= '</li>';
		}  
	}
	
	$output .= '</ul>';

	return $output;
}

?>