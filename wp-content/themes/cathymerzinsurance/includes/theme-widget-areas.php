<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Register Footer
if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'description'   => __('This is an area for widgets.','hbthemes'),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		);
		
		$sidebar_id = 0;
		
		$hb_sidebar = array("Footer 1", "Footer 2", "Footer 3", "Footer 4");
		
		foreach( $hb_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}
}


// Register default sidebar
if ( function_exists ( 'register_sidebar' ) )
    register_sidebar ( array ( 
    	'name' => __( 'Default Sidebar' , 'hbthemes' ),
		'description'   => __('This is an area for widgets.','hbthemes'),
		'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		)
	);

// Register dynamic sidebar
$dynamic_sidebar = array ();
if ( isset ( $data['hb_sidebar'] ) )
$dynamic_sidebar = $data['hb_sidebar'];

if( !empty( $dynamic_sidebar ) )
{
	foreach ( $dynamic_sidebar as $sidebar )
	{
		if ( function_exists( 'register_sidebar' ) )
	    register_sidebar( array(
			'name' => $sidebar['title'],
			'description'   => __('This is an area for widgets.','hbthemes'),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
			)
		);
	}
}
?>