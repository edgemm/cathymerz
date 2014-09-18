<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
global $data, $wp_query; 
?>

<?php get_header(); 
echo add_portfolio_items( $wp_query , 3 );
get_footer(); ?>