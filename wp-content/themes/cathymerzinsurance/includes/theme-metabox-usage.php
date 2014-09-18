<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */
 
 
 /********************* Theme Admin Variables ***********************/
 
//get theme options
if(get_option('aegaus_options')) {
	global $data;
}	


// Grab Sliders
$flex_sliders = array();
$temp_sliders = array();
$flex_sliders[] = "None";
if ( isset ( $data["hb_flex_slider"] ) ) 
	$temp_sliders = $data["hb_flex_slider"];
if (isset($temp_sliders)) {
	foreach ($temp_sliders as $temp_slider) {
		$flex_sliders[] = $temp_slider["title"];
	}
}

/********************* BEGIN META BOXES ***********************/
$prefix = "hb_";

$hb_meta_boxes = array();


/********************* PAGE META BOXES ***********************/

$hb_meta_boxes[] = array(
	"id" => "hb_page_option",
	"title" => __("Template Settings","hbthemes"),
	"pages" => array("page"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Exclude From Blog", "hbthemes"),
			"id" => $prefix . "exclude_from_blog_categories",
			"type" => "text",
			"std" => "",
			"desc" => __("Enter a list of comma separated categories to exclude from the blog page.", "hbthemes")
		),
		array(
			"name" => __("Map Link", "hbthemes"),
			"id" => $prefix . "contact_page_map",
			"type" => "textarea",
			"desc" => __("Enter embedded google map link.", "hbthemes")
		),	
		array(
			"name" => __("Portfolio Columns", "hbthemes"),
			"id" => $prefix . "portfolio_columns",
			"type" => "select",
			"std" => "2",
			"options" => array ( "2", "3", "4" ),
			"desc" => __("Select how many columns to show on portfolio page.", "hbthemes")
		),
		array(
			"name" => __("Portfolio with Filter Page Description", "hbthemes"),
			"id" => $prefix . "portfolio_page_description",
			"type" => "text",
			"std" => "",
			"desc" => __("A line of text which describes a portfolio page. The line is located on the oposite side of the portfolio filter.", "hbthemes")
		),
		array(
			"name" => __("Portfolio with Filter Separator Icon", "hbthemes"),
			"id" => $prefix . "portfolio_separator_icon",
			"type" => "text",
			"std" => "",
			"desc" => __("Enter an icon to display on separator, when using Portfolio with Filter template.", "hbthemes")
		),
		array(
			"name" => __("Specify Portfolio Category", "hbthemes"),
			"id" => $prefix . "portfolio_category_include",
			"type" => "text",
			"std" => "",
			"desc" => __("Specify a portfolio category slug here. Portfolio items in these categories will be shown on the page.  <small><em>*Separate slugs with commas.</em></small> ", "hbthemes")
		),
		array(
			"name" => __("Tour Position", "hbthemes"),
			"id" => $prefix . "tour_position",
			"type" => "select",
			"options" => array("Right Tour" => "Right Tour" , "Left Tour" => "Left Tour"),
			"multiple" => false,
			"std" => "Left Tour",
			"desc" => __("Select a position for your tour. Choose between left and right.", "hbthemes")
		),
		array(
			"name" => __("Column Count", "hbthemes"),
			"id" => $prefix . "staff_columns",
			"type" => "select",
			"options" => array("2" => "2" , "3" => "3", "4" => "4"),
			"multiple" => false,
			"std" => "3",
			"desc" => __("Select number of column on your page.", "hbthemes")
		),
		array(
			"name" => __("Staff Departments", "hbthemes"),
			"id" => $prefix . "staff_department_include",
			"type" => "text",
			"desc" => __("Specify which member sill display by entering the staff departments.<br/> <small>Note: Use deparment slugs, and separate them by commas.</small>", "hbthemes")
		),
		array(
			"name" => __("Background Image", "hbthemes"),
			"id" => $prefix . "background_image_sep",
			"type" => "media_upload",
			"desc" => __("Attach background image.", "hbthemes")
		),
		array(
			"name" => __("Background Texture", "hbthemes"),
			"id" => $prefix . "background_texture_sep",
			"type" => "media_upload",
			"desc" => __("Add background texture.", "hbthemes")
		),
		array(
			"name" => __("Enable Page Title", "hbthemes"),
			"id" => $prefix . "page_title_enable",
			"type" => "checkbox",
			"desc" => __("Check this box if you want to enable a custom Page Title", "hbthemes")
		),
		array(
			"name" => __("Custom Page Title", "hbthemes"),
			"id" => $prefix . "page_custom_title",
			"type" => "text",
			"desc" => __("Enter custom page title.", "hbthemes")
		),
		array(
			"name" => __("Custom Page Description", "hbthemes"),
			"id" => $prefix . "page_custom_description",
			"type" => "text",
			"desc" => __("Enter custom page description.", "hbthemes")
		),
		array(
			"name" => __("Page Sidebar Position", "hbthemes"),
			"id" => $prefix . "page_sidebar_position",
			"type" => "select",
			"options" => array("none" => "None" , "hb_left_sidebar" => "Left Sidebar", "hb_right_sidebar" => "Right Sidebar"),
			"multiple" => false,
			"std" => "None",
			"desc" => __("Select a position for your sidebar. Choose between left and right.", "hbthemes")
		),
		array(
			"name" => __("Page Sidebar", "hbthemes"),
			"id" => $prefix . "page_sidebar_name",
			"type" => "sidebar_list",
			"std" => "",
			"desc" => __("Choose a sidebar for your page.", "hbthemes")	
		),
		array(
			"name" => __("Breadcrumbs", "hbthemes"),
			"id" => $prefix . "include_breadcrumbs",
			"type" => "checkbox",
			"desc" => __("Check if you want to use breadcrumbs on this page.", "hbthemes")
		),
		array(
			"name" => __("Redirect Page Link", "hbthemes"),
			"id" => $prefix . "redirect_link",
			"type" => "text",
			"desc" => __("Enter the lin for your redirect page.", "hbthemes")
		),
		array(
			"name" => __("Revolution Slider", "hbthemes"),
			"id" => $prefix . "page_slider",
			"type" => "text",
			"desc" => __("Enter Revolution slider alias here.", "hbthemes")
		),
		array(
			"name" => __("Flex Slider", "hbthemes"),
			"id" => $prefix . "portfolio_page_slider",
			"type" => "select",
			"options" => $flex_sliders,
			"desc" => __("Choose a Flex slider from the dropdown list.", "hbthemes")
		),
		
		
	)
);


