var RevSliderAdmin = new function(){
		
		/**
		 * init "slider" view functionality
		 */
		var initSaveSliderButton = function(ajaxAction){
			
			jQuery("#button_save_slider").click(function(){
					
					//collect data
					var data = {						
							params: UniteSettingsRev.getSettingsObject("form_slider_params"),
							main: UniteSettingsRev.getSettingsObject("form_slider_main")
						};
					
					//add slider id to the data
					if(ajaxAction == "update_slider"){
						data.sliderid = jQuery("#sliderid").val();
						
						//some ajax beautifyer
						UniteAdminRev.setAjaxLoaderID("loader_update");
						UniteAdminRev.setAjaxHideButtonID("button_save_slider");
						UniteAdminRev.setSuccessMessageID("update_slider_success");
					}
					
					UniteAdminRev.ajaxRequest(ajaxAction ,data);
			});		
		}
		
		/**
		 * update shortcode from alias value.
		 */
		var updateShortcode = function(){
			var alias = jQuery("#alias").val();			
			var shortcode = "[rev_slider "+alias+"]";
			if(alias == "")
				shortcode = "-- wrong alias -- ";
			jQuery("#shortcode").val(shortcode);
		}
		
		/**
		 * change fields of the slider view
		 */
		var enableSliderViewResponsitiveFields = function(enableRes,enableWidth,isMaxHeight){
			
			//enable / disable responsitive fields
			if(enableRes){	
				jQuery("#responsitive_row").removeClass("disabled");
				jQuery("#responsitive_row input").prop("disabled","");
			}else{
				jQuery("#responsitive_row").addClass("disabled");
				jQuery("#responsitive_row input").prop("disabled","disabled");
			}
			
			//enable / disable width field
			if(enableWidth){	//enable
				jQuery("#cellWidth").removeClass("disabled");
				jQuery("#cellWidthInput").removeClass("disabled");
				jQuery("#width").prop("disabled","");
			}else{			    //disable
				jQuery("#cellWidth").addClass("disabled");
				jQuery("#cellWidthInput").addClass("disabled");
				jQuery("#width").prop("disabled","disabled");
			}
			
			if(isMaxHeight)
				jQuery("#cellHeight").html("Slider Max Height");
			else
				jQuery("#cellHeight").html("Slider Height");
			
		}
		
		
		/**
		 * init slider view custom controls fields.
		 */
		
		var initSliderViewCustomControls = function(){
			enableSliderViewResponsitiveFields(false,false,true);
		}
		
		
		/**
		 * init "slider->add" view.
		 */
		this.initAddSliderView = function(){
			jQuery("#title").focus();
			initSaveSliderButton("create_slider");
			initShortcode();
			initSliderViewCustomControls();
		}
		
		
		/**
		 * init "slider->edit" view.
		 */		
		this.initEditSliderView = function(){
			
			initShortcode();
			initSliderViewCustomControls();
			
			initSaveSliderButton("update_slider");			
			
			//delete slider action
			jQuery("#button_delete_slider").click(function(){
				
				if(confirm("Do you really want to delete '"+jQuery("#title").val()+"' ?") == false)
					return(true);
				
				var data = {sliderid: jQuery("#sliderid").val()}
				
				UniteAdminRev.ajaxRequest("delete_slider" ,data);

			});			
		}
		
		
		/**
		 * init shortcode functionality in the slider new and slider edit views.
		 */
		var initShortcode = function(){
			
			//select shortcode text when click on it.
			jQuery("#shortcode").focus(function(){				
				this.select();
			});
			jQuery("#shortcode").click(function(){				
				this.select();
			});
			
			//update shortcode
			jQuery("#alias").change(function(){
				updateShortcode();
			});

			jQuery("#alias").keyup(function(){
				updateShortcode();
			});
		}
		
		
		/**
		 * update slides order
		 */
		var updateSlidesOrder = function(sliderID){
			var arrSlideHtmlIDs = jQuery( "#list_slides" ).sortable("toArray");
			
			//get slide id's from html (li) id's
			var arrIDs = [];
			jQuery(arrSlideHtmlIDs).each(function(index,value){
				var slideID = value.replace("slidelist_item_","");
				arrIDs.push(slideID);
			});
			
			//save order
			var data = {arrIDs:arrIDs,sliderID:sliderID};
			
			jQuery("#saving_indicator").show();
			UniteAdminRev.ajaxRequest("update_slides_order" ,data,function(){
				jQuery("#saving_indicator").hide();
			});
			
		}
		
		/**
		 * init "sliders list" view 
		 */
		this.initSlidersListView = function(){
			jQuery(".button_delete_slider").click(function(){
				
				var sliderID = this.id.replace("button_delete_","");
				var sliderTitle = jQuery("#slider_title_"+sliderID).text(); 
				if(confirm("Do you really want to delete '"+sliderTitle+"' ?") == false)
					return(false);
				
				UniteAdminRev.ajaxRequest("delete_slider" ,{sliderid:sliderID});
			});
		}
		
		
		/**
		 * init "slides list" view 
		 */
		this.initSlidesListView = function(sliderID){
			
			//set the slides sortable, init save order
			jQuery("#list_slides").sortable({
					axis:"y",
					handle:'.col-handle',
					update:function(){updateSlidesOrder(sliderID)}
			});
			
			//new slide
			jQuery("#button_new_slide, #button_new_slide_top").click(function(){
				
				UniteAdminRev.openAddImageDialog("Select Slide Image",function(urlImage){
					var data = {sliderid:sliderID,url_image:urlImage};
					UniteAdminRev.ajaxRequest("add_slide" ,data);
				});	
			});
			
			// delete single slide
			jQuery(".button_delete_slide").click(function(){
				var slideID = this.id.replace("button_delete_slide_","");
				var data = {slideID:slideID,sliderID:sliderID};
				if(confirm("Delete this slide?") == false)
					return(false);
				UniteAdminRev.ajaxRequest("delete_slide" ,data);
			});
			
			//change image
			jQuery(".col-image .slide_image").click(function(){
				var slideID = this.id.replace("slide_image_","");
				UniteAdminRev.openAddImageDialog("Select Slide Image",function(urlImage){					
					var data = {slider_id:sliderID,slide_id:slideID,url_image:urlImage};
					UniteAdminRev.ajaxRequest("change_slide_image" ,data);
				});
			});	
			
		}
		
		
		/**
		 * init "edit slide" view
		 */
		this.initEditSlideView = function(slideID){
			
			//save slide actions
			jQuery("#button_save_slide").click(function(){
				
				var data = {
						slideid:slideID,
						params:UniteSettingsRev.getSettingsObject("form_slide_params"),
						layers:UniteLayersRev.getLayers()
					};
				
				UniteAdminRev.setAjaxHideButtonID("button_save_slide");
				UniteAdminRev.setAjaxLoaderID("loader_update");
				UniteAdminRev.setSuccessMessageID("update_slide_success");
				UniteAdminRev.ajaxRequest("update_slide" ,data);
			});
			
			//change image actions
			jQuery("#button_change_image").click(function(){
				
				UniteAdminRev.openAddImageDialog("Select Slide Image",function(urlImage){
						//set visual image 
						jQuery("#divLayers").css("background-image","url("+urlImage+")");
						
						//update setting input
						jQuery("#image_url").val(urlImage);
					}); //dialog
			});	//change image click.
		}

}
