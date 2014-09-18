<?php
/**
* @package WordPress
* @subpackage Notable
*/

// Section
function hb_section_shortcode($atts, $content = null)
{
	return '<div class="section clearfix">' . do_shortcode($content) . '</div>';    
}
add_shortcode('section', 'hb_section_shortcode');

// Fullwidth Boxes

function hb_boxes_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(        
		'margin_top' => '0px',
	), $atts));

	return '<div class="fullwidth-services clearfix" style="margin-top:' . $margin_top .';">' . do_shortcode($content) . '</div>';    
}
add_shortcode('boxes', 'hb_boxes_shortcode');


// Fullwidth Box
function hb_box_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(        
		'size' => 'one-fourth',        
		'icon' => '',        
		'title' => '',        
		'link' => '',        
		'last_column' => false,        
		'new_tab' => false        
	), $atts));

	if ($size)
		$size = ' ' . $size;
	
	if ($last_column == "true")
		$last_column = ' last-column';

	$output = '<div class="fullwidth-service' . $size . $last_column . '"><div>';    

	// Icon    
	if ($icon) {
		$output .= '<div class="icon-image"><span class="' . $icon . '"></span></div>';        
	}

	if ($title) {
		$output .= '<h4>';
		
		if ($link) {
			$output .= '<a href="' . $link . '"';
			
			if ($new_tab == "true")
				$output .= ' target="_blank"';

			$output .= '>';	
		}

		$output .= $title;
		
		if ($link)
		$output .= '</a>';
		$output .= '</h4>';
	}

	$output .= '<p>' . do_shortcode($content) . '</p>';    
	$output .= '</div>';    

	$output .= '</div>';

	return $output;
}
add_shortcode('box', 'hb_box_shortcode');

// Accordion
function hb_accordion_shortcode($atts, $content = null)
{
	return '<div class="accordion-unit clearfix">' . do_shortcode($content) . '</div>';    
}
add_shortcode('accordion', 'hb_accordion_shortcode');


// Accordion Item
function hb_accordion_item_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(        
		'title' => ''        
	), $atts));

	$output = '<span class="trigger-button"><span>' . $title . '</span></span>';
	$output .= '<div class="accordion"><div class="accordion-wrap">' . do_shortcode($content) . '</div></div>';
	
	return $output;
}
add_shortcode('accordion_item', 'hb_accordion_item_shortcode');


// Toggle 
function hb_toggle_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(        
		'title' =>'Title'        
	), $atts));

	$output = '<div class="toggle-unit clearfix">';    
	$output .= '<div class="toggle-wrap">';    
	$output .= '<span class="trigger">';    
	$output .= '<a href="#"><span class="trig-wrap">' . $title . '</span></a>';    
	$output .= '</span>';
	$output .= '<div class="toggle-container-wrapper">';    
	$output .= '<div class="toggle-container">';    
	$output .= do_shortcode($content);    
	$output .= '</div>';    
	$output .= '</div>';    
	$output .= '</div>';    
	$output .= '</div>';

	return $output;
}
add_shortcode('toggle', 'hb_toggle_shortcode');


// Service Column
function hb_service_shortcode($atts, $content = null){

	extract(shortcode_atts(array(
		'size' =>'col-12',        
		'last_column' =>'false',
		'title' =>'',
		'link' =>'',
		'icon' =>'',
		'layers'=>'',
	), $atts));

	// Set Classess    
	$last_class = "";    
	$layers_class = "";

	if ($last_column == "true")
		$last_class .= " last-column";

	if ( $layers == 'true' ) $layers = ' layers';
	else $layers = '';
	// Start output    
	$output = '<div class="' . $size . $last_class . '">';
	$output .= '<div class="service' . $layers . '">';    
	$output .= '<div class="service-arrow">' . $icon . '</div>';

	// Title
	$output .= '<h4>';

	if ($link != "") {
		$output .= '<a href="' . $link . '">' . $title . '</a>';
	} else {
		$output .= $title;
	}    
	
	$output .= '</h4>';

	// Content    
	$output .= '<p>' . do_shortcode($content) . '</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode('service', 'hb_service_shortcode');

// Separator
function hb_separator_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'icon' =>'',
		'hover_text' =>'',
		'text' =>'',
		'small' =>'',
		'to_top' =>''
	), $atts));

	$output = '';
	
	if ($icon)
		$output = '<div class="separator"><div class="separator-icon" title="' . $hover_text . '"><span class="' . $icon . '" title="' . $hover_text . '"></span></div></div>';

	else if ($text)
		$output = '<div class="separator"><div class="separator-text" style="left: 393px; " title="' . $hover_text . '">' . $text . '</div></div>';

	else if ($small == 'true')
		$output = '<div class="separator-small"></div>';

	else if ($to_top == 'true')
		$output = '<div class="separator"><a href="#" class="separator-top" original-title="' . __('Scroll to top', 'hbthemes') . '"><span></span></a></div>';

	else 
		$output = '<div class="separator"></div>';

	return $output;
}
add_shortcode('separator', 'hb_separator_shortcode');


