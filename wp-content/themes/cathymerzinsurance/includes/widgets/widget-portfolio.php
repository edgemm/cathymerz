<?php
/*
 * Plugin Name: Portfolio Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays Portfolio posts
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_portfolio_widgets' );

/*
 * Register widget.
 */
function hb_portfolio_widgets() {
	register_widget( 'HB_Portfolio_Widget' );
}

/*
 * Widget class.
 */
class hb_portfolio_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Portfolio_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'portfolio-widget', 'description' => __('A widget that displays your portfolio posts.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_portfolio_widget', __('Custom Portfolio Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$slugs = $instance['slugs'];
		$number = $instance['number'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Dribbble */
		
			$unique_id = "unique_id_".rand(1,50000);
			if ( $slugs != "" ) {
				$slugs = string_to_array_names_categories($slugs);
				$loop = new WP_Query( array( 'post_type' => __('portfolio' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'portfolio_cats', 'field' => 'slug', 'terms' => $slugs ) ) ) );
			} else {
				$loop = new WP_Query( array( 'post_type' => __('portfolio' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ) );
			}

			echo '<div class="hb-stream clearfix" id="'.$unique_id.'"><ul>';
			$counter = (int) $number;
			if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
			$thumb = get_post_thumbnail_id(); 
			$image = hb_resize( $thumb, '', 70, 67, true );
			if ( $thumb ) {
				$counter--;
				if ($counter>=0) {
					echo '<li><a href="'.get_permalink().'" title="'.get_the_title().'">';
					echo '<img src="'.$image['url'].'" />';
					echo '</a></li>';			
				}
			}
			endwhile; endif;
			wp_reset_query();
			echo '</ul></div>';
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
		$instance['slugs'] = strip_tags( $new_instance['slugs'] );
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
		'title' => 'Portfolio Widget',
		'slugs' => '',
		'number' => '9',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'slugs' ); ?>"><?php _e( 'From Category ( use slugs and separate them with commas ): ', 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'slugs' ); ?>" name="<?php echo $this->get_field_name( 'slugs' ); ?>" value="<?php echo $instance['slugs']; ?>" />
		</p>

		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Portfolio Item Number: ','hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

		
	<?php
	}
}
?>