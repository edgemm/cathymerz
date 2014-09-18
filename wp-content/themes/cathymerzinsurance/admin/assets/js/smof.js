/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */
jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function ($) {

    //(un)fold options in a checkbox-group
    jQuery('.fld').click(function () {
        var $fold = '.f_' + this.id;
        $($fold).slideToggle('normal', "swing");
    });

    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') {
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }

    //hides warning if js is enabled			
    $('#js-warning').hide();

    //Tabify Options			
    $('.group').hide();

    // Display last current tab	
    if ($.cookie("of_current_opt") === null) {
        $('.group:first').fadeIn('fast');
        $('#of-nav li:first').addClass('current');
    } else {

        var hooks = $('#hooks').html();
        hooks = jQuery.parseJSON(hooks);

        $.each(hooks, function (key, value) {

            if ($.cookie("of_current_opt") == '#of-option-' + value) {
                $('.group#of-option-' + value).fadeIn();
                $('#of-nav li.' + value).addClass('current');
            }

        });

    }

    //Current Menu Class
    $('#of-nav li a').click(function (evt) {
        // event.preventDefault();

        $('#of-nav li').removeClass('current');
        $(this).parent().addClass('current');

        var clicked_group = $(this).attr('href');

        $.cookie('of_current_opt', clicked_group, {
            expires: 7,
            path: '/'
        });

        $('.group').hide();

        $(clicked_group).fadeIn('fast');
        return false;

    });

    var flagsy = true;
    jQuery('#of-nav').find('ul').find('li').each(function () {
        if ($(this).is('.current')) {
            flagsy = false;
        }
    });
    if (flagsy) jQuery('#of-nav').find('li').first().addClass('current');

    //Expand Options 
    var flip = 0;

    $('#expand_options').click(function () {
        if (flip == 0) {
            flip = 1;
            $('#of_container #of-nav').hide();
            $('#of_container #content').width(755);
            $('#of_container .group').add('#of_container .group h2').show();

            $(this).removeClass('expand');
            $(this).addClass('close');
            $(this).text('Close');

        } else {
            flip = 0;
            $('#of_container #of-nav').show();
            $('#of_container #content').width(595);
            $('#of_container .group').add('#of_container .group h2').hide();
            $('#of_container .group:first').show();
            $('#of_container #of-nav li').removeClass('current');
            $('#of_container #of-nav li:first').addClass('current');

            $(this).removeClass('close');
            $(this).addClass('expand');
            $(this).text('Expand');

        }

    });

    //Update Message popup
    $.fn.center = function () {
        this.animate({
            "top": ($(window).height() - this.height() - 200) / 2 + $(window).scrollTop() + "px"
        }, 100);
        this.css("left", 250);
        return this;
    }


    $('#of-popup-save').center();
    $('#of-popup-reset').center();
    $('#of-popup-fail').center();

    $(window).scroll(function () {
        $('#of-popup-save').center();
        $('#of-popup-reset').center();
        $('#of-popup-fail').center();
    });


    //Masked Inputs (images as radio buttons)
    $('.of-radio-img-img').click(function () {
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });
    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    //Masked Inputs (background images as radio buttons)
    $('.of-radio-tile-img').click(function () {
        $(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
        $(this).addClass('of-radio-tile-selected');
    });
    $('.of-radio-tile-label').hide();
    $('.of-radio-tile-img').show();
    $('.of-radio-tile-radio').hide();

    //AJAX Upload
    function of_image_upload() {
        $('.image_upload_button').each(function () {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: { // Additional data to send
                    action: 'of_ajax_post_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID
                },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function (file, extension) {},
                onSubmit: function (file, extension) {
                    clickedObject.text('Uploading'); // change button text, when user selects file	
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function () {
                        var text = clickedObject.text();
                        if (text.length < 13) {
                            clickedObject.text(text + '.');
                        } else {
                            clickedObject.text('Uploading');
                        }
                    }, 200);
                },
                onComplete: function (file, response) {
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button


                    // If nonce fails
                    if (response == -1) {
                        var fail_popup = $('#of-popup-fail');
                        fail_popup.fadeIn();
                        window.setTimeout(function () {
                            fail_popup.fadeOut();
                        }, 2000);
                    }

                    // If there was an error
                    else if (response.search('Upload Error') > -1) {
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        $(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    } else {
                        var buildReturn = '<img class="hide of-option-image" id="image_' + clickedID + '" src="' + response + '" alt="" />';

                        $(".upload-error").remove();
                        $("#image_" + clickedID).remove();
                        clickedObject.parent().after(buildReturn);
                        $('img#image_' + clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });

        });

    }

    of_image_upload();

    //AJAX Remove Image (clear option value)
    $('.image_reset_button').live('click', function () {

        var clickedObject = $(this);
        var clickedID = $(this).attr('id');
        var theID = $(this).attr('title');

        var nonce = $('#security').val();

        var data = {
            action: 'of_ajax_post_action',
            type: 'image_reset',
            security: nonce,
            data: theID
        };

        $.post(ajaxurl, data, function (response) {

            //check nonce
            if (response == -1) { //failed

                var fail_popup = $('#of-popup-fail');
                fail_popup.fadeIn();
                window.setTimeout(function () {
                    fail_popup.fadeOut();
                }, 2000);
            } else {

                var image_to_remove = $('#image_' + theID);
                var button_to_hide = $('#reset_' + theID);
                image_to_remove.fadeOut(500, function () {
                    $(this).remove();
                });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            }


        });

    });

    // Style Select
    (function ($) {
        styleSelect = {
            init: function () {
                $('.select_wrapper').each(function () {
                    $(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
                });
                $('.select').live('change', function () {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
                $('.select').bind($.browser.msie ? 'click' : 'change', function (event) {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
            }
        };
        $(document).ready(function () {
            styleSelect.init()
        })
    })(jQuery);


    /** Aquagraphite Slider MOD */

    //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".slide_edit_button").live('click', function () {
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });

    // Update slide title upon typing		
    function update_slider_title(e) {
        var element = e;
        if (this.timer) {
            clearTimeout(element.timer);
        }
        this.timer = setTimeout(function () {
            $(element).parent().prev().find('strong').text(element.value);
        }, 100);
        return true;
    }

    $('.of-slider-title').live('keyup', function () {
        update_slider_title(this);
    });


    //Remove individual slider
    $('.slide_delete_button').live('click', function () {
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slider?");
        if (agree) {
            var $trash = $(this).parents('li');
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0,
            }, 500, function () {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });

    //Remove individual slide
    $('.slide_inner_delete_button').live('click', function () {
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slider?");
        if (agree) {
            var $trash = $(this).parent().parent();
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0,
            }, 500, function () {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });

    //Add new slide
    $(".slide_add_button").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="' + sliderInt + '">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //Add new flex slide
    $(".flex_slide_add_button").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>New Flex Slider ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value="New Flex Slider ' + newNum + '"><small class="input-description">Enter a title for this slider.</small>'
         + 
         '<a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //Add new orbit slide
    $(".orbit_slide_add_button").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>New Orbit Slider ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + 
         '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value="New Orbit Slider ' + newNum + '"><small class="input-description">Enter a title for this slider.</small><h5 class="option-title">Slider Settings</h5><hr class="seperator"/><label>Animation</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][animation]" id="'+sliderId+'_'+newNum+'_slide_animation" value="fade"/><small class="input-description">Enter animation for this slider. Options : <em>fade, horizontal-slide, vertical-slide, horizontal-push</em></small>'+
         '<label>Animation Speed</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][animationSpeed]" id="'+sliderId+'_'+newNum+'_slide_animation_speed" value="800"/><small class="input-description">Enter the animation speed in ms. 1000ms = 1s</small>' +
         '<label>Timer</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][timer]" id="'+sliderId+'_'+newNum+'_slide_timer" value="true"/><small class="input-description">Options : <em>true, false</em></small>' +
         '<label>Pause On Hover</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][pauseOnHover]" id="'+sliderId+'_'+newNum+'_slide_pause_on_hover" value="true"/><small class="input-description">Pause slideshow on mouse hover. Options : <em>true, false</em></small>' +
         '<label>Direction Navigation</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][directionNav]" id="'+sliderId+'_'+newNum+'_slide_direction_nav" value="true"/><small class="input-description">Show direction navigation. Options : <em>true, false</em></small>' +
         '<label>Control Navigation</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][bullets]" id="'+sliderId+'_'+newNum+'_slide_control_nav" value="true"/><small class="input-description">Show control navigation - bullets. Options : <em>true, false</em></small>' +
         '<label>Advance Speed</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][advanceSpeed]" id="'+sliderId+'_'+newNum+'_slide_advance_speed" value="4000"/><small class="input-description">If timer is enabled, time between transitions. Time is in ms.</small>' +
         '<a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

	 //Add new one by one slider
    $(".obo_slide_add_button").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>New One By One Slider ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + 
         '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value="New One By One Slider ' + newNum + '"><small class="input-description">Enter a title for this slider.</small><h5 class="option-title">Slider Settings</h5><hr class="seperator"/><label>Delay</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][delay]" id="'+sliderId+'_'+newNum+'_slide_delay" value="400"/><small class="input-description">The delay of the touch/drag tween in ms.</small>'+
         '<label>Tolerance</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][tolerance]" id="'+sliderId+'_'+newNum+'_slide_tolerance" value="0.25"/><small class="input-description">The tolerance of the touch/drag in ms.</small>' +
         '<label>Slideshow Delay</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][slideShowDelay]" id="'+sliderId+'_'+newNum+'_slide_slideShowDelay" value="8000"/><small class="input-description">The delay millisecond of the slidershow.</small>' +
         '<label>Enable Drag</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][enableDrag]" id="'+sliderId+'_'+newNum+'_slide_enableDrag" value="true"/><small class="input-description">Enable or disable the drag function by mouse. Options : <em>true, false</em></small>' +
         '<label>Show Arrow</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][showArrow]" id="'+sliderId+'_'+newNum+'_slide_showArrow" value="true"/><small class="input-description">Display the previous/next arrow or not. Options : <em>true, false</em></small>' +
         '<label>Show Button</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][showButton]" id="'+sliderId+'_'+newNum+'_slide_showButton" value="true"/><small class="input-description">Display the circle buttons or not. Options : <em>true, false</em></small>' +
         '<label>Slideshow</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][slideShow]" id="'+sliderId+'_'+newNum+'_slide_slideShow" value="true"/><small class="input-description">Auto play the slider or not. Options : <em>true, false</em></small>' +
         '<label>Random Easing</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][randomEasing]" id="'+sliderId+'_'+newNum+'_slide_randomEasing" value="false"/><small class="input-description">Animate each element with same random easing animation. Options : <em>true, false</em></small>' +
         '<label>Pause On Hover</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][pauseOnHover]" id="'+sliderId+'_'+newNum+'_slide_pauseOnHover" value="true"/><small class="input-description">Pause slideshow on mouse hover. Options : <em>true, false</em></small>' +
		 '<a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    $(".slider_manager_add_slider").live('click', function () {
        var slidesContainer = $(this).prev(); 
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');
        var selectValue = $('#hb_slider_manager_select').val();


        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slider ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label for="' + sliderId + '_' + newNum + '_slide_title"> Title </label><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        return false; //prevent jumps, as always..
    });

    /*Add new slider (manager)
	$('#hb_slider_manager_select').change(function () {		
		var button = jQuery(this).parent().parent().find('a.button');
		var value = jQuery('#hb_slider_manager_select').val();

	
		switch (value) {
	
			case 'One by One Slider' :
				jQuery(button).removeClass('obo_slider_manager');
				jQuery(button).removeClass('flex_slider_manager');
				jQuery(button).removeClass('orbit_slider_manager');
				
				jQuery(button).addClass('obo_slider_manager');
								
			break;
			
			case 'Orbit Slider' :
				jQuery(button).removeClass('obo_slider_manager');
				jQuery(button).removeClass('flex_slider_manager');
				jQuery(button).removeClass('orbit_slider_manager');
				
				jQuery(button).addClass('orbit_slider_manager');

				break;
			
			case 'Flex Slider' :
				jQuery(button).removeClass('obo_slider_manager');
				jQuery(button).removeClass('flex_slider_manager');
				jQuery(button).removeClass('orbit_slider_manager');
				
				jQuery(button).addClass('flex_slider_manager');
				
			break;
			
			default :
				alert('Error');
			break;
		
		}
	
	});*/

    $(".obo_slider_manager").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="' + sliderInt + '">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });


    $(".flex_slider_manager").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<p>Flex Slider Here</p>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });


    $(".orbit_slider_manager").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<p>Orbit Slider Here</p>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //Add new sidebar
    $(".sidebar_add_button").live('click', function () {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function () {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0
        };
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Sidebar ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Sidebar Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value="Sidebar ' + newNum + '"><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function () {
            $(this).removeClass('temphide');
        });

        return false; //prevent jumps, as always..
    });


    //Sort slides
    jQuery('.slider').find('ul').each(function () {
        var id = jQuery(this).attr('id');
        $('#' + id).sortable({
            placeholder: "placeholder",
            opacity: 0.6
        });
    });


    /**	Sorter (Layout Manager) */
    jQuery('.sorter').each(function () {
        var id = jQuery(this).attr('id');
        $('#' + id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.6,
            update: function () {
                $(this).find('.position').each(function () {

                    var listID = $(this).parent().attr('id');
                    var parentID = $(this).parent().parent().attr('id');
                    parentID = parentID.replace(id + '_', '')
                    var optionID = $(this).parent().parent().parent().attr('id');
                    $(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

                });
            }
        });
    });


    /**	Ajax Backup & Restore MOD */
    //backup button
    $('#of_backup_button').live('click', function () {

        var answer = confirm("Click OK to backup your current saved options.")

        if (answer) {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'backup_options',
                security: nonce
            };

            $.post(ajaxurl, data, function (response) {

                //check nonce
                if (response == -1) { //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function () {
                        fail_popup.fadeOut();
                    }, 2000);
                } else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    //restore button
    $('#of_restore_button').live('click', function () {

        var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

        if (answer) {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'restore_options',
                security: nonce
            };

            $.post(ajaxurl, data, function (response) {

                //check nonce
                if (response == -1) { //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function () {
                        fail_popup.fadeOut();
                    }, 2000);
                } else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /**	Ajax Transfer (Import/Export) Option */
    $('#of_import_button').live('click', function () {

        var answer = confirm("Click OK to import options.")

        if (answer) {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var import_data = $('#export_data').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'import_options',
                security: nonce,
                data: import_data
            };

            $.post(ajaxurl, data, function (response) {
                var fail_popup = $('#of-popup-fail');
                var success_popup = $('#of-popup-save');

                //check nonce
                if (response == -1) { //failed
                    fail_popup.fadeIn();
                    window.setTimeout(function () {
                        fail_popup.fadeOut();
                    }, 2000);
                } else {
                    success_popup.fadeIn();
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /** AJAX Save Options */
    $('#of_save').live('click', function () {

        var nonce = $('#security').val();

        $('.ajax-loading-img').fadeIn();

        //get serialized data from all our option fields			
        var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

        var data = {
            type: 'save',
            action: 'of_ajax_post_action',
            security: nonce,
            data: serializedReturn
        };

        $.post(ajaxurl, data, function (response) {
            var success = $('#of-popup-save');
            var fail = $('#of-popup-fail');
            var loading = $('.ajax-loading-img');
            loading.fadeOut();

            if (response == 1) {
                success.fadeIn();
            } else {
                fail.fadeIn();
            }

            window.setTimeout(function () {
                success.fadeOut();
                fail.fadeOut();
            }, 2000);
        });

        return false;

    });


    /* AJAX Options Reset */
    $('#of_reset').click(function () {

        //confirm reset
        var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

        //ajax reset
        if (answer) {

            var nonce = $('#security').val();

            $('.ajax-reset-loading-img').fadeIn();

            var data = {

                type: 'reset',
                action: 'of_ajax_post_action',
                security: nonce,
            };

            $.post(ajaxurl, data, function (response) {
                var success = $('#of-popup-reset');
                var fail = $('#of-popup-fail');
                var loading = $('.ajax-reset-loading-img');
                loading.fadeOut();

                if (response == 1) {
                    success.fadeIn();
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    fail.fadeIn();
                    window.setTimeout(function () {
                        fail.fadeOut();
                    }, 2000);
                }


            });

        }

        return false;

    });


    /**	Tipsy @since v1.3 */
    if (jQuery().tipsy) {
        $('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
            fade: true,
            gravity: 's',
            opacity: 0.7,
        });
    }

}); //end doc ready