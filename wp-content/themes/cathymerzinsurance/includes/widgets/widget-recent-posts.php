<?php
/*
 * Plugin Name: Recent Posts Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays recent posts
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_recent_posts_widgets' );

/*
 * Register widget.
 */
function hb_recent_posts_widgets() {
	register_widget( 'HB_Recent_Posts_Widget' );
}

/*
 * Widget class.
 */
class hb_recent_posts_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Recent_Posts_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'hb-recent-posts-widget', 'description' => __('A widget that displays your latest posts.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_recent_posts_widget', __('Custom Recent Posts Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		$category = $instance['category'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Dribbble */
		echo '<ul class="post_list">';
		
		
		query_posts ( array ( 'category_name' => $category , 'post_type' => 'post' , 'posts_per_page' => (string)$number , 'orderby' => 'post_date' , 'order'=>'DESC' ) );
		if ( have_posts() ) : while ( have_posts() ) : the_post();
				$thumb = get_post_thumbnail_id(); 
				$image = hb_resize( $thumb, '', 55, 55, true );
				echo '<li>';
				if ( $thumb ) {
					echo '<a href="'.get_permalink ( get_the_ID() ).'" class="blog-type-icon-format">';
					echo '<img src="' . $image['url'] . '" class="format-image" />';
					echo '</a>';
				}
				echo '<div class="post_description">';
				echo '<a class="post_caption" href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a>';
				echo '<small class="details">By ';
				the_author_posts_link();		
				echo ' on ';
				echo get_the_date();
				echo '</small>';
				echo '</div>';
				echo '</li>';
		endwhile; endif;
		echo '</ul>';
		
		wp_reset_query();
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Recent Posts Widget',
		'number' => '9',
		'category' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Latest Post Count: ', 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Latest Post From Category: <br/><small><strong>*Note: Use category slug</strong></small>', 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" />
		</p>
	<?php
	}
}
?>