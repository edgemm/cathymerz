<?php
/**
 * @package WordPress
 * @subpackage Notable
 */
 
function hb_register_post_types () {
	
	register_post_type ( __('staff','hbthemes') , 
			array(
				'labels' => array ( 
					'name' => __('Staff','hbthemes'),
					'all_items' => __( 'All Staff Members' , 'hbthemes' ),
					'singular_name' => __( 'Staff Member' , 'hbthemes' ) ,		
					'add_new' => __( 'Add New Staff Member', 'hbthemes' ),
					'add_new_item' => __( 'Add New Staff Member', 'hbthemes' ),
					'edit_item' => __( 'Edit Staff Member', 'hbthemes' ),
					'new_item' =>  __( 'New Staff Member', 'hbthemes' ),
					'view_item' =>  __( 'View Staff Member', 'hbthemes' ),
					'search_items' =>  __( 'Search Fro Staff Member', 'hbthemes' ),
					'not_found' =>  __( 'No Staff Members found', 'hbthemes' ),
					'not_found_in_trash' => __( 'No Staff Members found in Trash', 'hbthemes' ),
					'parent_item_colon' => ''
				),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 53,
				'supports' => array(
						'title', 
						'editor', 
						'thumbnail',
						'page-attributes',
						),
				'query_var' => true,
				'exclude_from_search' => false,
				'show_in_nav_menus' => false,
				'menu_icon' => get_template_directory_uri() . '/admin/assets/images/icon-staff.png',
			)
		);
		
	register_post_type ( __('testimonials','hbthemes') , 
			array(
				'labels' => array ( 
					'name' => __('Testimonials','hbthemes'),
					'all_items' => __( 'All Testimonials' , 'hbthemes' ),
					'singular_name' => __( 'Testimonial' , 'hbthemes' ) ,		
					'add_new' => __( 'Add New Testimonial', 'hbthemes' ),
					'add_new_item' => __( 'Add New Testimonial', 'hbthemes' ),
					'edit_item' => __( 'Edit Testimonial', 'hbthemes' ),
					'new_item' =>  __( 'New Testimonial', 'hbthemes' ),
					'view_item' =>  __( 'View Testimonial', 'hbthemes' ),
					'search_items' =>  __( 'Search For Testimonials', 'hbthemes' ),
					'not_found' =>  __( 'No Testimonials found', 'hbthemes' ),
					'not_found_in_trash' => __( 'No Testimonials found in Trash', 'hbthemes' ),
					'parent_item_colon' => ''
				),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 53,
				'supports' => array(
						'title', 
						'editor', 
						'page-attributes',
						),
				'query_var' => true,
				'exclude_from_search' => false,
				'show_in_nav_menus' => false,
				'menu_icon' => get_template_directory_uri() . '/admin/assets/images/icon-quote.png',
			)
		);


	register_post_type ( __('portfolio','hbthemes') , 
			array(
				'labels' => array ( 
					'name' => __('Portfolio','hbthemes'),
					'all_items' => __( 'All Portfolio Items' , 'hbthemes' ),
					'singular_name' => __( 'Portfolio Item' , 'hbthemes' ) ,		
					'add_new' => __( 'Add New Portfolio Item', 'hbthemes' ),
					'add_new_item' => __( 'Add New Portfolio Item', 'hbthemes' ),
					'edit_item' => __( 'Edit Portfolio Item', 'hbthemes' ),
					'new_item' =>  __( 'New Portfolio Item', 'hbthemes' ),
					'view_item' =>  __( 'View Portfolio Item', 'hbthemes' ),
					'search_items' =>  __( 'Search For Portfolio Item', 'hbthemes' ),
					'not_found' =>  __( 'No Portfolio Items found', 'hbthemes' ),
					'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'hbthemes' ),
					'parent_item_colon' => ''
				),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 53,
				'supports' => array(
						'title', 
						'editor', 
						'thumbnail',
						'page-attributes',
						),
				'query_var' => true,
				'exclude_from_search' => false,
				'show_in_nav_menus' => false,
				'menu_icon' => get_template_directory_uri() . '/admin/assets/images/icon-briefcase.png',
			)
		);

	register_post_type ( __('flexslider','hbthemes') , 
			array(
				'labels' => array ( 
					'name' => __('Flex Slides','hbthemes'),
					'all_items' => __( 'All Flex Slides' , 'hbthemes' ),
					'singular_name' => __( 'Flex Slide' , 'hbthemes' ) ,		
					'add_new' => __( 'Add New Flex Slide', 'hbthemes' ),
					'add_new_item' => __( 'Add New Flex Slide', 'hbthemes' ),
					'edit_item' => __( 'Edit Flex Slide', 'hbthemes' ),
					'new_item' =>  __( 'New Flex Slide', 'hbthemes' ),
					'view_item' =>  __( 'View Flex Slide', 'hbthemes' ),
					'search_items' =>  __( 'Search For Flex Slides', 'hbthemes' ),
					'not_found' =>  __( 'No Flex Slides found', 'hbthemes' ),
					'not_found_in_trash' => __( 'No Flex Slides found in Trash', 'hbthemes' ),
					'parent_item_colon' => ''
				),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 53,
				'supports' => array(
						'title', 
						'page-attributes',
						),
				'query_var' => false,
				'exclude_from_search' => true,
				'show_in_nav_menus' => false,
				'menu_icon' => get_template_directory_uri() . '/admin/assets/images/icon-slider2.png',
			)
		);
}
add_action( 'init', 'hb_register_post_types' );
?>