// Shortcode Separator
function hb_separatornew_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'hover_text' =>'',
	), $atts));

	$output = '<div class="separator"><div class="separator-text" style="left: 393px; " title="' . $hover_text . '">' . do_shortcode($content) . '</div></div>';

	return $output;
}
add_shortcode('separator_shortcode', 'hb_separatornew_shortcode');


// Focus Color
function hb_focus_color_shortcode($atts, $content = null)
{
	return '<span class="focus-color">' . do_shortcode($content) . '</span>';
}
add_shortcode('focus_color', 'hb_focus_color_shortcode');


// Columns
function hb_column_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'col-12',
		'last_column' =>'false',
		'bottom_margin' =>'true'
	), $atts));


	$last_class = "";

	if ($last_column == "true")
		$last_class .= " last-column";

	if ($bottom_margin == "false")
		$last_class .= ' no-margin';

	return '<div class="' . $size . $last_class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('column', 'hb_column_shortcode');

// Gallery 
function hb_gallery_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'number' =>8,
		'size' =>'col-3'
	), $atts));

	$args = array(
		'post_type' =>'attachment',
		'numberposts' => $number,
		'post_status' => null,
		'post_parent' => get_the_ID(),
		'orderby' =>'menu_order',
		'order' =>'DESC'
	);


	// To figure out when to put last-column class
	$counter = 0;
	$clear_counter = 1;

	switch ($size) {

		case 'col-3':
			$clear_counter = 4;
		break;
		
		case 'col-4':
			$clear_counter = 3;
		break;

		case 'col-6':
			$clear_counter = 2;
		break;
	}


	$attachments = get_posts($args);
	$output = '<div class="section gallery-section clearfix">';

	$unique_rel = 'gallery-group-' . rand(1, 10000);

	if ($attachments) {

		foreach ($attachments as $attachment) {

			$full_thumb = wp_get_attachment_image_src($attachment->ID, 'original');
			$image = hb_resize(null, $full_thumb[0], 438, 329, true);
			$counter++;

			$classes = "";

			if ($counter % $clear_counter == 0)
				$classes = ' last-column';

			$output .= '<div class="gallery-item ' . $size . $classes . '">';
			$output .= '<div class="inner-glare">';
			$output .= '<a href="' . $full_thumb[0] . '" class="fancybox" rel="' . $unique_rel . '">';
			$output .= '<img src="' . $image['url'] . '">';
			$output .= '</a>';
			$output .= '<p style="bottom:-50px; opacity:0;">' . $attachment->post_title . '</p>';
			$output .= '</div>';
			$output .= '</div>';
		}
	}    

	$output .= '</div>';    
	return $output;    
}
add_shortcode('hb_gallery', 'hb_gallery_shortcode');


// Icon Column

function hb_icon_column_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'col-6',
		'last_column' =>'false',
		'icon' =>'',
		'title' =>'Title',
		'link' =>'#',
		'color' =>'',
		'bottom_margin' =>'true'
	), $atts));


	if (strlen($color >0))
		if ($color[0] == '#')
			$color = substr($color, 1, strlen($color));


	$output = "";
	$icon_html = "";


	$icon_html = '<span class="' . $icon . '" style="font-size:1.7em; color:#' . $color . '; display:inline-block; width:30px;"></span>';

	if ($last_column == "true")
		$size .= ' last-column';

	if ($bottom_margin == "false")
		$size .= ' no-margin';

	$output .= '<div class="' . $size . '">';

	if ($link)
		$output .= '<a href="' . $link . '">';
		$output .= '<h6 class="no-margin">' . $icon_html . $title . '</h6>';

	if ($link)
		$output .= '</a>';
	
	$output .= '<p>' . do_shortcode($content) . '</p>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('icon_column', 'hb_icon_column_shortcode');

// Read More Type Button
function hb_readmore_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'link' =>'#',
		'ribbon' =>'false'
	), $atts));

	if ($ribbon == 'true')
		$ribbon = ' ribbon';
	else
		$ribbon = '';

	return '<a href="' . $link . '" class="read-more-button' . $ribbon . '">' . do_shortcode($content) . '<span class="arrow-in-button"></span></a>';
}
add_shortcode('read_more_button', 'hb_readmore_shortcode');


// Heading 1
function hb_h1_shortcode($atts, $content = null)
{
	return '<h1>' . do_shortcode($content) . '</h1>';
}
add_shortcode('h1', 'hb_h1_shortcode');

// Heading 2
function hb_h2_shortcode($atts, $content = null)
{
	return '<h2>' . do_shortcode($content) . '</h2>';
}
add_shortcode('h2', 'hb_h2_shortcode');

