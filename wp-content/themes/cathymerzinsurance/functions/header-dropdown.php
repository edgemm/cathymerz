<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

 
// Extract longitude from link 
function get_vars_from_map_link ( $hb_map_link ){ 
	$extracted_vars = array();
	$extracted_vars['latitude'] = "50";
	$extracted_vars['longitude'] = "50";
	$extracted_vars['zoom'] = 10;
	if ( $hb_map_link != "" ) {
		$temp_position = strpos ( $hb_map_link , "ll=");
		if ( $temp_position == false ) 
			$temp_position = strpos ( $hb_map_link , "ll=" );

		$temp_string = substr ( $hb_map_link , $temp_position + 3);

		$extracted_vars['latitude'] = (double) ( substr( $temp_string , 0 , strpos($temp_string, ",") ) );
		$extracted_vars['longitude'] =  (double) ( substr ( $temp_string , strpos( $temp_string , ",") + 1 , strpos( $temp_string, "&") - strpos( $temp_string , ",") - 1 ));
		
		$temp_position = strpos( $hb_map_link , "z=");
		$temp_string = substr( $hb_map_link , $temp_position + 2);

		if ( strpos ($temp_string, "&") ) {
			$extracted_vars['zoom'] = (int) substr ( $temp_string, 0 , strpos($temp_string, "&"));
		} else $extracted_vars['zoom'] = (int) $temp_string;
	
	}
	
	return $extracted_vars;
}
// Function which includes header dropdown with a gmap
function add_map_dropdown() {
	global $data;	
	
	$hb_map_link = $data['hb_map_link'];

	$hb_map_panControl = $data['hb_map_panControl'];
	$hb_map_zoomControl = $data['hb_map_zoomControl'];
	$hb_map_typeControl = $data['hb_map_typeControl'];
	$hb_map_streetViewControl = $data['hb_map_streetViewControl'];
	$hb_map_overviewControl = $data['hb_map_overviewControl'];
	$hb_map_centerIcon = $data['hb_map_centerIcon'];
	$hb_map_zoomSize= $data['hb_map_zoomSize'];
	
	$map_atts = get_vars_from_map_link ( $hb_map_link );
	
	$latitude = $map_atts['latitude'];
	$longitude = $map_atts['longitude'];
	$zoom = $map_atts['zoom'];

	if ( $hb_map_zoomSize ) $hb_map_zoomSize = "SMALL";
	else $hb_map_zoomSize = "LARGE";
	
	if ( $hb_map_centerIcon ) $hb_map_centerIcon = "markers: [
										{ 	
											latitude: $latitude, 
											longitude: $longitude,											
											icon: {image: \"$hb_map_centerIcon\",iconsize: [32, 32],iconanchor: [16,32]} 										
										}
										]";
	else $hb_map_centerIcon = "";
	
	if ( $data['hb_include_gmap_header'] ) {

		print "<!-- START #header-dropdown -->\n";
		print "\t<div id=\"header-dropdown\">\n";

		print "<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false\"></script>


			<script type=\"text/javascript\">
					jQuery(document).ready(function(){
						jQuery(\"#map\").gMap({

							controls: {
										panControl: $hb_map_panControl,
										zoomControl: $hb_map_zoomControl,
										zoomControlOptions: {
											style: google.maps.ZoomControlStyle.$hb_map_zoomSize
										},
										mapTypeControl: $hb_map_typeControl,
										streetViewControl: $hb_map_streetViewControl,
										overviewMapControl: $hb_map_overviewControl
									},
									maptype: 'ROADMAP',
									zoom: $zoom,
									latitude: $latitude,
									longitude: $longitude,
									$hb_map_centerIcon
						});
					});
			</script>";

		print "\t\t<div id=\"map\"></div>\n";

		if ( $data['hb_enable_map_box'] ) { ?>
 			<!-- START #map-conctact-info -->
 			<div id="map-contact-info">
 				<!-- START .contact-widget -->
	        	<ul class="contact-widget">
	        		<?php if ( $data['hb_map_box_title'] ) { ?>
	        		<p class="aligncenter"><strong><?php echo $data['hb_map_box_title']; ?></strong></p>
	        		<?php } if ( $data['hb_map_box_phone'] ) { ?>
	        		<li><span><?php _e('Phone: ' , 'hbthemes' ); ?></span><?php echo $data['hb_map_box_phone']; ?></li>
	        		<?php } if ( $data['hb_map_box_fax'] ) { ?>
	        		<li><span><?php _e('Fax: ' , 'hbthemes' ); ?></span><?php echo $data['hb_map_box_fax']; ?></li>
	        		<?php } if ( $data['hb_map_box_mail'] ) { ?>
	        		<li><span><?php _e('Mail: ' , 'hbthemes' ); ?></span><?php echo $data['hb_map_box_mail']; ?></li>
	        		<?php } if ( $data['hb_map_box_website'] ) { ?>
	        		<li><span><?php _e('Website: ' , 'hbthemes' ); ?></span><?php echo $data['hb_map_box_website']; ?></li>
	        		<?php } if ( $data['hb_map_box_address'] ) { ?>
	        		<li><span><?php _e('Address: ' , 'hbthemes' ); ?></span><?php echo $data['hb_map_box_address']; ?></li>
	        		<?php } ?>
				</ul>
				<!-- END .contact-widget -->
				<a href="#" id="close-map-info"><span class="icon-remove"></span></a>
			</div>
			<!-- END #map-contact-info -->
		<?php }
        print "\t\t<div class=\"arrow-down\"></div>\n";

		print "\t</div>\n";
		print "\t<!-- END #header-dropdown -->\n";
	}
}
?>