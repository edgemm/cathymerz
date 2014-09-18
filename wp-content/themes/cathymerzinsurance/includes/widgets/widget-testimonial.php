<?php
/*
 * Plugin Name: Testimonial Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays pinterest posts
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

 

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_testimonial_widgets' );

/*
 * Register widget.
 */
function hb_testimonial_widgets() {
	register_widget( 'HB_Testimonial_Widget' );
}

/*
 * Widget class.
 */
class hb_testimonial_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Testimonial_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'testimonial-widget', 'description' => __('A widget that displays your a testimonial.', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_testimonial_widget', __('Custom Testimonial Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		$loop = new WP_Query( array( 'posts_per_page' => 1 , 'post_type' => __('testimonials','hbthemes') , 'orderby' => 'rand') );
		
		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
			$testimonial_author = get_post_meta ( get_the_ID() , 'hb_testimonial_author' , true );
			$testimonial_author_info = get_post_meta ( get_the_ID() , 'hb_testimonial_author_info' , true );
		
			?>
			<!-- START .testimonial-box -->
			<div class="testimonial-box">
				<!-- START .testimonial-header -->
				<div class="testimonial-header">
					<div class="testimonial-content"><?php the_content(); ?></div>
					<span class="arrow-down"></span>
				</div>
				<!-- END .testimonial-header -->
				
				<!-- START .testimonial-footer -->
				<div class="testimonial-footer">
				<span><?php echo $testimonial_author; ?></span><?php if ( $testimonial_author_info ) { echo ', '.$testimonial_author_info; } ?>
				</div>
				<!-- END .testimonial-footer -->
			</div>
			<!-- END .testimonial-box -->
			<?php
		
		endwhile; endif;

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
		$instance['test_title'] = strip_tags( $new_instance['test_title'] );
		$instance['test_author'] = strip_tags( $new_instance['test_author'] );

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
		'title' => 'Testimonial Widget',
		'test_title' => '',
		'test_author' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		

		
	<?php
	}
}
?>