// Heading 3
function hb_h3_shortcode($atts, $content = null)
{
	return '<h3>' . do_shortcode($content) . '</h3>';
}
add_shortcode('h3', 'hb_h3_shortcode');


// Heading 4
function hb_h4_shortcode($atts, $content = null)
{
	return '<h4>' . do_shortcode($content) . '</h4>';
}
add_shortcode('h4', 'hb_h4_shortcode');



// Heading 5
function hb_h5_shortcode($atts, $content = null)
{
	return '<h5>' . do_shortcode($content) . '</h5>';
}
add_shortcode('h5', 'hb_h5_shortcode');


// Heading 6
function hb_h6_shortcode($atts, $content = null)
{
	return '<h6>' . do_shortcode($content) . '</h6>';
}
add_shortcode('h6', 'hb_h6_shortcode');


// Focus Heading
function hb_h1_focus_heading_shortcode($atts, $content = null)
{
	return '<h1 class="focus-heading">' . do_shortcode($content) . '</h1>';
}
add_shortcode('h1_focus_heading', 'hb_h1_focus_heading_shortcode');


function hb_h2_focus_heading_shortcode($atts, $content = null)
{
	return '<h2 class="focus-heading">' . do_shortcode($content) . '</h2>';
}
add_shortcode('h2_focus_heading', 'hb_h2_focus_heading_shortcode');



function hb_h3_focus_heading_shortcode($atts, $content = null)
{
	return '<h3 class="focus-heading">' . do_shortcode($content) . '</h3>';
}
add_shortcode('h3_focus_heading', 'hb_h3_focus_heading_shortcode');


function hb_focus_heading_shortcode($atts, $content = null)
{
	return '<h4 class="focus-heading">' . do_shortcode($content) . '</h4>';
}
add_shortcode('h4_focus_heading', 'hb_focus_heading_shortcode');


function hb_h5_focus_heading_shortcode($atts, $content = null)
{
	return '<h5 class="focus-heading">' . do_shortcode($content) . '</h5>';
}
add_shortcode('h5_focus_heading', 'hb_h5_focus_heading_shortcode');


function hb_h6_focus_heading_shortcode($atts, $content = null)
{
	return '<h6 class="focus-heading">' . do_shortcode($content) . '</h6>';
}
add_shortcode('h6_focus_heading', 'hb_h6_focus_heading_shortcode');


// Service Type 2
function hb_service_type_2_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' =>'',
		'link' =>'',
		'icon' =>'',
		'boxed' =>'',
		'new_tab' => '',
	), $atts));


	if ($boxed == "true")
		$boxed = ' boxed-service';

	else
		$boxed = "";

	$output = '<div class="service-alt' . $boxed . '">';

	if ($icon)
		$output .= '<div class="icon-image"><span class="' . $icon . '"></span></div>';

	if ($title) {
		$output .= '<h4>';

		if ($link) {
			$output .= '<a href="' . $link . '"';
			if ( $new_tab == 'true' ) $output .= ' target="_blank"';
			$output .= '>';
		}
			
		$output .= do_shortcode($title);

		if ($link)
			$output .= '</a>';

		$output .= '</h4>';
	}


	$output .= '<p>' . do_shortcode($content) . '</p>';
	$output .= '</div>';
	return $output;

}
add_shortcode('service_type_2', 'hb_service_type_2_shortcode');

// Blockquote 
function hb_blockquote_shortcode($atts, $content = null)
{
	return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}
add_shortcode('blockquote', 'hb_blockquote_shortcode');

// Tooltip
function hb_tooltip_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' =>''
	), $atts));

	return '<span class="tooltip" original-title="' . $title . '">' . do_shortcode($content) . '</span>';
}
add_shortcode('tooltip', 'hb_tooltip_shortcode');


// Callout Boxes
function hb_callout_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'',
		'last_column' =>'',
		'title' =>'',
		'description' =>'',
		'button_link' =>'',
		'button_title' =>'',
		'button_size' =>'xlarge',	
		'button_color' =>'orange',
		'button_rounded' =>'false',
		'button_icon' =>'',
		'button_in_new_tab' =>'',
		'flip_left_edge' =>'false',
		'flip_right_edge' =>'false'
	), $atts));

	$classes = '';
	$classes_inner = '';
	if ($flip_right_edge == 'true')
		$classes_inner = ' flip-edge';

	if ($flip_left_edge == 'true')
		$classes_inner = ' flip-edge left-edge';

	if ($button_in_new_tab == 'true')
		$button_in_new_tab = ' target="_blank"';

	if ($size)
		$classes = $size;

	else
		$classes .= ' col-12';

	if ($last_column == "true")
		$classes .= ' last-column';


	if ($button_color)
		$button_color = ' btn-' . $button_color;

	if ($button_size)
		$button_size = ' btn-' . $button_size;

	if ($button_rounded == 'true')
		$button_rounded = ' btn-rounded';
	else
		$button_rounded = '';

	$icon_class = '';
	$icon_html = '';
	
	if (  $button_icon ) {
			$icon_class = ' btn-with-icon';
			$icon_html = '<span class="' . $button_icon . '"></span>';
	}
	$output = "";

	$output .= '<div class="' . $classes . ' callout-wrapper-column">';
	$output .= '<div class="callout-box' . $classes_inner . '">';
	$output .= '<div class="callout-box-inner clearfix">';

	if ($button_title) {
		$output .= '<a href="' . $button_link . '"' . $button_in_new_tab . ' class="button ' . $icon_class . $button_color . $button_size . $button_rounded . '">' . $button_title ;
		if ($button_icon != "") {
			$output .= '<span class="icon">' . $icon_html . '</span>';
		}
		$output .= '</a>';
	}

	$output .= '<h2>' . $title . '</h2>';
	if ($description)
		$output .= '<p>' . $description . '</p>';
		
	$output .= '</div></div></div>';

	return $output;
}
add_shortcode('callout', 'hb_callout_shortcode');

