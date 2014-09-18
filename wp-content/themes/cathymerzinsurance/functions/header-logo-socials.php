<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes the logo, social icons and responsive menu.
function add_theme_header () {
	global $data;

	$hb_image_logo = $data['hb_image_logo'];
	$hb_html_logo = $data['hb_html_logo'];
	$hb_logo_width = $data['hb_logo_width'];
	$hb_logo_height = $data['hb_logo_height'];

	if ( $hb_logo_height ) $hb_logo_height = "height=\"".$hb_logo_height . "\"";
	if ( $hb_logo_width ) $hb_logo_width = " width=\"".$hb_logo_width . "\"";

	$hb_home_link = get_bloginfo ('url');
	$hb_enable_tagline = $data['hb_enable_tagline'];
	
	print "<!-- START #header -->\n";
	print "\t<div id=\"header\" class=\"clearfix\">\n";

	print "\t<!-- START #logo-wrap-->\n";
	print "\t<div id=\"logo-wrap\">\n";

	// Start Logo
	print "\t<div id=\"logo\">\n";
	print "\t<a href=\"$hb_home_link\">\n";
	if ( $hb_image_logo ) {

		print "<img src=\"$hb_image_logo\"$hb_logo_width $hb_logo_height />";
	} else if ( $hb_html_logo ) { 
		print $hb_html_logo;
	} else {
		bloginfo('name');
	}
	print "\t</a>\n";
	print "\t</div>\n";

	// Start Tagline
	if ( $hb_enable_tagline ) {
		print "\t<p id=\"tagline\">\n";
		bloginfo ( 'description' );
		print "\t</p>\n";
	}

	print "\t</div>\n";
	print "\t<!-- END #logo-wrap -->\n";

	print "\t<!-- START #social-wrap -->\n";
	print "\t<div id=\"social-wrap\">\n";
	// Start Social Buttons
	$socials = get_social_links();
	if ( is_array($socials)) {
		
		print "\t<div id=\"header-social\">\n";
		print "\t<ul class=\"social clearfix\">\n";
		foreach ($socials as $social_icon => $soc) {
			print "\t\t<li><a class=\"$social_icon\" href=\"$soc\" target=\"_blank\"></a></li>\n";
		}
		print "\t</ul>\n";
		print "\t</div>\n";
	}

	// Site Info
	if ( $data['hb_enable_siteinfo'] ) {
		print "\t<div id=\"site-info\">\n";
		print $data['hb_siteinfo_content'];
		print "\t</div>\n";
	} 
	print "\t</div>\n";
	print "\t<!-- END #social-wrap -->\n";

	$menu_to_count = wp_nav_menu(array(
				'echo' => false,
				'theme_location' => 'main-menu'
				));
	$menu_items = substr_count($menu_to_count,'class="menu-item ');

	if ( $menu_items > 0 ) {
			
	print "<!-- BEGIN RESPONSIVE NAVIGATION -->
				<div id=\"nav-wrap\" class=\"navigation-class\">                  
					<div id=\"menu-icon\"><span class=\"image-icon\"></span></div>
						<ul id=\"nav-resp\">
							<div class=\"triangle\"></div>
						</ul>						
				</div>
				<!-- END RESPONSIVE NAVIGATION -->";
	} 

	print "\t</div>\n";
	print "\t<!-- END #header -->\n";
}

