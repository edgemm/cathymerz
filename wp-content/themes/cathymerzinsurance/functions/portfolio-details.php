<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which adds portfolio details
function add_portfolio_details ( $post_id ) {
	global $data;
	
	$pf_item_detail_date = get_post_meta ( $post_id , 'hb_portfolio_details_date' , true );
	$pf_item_detail_client = get_post_meta ( $post_id , 'hb_portfolio_details_client' , true );
	$pf_item_detail_skills = get_post_meta ( $post_id , 'hb_portfolio_details_skills' , true );
	$pf_item_detail_cats = get_post_meta ( $post_id , 'hb_portfolio_details_categories' , true );
	$pf_item_detail_link = get_post_meta ( $post_id , 'hb_portfolio_details_link' , true );
	$pf_item_detail_likes = get_post_meta ( $post_id , 'hb_portfolio_details_likes' , true );
	$pf_item_detail_other = get_post_meta ( $post_id , 'hb_portfolio_details_other_projects' , true );

	echo '<ul>';
	if ( $pf_item_detail_date ) {
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Date:','hbthemes').'</span>';
		echo '<div class="list-terms">' . $pf_item_detail_date . '</div>';
		echo '</li>';
	}
	if ( $pf_item_detail_client ) {
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Client:','hbthemes').'</span>';
		echo '<div class="list-terms">' . $pf_item_detail_client . '</div>';
		echo '</li>';
	}
	if ( $pf_item_detail_skills ) {

		$term_list = wp_get_post_terms( $post_id, 'portfolio_skills');
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Skills Used: ','hbthemes').'</span>';
		echo '<div class="list-terms">';
		foreach ( $term_list as $term_pro ) {
			echo '<a href="' . get_term_link( $term_pro , 'portfolio_skills' ) . '">' . $term_pro->name . '</a><br/>';
		}
		echo '</div>';
		echo '</li>';
	}
	if ( $pf_item_detail_cats ) {
		$term_list = wp_get_post_terms( $post_id, 'portfolio_cats');
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Categories: ','hbthemes').'</span>';
		echo '<div class="list-terms">';
		foreach ( $term_list as $term_pro ) {
			echo '<a href="' . get_term_link( $term_pro , 'portfolio_cats' ) . '">' . $term_pro->name . '</a><br/>';
		}
		echo '</div>';
		echo '</li>';
	}
	if ( $pf_item_detail_link ) {
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Link: ','hbthemes').'</span>';
		echo '<div class="list-terms"><a href="' . $pf_item_detail_link . '">'.$pf_item_detail_link.'</a></div>';
		echo '</li>';
	}
	if ( $pf_item_detail_likes ) {
		echo '<li class="project-terms clearfix">';
		echo '<span>'.__('Likes: ','hbthemes').'</span>';
		echo '<div class="list-terms">';
		echo hb_printLikesSingle( $post_id );
		echo '</div>';
		echo '</li>';
	}
	if ( $pf_item_detail_other ) {
		echo '<li class="project-terms other-projects clearfix">';
		echo '<span>Other Projects:</span>';

		echo '<div class="list-terms">';
		if ( get_previous_post() )
			echo '<a href="' . get_permalink ( get_previous_post()->ID ) . '" class="prev-project">prev</a>';
		if ( $data['hb_all_projects_link'] ) 
			echo '<a href="'.$data['hb_all_projects_link'].'" class="all-project">all</a>';
		if ( get_next_post() )
			echo '<a href="' . get_permalink ( get_next_post()->ID ) . '" class="next-project">next</a>';

		echo '</div>';
		echo '</li>';
	}
}
?>