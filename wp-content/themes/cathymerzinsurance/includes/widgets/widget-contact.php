<?php
/*
 * Plugin Name: Contact Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays contact info
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

 

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_contact_widgets' );

/*
 * Register widget.
 */
function hb_contact_widgets() {
	register_widget( 'HB_Contact_Widget' );
}

/*
 * Widget class.
 */
class hb_contact_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Contact_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contact-widget', 'description' => __('A widget that displays your contact info.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_contact_widget', __('Custom Contact Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$content = $instance['content'];
		$telephone = $instance['telephone'];
		$fax = $instance['fax'];
		$mail = $instance['mail'];
		$web = $instance['web'];
		$address = $instance['address'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Dribbble */
		
			$unique_id = 'unique_id_'.rand(1,50000);
		 ?>
			<ul class="contacts-widget">
			<?php if ( $content ) {  echo '<p>'.$content.'</p>'; } ?>
			<?php if ( $telephone ) { echo '<li><span>'.__('Tel' , 'hbthemes').'</span>'.$telephone.'</li>'; } ?>
			<?php if ( $fax ) { echo '<li><span>'.__('Fax' , 'hbthemes').'</span>'.$fax.'</li>'; } ?>
			<?php if ( $mail ) { echo '<li><span>'.__('Mail' , 'hbthemes').'</span>'.$mail.'</li>'; } ?>
			<?php if ( $web ) { echo '<li><span>'.__('Web' , 'hbthemes').'</span><a href="'.$web.'">'.$web.'</a></li>'; } ?>
			<?php if ( $address ) { echo '<li><span>'.__('Add' , 'hbthemes').'</span>'.$address.'</li>'; } ?>
			</ul>
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
		$instance['content'] = strip_tags( $new_instance['content'] );
		$instance['telephone'] = strip_tags( $new_instance['telephone'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['web'] = strip_tags( $new_instance['web'] );
		$instance['address'] = strip_tags( $new_instance['address'] );

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
		'title' => 'Contact Widget',
		'content' => '',
		'telephone' => '',
		'mail' => '',
		'fax' => '',
		'web' => '',
		'address' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Content: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Contact Content: ' , 'hbthemes'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo $instance['content']; ?>" ><?php echo $instance['content']; ?></textarea>
		</p>

		<!-- Phone: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'telephone' ); ?>"><?php _e( 'Contact Phone Number: ' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'telephone' ); ?>" name="<?php echo $this->get_field_name( 'telephone' ); ?>" value="<?php echo $instance['telephone']; ?>" />
		</p>
		
		<!-- Fax: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Contact Fax: ' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" />
		</p>

		<!-- Mail: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'mail' ); ?>"><?php _e( 'Contact Mail: ' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'mail' ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" value="<?php echo $instance['mail']; ?>" />
		</p>
		
		<!-- Website: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'web' ); ?>"><?php _e( 'Contact Website: ','hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'web' ); ?>" name="<?php echo $this->get_field_name( 'web' ); ?>" value="<?php echo $instance['web']; ?>" />
		</p>
		
		<!-- Address: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php echo 'Contact Address: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" />
		</p>
		
	<?php
	}
}
?>