// PORTFOLIO META BOXES

$hb_meta_boxes[] = array(
	"id" => "hb_portfolio_settings",
	"title" => __("Custom Settings","hbthemes"),
	"pages" => array( __( "portfolio" , "hbthemes" ) ),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		
		array(
			"name" => __("Embedded Video Link", "hbthemes"),
			"id" => $prefix . "portfolio_video_link",
			"type" => "textarea",
			"desc" => __("Enter embedded link to a video which will be used instead of the featured image.", "hbthemes")
		),
		array(
			"name" => __("Select Slider", "hbthemes"),
			"id" => $prefix . "portfolio_page_slider",
			"type" => "select",
			"options" => $flex_sliders,
			"desc" => __("Attach a Flex slider to single portfolio page.", "hbthemes")
		),
		array(
			"name" => __("Enable Related Posts", "hbthemes"),
			"id" => $prefix . "enable_related_portfolio",
			"type" => "checkbox",
			"desc" => __("Check this box if you want to enable related posts.", "hbthemes")
		),
		array(
			"name" => __("Item Description Title", "hbthemes"),
			"id" => $prefix . "portfolio_item_description_title",
			"type" => "text",
			"desc" => __("Enter item description title.", "hbthemes")
		),
		array(
			"name" => __("Background Image", "hbthemes"),
			"id" => $prefix . "background_image_sep",
			"type" => "media_upload",
			"desc" => __("Attach background image.", "hbthemes")
		),
		array(
			"name" => __("Background Texture", "hbthemes"),
			"id" => $prefix . "background_texture_sep",
			"type" => "media_upload",
			"desc" => __("Add background texture.", "hbthemes")
		),
		array(
			"name" => __("Breadcrumbs", "hbthemes"),
			"id" => $prefix . "include_breadcrumbs",
			"type" => "checkbox",
			"desc" => __("Check if you want to use breadcrumbs on this page.", "hbthemes")
		),
		array(
			"name" => __("Enable Page Title", "hbthemes"),
			"id" => $prefix . "page_title_enable",
			"type" => "checkbox",
			"desc" => __("Check this box if you want to enable a custom Page Title", "hbthemes")
		),
		array(
			"name" => __("Custom Page Title", "hbthemes"),
			"id" => $prefix . "page_custom_title",
			"type" => "text",
			"desc" => __("Enter custom page title.", "hbthemes")
		),
		array(
			"name" => __("Custom Page Description", "hbthemes"),
			"id" => $prefix . "page_custom_description",
			"type" => "text",
			"desc" => __("Enter custom page description.", "hbthemes")
		),
	)
);

