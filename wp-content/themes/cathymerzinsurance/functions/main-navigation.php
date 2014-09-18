<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes main navigation
function add_theme_main_nav () {
	if ( has_nav_menu ('main-menu') ) {
				wp_nav_menu( array ( 'theme_location' => 'main-menu' , 'container_id' => 'main-navigation-wrapper', 'container_class' => 'navigation-class clearfix', 'menu_class' => 'menu clearfix', 'menu_id'=>'nav') );
		}
}

function add_theme_footer_nav() {
	if ( has_nav_menu ('footer-menu') ) {
			wp_nav_menu( array ( 'theme_location' => 'footer-menu' , 'container_id' => 'footer-nav' ,'container_class' => '',  'items_wrap' => '<ul id="footer-navigation">%3$s</ul>',  'before' => '<span>/</span>' ) );
	}
}
?>