<?php

	class UniteFunctionsWPRev{
		
		public static function isMultisite(){
			if(!defined("WP_ALLOW_MULTISITE") || !defined("MULTISITE"))
				return(false);
				
			if(WP_ALLOW_MULTISITE == true && MULTISITE == true)
				return(true);
				
			return(false);
		}
		
		
		/**
		 * 
		 * check if some db table exists
		 */
		public static function isDBTableExists($tableName){
			global $wpdb;
			
			if(empty($tableName))
				UniteFunctionsRev::throwError("Empty table name!!!");
			
			$sql = "show tables like '$tableName'";
			
			$table = $wpdb->get_var($sql);
			
			if($table == $tableName)
				return(true);
				
			return(false);
		}
		
		
		/**
		 * 
		 * get wordpress base path
		 */
		public static function getPathBase(){
			return ABSPATH;
		}
		
		/**
		 * 
		 * get wp-content path
		 */
		public static function getPathContent(){		
			if(self::isMultisite()){
				$pathContent = BLOGUPLOADDIR;
			}else{
				$pathContent = WP_CONTENT_DIR;
				if(!empty($pathContent)){
					$pathContent .= "/";
				}
				else{
					$pathBase = self::getPathBase();
					$pathContent = $pathBase."wp-content/";
				}
			}
			
			return($pathContent);
		}
		
		/**
		 * 
		 * get content url
		 */
		public static function getUrlContent(){
		
			if(self::isMultisite() == false){	//without multisite
				$baseUrl = content_url()."/";
			}
			else{	//for multisite
				$arrUploadData = wp_upload_dir();
				$baseUrl = $arrUploadData["baseurl"]."/";
			}
			
			return($baseUrl);
			
		}
		
		/**
		 * 
		 * register widget (must be class)
		 */
		public static function registerWidget($widgetName){
			add_action('widgets_init', create_function('', 'return register_widget("'.$widgetName.'");'));
		}

		/**
		 * get image relative path from image url (from upload)
		 */
		public static function getImagePathFromURL($urlImage){
			
			$baseUrl = self::getUrlContent();
			$pathImage = str_replace($baseUrl, "", $urlImage);
			
			return($pathImage);
		}
		
		/**
		 * get image real path phisical on disk from url
		 */
		public static function getImageRealPathFromUrl($urlImage){
			$filepath = self::getImagePathFromURL($urlImage);
			$realPath = UniteFunctionsWPRev::getPathContent().$filepath;
			return($realPath);
		}
		
		
		/**
		 * 
		 * get image url from image path.
		 */
		public static function getImageUrlFromPath($pathImage){
			$urlImage = self::getUrlContent().$pathImage;
			return($urlImage); 
		}
		
		
	}
?>