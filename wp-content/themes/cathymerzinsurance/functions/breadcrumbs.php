<?php
/*
* Breadcrumbs Function
* Original source: http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
*/

function hbthemes_breadcrumbs() {
 
  global $data;
  $delimiter = '<span class="sep-icon icon-chevron-right"></span>';
  $home = '<span class="icon-home"></span>';
  $before = '<span>';
  $after = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
 	echo '<div class="breadcrumb-wrapper clearfix">';
 	echo '<div class="breadcrumb-inside">';
 	echo '<span class="blog-arrow"></span>';

    global $post; //get global post data
	global $data; //get theme options
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); //get term
    $homeLink = get_home_url(); //home url
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' '; //home link

	
	
	//category
    if (is_category()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . '' . single_cat_title('', false) . '' . $after;

	//daily archive
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
 	//month
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
 	//year
    } elseif ( is_year() ) {
		echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single()  && !is_attachment() ) {
		
	  //regular posts
      if ( get_post_type() == 'post' ) {
		$cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
	  }
	  
	
		//portfolio posts
		if ( get_post_type() == __('portfolio', 'hbthemes' )) {
		  echo $before . get_the_title() . $after;
		}
	

 	//attachment page
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

	//page
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
	//page with parent
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

	//search page
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

	//tags
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

	//author
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Posts by ' . $userdata->display_name . $after;

	//404 page
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
	
	//portfolio categories
	elseif (is_tax( 'portfolio_cats') ) {
	  if(!empty($data['hb_all_projects_link'])) {
		  echo '<a href="' . $data['hb_all_projects_link'] . '">' . __('Portfolio','hbthemes') . '</a> ' . $delimiter . ' ';
	  }
	  echo $before . $term->name . $after;
    } elseif (is_tax( 'portfolio_skills') ) {
	  if(!empty($data['hb_all_projects_link'])) {
		  echo '<a href="' . $data['hb_all_projects_link'] . '">' . __('Portfolio','hbthemes') . '</a> ' . $delimiter . ' ';
	  }
	  echo $before . $term->name . $after;
    } elseif (is_tax( 'staff_departments') ) {
	    echo $before . $term->name . $after;
    }
	else if ( has_post_format('aside')) {
		echo $before . "Aside Posts" . $after;
	} else if ( has_post_format('audio')) {
		echo $before . "Audio Posts" . $after;
	} else if ( has_post_format('quote')) {
		echo $before . "Quote Posts" . $after;
	} else if ( has_post_format('link')) {
		echo $before . "Link Posts" . $after;
	} else if ( has_post_format('video')) {
		echo $before . "Video Posts" . $after;
	} else if ( has_post_format('image')) {
		echo $before . "Image Posts" . $after;
	} 

	//paged
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || has_post_format('aside') || has_post_format ('audio') || has_post_format('image') || has_post_format('video') || has_post_format('quote') || has_post_format('link') )
      echo '<span style="margin-left:5px"> </span> ' .$delimiter . $before .  __(' Page ', 'hbthemes') . ' ' . get_query_var('paged') . $after;
      //if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
    }
 
    echo '</div>';
    
    if  ( $data['hb_include_breadcrumb_search'] ) { ?>
    <div class="breadcrumb-search">
    <form role="search" method="get" id="input-search-button" action="<?php echo home_url( '/' ); ?>">
      <input type="text" placeholder="<?php _e('Search and hit enter...' , 'hbthemes'); ?>" name="s" id="search" />
      <input type="hidden" id="searchsubmit" /> 
    </form>
    </div>
    <?php }

    echo '</div>';
 
  }
  
} // end function

?>