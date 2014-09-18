<?php
/*
 * Plugin Name: Pinterest Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays pinterest posts
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

 

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_twitter_widgets' );

/*
 * Register widget.
 */
function hb_twitter_widgets() {
	register_widget( 'HB_Twitter_Widget' );
}

/*
 * Widget class.
 */
class hb_twitter_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Twitter_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter-widget', 'description' => __('A widget that displays your twitter posts.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_twitter_widget', __('Custom Twitter Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$number = $instance['number'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Dribbble */
		
			$unique_id = 'unique_id_'.rand(1,50000);
		 ?>
			<div id='<?php echo $unique_id; ?>'></div>
            	<script type="text/javascript">
                  jQuery(document).ready(function() { 
					if (jQuery('#<?php echo $unique_id; ?>').length) {
						jQuery('#<?php echo $unique_id; ?>').tweet({
							username: '<?php echo $username; ?>',
							count: '<?php echo $number; ?>',
							loading_text: "Loading Tweets. Please wait...",
							auto_join_text_default: "we said,",
							auto_join_text_ed: "we",
							auto_join_text_ing: "we were",
							auto_join_text_reply: "we replied to",
							auto_join_text_url: "we were checking out",
						});
					}                 
								  });
                </script>
			
		<?php 

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
		$instance['username'] = strip_tags( $new_instance['username'] );
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
		'title' => 'Twitter Widget',
		'username' => 'envato',
		'number' => '2',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username: ' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>

		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Twitter Item Number: ' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

		
	<?php
	}
}
?>