$hb_meta_boxes[] = array(
	"id" => "hb_sidebar_portfolio_settings",
	"title" => __("Project Details","hbthemes"),
	"pages" => array( __( "portfolio" , "hbthemes" ) ),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Enable portfolio details", "hbthemes"),
			"id" => $prefix . "portfolio_details_enable",
			"type" => "checkbox",
			"desc" => __("Check this box if you want add project details box.", "hbthemes")
		),
		array(
			"name" => __("Title", "hbthemes"),
			"id" => $prefix . "portfolio_details_title",
			"type" => "text",
			"desc" => __("Enter project details title.", "hbthemes")
		),
		array(
			"name" => __("Date", "hbthemes"),
			"id" => $prefix . "portfolio_details_date",
			"type" => "text",
			"desc" => __("Enter project date here.", "hbthemes")
		),
		array(
			"name" => __("Client", "hbthemes"),
			"id" => $prefix . "portfolio_details_client",
			"type" => "text",
			"desc" => __("Enter project client here.", "hbthemes")
		),
		array(
			"name" => __("Skills Used", "hbthemes"),
			"id" => $prefix . "portfolio_details_skills",
			"type" => "checkbox",
			"desc" => __("Check this box if you want add skills used on this project (this uses the portfolio item filters).", "hbthemes")
		),
		array(
			"name" => __("Categories", "hbthemes"),
			"id" => $prefix . "portfolio_details_categories",
			"type" => "checkbox",
			"desc" => __("Check this box if you want add categories of this project (this uses the portfolio item categories).", "hbthemes")
		),
		array(
			"name" => __("Link", "hbthemes"),
			"id" => $prefix . "portfolio_details_link",
			"type" => "text",
			"desc" => __("Enter link to your project.", "hbthemes")
		),
		array(
			"name" => __("Likes", "hbthemes"),
			"id" => $prefix . "portfolio_details_likes",
			"type" => "checkbox",
			"std" => "on",
			"desc" => __("Check this box if you want add how many likes your project has.", "hbthemes")
		),
		array(
			"name" => __("Other Projects", "hbthemes"),
			"id" => $prefix . "portfolio_details_other_projects",
			"type" => "checkbox",
			"std" => "on",
			"desc" => __("Check this box if you want add link to previous and next project.", "hbthemes")
		),
	)
);


// STAFF META BOXES

$hb_meta_boxes[] = array(
	"id" => "hb_staff_settings",
	"title" => __("Extra Settings","hbthemes"),
	"pages" => array( __( "staff" , "hbthemes" ) ),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		
		array(
			"name" => __("Staff Member Position", "hbthemes"),
			"id" => $prefix . "team_member_position",
			"type" => "text",
			"desc" => __("Position of your staff member.", "hbthemes")
		),
	)
);