function get_social_links() {
	global $data;

	$social_links = array();

	if ($data['hb_facebook']) $social_links["facebook"] = $data['hb_facebook'];
	if ($data['hb_delicious']) $social_links["delicious"] = $data['hb_delicious'];
	if ($data['hb_deviantart']) $social_links["deviantart"] = $data['hb_deviantart'];
	if ($data['hb_dribbble']) $social_links["dribbble"] = $data['hb_dribbble'];
	if ($data['hb_flickr']) $social_links["flickr"] = $data['hb_flickr'];
	if ($data['hb_googleplus']) $social_links["googleplus"] = $data['hb_googleplus'];
	if ($data['hb_digg']) $social_links["digg"] = $data['hb_digg'];
	if ($data['hb_pinterest']) $social_links["pinterest"] = $data['hb_pinterest'];
	if ($data['hb_reddit']) $social_links["reddit"] = $data['hb_reddit'];
	if ($data['hb_lastfm']) $social_links["lastfm"] = $data['hb_lastfm'];
	if ($data['hb_stumbleupon']) $social_links["stumbleupon"] = $data['hb_stumbleupon'];
	if ($data['hb_twitter']) $social_links["twitter"] = $data['hb_twitter'];
	if ($data['hb_apple']) $social_links["apple"] = $data['hb_apple'];
	if ($data['hb_skype']) $social_links["skype"] = $data['hb_skype'];
	if ($data['hb_youtube']) $social_links["youtube"] = $data['hb_youtube'];
	if ($data['hb_forrst']) $social_links["forrst"] = $data['hb_forrst'];
	if ($data['hb_github']) $social_links["github"] = $data['hb_github'];
	if ($data['hb_linkedin']) $social_links["linkedin"] = $data['hb_linkedin'];
	if ($data['hb_vimeo']) $social_links["vimeo"] = $data['hb_vimeo'];
	if ($data['hb_rss']) $social_links["rss"] = $data['hb_rss'];

	return $social_links;
}

function get_staff_social_links ( $post_id ) {
	$social_links = array();

	if ( get_post_meta ( $post_id , 'hb_staff_facebook' , true ) ) $social_links["facebook"] = get_post_meta ( $post_id , 'hb_staff_facebook' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_delicious' , true ) ) $social_links["delicious"] = get_post_meta ( $post_id , 'hb_staff_delicious' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_deviantart' , true ) ) $social_links["deviantart"] = get_post_meta ( $post_id , 'hb_staff_deviantart' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_dribbble' , true ) ) $social_links["dribbble"] = get_post_meta ( $post_id , 'hb_staff_dribbble' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_flickr' , true ) ) $social_links["flickr"] = get_post_meta ( $post_id , 'hb_staff_flickr' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_googleplus' , true ) ) $social_links["googleplus"] = get_post_meta ( $post_id , 'hb_staff_googleplus' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_digg' , true ) ) $social_links["digg"] = get_post_meta ( $post_id , 'hb_staff_digg' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_pinterest' , true ) ) $social_links["pinterest"] = get_post_meta ( $post_id , 'hb_staff_pinterest' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_reddit' , true ) ) $social_links["reddit"] = get_post_meta ( $post_id , 'hb_staff_reddit' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_lastfm' , true ) ) $social_links["lastfm"] = get_post_meta ( $post_id , 'hb_staff_lastfm' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_stumbleupon' , true ) ) $social_links["stumbleupon"] = get_post_meta ( $post_id , 'hb_staff_stumbleupon' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_twitter' , true ) ) $social_links["twitter"] = get_post_meta ( $post_id , 'hb_staff_twitter' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_rss' , true ) ) $social_links["rss"] = get_post_meta ( $post_id , 'hb_staff_rss' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_apple' , true ) ) $social_links["apple"] = get_post_meta ( $post_id , 'hb_staff_apple' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_skype' , true ) ) $social_links["skype"] = get_post_meta ( $post_id , 'hb_staff_skype' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_youtube' , true ) ) $social_links["youtube"] = get_post_meta ( $post_id , 'hb_staff_youtube' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_forrst' , true ) ) $social_links["forrst"] = get_post_meta ( $post_id , 'hb_staff_forrst' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_github' , true ) ) $social_links["github"] = get_post_meta ( $post_id , 'hb_staff_github' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_linkedin' , true ) ) $social_links["linkedin"] = get_post_meta ( $post_id , 'hb_staff_linkedin' , true );
	if ( get_post_meta ( $post_id , 'hb_staff_vimeo' , true ) ) $social_links["vimeo"] = get_post_meta ( $post_id , 'hb_staff_vimeo' , true );


	return $social_links;
}
?>