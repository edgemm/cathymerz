<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which includes custom SEO or default meta tag values
function add_favicon () {
	global $data;

	$hb_favicon = $data['hb_favicon'];
	$hb_appleicon_144 = $data['hb_appleicon_144'];
	$hb_appleicon_114 = $data['hb_appleicon_114'];
	$hb_appleicon = $data['hb_appleicon'];

	print "\t<!-- Favicon and apple-touch Icons -->\n";
	if ( $hb_favicon ) 
		print "\t<link rel=\"shortcut icon\" href=\"$hb_favicon\">\n";
	if ( $hb_appleicon )
		print "\t<link rel=\"apple-touch-icon-precomposed\" href=\"$hb_appleicon\">\n";
	if ( $hb_appleicon_144 )
		print "\t<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"$hb_appleicon_144\">\n";
	if ( $hb_appleicon_114 )
		print "\t<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"$hb_appleicon_114\">\n";
}
?>