$hb_meta_boxes[] = array(
	"id" => "hb_staff_socials",
	"title" => __("Social settings","hbthemes"),
	"pages" => array( __( "staff" , "hbthemes" ) ),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Facebook", "hbthemes"),
			"id" => $prefix . "staff_facebook",
			"type" => "text",
			"desc" => __("Link to Facebook profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Delicious", "hbthemes"),
			"id" => $prefix . "staff_delicious",
			"type" => "text",
			"desc" => __("Link to Delicious profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("DeviantArt", "hbthemes"),
			"id" => $prefix . "staff_deviantart",
			"type" => "text",
			"desc" => __("Link to DeviantArt profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Dribbble", "hbthemes"),
			"id" => $prefix . "staff_dribbble",
			"type" => "text",
			"desc" => __("Link to Dribbble profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Flickr", "hbthemes"),
			"id" => $prefix . "staff_flickr",
			"type" => "text",
			"desc" => __("Link to Flickr profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("GooglePlus", "hbthemes"),
			"id" => $prefix . "staff_googleplus",
			"type" => "text",
			"desc" => __("Link to GooglePlus profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Digg", "hbthemes"),
			"id" => $prefix . "staff_digg",
			"type" => "text",
			"desc" => __("Link to Digg profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Pinterest", "hbthemes"),
			"id" => $prefix . "staff_pinterest",
			"type" => "text",
			"desc" => __("Link to Pinterest profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Reddit", "hbthemes"),
			"id" => $prefix . "staff_reddit",
			"type" => "text",
			"desc" => __("Link to Reddit profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("LastFM", "hbthemes"),
			"id" => $prefix . "staff_lastfm",
			"type" => "text",
			"desc" => __("Link to LastFM profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("StumbleUpon", "hbthemes"),
			"id" => $prefix . "staff_stumbleupon",
			"type" => "text",
			"desc" => __("Link to StumbleUpon profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Twitter", "hbthemes"),
			"id" => $prefix . "staff_twitter",
			"type" => "text",
			"desc" => __("Link to Twitter profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("RSS", "hbthemes"),
			"id" => $prefix . "staff_rss",
			"type" => "text",
			"desc" => __("Link to RSS profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Apple", "hbthemes"),
			"id" => $prefix . "staff_apple",
			"type" => "text",
			"desc" => __("Link to Apple profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Skype", "hbthemes"),
			"id" => $prefix . "staff_skype",
			"type" => "text",
			"desc" => __("Link to Skype profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("YouTube", "hbthemes"),
			"id" => $prefix . "staff_youtube",
			"type" => "text",
			"desc" => __("Link to YouTube profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Forrst", "hbthemes"),
			"id" => $prefix . "staff_forrst",
			"type" => "text",
			"desc" => __("Link to Forrst profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Github", "hbthemes"),
			"id" => $prefix . "staff_github",
			"type" => "text",
			"desc" => __("Link to Github profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("LinkedIn", "hbthemes"),
			"id" => $prefix . "staff_linkedin",
			"type" => "text",
			"desc" => __("Link to LinkedIn profile of your staff member.", "hbthemes")
		),
		array(
			"name" => __("Vimeo", "hbthemes"),
			"id" => $prefix . "staff_vimeo",
			"type" => "text",
			"desc" => __("Link to Vimeo profile of your staff member.", "hbthemes")
		),
	)
);


/********************* FLEX SLIDER META BOXES ***********************/
$hb_meta_boxes[] = array(
	"id" => "hb_image_slide_attachment",
	"title" => __("Attach to Slider","hbthemes"),
	"pages" => array("flexslider"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Instructions", "hbthemes"),
			"id" => $prefix . "flex_instructions",
			"type" => "plaintext",
			"desc" => __("Add this slide to a slider from the list above. Note that you need to create at least one slider in our <strong>Slider Manager</strong> in <a href='" . get_home_url() . "'/wp-admin/themes.php?page=optionsframework'>theme options</a>", "hbthemes")
		),
		array(
			"name" => __("Attach this slide to a slider from the list", "hbthemes"),
			"id" => $prefix . "flexslider",
			"type" => "select",
			"options" => $flex_sliders,
			"desc" => __("Add this slide to a slider from the list above. Note that you need to create at least one slider in our <strong>Slider Manager</strong> in <a href='" . get_home_url() . "'/wp-admin/themes.php?page=optionsframework'>theme options</a>", "hbthemes")
		),
	)
);

$hb_meta_boxes[] = array(
	"id" => "hb_image_slide_settings",
	"title" => __("Slide Settings","hbthemes"),
	"pages" => array("flexslider"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Slide Image", "hbthemes"),
			"id" => $prefix . "image_slider_uploaded_image",
			"type" => "media_upload",
			"desc" => __("Attach image to this slide.", "hbthemes")
		),
		array(
			"name" => __("Slide Video", "hbthemes"),
			"id" => $prefix . "image_slider_video",
			"type" => "textarea",
			"desc" => __("Enter embedded link to a video.", "hbthemes")
		),
		array(
			"name" => __("Caption Text", "hbthemes"),
			"id" => $prefix . "image_slider_caption_text",
			"type" => "text",
			"desc" => __("Add a caption to this slide", "hbthemes")
		),
		array(
			"name" => __("Caption Link", "hbthemes"),
			"id" => $prefix . "image_slider_link",
			"type" => "text",
			"desc" => __("Add a link to your caption. (Optional)", "hbthemes")
		),
	)
);

// TESTIMONIALS

$hb_meta_boxes[] = array(
	"id" => "hb_testimonials_settings",
	"title" => __("Testimonial Settings","hbthemes"),
	"pages" => array(__("testimonials", "hbthemes")),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Author", "hbthemes"),
			"id" => $prefix . "testimonial_author",
			"type" => "text",
			"desc" => __("Enter Testimonial's Author", "hbthemes")
		),
		array(
			"name" => __("Author info", "hbthemes"),
			"id" => $prefix . "testimonial_author_info",
			"type" => "text",
			"desc" => __("Enter Testimonial's Author Info", "hbthemes")
		),
	)
);

// POST META BOXES
$hb_meta_boxes[] = array(
	"id" => "hb_post_settings",
	"title" => __("Post Format Settings","hbthemes"),
	"pages" => array("post"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		
		array(
			"name" => __("Link", "hbthemes"),
			"id" => $prefix . "link_post_link",
			"type" => "text",
			"desc" => __("Link for the <strong>link</strong> post format.", "hbthemes")
		),

		array(
			"name" => __("Embedded Video URL", "hbthemes"),
			"id" => $prefix . "video_post_link",
			"type" => "textarea",
			"desc" => __("Enter embedded video link for the <strong>video</strong> post format.", "hbthemes")
		),
		array(
			"name" => __("Select Slider", "hbthemes"),
			"id" => $prefix . "gallery_post_slider",
			"type" => "select",
			"options" => $flex_sliders,
			"desc" => __("Attach a Flex slider to <strong>gallery</strong> post format.", "hbthemes")
		),
	)
);

$hb_meta_boxes[] = array(
	"id" => "hb_post_option",
	"title" => __("Single Post Settings","hbthemes"),
	"pages" => array("post"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		array(
			"name" => __("Background Image", "hbthemes"),
			"id" => $prefix . "background_image_sep",
			"type" => "media_upload",
			"desc" => __("Attach background image.", "hbthemes")
		),
		array(
			"name" => __("Background Texture", "hbthemes"),
			"id" => $prefix . "background_texture_sep",
			"type" => "media_upload",
			"desc" => __("Add background texture.", "hbthemes")
		),
		array(
			"name" => __("Enable Page Title", "hbthemes"),
			"id" => $prefix . "page_title_enable",
			"type" => "checkbox",
			"desc" => __("Check this box if you want to enable a custom Page Title", "hbthemes")
		),
		array(
			"name" => __("Custom Page Title", "hbthemes"),
			"id" => $prefix . "page_custom_title",
			"type" => "text",
			"desc" => __("Enter custom page title.", "hbthemes")
		),
		array(
			"name" => __("Custom Page Description", "hbthemes"),
			"id" => $prefix . "page_custom_description",
			"type" => "text",
			"desc" => __("Enter custom page description.", "hbthemes")
		),
		array(
			"name" => __("Page Sidebar Position", "hbthemes"),
			"id" => $prefix . "page_sidebar_position",
			"type" => "select",
			"options" => array("none" => "None" , "hb_left_sidebar" => "Left Sidebar", "hb_right_sidebar" => "Right Sidebar"),
			"multiple" => false,
			"std" => "None",
			"desc" => __("Select a position for your sidebar. Choose between left and right.", "hbthemes")
		),
		array(
			"name" => __("Page Sidebar", "hbthemes"),
			"id" => $prefix . "page_sidebar_name",
			"type" => "sidebar_list",
			"std" => "",
			"desc" => __("Choose a sidebar for your page.", "hbthemes")	
		),
		array(
			"name" => __("Breadcrumbs", "hbthemes"),
			"id" => $prefix . "include_breadcrumbs",
			"type" => "checkbox",
			"desc" => __("Check if you want to use breadcrumbs on this page.", "hbthemes")
		),
		array(
			"name" => __("Enable About Author", "hbthemes"),
			"id" => $prefix . "about_author",
			"type" => "checkbox",
			"desc" => __("Check if you want to add about author on this page.", "hbthemes")
		),
		array(
			"name" => __("Page Slider", "hbthemes"),
			"id" => $prefix . "page_slider",
			"type" => "text",
			"desc" => __("Enter Revolution slider alias here.", "hbthemes")
		),
	)
);

// SEO META BOXES
$hb_meta_boxes[] = array(
	"id" => "hb_seo_options",
	"title" => __("Custom SEO Settings","hbthemes"),
	"pages" => array("page","post","portfolio"),
	"context" => "normal",
	"priority" => "high",
	"fields" => array(
		
		array(
			"name" => __("Use Custom SEO", "hbthemes"),
			"id" => $prefix . "seotools_active",
			"type" => "checkbox",
			"desc" => __("Check this box if you want to use custom SEO setting bellow. Otherwise default settings will be used.<br/><strong>SEO checkbox in theme options needs to be checked.</strong>", "hbthemes")
		),
		array(
			"name" => __("SEO Title", "hbthemes"),
			"id" => $prefix . "seotools_title",
			"type" => "text",
			"desc" => __("Enter custom page SEO title for this page.", "hbthemes")
		),
		array(
			"name" => __("SEO Description", "hbthemes"),
			"id" => $prefix . "seotools_description",
			"type" => "textarea",
			"desc" => __("Enter custom page SEO description for this page.", "hbthemes")
		),
		array(
			"name" => __("SEO Keywords", "hbthemes"),
			"id" => $prefix . "seotools_keywords",
			"type" => "textarea",
			"desc" => __("Enter custom page SEO keywords for this page. <small><em>&nbsp;&nbsp;*Separate keywords with commas.</em></small>", "hbthemes")
		),
	)
);
foreach ($hb_meta_boxes as $meta_box) {
	new hb_meta_box($meta_box);
}
?>