// Newsletter
function hb_newsletter_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'col-6',
		'last_column' =>'false',
		'flip_left_edge' =>'false',
		'flip_right_edge' =>'false',
		'title' =>'',
		'description' =>'',
		'bottom_margin' =>'true'
	), $atts));

	$classes = '';
	$size_classes = '';

	if ($flip_right_edge == 'true')
		$classes = 'flip-edge';

	if ($flip_left_edge == 'true')
		$classes = 'flip-edge left-edge';

	if ($bottom_margin == 'false')
		$classes .= ' no-margin';


	if ($size)
		$size_classes = $size;

	if ($last_column == "true")
		$size_classes .= ' last-column';

	$output = '<div class="' . $size_classes . '">';
	$output .= '<div class="newsletter-box ' . $classes . '">';
	$output .= '<div class="newsletter-box-inner">';

	$action = get_action_for_form($content);

	if ($title)
		$output .= '<h4>' . $title . '</h4>';

	if ($description)
		$output .= '<p>' . $description . '</p>';

	$output .= '<form class="newsletter-box-form" action="' . $action . '" method="post" novalidate>

	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="' . __('Email address', 'hbthemes') . '" />

	<input type="submit" value="' . __('Subscribe', 'hbthemes') . '" name="subscribe" id="mc-embedded-subscribe" />

	</form>';

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode('newsletter_mailchimp', 'hb_newsletter_shortcode');

// Image
function hb_image_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'white_frame' =>'true',
		'width' =>'',
		'height' =>'',
		'fancybox_rel' =>'',
		'align' =>'left'
	), $atts));

	if ($fancybox_rel == "")
		$fancybox_rel = rand(1, 10000);

	$image = "";

	if ($width && $height)
		$image = hb_resize(null, do_shortcode($content), $width, $height, true);
	else
		$image['url'] = do_shortcode($content);

	// manage classes

	$classes = "";
	$align_class = "";

	if ($align != "")
		$align_class = "align" . $align;

	if ($white_frame == "true")
		$classes .= 'white-frame';

	if ($classes != "" && $align != "")
		$align_class = ' ' . $align_class;

	//construct output

	$output = '<a href="' . do_shortcode($content) . '" class="fancybox" rel="' . $fancybox_rel . '"><img class="' . $classes . $align_class . '" src="' . $image['url'] . '" /></a>';

	return $output;
}
add_shortcode('hb_image', 'hb_image_shortcode');



// Info Boxes
function hb_infoboxes_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'color' =>'',
		'size' =>'',
		'last_column' =>'false',
		'closable' =>'true',
		'bottom_margin' =>'true'
	), $atts));


	$color_class = "";
	$last_column_class = "";

	if ($color != "")
		$color_class = ' info-' . $color;

	if ($last_column == "true")
		$last_column_class .= " last-column";

	if ($bottom_margin == "false")
		$last_column_class .= " no-margin";

	if ($size)
		$size = ' ' . $size;

	$output = "";
	$output .= '<div class="info-box' . $color_class . $size . $last_column_class . '">';
	$output .= '<div class="info-box-inner">';
	$output .= '<p>' . do_shortcode($content) . '</p>';

	if ($closable == "true") {
		$output .= '<a href="#" class="close-info-box">X</a>';
	}

	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode('infobox', 'hb_infoboxes_shortcode');

// Social
function hb_social_shortcode($atts, $content = null)
{
	return '<ul class="social">' . do_shortcode($content) . '</ul>';
}
add_shortcode('social', 'hb_social_shortcode');


// Social Item
function hb_socialicon_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'type' =>'facebook',
		'link' =>'#',
		'in_new_tab' =>'false'
	), $atts));
	
	$target = "";

	if ($in_new_tab == "true")
		$target = ' target="_blank"';

	return '<li><a class="' . strtolower($type) . '" href="' . $link . '"' . $target . '></a></li>';

}
add_shortcode('social_icon', 'hb_socialicon_shortcode');



