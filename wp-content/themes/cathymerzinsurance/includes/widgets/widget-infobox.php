<?php
/*
 * Plugin Name: Infobox Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays infobox
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_infobox_widgets' );

/*
 * Register widget.
 */
function hb_infobox_widgets() {
	register_widget( 'HB_Infobox_Widget' );
}

/*
 * Widget class.
 */
class hb_infobox_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Infobox_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'infobox-widget', 'description' => __('A widget that displays an infobox.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_infobox_widget', __('Custom Infobox Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$content = $instance['content'];
		$closable = $instance['closable'];
		$color = $instance['color'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="info-box info-'.$color.'">';
		echo '<div class="info-box-inner">';
		echo '<p>'.$content.'</p>';
		if ( $closable == "true" ) {
			echo '<a href="#" class="close-info-box">X</a>';
		}
		echo '</div>';
		echo '</div>';

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
		$instance['content'] = strip_tags( $new_instance['content'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['closable'] = strip_tags( $new_instance['closable'] );

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
		'title' => 'Infobox Widget',
		'content' => '',
		'closable' => 'true',
		'color' => 'green',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Infobox Content: ','hbthemes'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo $instance['content']; ?>" ><?php echo $instance['content']; ?></textarea>
		</p>

		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Infobox Color: ','hbthemes'); ?></label>
			<select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>"  size="1">
                <option value="green" <?php if ( $instance['color'] == 'green' ) echo 'selected="selected"'; ?>>Green</option>
                <option value="red" <?php if ( $instance['color'] == 'red' ) echo 'selected="selected"'; ?>>Red</option>
                <option value="blue" <?php if ( $instance['color'] == 'blue' ) echo 'selected="selected"'; ?>>Blue</option>
                <option value="orange" <?php if ( $instance['color'] == 'orange' ) echo 'selected="selected"'; ?>>Orange</option>
                <option value="grey" <?php if ( $instance['color'] == 'grey' ) echo 'selected="selected"'; ?>>Grey</option>
            </select>
		</p>
		
		<!-- Number: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'closable' ); ?>"><?php _e('Is Closable: ' , 'hbthemes'); ?></label>
			<select id="<?php echo $this->get_field_id( 'closable' ); ?>" name="<?php echo $this->get_field_name( 'closable' ); ?>"  size="1">
                <option value="true" <?php if ( $instance['closable'] == 'true' ) echo 'selected="selected"'; ?>>True</option>
                <option value="false" <?php if ( $instance['closable'] == 'false' ) echo 'selected="selected"'; ?>>False</option>
            </select>
		</p>
		

		
	<?php
	}
}
?>