<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Retrieves array of category names from string of slugs
function string_to_array_names_categories( $string ) {
    $cat_slugs = array();
    $catnames= array();
    $string = str_replace(" ", "", $string);
    $cat_slugs = explode(",",$string);
    if(is_array($cat_slugs)) {
      foreach ($cat_slugs as $cat_slug) {
        $catnames[] = $cat_slug;
      }
    }
    return $catnames;
}

// Retrieves array of category IDs from string of slugs
function string_to_array_categories( $string ) {
    $cat_slugs = array();
    $cat_ids = array();
    $string = str_replace(" ", "", $string);
    $cat_slugs = explode(",",$string);
    if(is_array($cat_slugs)) {
      foreach ($cat_slugs as $cat_slug) {
		$catObj = get_category_by_slug($cat_slug);
		if ( $catObj ) 
        $cat_ids[] = $catObj->term_id;
      }
    }
    return $cat_ids;
}
?>