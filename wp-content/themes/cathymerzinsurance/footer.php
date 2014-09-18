<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

global $data;
?>
	<?php if ( !is_attachment() ) { ?>
		<?php if ( comments_open() ) { comments_template(); ?>
			<div class="spacer"></div>
		<?php } ?>
	<?php } ?>
	
	<?php if ( !page_has_sidebar( get_the_ID() ) ) { ?>
		</div>
		<!-- END #fullwidth-wrapper -->
	<?php } else { ?>
		
		</div>
		<!-- END #main-content-with-sidebar -->

		<!-- START #main-sidebar -->
		<div id="main-sidebar" class="col-4">
			<!-- START #main-sidebar-inner -->
			<div id="main-sidebar-inner">
			<?php
				if ( is_archive() || is_category() || is_tag() || is_search() || is_author() ) {
					dynamic_sidebar ( __('Default Sidebar' , 'hbthemes' ) );
				} else {
					dynamic_sidebar( get_post_meta ( get_the_ID() , 'hb_page_sidebar_name' , true ) );
				}
			?>
			
			</div>
			<!-- END #main-sidebar-inner -->
		</div>
		<!-- END #main-sidebar -->
		
		</div>
		<!-- END #sidebar-page-wrapper -->

	<?php } ?>

	</div>
	<!-- END #main-inner-wrapper -->
	
	</div>
	<!-- END #main-content -->
	
	<!-- START #footer -->
	<?php $hb_footer_class = array(
				'footer-style-01.png'=>array('1'=>'col-3', '2'=>'col-3', '3'=>'col-3', '4'=>'col-3'),
				'footer-style-02.png'=>array('1'=>'col-3', '2'=>'col-3', '3'=>'col-6', '4'=>'hidden'),
				'footer-style-03.png'=>array('1'=>'col-6', '2'=>'col-3', '3'=>'col-3', '4'=>'hidden'),
				'footer-style-04.png'=>array('1'=>'col-3', '2'=>'col-6', '3'=>'col-3', '4'=>'hidden'),
				'footer-style-05.png'=>array('1'=>'col-4', '2'=>'col-4', '3'=>'col-4', '4'=>'hidden'),
				'footer-style-06.png'=>array('1'=>'col-8', '2'=>'col-4', '3'=>'hidden', '4'=>'hidden'),
				'footer-style-07.png'=>array('1'=>'col-4', '2'=>'col-8', '3'=>'hidden', '4'=>'hidden'),
				'footer-style-08.png'=>array('1'=>'col-6', '2'=>'col-6', '3'=>'hidden', '4'=>'hidden'),
				'footer-style-09.png'=>array('1'=>'col-3', '2'=>'col-9', '3'=>'hidden', '4'=>'hidden'),
				'footer-style-10.png'=>array('1'=>'col-9', '2'=>'col-3', '3'=>'hidden', '4'=>'hidden'),
				'footer-style-11.png'=>array('1'=>'col-12', '2'=>'hidden', '3'=>'hidden', '4'=>'hidden'),

			);
			$hb_footer_style = $data['hb_footer_layout'];
			
			if ( !$hb_footer_style ) $hb_footer_style = 'footer-style-1.png';
			
			$hb_footer_class_id = "four-column-footer";
			switch ($hb_footer_style) {
				case 'footer-style-01.png':
					$hb_footer_class_id = "four-column-footer";
				break;
				case 'footer-style-02.png':
					$hb_footer_class_id = "three-column-footer";
				break;
				case 'footer-style-03.png':
					$hb_footer_class_id = "three-column-footer";
				break;
				case 'footer-style-04.png':
					$hb_footer_class_id = "three-column-footer";
				break;
				case 'footer-style-05.png':
					$hb_footer_class_id = "three-column-footer";
				break;
				case 'footer-style-06.png':
					$hb_footer_class_id = "two-column-footer";
				break;
				case 'footer-style-07.png':
					$hb_footer_class_id = "two-column-footer";
				break;
				case 'footer-style-08.png':
					$hb_footer_class_id = "two-column-footer";
				break;
				case 'footer-style-09.png':
					$hb_footer_class_id = "two-column-footer";
				break;
				case 'footer-style-10.png':
					$hb_footer_class_id = "two-column-footer";
				break;
				case 'footer-style-11.png':
					$hb_footer_class_id = "one-column-footer";
				break;
				
			}
	?>

	<?php if ( $data['hb_disable_footer'] == false ) { ?>
		<div id="footer" class="<?php echo $hb_footer_class_id; ?>">
		
			<div class="arrow-down"></div>
			
			<!-- START #footer-inned -->
			<div id="footer-inner" class="container clearfix">
			<?php			 
				for( $i=1 ; $i<=4; $i++ ){
					echo '<div class="' . $hb_footer_class[$hb_footer_style][$i] . ' widget-column">';
					dynamic_sidebar('Footer ' . $i);
					echo '</div>';
				}
			?>
			</div>
			<!-- END #footer-inner -->
		</div>
		<!-- END #footer -->
	<?php } ?>

	</div>
	<!-- END #content-inner -->

	</div>
	<!-- END #content -->

	<?php if ( $data['hb_disable_copyright_line'] == false ) { ?>
		<!-- START #bottom-line -->
		<div id="bottom-line" class="container clearfix">
	    	<div id="bottom-inner" class="col-12 clearfix">
	    		<div id="copyright-line">
	            	<?php echo $data['hb_copyright']; ?>
	            </div>

	            <?php add_theme_footer_nav(); ?>
	            
	    	</div>
	    </div>
	    <!-- END #bottom-line -->
    <?php } ?>

	</div>
	<!-- END #wrapper -->

	<?php wp_footer(); ?>

</body>
<!-- END body -->

</html>
<!-- END html -->