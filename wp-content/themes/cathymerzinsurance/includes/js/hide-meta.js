jQuery(document).ready(function () {

	function hide_all_page_meta_boxes() {
		if ( jQuery('.icon32-posts-page').length ) {
		
		
			if( jQuery('.postbox').length ) {
			jQuery('.hb-select').each(function(){
			
				if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
					jQuery(this).parent().parent().hide();
				}
				
				if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
					jQuery(this).parent().parent().hide();
				}
					
				if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
					jQuery(this).parent().parent().hide();
				}
				
				if(jQuery(this).attr("name") == "hb_tour_position") {
					jQuery(this).parent().parent().hide();
				}
				
				if(jQuery(this).attr("name") == "hb_staff_columns") {
					jQuery(this).parent().parent().hide();
				}
				
				if(jQuery(this).attr("name") == "hb_portfolio_columns") {
					jQuery(this).parent().parent().hide();
				}
			});
			
			jQuery('.hb-checkbox').each( function() {
			
				if(jQuery(this).attr("name") == "hb_page_title_enable") {
					jQuery(this).parent().parent().hide();
				}
				
				if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
					jQuery(this).parent().parent().hide();
				}
					
			});
			
			jQuery('#input_hb_background_image_sep').parent().parent().hide();
			jQuery('#input_hb_background_texture_sep').parent().parent().hide();
			jQuery('#hb_page_custom_title').parent().parent().hide();
			jQuery('#hb_page_custom_description').parent().parent().hide();
			jQuery('#hb_redirect_link').parent().parent().hide();
			jQuery('#hb_page_slider').parent().parent().hide();
			jQuery('#hb_contact_page_map').parent().parent().hide();
			jQuery('#hb_exclude_from_blog_categories').parent().parent().hide();
			jQuery('#hb_staff_department_include').parent().parent().hide();
			jQuery('#hb_portfolio_category_include').parent().parent().hide();
			jQuery('#hb_portfolio_page_description').parent().parent().hide();
			jQuery('#hb_portfolio_separator_icon').parent().parent().hide();
			
			}
		}
	}


	function show_page_meta_boxes() {
		hide_all_page_meta_boxes();
		
		var current;
		
		jQuery('#page_template').find("option").each( function() {
			if (jQuery(this).attr("selected") == "selected" ){
				current = jQuery(this).val();
			}
		});
		
		switch( current ){
			case 'page-archive.php':
				
				jQuery('.hb-select').each(function(){
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
			break;
			
			case 'page-blog.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
				jQuery('#hb_exclude_from_blog_categories').parent().parent().show();
			break;
			
			case 'page-blog-grid.php':
				jQuery('.hb-select').each(function(){
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
				jQuery('#hb_exclude_from_blog_categories').parent().parent().show();
			break;
			
			case 'page-contact.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_contact_page_map').parent().parent().show();

			break;
			
			case 'page-portfolio.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_columns") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
				jQuery('#hb_portfolio_category_include').parent().parent().show();
				jQuery('#hb_portfolio_page_description').parent().parent().show();
				jQuery('#hb_portfolio_separator_icon').parent().parent().show();
			break;
			
			case 'page-portfolio-gallery.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_columns") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
				jQuery('#hb_portfolio_category_include').parent().parent().show();
				jQuery('#hb_portfolio_page_description').parent().parent().show();
				jQuery('#hb_portfolio_separator_icon').parent().parent().show();
			break;
			
			case 'page-redirect.php':
				jQuery('#hb_redirect_link').parent().parent().show();
			break;
			
			case 'page-sitemap.php':
				jQuery('.hb-select').each(function(){
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
			break;
			
			case 'page-team.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_staff_columns") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();
				jQuery('#hb_staff_department_include').parent().parent().show();
			break;
			
			case 'page-testimonials.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
										
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();	
			break;
			
			case 'page-tour.php':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_tour_position") {
						jQuery(this).parent().parent().show();
					}
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();	
			break;
			case 'default':
				jQuery('.hb-select').each(function(){
					if(jQuery(this).attr("name") == "hb_page_sidebar_position") {
						jQuery(this).parent().parent().show();
					}
										
					if(jQuery(this).attr("name") == "hb_page_sidebar_name") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_portfolio_page_slider") {
						jQuery(this).parent().parent().show();
					}
					
				});
				jQuery('.hb-checkbox').each( function() {
					if(jQuery(this).attr("name") == "hb_page_title_enable") {
						jQuery(this).parent().parent().show();
					}
					
					if(jQuery(this).attr("name") == "hb_include_breadcrumbs") {
						jQuery(this).parent().parent().show();
					}
					
				});
				
				jQuery('#input_hb_background_image_sep').parent().parent().show();
				jQuery('#input_hb_background_texture_sep').parent().parent().show();
				jQuery('#hb_page_custom_title').parent().parent().show();
				jQuery('#hb_page_custom_description').parent().parent().show();
				jQuery('#hb_page_slider').parent().parent().show();	
			break;
		}
		
	}
	
	show_page_meta_boxes();
	
	jQuery('#page_template').change( function() {
		show_page_meta_boxes();	
	});
	
	function hide_all_post_meta_boxes() {
		if( jQuery('.icon32-posts-post').length ) 	{
			if( jQuery('.postbox').length ) {
				jQuery('#hb_post_settings').hide();
				jQuery('#hb_link_post_link').parent().parent().hide();
				jQuery('#hb_video_post_link').parent().parent().hide();
				jQuery('.hb-select').each(function(){ 
					if(jQuery(this).attr("name") == "hb_gallery_post_slider") {
						jQuery(this).parent().parent().hide();
					}
				});
				
				var aside = jQuery('#post-format-aside').attr('checked');
				var video = jQuery('#post-format-video').attr('checked');
				var link = jQuery('#post-format-link').attr('checked');
				var gallery = jQuery('#post-format-gallery').attr('checked');
				var standard = jQuery('#post-format-0').attr('checked');
				
				if (link == 'checked'){
					jQuery('#hb_post_settings').show();
					jQuery('#hb_link_post_link').parent().parent().show();
				} else if (video == 'checked'){
					jQuery('#hb_post_settings').show();
					jQuery('#hb_video_post_link').parent().parent().show();
				} else if ( gallery ==  'checked' ) {
					jQuery('#hb_post_settings').show();
					jQuery('.hb-select').each(function(){ 
					if(jQuery(this).attr("name") == "hb_gallery_post_slider") {
						jQuery(this).parent().parent().show();
					}
				});
				}
			}
		}
	}
	
	hide_all_post_meta_boxes();
	
	jQuery('#post-format-0').live("click", function () {
		hide_all_post_meta_boxes();
	});
	
	jQuery('#post-format-video').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_settings').show();
		jQuery('#hb_video_post_link').parent().parent().show();
	});
	
	jQuery('#post-format-link').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_settings').show();
		jQuery('#hb_link_post_link').parent().parent().show();
	});
	
	jQuery('#post-format-aside').live("click", function () {
		hide_all_post_meta_boxes();
	});
	
	jQuery('#post-format-gallery').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_settings').show();
		jQuery('.hb-select').each(function(){ 
			if(jQuery(this).attr("name") == "hb_gallery_post_slider") {
				jQuery(this).parent().parent().show();
			}
		});
	});

	/*
		
			

	function hide_all_post_meta_boxes() {
		if( jQuery('.icon32-posts-post').length ) 	{
			if( jQuery('.postbox').length ) {
				jQuery('#hb_post_format_options').hide();
				jQuery('#hb_post_aside_content').parent().parent().hide();
				jQuery('#hb_post_video_link').parent().parent().hide();
				jQuery('#hb_post_audio_song_mp3').parent().parent().hide();
				jQuery('#hb_post_audio_song_ogg').parent().parent().hide();
				jQuery('#hb_post_quote_content').parent().parent().hide();
				jQuery('#hb_post_link_content').parent().parent().hide();

				var aside = jQuery('#post-format-aside').attr('checked');
				var audio = jQuery('#post-format-audio').attr('checked');
				var video = jQuery('#post-format-video').attr('checked');
				var link = jQuery('#post-format-link').attr('checked');
				var quote = jQuery('#post-format-quote').attr('checked');
				var image = jQuery('#post-format-image').attr('checked');
				var standard = jQuery('#post-format-0').attr('checked');

				if (aside == 'checked') {
					jQuery('#hb_post_format_options').show();
					jQuery('#hb_post_aside_content').parent().parent().show();
				}

				else if (audio == 'checked'){
					jQuery('#hb_post_format_options').show();
					jQuery('#hb_post_audio_song_mp3').parent().parent().show();
					jQuery('#hb_post_audio_song_ogg').parent().parent().show();
				}
				else if (video == 'checked'){
					jQuery('#hb_post_format_options').show();
					jQuery('#hb_post_video_link').parent().parent().show();
				}
				else if (link == 'checked'){
					jQuery('#hb_post_format_options').show();
					jQuery('#hb_post_link_content').parent().parent().show();
				}
				else if(quote == 'checked'){
					jQuery('#hb_post_format_options').show();
					jQuery('#hb_post_quote_content').parent().parent().show();
				}
				else return;

			}
		}
	}
	
	
	
	jQuery('#post-format-audio').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_format_options').show();
		jQuery('#hb_post_audio_song_mp3').parent().parent().show();
		jQuery('#hb_post_audio_song_ogg').parent().parent().show();
	});
	
	jQuery('#post-format-video').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_format_options').show();
		jQuery('#hb_post_video_link').parent().parent().show();
	});
	
	jQuery('#post-format-link').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_format_options').show();
		jQuery('#hb_post_link_content').parent().parent().show();
	});
	
	jQuery('#post-format-quote').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_format_options').show();
		jQuery('#hb_post_quote_content').parent().parent().show();
	});
	
	jQuery('#post-format-aside').live("click", function () {
		hide_all_post_meta_boxes();
		jQuery('#hb_post_format_options').show();
		jQuery('#hb_post_aside_content').parent().parent().show();
	});
	
	jQuery('#post-format-image').live("click", function () {
		hide_all_post_meta_boxes();
	});

	
	if( jQuery('.icon32-posts-oboslides').length ) 	{
		if( jQuery('.postbox').length ) {
			var i;
			
			
			
			for ( i = 1; i <= 30; i++ ) {
				// Hide All Meta Fields From Element Meta Boxes
				jQuery('#hb_obo_slide_settings_'+i).find('#input_hb_obo_image_uploaded_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_left_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_top_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_custom_html_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_text_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_link_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_height_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_width_'+i).parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_color_'+i+'_select').parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_size_'+i+'_select').parent().parent().hide();
				jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_animation_'+i+'_select').parent().parent().hide();
				
				var elementType = jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_type_'+i+'_select').val();
				jQuery('#hb_obo_slide_settings_'+i).removeClass('hide-if-js');
				if(elementType == "select"){
					jQuery('#hb_obo_slide_settings_'+ i).hide();
				} else if (elementType == 'imagetype') {
					jQuery('#hb_obo_slide_settings_'+i).find('#input_hb_obo_image_uploaded_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_width_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_height_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_left_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_top_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_animation_'+i+'_select').parent().parent().show();
				} else if ( elementType == 'buttontype' ) {
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_left_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_top_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_text_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_link_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_color_'+i+'_select').parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_button_size_'+i+'_select').parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_animation_'+i+'_select').parent().parent().show();
				} else if ( elementType == 'htmltype' ) {
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_custom_html_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_left_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_position_top_'+i).parent().parent().show();
					jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_animation_'+i+'_select').parent().parent().show();
				}
			}						
		}
	}
	
	jQuery('.hb-add-element').live("click", function () {
		var i;
		for ( i = 1; i <= 30; i++ ) {			
			var elementType = jQuery('#hb_obo_slide_settings_'+i).find('#hb_obo_element_type_'+i+'_select');
			if (elementType.val() == "select" && !elementType.is(":visible")) {
				jQuery('#hb_obo_slide_settings_'+ i).show(0);
				var offset = jQuery('#hb_obo_slide_settings_'+ i).offset();
				var height = jQuery('#hb_obo_slide_settings_'+ i).height();
				var offsetTop = offset.top;
				jQuery('body').scrollTop(offsetTop);
				break;
			}			
		}
		return false;
	});

	jQuery(".hb-select").change(function() {
		var type = jQuery(this).val();
		var container = jQuery(this).parent().parent().parent();
		var imageUploadID = jQuery(this).parent().parent().parent().find(jQuery('[id^=input_hb_obo_image_uploaded_]'));
		var positionLeftID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_position_left]'));
		var positionRightID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_position_top]'));
		var customHtmlID =jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_custom_html]'));
		var buttonTextID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_button_text]'));
		var buttonLinkID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_button_link]'));
		var buttonColorID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_button_color]'));
		var imageWidth = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_width]'));
		var imageHeight = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_height]'));
		var buttonSizeID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_button_size]'));
		var elementAnimationID = jQuery(this).parent().parent().parent().find(jQuery('[id^=hb_obo_element_animation]'));
		switch(type) {
			case 'select':
				var x = confirm("Are you sure? This will delete all information stored about this element.");
				if(x==true) {
					jQuery(imageUploadID).parent().parent().hide(500);
					jQuery(positionLeftID).parent().parent().hide(500);
					jQuery(positionRightID).parent().parent().hide(500);
					jQuery(customHtmlID).parent().parent().hide(500);
					jQuery(buttonTextID).parent().parent().hide(500);
					jQuery(buttonLinkID).parent().parent().hide(500);
					jQuery(buttonColorID).parent().parent().hide(500);
					jQuery(buttonSizeID).parent().parent().hide(500);
					jQuery(imageWidth).parent().parent().hide(500);
					jQuery(imageHeight).parent().parent().hide(500);
					jQuery(elementAnimationID).parent().parent().hide(500);
					
					jQuery(imageUploadID).attr('value','');
					jQuery(imageUploadID).parent().find('.hb-upload-image-wrapper').html('');
					jQuery(positionLeftID).attr('value','');
					jQuery(positionRightID).attr('value','');
					jQuery(customHtmlID).attr('value','');
					jQuery(buttonTextID).attr('value','');
					jQuery(buttonLinkID).attr('value','');
					jQuery(imageWidth).attr('value','');
					jQuery(imageHeight).attr('value','');
					jQuery(buttonColorID).attr('value','default');
					jQuery(buttonSizeID).attr('value','btn-small');
					jQuery(elementAnimationID).attr('value','fadeIn');
					
				}
			break;
			case 'imagetype':
				jQuery(customHtmlID).parent().parent().hide(500);
				jQuery(buttonTextID).parent().parent().hide(500);
				jQuery(buttonLinkID).parent().parent().hide(500);
				jQuery(buttonColorID).parent().parent().hide(500);
				jQuery(buttonSizeID).parent().parent().hide(500);
				jQuery(imageUploadID).parent().parent().show(500);
				jQuery(imageWidth).parent().parent().show(500);
				jQuery(imageHeight).parent().parent().show(500);
				jQuery(positionLeftID).parent().parent().show(500);
				jQuery(positionRightID).parent().parent().show(500);
				jQuery(elementAnimationID).parent().parent().show(500);
			break;
			case 'buttontype':
				jQuery(customHtmlID).parent().parent().hide(500);
				jQuery(imageHeight).parent().parent().hide(500);
				jQuery(imageWidth).parent().parent().hide(500);
				jQuery(buttonTextID).parent().parent().show(500);
				jQuery(buttonLinkID).parent().parent().show(500);
				jQuery(buttonColorID).parent().parent().show(500);
				jQuery(buttonSizeID).parent().parent().show(500);
				jQuery(imageUploadID).parent().parent().hide(500);
				jQuery(positionLeftID).parent().parent().show(500);
				jQuery(positionRightID).parent().parent().show(500);
				jQuery(elementAnimationID).parent().parent().show(500);
			break;
			case 'htmltype':
				jQuery(customHtmlID).parent().parent().show(500);
				jQuery(buttonTextID).parent().parent().hide(500);
				jQuery(imageWidth).parent().parent().hide(500);
				jQuery(imageHeight).parent().parent().hide(500);
				jQuery(buttonLinkID).parent().parent().hide(500);
				jQuery(buttonColorID).parent().parent().hide(500);
				jQuery(buttonSizeID).parent().parent().hide(500);
				jQuery(imageUploadID).parent().parent().hide(500);
				jQuery(elementAnimationID).parent().parent().show(500);
				jQuery(positionLeftID).parent().parent().show(500);
				jQuery(positionRightID).parent().parent().show(500);
			break;
		}
		
		
	});
	
	
	*/
});