// Circle Feature Column
function hb_circle_column($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'col-4',
		'last_column' =>'false',
		'color' =>'',
		'title' =>'',
		'link' =>'',
		'number' =>'1',
		'icon' =>'',
		'bottom_margin' =>'true'
	), $atts));


	$color_class = " default-color";

	if ($color != "")
		$color_class = ' btn-' . $color;

	$last_class = "";

	if ($last_column == "true")
		$last_class .= ' last-column';

	if ($bottom_margin == "false")
		$last_class .= ' no-margin';

	$circle_content = '';

	if ($icon)
		$circle_content = '<span class="' . $icon . '"></span>';
	else
		$circle_content = $number;

	$output = '<div class="' . $size . $last_class . '">';
	$output .= '<div class="circle-feature-wrapper">';
	$output .= '<div class="circle-feature' . $color_class . '">' . $circle_content . '</div>';
	$output .= '<div class="circle-description">';
	$output .= '<h4>';

	if ($link)
		$output .= '<a href="' . $link . '">';

	$output .= $title;

	if ($link)
		$output .= '</a>';

	$output .= '</h4>';

	$output .= do_shortcode($content);

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	if ($last_class)
		$output .= '<div class="clear"></div>';

	return $output;
}
add_shortcode('circle_feature', 'hb_circle_column');


// Custom List
function hb_list_shortcode($atts, $content = null)
{
	return '<ul class="the-icons">' . do_shortcode($content) . '</ul>';
}
add_shortcode('list', 'hb_list_shortcode');


function hb_listitem_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'',
		'icon' =>'beaker',
		'hex_color' =>''
	), $atts));

	if ($size != "")
		$size = " icon-large";

	
	if (strlen($hex_color) > 0)
		if ($hex_color[0] == '#')
			$hex_color = substr($hex_color, 1, strlen($hex_color));

	if ($hex_color != "")
		$hex_color = ' style="color:#' . $hex_color . ';"';

	return '<li><span class="' . $icon . $size . '"' . $hex_color . '></span>' . do_shortcode($content) . '</li>';
}
add_shortcode('list_item', 'hb_listitem_shortcode');

// Icon
function hb_icon_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'20px',
		'color' =>'',
		'icon' =>'bolt'
	), $atts));

	if ($color != "") {
		if ($color[0] == '#')
			$color = substr($color, 1, strlen($color));
	}

	return '<span style="font-size:' . $size . '; display:inline-block; line-height:' . $size . '; width:' . $size . '; height:' . $size . '; color:#' . $color . '; margin:3px;" class="' . $icon . '"></span>';

}
add_shortcode('icon', 'hb_icon_shortcode');

// Flex Slider
function hb_flexslider_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'name' =>''
	), $atts));

	$output = '<div style="overflow:hidden; width:100%;">' . putFlexSlider($name) . '</div>';
	wp_reset_query();
	return $output;
}
add_shortcode('flexslider', 'hb_flexslider_shortcode');



// Buttons
function hb_button_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' =>'title',
		'link' =>'#',
		'size' =>'large',
		'color' =>'orange',
		'icon' =>'',
		'rounded' =>'false',
		'in_new_tab' =>'false'
	), $atts));

	$icon_class = "";

	$icon_html = $icon;
	$rounded_class = '';
	
	if ($icon != '') {
		if (strlen($icon) > 1) {
		$icon_class = " btn-with-icon";
			$icon_html = '<span class="' . $icon . '"></span>';
		}
	}

	$target_class = "";

	if ($in_new_tab == "true")
		$target_class = " target='_blank'";

	if ($rounded == 'true')
		$rounded_class = ' btn-rounded';

	$output = '<a href="' . $link . '"' . $target_class . ' class="button btn-' . $size . ' btn-' . $color . $icon_class . $rounded_class . '">';
	$output .= $title;
	if ($icon != "") {
		$output .= '<span class="icon">' . $icon_html . '</span>';
	}
	$output .= '</a>';
	
	return $output;
}
add_shortcode('button', 'hb_button_shortcode');


