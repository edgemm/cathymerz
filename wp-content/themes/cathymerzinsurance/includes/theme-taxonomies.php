<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

add_action ('init' , 'hb_create_taxonomies' );

function hb_create_taxonomies () {

	global $data; 

	// portfolio skills taxonomies
	$portfolio_cat_labels = array(
		'name' => __( 'Portfolio Filters', 'hbthemes' ),
		'singular_name' => __( 'Portfolio Filter', 'hbthemes' ),
		'search_items' =>  __( 'Search Portfolio Filters', 'hbthemes' ),
		'all_items' => __( 'All Portfolio Filters', 'hbthemes' ),
		'parent_item' => __( 'Parent Portfolio Filter', 'hbthemes' ),
		'parent_item_colon' => __( 'Parent Portfolio Filter:', 'hbthemes' ),
		'edit_item' => __( 'Edit Portfolio Filter', 'hbthemes' ),
		'update_item' => __( 'Update Portfolio Filter', 'hbthemes' ),
		'add_new_item' => __( 'Add New Portfolio Filter', 'hbthemes' ),
		'new_item_name' => __( 'New Portfolio Filter Name', 'hbthemes' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio filters', 'hbthemes' )
	); 	

	register_taxonomy('portfolio_skills', 'portfolio' ,array(
		'hierarchical' => false,
		'labels' => $portfolio_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => __('portfoliofilters','hbthemes') ),
	));

	// portfolio taxonomies
	$portfolio_cat_labels = array(
		'name' => __( 'Portfolio Categories', 'hbthemes' ),
		'singular_name' => __( 'Portfolio Category', 'hbthemes' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'hbthemes' ),
		'all_items' => __( 'All Portfolio Categories', 'hbthemes' ),
		'parent_item' => __( 'Parent Portfolio Category', 'hbthemes' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'hbthemes' ),
		'edit_item' => __( 'Edit Portfolio Category', 'hbthemes' ),
		'update_item' => __( 'Update Portfolio Category', 'hbthemes' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'hbthemes' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'hbthemes' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'hbthemes' )
	); 	

	register_taxonomy('portfolio_cats', 'portfolio' ,array(
		'hierarchical' => true,
		'labels' => $portfolio_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => __('portfoliocat','hbthemes') ),
	));

	// staff taxonomies
	$staf_cat_labels = array(
		'name' => __( 'Staff Departments', 'hbthemes' ),
		'singular_name' => __( 'Staff Department', 'hbthemes' ),
		'search_items' =>  __( 'Search Staff Departments', 'hbthemes' ),
		'all_items' => __( 'All Staff Departments', 'hbthemes' ),
		'parent_item' => __( 'Parent Staff Department', 'hbthemes' ),
		'parent_item_colon' => __( 'Parent Staff Department:', 'hbthemes' ),
		'edit_item' => __( 'Edit Staff Department', 'hbthemes' ),
		'update_item' => __( 'Update Staff Department', 'hbthemes' ),
		'add_new_item' => __( 'Add New Staff Department', 'hbthemes' ),
		'new_item_name' => __( 'New Staff Department Name', 'hbthemes' ),
		'choose_from_most_used'	=> __( 'Choose from the most used staff departments', 'hbthemes' )
	); 	

	register_taxonomy('staff_departments', __('staff','hbthemes') ,array(
		'hierarchical' => false,
		'labels' => $staf_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => __('staffmember','hbthemes') ),
	));
}

?>