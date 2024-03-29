<?php
 
	$operations = new RevOperations();

	//set Layer settings	
	$contentCSS = $operations->getCaptionsContent();
	$arrAnimations = $operations->getArrAnimations();
	$htmlButtonDown = '<div id="layer_captions_down" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowthick-1-s"></span></div>';
	$buttonEditStyles = UniteFunctionsRev::getHtmlLink("javascript:void(0)", "Edit CSS File","button_edit_css","button-secondary");
	$arrEasing = $operations->getArrEasing();
	
	$captionsAddonHtml = $htmlButtonDown.$buttonEditStyles;
	
	//set Layer settings
	$layerSettings = new UniteSettingsAdvancedRev();
	$layerSettings->addSection("Layer Params","layer_params");
	$layerSettings->addSap("Layer Params","layer_params");
	$layerSettings->addTextBox("layer_caption", "caption_green", "Style",array(UniteSettingsRev::PARAM_ADDTEXT=>$captionsAddonHtml,"class"=>"textbox-caption"));

	$addHtmlTextarea =  UniteFunctionsRev::getHtmlLink("javascript:void(0)", "insert button","linkInsertButton","disabled");
	
	$layerSettings->addTextArea("layer_text", "","Text / Html",array("class"=>"area-layer-params",UniteSettingsRev::PARAM_ADDTEXT_BEFORE_ELEMENT=>$addHtmlTextarea));
	
	$layerSettings->addSelect("layer_animation",$arrAnimations,"Animation","fade");	
	$layerSettings->addSelect("layer_easing", $arrEasing, "Easing","easeOutExpo");
	$layerSettings->addTextBox("layer_speed", "","Speed");
	$layerSettings->addTextBox("layer_left", "","X");
	$layerSettings->addTextBox("layer_top", "","Y");
	$layerSettings->addButton("button_edit_video", "Edit Video",array("hidden"=>true));
	
	self::storeSettings("layer_settings",$layerSettings);
	
	//store settings of content css for editing on the client.
	self::storeSettings("css_captions_content",$contentCSS);
	
?>