// Animation
function hb_animation_shortcode($atts, $content = null)
{

	extract(shortcode_atts(array(
		'animation' =>'shake',	
		'duration' =>'3s',
		'delay' =>'0',
		'iteration' =>'1'
	), $atts));

	$output = '<div class="animated ' . $animation . '" data-transition="' . $animation . '" style="animation-duration: ' . $duration . ';-moz-animation-duration: ' . $duration . ';-webkit-animation-duration: ' . $duration . ';-ms-animation-duration: ' . $duration . ';-o-animation-duration: ' . $duration . ';animation-delay: ' . $delay . ';-moz-animation-delay: ' . $delay . ';-webkit-animation-delay: ' . $delay . ';-ms-animation-delay: ' . $delay . ';-o-animation-delay: ' . $delay . ';animation-iteration-count: ' . $iteration . ';-moz-animation-iteration-count: ' . $iteration . ';-webkit-animation-iteration-count: ' . $iteration . ';-ms-animation-iteration-count: ' . $iteration . ';-o-animation-iteration-count: ' . $iteration . ';">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}
add_shortcode('animate', 'hb_animation_shortcode');

// From Portfolio
function hb_fromportfolio_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'category' =>'',
		'columns' =>'3',
		'number' =>-1
	), $atts));
	$output = '';
	$page_portfolio_cats = string_to_array_names_categories($category);
	$number = intval($number);

	// Extract portfolio items
	if ($category) {
		$loop = new WP_Query(array(
			'post_type' =>'portfolio',
			'orderby' =>'menu_order',
			'order' =>'ASC',
			'posts_per_page' =>$number,
			'tax_query' =>array(
				array(
					'taxonomy' =>'portfolio_cats',
					'field' =>'slug',
					'terms' =>$page_portfolio_cats
					)
				)
			));
	} else {
		$loop = new WP_Query(array(
			'post_type' =>'portfolio',
			'orderby' =>'menu_order',
			'order' =>'ASC',
			'posts_per_page' =>$number
			));
	}

	$output .= add_portfolio_items($loop, $columns);
	wp_reset_query();
	return $output;
}
add_shortcode('portfolio', 'hb_fromportfolio_shortcode');


// From Blog
function hb_fromblog_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'category' =>'',
		'number' =>-1
		), $atts));
	
	$output = '';

	if ($number)
		$number = intval($number);

	if ($category)
		$category = get_cat_ID($category);

	$args = array(
		'numberposts' =>$number,
		'category' =>$category
		);


	$blog_posts = get_posts($args);

	if (is_array($blog_posts)) {
		$output .= '<!-- START .posts-grid -->';
		$output .= '<div class="posts-grid clearfix">';

		foreach ($blog_posts as $blog_post) {
			$output .= print_blog_grid_post($blog_post->ID);
		}

		$output .= '</div>';
		$output .= '<!-- END .posts-grid -->';
	}

	return $output;
}
add_shortcode('blog', 'hb_fromblog_shortcode');

// Pricing table

function hb_pricingwrap_shortcode($atts, $content = null)
{
	return '<div class="pricing-table clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode('pricing_wrap', 'hb_pricingwrap_shortcode');

function hb_pricingitem_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'layers' =>'true',
		'title' =>'Title',
		'focus' =>'false',
		'button_title' =>'Button',
		'button_link' =>'#',
		'size' =>'col-4',
		'last_column' =>'false',
		'bottom_margin' =>'true'
		), $atts));

	if ($last_column == "true")
		$size .= ' last-column';

	if ($bottom_margin == "false")
		$size .= ' no-margin';

	if ($layers == "true")
		$layers = " layers";
	else
		$layers = "";

	if ($focus == "true")
		$layers .= ' focus-plan';

	$output = "";
	$output .= '<div class="' . $size . '">';
	$output .= '<div class="plan-item' . $layers . '">';
	$output .= '<h4 class="plan-item-header">' . $title . '</h4>';

	$output .= '<ul class="plan-item-features">';
	$output .= do_shortcode($content);
	$output .= '</ul>';

	if ($button_title) {
		$output .= '<div class="plan-item-button"><a href="' . $button_link . '" target="_blank">' . $button_title . '</a></div>';
	}
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode('pricing_item', 'hb_pricingitem_shortcode');


function hb_pricingrow_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'is_price' =>'false'
		), $atts));

	if ($is_price == "true")
		return '<li class="plan-item-price">' . do_shortcode($content) . '</li>';
	else
		return '<li>' . do_shortcode($content) . '</li>';
}
add_shortcode('pricing_row', 'hb_pricingrow_shortcode');



// Display
function hb_display_desktop_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'size' =>'desktop'
		), $atts));

	return '<div class="visible-' . $size . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('screen', 'hb_display_desktop_shortcode');

// Staff

