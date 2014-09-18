<?php

global $shortname;

add_action( 'init' , 'of_options' );

if ( !function_exists( 'of_options' ) )
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories( 'hide_empty=0' );
		foreach ( $of_categories_obj as $of_cat ) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$footer_images_path = get_template_directory(). '/admin/assets/images/footer/'; // change this to where you store your bg images
		$footer_images_url = get_template_directory_uri().'/admin/assets/images/footer/'; // change this to where you store your bg images
		$footer_images = array();
		
		if ( is_dir($footer_images_path) ) {
		    if ($footer_images_dir = opendir($footer_images_path) ) { 
		        while ( ($footer_images_file = readdir($footer_images_dir)) !== false ) {
		            if(stristr($footer_images_file, ".png") !== false || stristr($footer_images_file, ".jpg") !== false) {
		                $footer_images[$footer_images_file] = $footer_images_url . $footer_images_file;
		            }
		        }    
		    }
		}
		
		//Footer Style Images Reader
		$bg_images_path = get_template_directory(). '/images/textures/body'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/textures/body/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[$bg_images_url . $bg_images_file] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;

// Useful variables
$current_user = wp_get_current_user();
$nameofuser = $current_user->user_login;
$wordpressversion = get_bloginfo('version');
$my_theme = wp_get_theme();
$my_theme_version = $my_theme->Version;

$of_options = array();

