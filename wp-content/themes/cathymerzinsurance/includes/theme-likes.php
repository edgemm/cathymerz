<?php

function hb_likeThis($post_id,$action = 'get') {

	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if

	switch($action) {
	
	case 'get':
		$data = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($data[0])) {
			$data[0] = 0;
			add_post_meta($post_id, '_likes', '0', true);
		} //if
		
		return $data[0];
	break;
	
	
	case 'update':
		if(isset($_COOKIE["like_" + $post_id])) {
			return;
		} //if
		
		$currentValue = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($currentValue[0])) {
			$currentValue[0] = 0;
			add_post_meta($post_id, '_likes', '1', true);
		} //if
		
		$currentValue[0]++;
		update_post_meta($post_id, '_likes', $currentValue[0]);
		
		setcookie("like_" + $post_id, $post_id,time()*20, '/');
	break;

	} //switch

} //hb_likeThis


function hb_printLikes($post_id) {
	global $data;
	$output = '';
	if ( $data['hb_include_like'] ) {
		$likes = hb_likeThis($post_id);
		
		$titl = get_the_title($post_id);

		if(isset($_COOKIE["like_" + $post_id])) {
			return '<a href="#" id="like-'.$post_id.'" title="You already like this" class="like-button like-active"><span class="icon"></span>'.$likes.'</a>';	  	
			 
		} //if

		return '<a href="#" title="Like '.$titl.'" id="like-'.$post_id.'" class="like-button"><span class="icon"></span>'.$likes.'</a>';	  	
		
	}
} //hb_printLikes

function hb_printLikesSingle($post_id) {
	global $data;
	if ( $data['hb_include_like'] ) {
		$likes = hb_likeThis($post_id);
		
		$titl = get_the_title($post_id);

		if(isset($_COOKIE["like_" + $post_id])) {
				return '<a href="#" id="like-'.$post_id.'" title="You already like this" class="like-count-sec like-active"><span class="icon"></span>'.$likes.'</a>';	  	
		} //if

		return '<a href="#" title="Like '.$titl.'" id="like-'.$post_id.'" class="like-count-sec"><span class="icon"></span>'.$likes.'</a>';	  	
	}
} //hb_printLikes

function setUpPostLikes($post_id) {
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if
	
	
	add_post_meta($post_id, '_likes', '0', true);

} //setUpPost


function checkHeaders() {
	if(isset($_POST["likepost"])) {
		hb_likeThis($_POST["likepost"],'update');
	} //if

} //checkHeaders


function jsIncludes() {
	wp_enqueue_script('jquery');

} //jsIncludes

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');
add_action ('get_header', 'jsIncludes');
?>