function hb_staff_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'columns' =>3,
		'number' =>-1,
		'departments' =>''
		), $atts));

	$output = '';
	$dept_new = string_to_array_names_categories($departments);
	$staff_col_class = 'col-4';

	if ($number)
		$number = intval($number);

	switch ($columns) {

		case 2:
			$staff_col_class = 'col-6';
		break;

		case 3:
			$staff_col_class = 'col-4';
		break;

		case 4:
			$staff_col_class = 'col-3';
		break;
	}


	if ($departments) {
		$loop = new WP_Query(array(
			'post_type' =>__('staff', 'hbthemes'),
			'orderby' =>'menu_order',
			'order' =>'ASC',
			'posts_per_page' =>$number,
			'tax_query' =>array(
				array(
					'taxonomy' =>'staff_departments',
					'field' =>'slug',
					'terms' =>$dept_new
					)
				)
			));

	} else {
		$loop = new WP_Query(array(
			'post_type' =>__('staff', 'hbthemes'),
			'orderby' =>'menu_order',
			'order' =>'ASC',
			'posts_per_page' =>$number
			));
	}


	$post_count_staff = $loop->post_count;
	$counter = 0;

	while ($loop->have_posts()):$loop->the_post();
		$counter++;
		$last_column_class = "";
		$thumb = get_post_thumbnail_id();
		$image = hb_resize($thumb, '', 450, 301, true);
		$full_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'original');


		if ($counter % $columns == 0)
			$last_column_class = " last-column";

		else
			$last_column_class = "";

		$output .= '<div class="' . $staff_col_class . $last_column_class . '">';
		$output .= '<div class="team-member-box">';
		$output .= '<a href="' . $full_thumb[0] . '" class="fancybox"><img class="team-member-img" src="' . $image['url'] . '"/></a>';
		$output .= '<div class="team-member-description">';
		$output .= '<div class="team-header-info clearfix">';
		$output .= '<div class="team-name">';
		$output .= '<h4 class="team-member-name">' . get_the_title() . '</h4>';
		$output .= '<p class="team-position">' . get_post_meta(get_the_ID(), 'hb_team_member_position', true) . '</p>';
		$output .= '</div>';
		$output .= '<div class="social-list clearfix">';
		$output .= '<ul class="social">';

		$social_links = get_staff_social_links(get_the_ID());
		if (!empty($social_links)) {

			foreach ($social_links as $soc_network => $soc_link) {
				$output .= '<li><a class="' . $soc_network . '" href="' . $soc_link . '" target="_blank"></a></li>';
			}
		}
		$output .= '</ul>';
		$output .= '</div>';

		$output .= '</div>';

		$output .= '<div class="team-member-content">';
		$output .= do_shortcode(get_the_content());
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		if ($counter % $columns == 0 && $counter != $post_count_staff) {
			$output .= '<div class="clear"></div>';
			$output .= '<div class="spacer"></div>';
		} else if ($counter == $post_count_staff) {
			$output .= '<div class="clear"></div>';
		}

	endwhile;

	wp_reset_query();

	return $output;
}
add_shortcode('staff', 'hb_staff_shortcode');



// Tabs
function hb_tabs_shortcode($atts, $content = null)
{
	$defaults = array();

	extract(shortcode_atts(array(
		'layers' =>'false'
		), $atts));

	// Extract the tab titles for use in the tab widget.
	preg_match_all('/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

	$tab_titles = array();
	if (isset($matches[1])) {
		$tab_titles = $matches[1];
	}

	$output = '';
	$layers_class = "";
	if ($layers == "true")
		$layers_class = " layers";


	if (count($tab_titles)) {
		$output .= '<div id="tabs-' . rand(1, 1000) . '" class="tabs_container' . $layers_class . '">';
		$output .= '<ul class="tabs">';

		foreach ($tab_titles as $tab) {
			$output .= '<li><a href="#tab-' . sanitize_title($tab[0]) . '">' . $tab[0] . '</a></li>';
		}

		$output .= '</ul>';
		$output .= '<div class="tabs_contents">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';

	} else {
		$output .= do_shortcode($content);
	}
	return $output;
}
add_shortcode('tabs', 'hb_tabs_shortcode');


// Tab
function hb_tab_shortcode($atts, $content = null)
{
	$defaults = array(
		'title' =>'Tab'
		);
	
	extract(shortcode_atts($defaults, $atts));

	return '<div id="tab-' . sanitize_title($title) . '" class="tab_content">' . do_shortcode($content) . '</div>';
}
add_shortcode('tab', 'hb_tab_shortcode');

// Clear
function hb_clear_shortcode($atts, $content = null)
{
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'hb_clear_shortcode');

//Spacer
function hb_spacer_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'height' =>'20px'
		), $atts));

	$spacer_style = "";
	if ($height)
		$spacer_style = ' style="height:' . $height . ';"';

	return '<div class="spacer"' . $spacer_style . '></div>';
}
add_shortcode('spacer', 'hb_spacer_shortcode');

// Dropcap
function hb_dropcap_shortcode($atts, $content = null)
{
	return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'hb_dropcap_shortcode');


// Inline Elements
function hb_sup_shortcode($atts, $content = null)
{
	return '<sup>' . do_shortcode($content) . '</sup>';
}
add_shortcode('sup', 'hb_sup_shortcode');


function hb_sub_shortcode($atts, $content = null)
{
	return '<sub>' . do_shortcode($content) . '</sub>';
}
add_shortcode('sub', 'hb_sub_shortcode');


function hb_del_shortcode($atts, $content = null)
{
	return '<del>' . do_shortcode($content) . '</del>';
}
add_shortcode('del', 'hb_del_shortcode');