$of_options[] = array( "name" => __( 'Dashboard' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'Dashboard Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_home_info",
					"std" => __( 'Hey there <strong>' , 'hbthemes' ) . $nameofuser . __('.</strong><br/><br/>Welcome to <strong>Aegaeus Dashboard.</strong><br/><br/>* Aegaeus Theme version <strong>','hbthemes') . $my_theme_version . __('</strong> *<br/>* WordPress version <strong>','hbthemes') . $wordpressversion . __('</strong> *<br/><br/>This is your theme dashboard. You can do some quick actions here, like setting your front page, menus or widgets, reading the documentation or contacting the authors.<br/><br/>Use <strong>Options Reset</strong> button to <strong>restore</strong> all options to default and <strong>Save All Changes</strong> to <strong>save</strong> the options that you have entered in each section<br/><br/><strong>TIP :</strong> Watch out for blue notifications like this one, at the top of the options pages, it can really help you understanding the settings and guiding you through the documentation sections.' , 'hbthemes' ),
					"icon" => true,
					"type" => "info");

$of_options[] = array ( "name" => __( 'Quick Actions ', 'hbthemes'),
					"text" => __( 'Set Front Page', 'hbthemes' ),
					"link" => "options-reading.php",
					"type" => "button",
					"id" => "hb_front_page"
					);

$of_options[] = array ( "name" => "",
					"text" => __( 'Create / Edit Menus' , 'hbthemes'),
					"link" => "nav-menus.php",
					"type" => "button",
					"id" => "hb_createedit_menu"
					);
$of_options[] = array ( "name" => "",
					"text" => __( 'Sidebars & Widgets' , 'hbthemes'),
					"link" => "widgets.php",
					"type" => "button",
					"id" => "hb_sidebar_widgets"
					);
$of_options[] = array ( "name" => "",
					"text" => __( 'Documentation' , 'hbthemes'),
					"link" => "http://documentation.hb-themes.com/aegaeus",
					"type" => "button",
					"id" => "hb_read_documentation"
					);
$of_options[] = array ( "name" => "",
					"text" => __( 'Contact the authors' , 'hbthemes'),
					"link" => "http://mojo-themes.com/user/BrankoCee",
					"type" => "button",
					"id" => "hb_contact_author"
					);
$of_options[] = array ( "name" => "",
					"text" => __( 'Open a support ticket' , 'hbthemes'),
					"link" => "http://hbsupport.ticksy.com",
					"type" => "button",
					"id" => "hb_ticket_author"
					);
$of_options[] = array ( "name" => "",
					"text" => __( 'Follow us on Twitter' , 'hbthemes'),
					"link" => "http://twitter.net/HB-Themes",
					"type" => "button",
					"id" => "hb_twitter_author"
					);					

$of_options[] = array( "name" => __( 'General Settings' , 'hbthemes' ), 
					"type" => "heading");
										
$of_options[] = array( "name" => __( 'General Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_general_info",
					"std" => __( 'This is the <strong>General Settings</strong> section.<br/><br/>It controls some of the most basic configuration settings for your site: enabling responsiveness, the like plugin, settings for archive/search pages, contact form success/error lines etc. <br/><br/><strong>TIP :</strong> You can find more information about the General section in the <a href="http://documentation.hb-themes.com/aegaeus/#generalSettings" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);
					
$of_options[] = array (
					"name" => __( 'Enable / Disable Responsiveness' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want the theme to be responsive.' , 'hbthemes' ),
					"id" => "hb_enable_responsive",
					"std" => true,
					"type" => "checkbox"
				);					

$of_options[] = array (
					"name" => __( 'Enable / Disable Like Plugin' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the like plugin.' , 'hbthemes' ),
					"id" => "hb_include_like",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Enable / Disable Search in Breadcrumbs' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the search box in breadcrumbs.' , 'hbthemes' ),
					"id" => "hb_include_breadcrumb_search",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Enable / Disable Return To Top Button' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable a return to top button.' , 'hbthemes' ),
					"id" => "hb_include_to_top",
					"std" => true,
					"type" => "checkbox"
				);					

$of_options[] = array (
					"name" => __( 'All Projects Link', 'hbthemes' ),
					"desc" => __( 'Enter a portfolio page permalink here which will lead to your portfolio page from every single portfolio. (The page containing your portfolio items)' , 'hbthemes' ),
					"id" => "hb_all_projects_link",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Comment Form Respond Line', 'hbthemes' ),
					"desc" => __( 'Enter a line of text which goes above the contact form.' , 'hbthemes' ),
					"id" => "hb_respond_title",
					"std" => "Don't worry. We never use your email for spam.",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Contact Form Success Message', 'hbthemes' ),
					"desc" => __( 'Enter success message for your contact form. This message will be displayed if the form has been filled out correctly and the email has been sent.' , 'hbthemes' ),
					"id" => "hb_contact_success",
					"std" => "Yippie! Your message has been successfully sent. Thank you.",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Contact Form Error Message', 'hbthemes' ),
					"desc" => __( "Enter error message for your contact form. This message will be displayed if the form hasn't been filled out properly." , 'hbthemes' ),
					"id" => "hb_contact_error",
					"std" => "Dang! It looks like there are errors in your form. Try again!",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Default Sidebar Position', 'hbthemes' ),
					"desc" => __( "Enter a position for the sidebar in page such as archive, category, search etc." , 'hbthemes' ),
					"id" => "hb_archive_pages_sidebar_position",
					"std" => "None",
					"type" => "select",
					"options" => array ( 'None' => 'None' , 'Left-Sidebar' => 'Left-Sidebar' , 'Right-Sidebar' => 'Right-Sidebar' )
				);
					
$of_options[] = array( "name" => __( 'Custom CSS', 'hbthemes' ),
					"desc" => __( 'Enter your custom CSS code' , 'hbthemes'),
					"id" => "hb_custom_css_field",
					"std" => '',
					"type" => "textarea"
);

					
$of_options[] = array( "name" => __( 'Header Settings' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'Logo Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_logo_info",
					"std" => __( 'This is the <strong>Logo Settings</strong> section.<br/><br/>Upload your logo image and resize it if needed. If you leave logo image field empty, site title from <strong>General Settings</strong> will be used as logo text.<br/><br/>Also, you can upload your favicon and apple icon image here.<br/><br/><strong>TIP :</strong> If you leave width or height inputs empty, the logo image will not be resized. Actual image size will be used. Find more about Logo Settings in our <a href="http://documentation.hb-themes.com/aegaeus/#logoSettings" target="_blank">theme documentation</a>.' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);
					
$of_options[] = array (
					"name" => __( 'Site Logo', 'hbthemes' ),
					"desc" => __( 'Upload a logo for your site. If you do not upload an image, site title will be used as logo.' , 'hbthemes' ),
					"id" => "hb_image_logo",
					"std" => "",
					"type" => "media"
				);

$of_options[] = array (
					"name" => '',
					"desc" => __( 'Write your site logo in HTML.<br/><small><strong>Always use single instead of double quotes</strong></small>.' , 'hbthemes' ),
					"id" => "hb_html_logo",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => '',
					"desc" => __( '<strong>Logo Width</strong>.<br/>If you do not enter any value, logo image will not be resized.' , 'hbthemes' ),
					"id" => "hb_logo_width",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => '',
					"desc" => __( '<strong>Logo Height</strong>.<br/>If you do not enter any value, logo image will not be resized.' , 'hbthemes' ),
					"id" => "hb_logo_height",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Enable / Disable Tagline' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable Tagline bellow logo.' , 'hbthemes' ),
					"id" => "hb_enable_tagline",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Favicon, Apple Icon and Android Icon', 'hbthemes' ),
					"desc" => __( '<strong>Favicon : </strong> Upload a <a href="http://en.wikipedia.org/wiki/Favicon" target="_blank">Favicon</a> image.' , 'hbthemes' ),
					"id" => "hb_favicon",
					"std" => "",
					"type" => "media"
				);
$of_options[] = array (
					"name" => '',
					"desc" => __( '<strong>Apple Icon : </strong> Upload an 144 x 144 <a href="http://mathiasbynens.be/notes/touch-icons" target="_blank">Apple Icon</a> image for high-resolution iPad \'Retina\' displays.' , 'hbthemes' ),
					"id" => "hb_appleicon_144",
					"std" => "",
					"type" => "media"
				);

$of_options[] = array (
					"name" => '',
					"desc" => __( '<strong>Apple Icon : </strong> Upload an 114 x 114 <a href="http://mathiasbynens.be/notes/touch-icons" target="_blank">Apple Icon</a> image for high-resolution iPhone \'Retina\' displays.' , 'hbthemes' ),
					"id" => "hb_appleicon_114",
					"std" => "",
					"type" => "media"
				);

$of_options[] = array (
					"name" => '',
					"desc" => __( '<strong>Apple Icon : </strong> Upload an 54 x 54 <a href="http://mathiasbynens.be/notes/touch-icons" target="_blank">Apple Icon</a> image for other displays.' , 'hbthemes' ),
					"id" => "hb_appleicon",
					"std" => "",
					"type" => "media"
				);
				
$of_options[] = array (
					"name" => __( 'Enable / Disable Site Info' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable Site info box.' , 'hbthemes' ),
					"id" => "hb_enable_siteinfo",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Site Info Content' , 'hbthemes' ),
					"desc" => __( 'Enter your site info here.' , 'hbthemes' ),
					"id" => "hb_siteinfo_content",
					"std" => "<span>Call us now!</span> 0800-500-400",
					"type" => "text"
				);


$of_options[] = array( "name" => __( 'SEO Settings' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'SEO Settings info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_seo_info",
					"std" => __( 'This is the <strong>SEO Settings</strong> section.<br/><br/>SEO is a technique which helps search engines find and rank your site higher than the millions of other sites in response to a search query.<br/><br/>In the fields bellow you specify metadata that will apply to <strong>those pages that do not have custom metadata</strong>. Don\'t forget that every page or post can have custom SEO metadata, but you have to check the option bellow. In case these fields are left empty, metatags will be set using WordPress.<br/><br/><strong>TIP : </strong>You can find more about WordPress meta tags on <a href="http://codex.wordpress.org/Meta_Tags_in_WordPress" target="_blank">Codex</a> and more about our SEO implementation in our <a href="http://documentation.hb-themes.com/aegaeus/#seoSettings" target="_blank">theme documentation</a>.' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array (
					"name" => __( 'Enable / Disable SEO' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable your site custom SEO settings.' , 'hbthemes' ),
					"id" => "hb_seo_enable",
					"std" => false,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Default title', 'hbthemes' ),
					"desc" => __( 'Enter your default title text.' , 'hbthemes' ),
					"id" => "hb_seo_title",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Default Description' , 'hbthemes' ),
					"desc" => __( 'Enter your default description text.' , 'hbthemes' ),
					"id" => 'hb_seo_description',
					"std" => "",
					"type" => "textarea"
				);

$of_options[] = array (
					"name" => __( 'Default Keywords' , 'hbthemes' ),
					"desc" => __( 'Enter your default keywords. <br/>Separate them using commas.<br/><br/><em>Example: HTML, CSS, XML, JavaScript</em>' , 'hbthemes' ),
					"id" => 'hb_seo_keywords',
					"std" => "",
					"type" => "textarea"
				);

				
$of_options[] = array( "name" => __( 'Sidebar Settings' , 'hbthemes' ), 
					"type" => "heading");


$of_options[] = array( "name" => __( 'Sidebar Settings info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_seo_info",
					"std" => __( 'This is the <strong>Sidebar Settings</strong> section.<br/><br/>This section allows you to create unlimited number of sidebars simply by clicking the button <strong>Add New Sidebar</strong>.<br/><br/>You can open details on each sidebar by clicking the arrow at the top right corner of each sidebar title. Details allows you to rename each sidebar or to remove it. You can reorder sidebars by draging the titles.<br/><br/> Once you have created the desired number of sidebars, go to <strong>Appearance > Widgets</strong> to populate them with Widget items.<br/><br/><strong>TIP : </strong> Don\'t forget to click <strong>Save All Changes</strong> before you leave this section. More about sidebars in our <a href="http://documentation.hb-themes.com/aegaeus/#sidebarSettings" target="_blank">theme documentation</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array (
					"name" => __( 'Sidebars', 'hbthemes' ),
					"desc" => '',
					"id" => "hb_sidebar",
					"std" => array(),
					"type" => "sidebar"
				);

$of_options[] = array( "name" => __( 'Slider Manager' , 'hbthemes' ), 
					"type" => "heading");

$of_options[] = array( "name" => __( 'Post Types Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_post_type_info",
					"std" => __( 'This is the <strong>Slider Manager</strong> section.</br></br>Here you can create unlimited number of three different types of sliders.<br/><br/>You can open details on each slider by clicking the arrow at the top right corner of each slider title. Details allows you to change each sliders values, as well as removing the slider.<br/></br>Once you have created the sliders, you need to create <strong>Slides</strong>.</br></br><strong>Important : </strong>It\'s very important to read the documentation of this section in our <a href="http://documentation.hb-themes.com/aegaeus/#sliderManager" target="_blank">theme documentation</a>, you can also view video tutorials there. ' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array( "name" => __( 'Flex Slider', 'hbthemes' ),
					"desc" => "List of created Flex Sliders.",
					"id" => "hb_flex_slider",
					"std" => array(),
					"type" => "flexslider"
					);
				
$of_options[] = array( "name" => __( 'Footer Settings' , 'hbthemes' ), 
					"type" => "heading");
															
$of_options[] = array( "name" => __( 'Footer Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_footer_info",
					"std" => __( 'This is the <strong>Footer Settings</strong> section.<br/><br/>Here you can choose from a predefined list of 11 <strong>footer layouts</strong>. <br/>Also you can enter a Footer Copyright line in this section. <br/><br/><strong>TIP :</strong> You can find more information about the Footer section in the <a href="http://documentation.hb-themes.com/aegaeus/#footerSettings" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);


$of_options[] = array (
					"name" => __( 'Disable Footer Widgets' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to disable footer widgets completely.' , 'hbthemes' ),
					"id" => "hb_disable_footer",
					"std" => false,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Disable Copyright Line' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to disable copyright line.' , 'hbthemes' ),
					"id" => "hb_disable_copyright_line",
					"std" => false,
					"type" => "checkbox"
				);
					
$of_options[] = array( "name" => __( 'Select Footer Layout', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_footer_layout",
					"std" => 'footer-style-01.png',
					"options" => $footer_images,
					"type" => "tiles"
					);	

$of_options[] = array (
					"name" => __( 'Copyright Line' , 'hbthemes' ),
					"desc" => __( 'Enter a line of text that goes on the footer bottom.' , 'hbthemes' ),
					"id" => "hb_copyright",
					"std" => "Copyright 2012 &middot; Aegaeus. Proudly powered by <a href='#'>WordPress.</a>",
					"type" => "text"
				);

$of_options[] = array( "name" => __( 'Social Links' , 'hbthemes' ), 
					"type" => "heading");
		
					
$of_options[] = array( "name" => __( 'Social Links Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_social_links_info",
					"std" => __( 'This is the <strong>Social Links</strong> section.<br/><br/>Here you can enter the links to your social networks which will be shown in page title box. Leave fields empty if you don\'t want to show that social network icon.<br/><br/><strong>TIP :</strong> There\'s a RSS field at the bottom of this section. Have a look at <a href="http://codex.wordpress.org/WordPress_Feeds" target="_blank">Codex</a> for more info about RSS feeds. Find more about social links section in our <a href="http://documentation.hb-themes.com/aegaeus/#socialLinks" target="_blank">theme documentation</a>. ' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);
					
$of_options[] = array (
					"name" => __( 'Facebook', 'hbthemes' ),
					"desc" => __( 'Link to your Facebook profile.' , 'hbthemes' ),
					"id" => "hb_facebook",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Twitter', 'hbthemes' ),
					"desc" => __( 'Link to your Facebook profile.' , 'hbthemes' ),
					"id" => "hb_twitter",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( 'Vimeo', 'hbthemes' ),
					"desc" => __( 'Link to your Facebook profile.' , 'hbthemes' ),
					"id" => "hb_vimeo",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Delicious', 'hbthemes' ),
					"desc" => __( 'Link to your Delicious profile.' , 'hbthemes' ),
					"id" => "hb_delicious",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'DeviantArt', 'hbthemes' ),
					"desc" => __( 'Link to your DeviantArt profile.' , 'hbthemes' ),
					"id" => "hb_deviantart",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Dribbble', 'hbthemes' ),
					"desc" => __( 'Link to your Dribbble profile.' , 'hbthemes' ),
					"id" => "hb_dribbble",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Flickr', 'hbthemes' ),
					"desc" => __( 'Link to your Flickr profile.' , 'hbthemes' ),
					"id" => "hb_flickr",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Google Plus', 'hbthemes' ),
					"desc" => __( 'Link to your Google Plus profile.' , 'hbthemes' ),
					"id" => "hb_googleplus",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Digg', 'hbthemes' ),
					"desc" => __( 'Link to your Digg profile.' , 'hbthemes' ),
					"id" => "hb_digg",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Pinterest', 'hbthemes' ),
					"desc" => __( 'Link to your Pinterest profile.' , 'hbthemes' ),
					"id" => "hb_pinterest",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Reddit', 'hbthemes' ),
					"desc" => __( 'Link to your Reddit profile.' , 'hbthemes' ),
					"id" => "hb_reddit",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'LastFM', 'hbthemes' ),
					"desc" => __( 'Link to your LastFM profile.' , 'hbthemes' ),
					"id" => "hb_lastfm",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'StumbleUpon', 'hbthemes' ),
					"desc" => __( 'Link to your StumbleUpon profile.' , 'hbthemes' ),
					"id" => "hb_stumbleupon",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'RSS', 'hbthemes' ),
					"desc" => __( 'Link to your RSS profile.' , 'hbthemes' ),
					"id" => "hb_rss",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Apple', 'hbthemes' ),
					"desc" => __( 'Link to your Apple profile.' , 'hbthemes' ),
					"id" => "hb_apple",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Skype', 'hbthemes' ),
					"desc" => __( 'Link to your Skype profile.' , 'hbthemes' ),
					"id" => "hb_skype",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'YouTube', 'hbthemes' ),
					"desc" => __( 'Link to your YouTube profile.' , 'hbthemes' ),
					"id" => "hb_youtube",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'Forrst', 'hbthemes' ),
					"desc" => __( 'Link to your Forrst profile.' , 'hbthemes' ),
					"id" => "hb_forrst",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'GitHub', 'hbthemes' ),
					"desc" => __( 'Link to your GitHub profile.' , 'hbthemes' ),
					"id" => "hb_github",
					"std" => "",
					"type" => "text"
				);
				
$of_options[] = array (
					"name" => __( 'LinkedIn', 'hbthemes' ),
					"desc" => __( 'Link to your LinkedIn profile.' , 'hbthemes' ),
					"id" => "hb_linkedin",
					"std" => "",
					"type" => "text"
				);


$of_options[] = array( "name" => __( 'Page 404' , 'hbthemes' ), 
					"type" => "heading");

$of_options[] = array( "name" => __( '404 Page Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_four_o_four_info",
					"std" => __( 'This is the <strong>404 Page Settings</strong> section.<br/></br>This theme comes with customizable 404 page. Here you can specify some basic settings about your 404 page.<br/><br/><strong>TIP : </strong>You can view your 404 page <a href="'.get_bloginfo('url').'/?error=404">here</a>. More about this section in our <a href="http://documentation.hb-themes.com/aegaeus/#page404" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array (
					"name" => __( '404 Page Title', 'hbthemes' ),
					"desc" => '',
					"id" => "hb_error_title",
					"std" => "404",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( '404 Page Description', 'hbthemes' ),
					"desc" => '',
					"id" => "hb_error_description",
					"std" => "The page you are looking for cannot be found.",
					"type" => "text"
				);
					


$of_options[] = array (
					"name" => __( 'Enable / Disable Search Form' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the search form including separator.' , 'hbthemes' ),
					"id" => "hb_enable_search",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Search Title', 'hbthemes' ),
					"desc" => __( 'Enter a line which goes above the search form.' , 'hbthemes' ),
					"id" => "hb_error_search_title",
					"std" => "<span>Feeling lost?</span> Search the website.",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( '404 Separator Icon Title', 'hbthemes' ),
					"desc" => __( 'Text shown when hovering separator icon.' , 'hbthemes' ),
					"id" => "hb_error_separator_icon_title",
					"std" => "Are you lost?",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __( '404 Separator Icon', 'hbthemes' ),
					"desc" => __( 'You can choose between two types of separator icons. Find more about separator icons <a href="#">here</a>.' , 'hbthemes' ),
					"id" => "hb_error_separator_icon",
					"std" => "cloud icon",
					"type" => "text"
				);
				
$of_options[] = array( "name" => __( 'Redirect Page' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'Redirect Page Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_redirect_info",
					"std" => __( 'This is the <strong>Redirect Page Settings</strong> section.<br/><br/>This theme comes with an unique redirect page template. Here you can define some basic settings about redirect page template.<br/><br/>More about this section in our <a href="http://documentation.hb-themes.com/aegaeus/#redirectPage" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);
					
$of_options[] = array (
					"name" => __( 'Timer value', 'hbthemes' ),
					"desc" => __( 'Enter timer value in seconds for redirect page.' , 'hbthemes' ),
					"id" => "hb_redirect_time",
					"std" => "15",
					"type" => "text"
				);	
				
$of_options[] = array (
					"name" => __( 'Redirect page title', 'hbthemes' ),
					"desc" => __( 'Enter title for redirect page.' , 'hbthemes' ),
					"id" => "hb_redirect_title",
					"std" => "External Link",
					"type" => "text"
				);	
				
$of_options[] = array (
					"name" => __( 'Redirect page description', 'hbthemes' ),
					"desc" => __( 'Enter description for redirect page.' , 'hbthemes' ),
					"id" => "hb_redirect_subtitle",
					"std" => "You are about to leave ".get_bloginfo('title'),
					"type" => "text"
				);	
				
$of_options[] = array (
					"name" => __( 'Redirect page icon', 'hbthemes' ),
					"desc" => __( 'Enter icon for redirect page.' , 'hbthemes' ),
					"id" => "hb_redirect_icon",
					"std" => "icon-globe",
					"type" => "text"
				);


$of_options[] = array( "name" => __( 'Map Settings' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'Map Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_map_info",
					"std" => __( 'This is the <strong>Map Settings</strong> section.<br/><br/>Choose whether you want a <strong>header dropdown</strong> containing a map on your website. Enter details for displaying the map, such as its embedded URL, check which elements to add to the map.<br/><br/>Add a box containing your <strong>basic contact</strong> info!<br/><br/><strong>TIP :</strong> You can find more information about the Map section in the <a href="http://documentation.hb-themes.com/aegaeus/#mapSettings" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);					


$of_options[] = array (
					"name" => __( 'Enable / Disable Gmap Header Dropdown' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the dropdown containing a Google Map' , 'hbthemes' ),
					"id" => "hb_include_gmap_header",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => 'Google Map URL',
					"desc" => __( 'URL' , 'hbthemes' ),
					"id" => "hb_map_link",
					"std" => "",
					"type" => "text"
				);

$of_options[] = array (
					"name" => __('Center Icon' , 'hbthemes' ),
					"desc" => __( 'Upload a 32x32 px icon to place in the center of the map (a pin icon).' , 'hbthemes' ),
					"id" => "hb_map_centerIcon",
					"type" => "upload"
				);

$of_options[] = array (
					"name" => __('Enable / Disable Pan Control' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the Pan Control' , 'hbthemes' ),
					"id" => "hb_map_panControl",
					"std" => true,
					"type" => "checkbox"
				);

$of_options[] = array (
					"name" => __( 'Enable / Disable Zoom Control' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the Zoom Control' , 'hbthemes' ),
					"id" => "hb_map_zoomControl",
					"std" => true,
					"type" => "checkbox"
				);
				
$of_options[] = array (
					"name" => __( 'Use Small Zoom' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want use a small zoom panel ( shows only + and - sign )' , 'hbthemes' ),
					"id" => "hb_map_zoomSize",
					"std" => true,
					"type" => "checkbox"
				);
				
$of_options[] = array (
					"name" => __( 'Enable / Disable Map Type Control' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the Map Type Control' , 'hbthemes' ),
					"id" => "hb_map_typeControl",
					"std" => true,
					"type" => "checkbox"
				);
$of_options[] = array (
					"name" => __( 'Enable / Disable Street View Control' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the Street View Control' , 'hbthemes' ),
					"id" => "hb_map_streetViewControl",
					"std" => true,
					"type" => "checkbox"
				);
$of_options[] = array (
					"name" => __( 'Enable / Disable Overview Control' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable the Overview Control' , 'hbthemes' ),
					"id" => "hb_map_overviewControl",
					"std" => true,
					"type" => "checkbox"
				);
$of_options[] = array (
					"name" => __( 'Enable / Disable Map Contact Info Box' , 'hbthemes' ),
					"desc" => __( 'Check this box if you want to enable a box with your info over the map.' , 'hbthemes' ),
					"id" => "hb_enable_map_box",
					"std" => false,
					"type" => "checkbox"
				);
				
$of_options[] = array (
					"name" => __( 'Map Box Title', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box title.' , 'hbthemes' ),
					"id" => "hb_map_box_title",
					"std" => "",
					"type" => "text"
				);
$of_options[] = array (
					"name" => __( 'Map Box Phone', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box phone.' , 'hbthemes' ),
					"id" => "hb_map_box_phone",
					"std" => "",
					"type" => "text"
				);
$of_options[] = array (
					"name" => __( 'Map Box Fax', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box fax.' , 'hbthemes' ),
					"id" => "hb_map_box_fax",
					"std" => "",
					"type" => "text"
				);
$of_options[] = array (
					"name" => __( 'Map Box Mail', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box mail.' , 'hbthemes' ),
					"id" => "hb_map_box_mail",
					"std" => "",
					"type" => "text"
				);
$of_options[] = array (
					"name" => __( 'Map Box Website', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box website.' , 'hbthemes' ),
					"id" => "hb_map_box_website",
					"std" => "",
					"type" => "text"
				);
$of_options[] = array (
					"name" => __( 'Map Box Address', 'hbthemes' ),
					"desc" => __( 'Enter map contact info box address.' , 'hbthemes' ),
					"id" => "hb_map_box_address",
					"std" => "",
					"type" => "text"
				);

				

$of_options[] = array( "name" => __( 'Font Settings' , 'hbthemes' ), 
					"type" => "heading");

$of_options[] = array( "name" => __( 'Font Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_fonts_setting_info",
					"std" => __( 'This is the <strong>Font Settings</strong> section.<br/><br/>Here you can select theme fonts, enter custom font-face CSS code and change font color.<br/><br/>These are just small typography changes, for bigger changes we suggest <a href="http://adrian3.com/projects/wordpress-plugins/wordpress-google-fonts-plugin/" target="_blank">Google Web Fonts Plugin </a> for WordPress.<br/><br/><strong> TIP : </strong>Find about font section and embedding Google Web Fonts in our <a href="http://documentation.hb-themes.com/aegaeus/#fontSettings" target="_blank">theme documentation file.</a>' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array( "name" => __( 'Enable / Disable Custom Typography', 'hbthemes' ),
					"desc" => __("Check this box to enable custom typography.","hbthemes"),
					"id" => "hb_use_custom_typography",
					"std" => false,
					"type" => "checkbox"
					);

$of_options[] = array( "name" => __( 'Content Font', 'hbthemes' ),
					"desc" => __("Content main font settings.","hbthemes"),
					"id" => "hb_body_font",
					"std" => array('size' => '12px','face' => 'Helvetica Neue, Helvetica','style' => 'normal','color' => '#656565'),
					"type" => "typography"
					);

$of_options[] = array( "name" => __( 'Navigation Font', 'hbthemes' ),
					"desc" => __("Navigation font settings.","hbthemes"),
					"id" => "hb_nav_font",
					"std" => array('size' => '12px','face' => 'Helvetica Neue, Helvetica','style' => 'normal','color' => '#656565'),
					"type" => "typography"
					);

$of_options[] = array( "name" => __( 'Widget Areas Font', 'hbthemes' ),
					"desc" => __("Widget Areas font settings.","hbthemes"),
					"id" => "hb_widget_font",
					"std" => array('size' => '12px','face' => 'Helvetica Neue, Helvetica','style' => 'normal','color' => '#656565'),
					"type" => "typography"
					);

$of_options[] = array( "name" => __( 'H1 Heading', 'hbthemes' ),
					"desc" => __("H1 font settings.","hbthemes"),
					"id" => "hb_h1_font",
					"std" => array('size' => '28px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);

$of_options[] = array( "name" => __( 'H2 Heading', 'hbthemes' ),
					"desc" => __("H2 font settings.","hbthemes"),
					"id" => "hb_h2_font",
					"std" => array('size' => '24px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);

$of_options[] = array( "name" => __( 'H3 Heading', 'hbthemes' ),
					"desc" => __("H3 font settings.","hbthemes"),
					"id" => "hb_h3_font",
					"std" => array('size' => '20px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);	

$of_options[] = array( "name" => __( 'H4 Heading', 'hbthemes' ),
					"desc" => __("H4 font settings.","hbthemes"),
					"id" => "hb_h4_font",
					"std" => array('size' => '16px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);	

$of_options[] = array( "name" => __( 'H5 Heading', 'hbthemes' ),
					"desc" => __("H5 font settings.","hbthemes"),
					"id" => "hb_h1_font",
					"std" => array('size' => '14px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);	

$of_options[] = array( "name" => __( 'H6 Heading', 'hbthemes' ),
					"desc" => __("H6 font settings.","hbthemes"),
					"id" => "hb_h6_font",
					"std" => array('size' => '13px','face' => 'PTSansCaptionBold','style' => 'normal','color' => '#404348'),
					"type" => "typography"
					);
					
$of_options[] = array( "name" => __( 'Custom Font Import', 'hbthemes' ),
					"desc" => __("Import custom fonts here.","hbthemes"),
					"id" => "hb_custom_font_import",
					"std" => '',
					"type" => "textarea"
					);		

$of_options[] = array( "name" => __( 'Style Settings' , 'hbthemes' ), 
					"type" => "heading");
					
$of_options[] = array( "name" => __( 'Theme Color', 'hbthemes' ),
					"desc" => __("Theme Color Focus is a color in hex format used for many elements.","hbthemes"),
					"id" => "hb_theme_color",
					"std" => '#ff6838',
					"type" => "color"
					);					
					
$of_options[] = array( "name" => __( 'Default Background Texture', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_background_tiles_images",
					"std" => $bg_images_url . 'dots1.png',
					"options" => $bg_images,
					"type" => "tiles"
					);		

$of_options[] = array (
					"name" => __( 'Default Background Image', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_default_background",
					"std" => "",
					"type" => "media"
				);

$of_options[] = array( "name" => __( 'Use Default Plain Background color', 'hbthemes' ),
					"desc" => __("Check this box if you want to use plain background color.","hbthemes"),
					"id" => "hb_plain_bg",
					"std" => false,
					"type" => "checkbox"
					);

$of_options[] = array( "name" => __( 'Plain Background Color', 'hbthemes' ),
					"desc" => __("Select a default background color for your website.","hbthemes"),
					"id" => "hb_plain_bg_color",
					"std" => '#363D40',
					"type" => "color"
					);						
					
$of_options[] = array( "name" => __( 'Backup Options' , 'hbthemes' ), 
					"type" => "heading");


$of_options[] = array( "name" => __( 'Backup Settings Info', 'hbthemes' ),
					"desc" => "",
					"id" => "hb_backup_setting_info",
					"std" => __( 'This is the <strong>Backup Options</strong> section.<br/><br/>Here you can backup or restore your theme options.<br/><br/>Click <strong>Backup Options</strong> to backup your current theme options values.<br/>Click <strong>Restore Options</strong> to restore theme options from your latest backup.' , 'hbthemes' ),
					"icon" => true,
					"type" => "info"
					);

$of_options[] = array( "name" => __( 'Backup Theme Options Values', 'hbthemes' ),
					"id" => "hb_backup_options",
					"type" => "backup"
					);	

	}
}
?>