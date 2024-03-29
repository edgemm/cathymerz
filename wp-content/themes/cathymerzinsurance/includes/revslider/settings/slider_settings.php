<?php
	
	//set "slider_main" settings
	$sliderMainSettings = new UniteSettingsAdvancedRev();
	$sliderMainSettings->addTextBox("title", "","Slider Title",array("description"=>"The title of the slider. Example: Slider1","required"=>"true"));	
	$sliderMainSettings->addTextBox("alias", "","Slider Alias",array("description"=>"The alias that will be used for embedding the slider. Example: slider1","required"=>"true"));
	$sliderMainSettings->addTextBox("shortcode", "","Slider Short Code",array("readonly"=>true,"class"=>"code"));
	$sliderMainSettings->addHr();
	
	$sliderMainSettings->addRadio("slider_type", array("responsitive"=>"Responsive"),"Slider Type","responsitive");
	
	$paramsSize = array("width"=>990,"height"=>350);	
	$sliderMainSettings->addCustom("slider_size", "slider_size","","Slider Size",$paramsSize);
	
	$paramsResponsitive = array("w1"=>991,"sw1"=>820,"w2"=>816,"sw2"=>700,"w3"=>711,"sw3"=>540,"w4"=>541,"sw4"=>300);
	$sliderMainSettings->addCustom("responsitive_settings", "responsitive","","Responsitive Sizes",$paramsResponsitive);
	$sliderMainSettings->addHr();
	
	self::storeSettings("slider_main",$sliderMainSettings);
	
	//set "slider_params" settings. 
	$sliderParamsSettings = new UniteSettingsAdvancedRev();	
	$sliderParamsSettings->loadXMLFile(self::$path_settings."/slider_settings.xml");
	self::storeSettings("slider_params",$sliderParamsSettings); 
	
?>