function hb_mark_shortcode($atts, $content = null)
{
	return '<mark>' . do_shortcode($content) . '</mark>';
}
add_shortcode('mark', 'hb_mark_shortcode');


function hb_markdark_shortcode($atts, $content = null)
{
	return '<mark class="dark">' . do_shortcode($content) . '</mark>';
}
add_shortcode('mark_dark', 'hb_markdark_shortcode');


function hb_dfn_shortcode($atts, $content = null)
{
	return '<dfn>' . do_shortcode($content) . '</dfn>';
}
add_shortcode('dfn', 'hb_dfn_shortcode');


function hb_strong_shortcode($atts, $content = null)
{
	return '<strong>' . do_shortcode($content) . '</strong>';
}
add_shortcode('strong', 'hb_strong_shortcode');



function hb_code_shortcode($atts, $content = null)
{
	return '<code>' . do_shortcode($content) . '</code>';
}
add_shortcode('code', 'hb_code_shortcode');


function hb_abbr_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' =>'This is abbreviation'
		), $atts));

	return '<abbr title="' . $title . '">' . do_shortcode($content) . '</abbr>';
}
add_shortcode('abbr', 'hb_abbr_shortcode');


// Testimonial Shortcode
function hb_testimonial_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'number' =>-1,
		'columns' =>'',
		'random' => 'true'
		), $atts));

	if ($number)
		$number = intval($number);

	$page_testimonial_col_class = 'col-4';

	switch ($columns) {
		case 2:
		$page_testimonial_col_class = 'col-6';
		break;

		case 3:
		$page_testimonial_col_class = 'col-4';
		break;

		case 4:
		$page_testimonial_col_class = 'col-3';
		break;	
	}

	if ( $random == 'true' ) {
		$loop = new WP_Query(array(
			'post_type' =>__('testimonials', 'hbthemes'),
			'orderby' =>'rand',
			'posts_per_page' =>$number
			));

		$output = '<!-- START .posts-grid -->';
		$output .= '<div class="posts-grid">';
	} else {
		$loop = new WP_Query(array(
			'post_type' =>__('testimonials', 'hbthemes'),
			'orderby' =>'menu_order',
			'order' =>'DESC',
			'posts_per_page' =>$number
			));

		$output = '<!-- START .posts-grid -->';
		$output .= '<div class="posts-grid">';
	}
	
	while ($loop->have_posts()):$loop->the_post();

		$testimonial_author = get_post_meta(get_the_ID(), 'hb_testimonial_author', true);
		$testimonial_author_info = get_post_meta(get_the_ID(), 'hb_testimonial_author_info', true);
		$output .= '<div class="' . $page_testimonial_col_class . ' post">';

		$output .= '<div class="testimonial-box">';
		$output .= '<div class="testimonial-header">';
		$output .= '<div class="testimonial-content">' . do_shortcode(get_the_content()) . '</div>';	
		$output .= '<span class="arrow-down"></span>';
		$output .= '</div>';

		$output .= '<div class="testimonial-footer">';
		$output .= '<span>' . $testimonial_author . '</span>';
		
		if ($testimonial_author_info) {
			$output .= ', ' . $testimonial_author_info;
		}
		
		$output .= '</div>';
		$output .= '</div>';

		$output .= '</div>';

	endwhile;

	$output .= '</div>';
	
	wp_reset_query();

	return $output;
}
add_shortcode('testimonials', 'hb_testimonial_shortcode');



// Map Shortcode
function hb_map_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'width' =>'400',
		'height' =>'250'
		), $atts));

	if ($content) {
		$output = '<iframe class="white-frame" width="' . $width . '" height="' . $height . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . get_src_from_embedded_link($content) . '"></iframe>';
	}

	return $output;
}
add_shortcode('map', 'hb_map_shortcode');

function hb_h2_titledesc_class_shortcode($atts, $content = null)
{
	return '<h2 class="title-description">' . do_shortcode($content) . '</h2>';
}
add_shortcode('title_description', 'hb_h2_titledesc_class_shortcode');

// Focus Text 
function hb_focus_text_shortcode ( $atts , $content = null ) {
  return '<span class="focus-sep-text">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode ( 'focus_separator_text' , 'hb_focus_text_shortcode' );


// Video
function hb_video_shortcode ( $atts , $content = null ) {
  extract( shortcode_atts( 
        array(
          'width' => '',
          'height' => '',
          'white_frame' => 'true'
        ), $atts 
      )     
  );
  
  $output = '';
  $classes = '';
  if ( $white_frame == "true" ) $classes .= " class='white-frame'";
  if ( $width ) $classes .= ' width="'.$width.'"';
  if ( $height ) $classes .= ' height="'.$height.'"';
  $output .= '<iframe src="' . get_src_from_embedded_link($content) . '"'.$classes.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
  return $output;
}
add_shortcode ( 'hb_video' , 'hb_video_shortcode' );
?>