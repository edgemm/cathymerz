<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which prints portfolio items
function add_portfolio_items ( $loop , $page_portfolio_columns) {

	$page_portfolio_size_class = "";
	$rand_num = rand(0,20000);

 	$output = "<!-- START .portfolio-wrapper -->";
	$output .= '<div class="portfolio-wrapper clearfix">';


	$output .= '<!-- START #portfolio-container-sec -->';
	$output .= '<div id="portfolio-container-sec" class="clearfix">';

	while ( $loop->have_posts() ) : $loop->the_post();

	// get video link from post meta
	$page_portfolio_video_link = get_post_meta ( get_the_ID() , 'hb_portfolio_video_link' , true );

	// get featured image
	$thumb = get_post_thumbnail_id(); 
	$image = hb_resize( $thumb, '', 480, 360, true );

	// get portfolio filters
	$term_list = wp_get_post_terms(get_the_ID(), 'portfolio_skills', array("fields" => "slugs"));
	$terms = implode(" ",$term_list);
	$terms = " ".$terms;
	$terms = strtolower($terms);

	// set the size class
	switch ( $page_portfolio_columns ) {
		case "2" :  $page_portfolio_size_class = "col-6 ";
		break;
		case "3" :  $page_portfolio_size_class = "col-4 ";
		break;
		case "4" :  $page_portfolio_size_class = "col-3 ";
		break;
	}

	$output .= '<div class="'.$page_portfolio_size_class.'from-the-portfolio-sec'.$terms.'">';

	// print image or video
	$output .= '<a href="'.get_permalink( get_the_ID() ).'" class="from-the-portfolio-sec-header" rel="portfolio_'.$rand_num.'">';
	if ( $page_portfolio_video_link ) {
		$output .= '<iframe src="'.get_src_from_embedded_link($page_portfolio_video_link).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	} else if ( $thumb ) {
		$output .= '<img src="'.$image['url'].'" />';
	}
	$output .= '</a>';


	$output .= '<div class="from-the-portfolio-sec-text clearfix">';
	$output .= '<span class="arrow-cropper">ã</span>';
	$output .= '<a href="'.get_permalink( get_the_ID() ).'">'.get_the_title( get_the_ID() ).'<span class="arrow-in-button"></span></a>';
					
	$output .= '<ul class="from-the-portfolio-sec-meta">';
	$output .= '<li class="like-count-sec">';
	$output .= hb_printLikes( get_the_ID() ); 
	$output .= '</li>';
	$output .= '</ul>';

	$output .= '</div>';

	$output .= '</div>';
	endwhile;

	$output .= '</div>';
	$output .= '<!-- END #portfolio-container-sec -->';

	$output .= '</div>';
	$output .= '<!-- END .portfolio-wrapper -->';

	return $output;
}

// Function which prints portfolio items gallery type
function add_portfolio_items_Gallery ( $loop , $page_portfolio_columns) {
	$page_portfolio_size_class = "";	
?>
<!-- START .portfolio-wrapper -->
<div class="portfolio-wrapper clearfix">

<!-- START #portfolio-container-gal -->
<div id="portfolio-container-gal" class="clearfix">

<?php while ( $loop->have_posts() ) : $loop->the_post();

	$rand_num = rand (0,20000);
	
	// get attachments for the portfolio
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => get_the_ID(),
		'orderby' => 'menu_order',
		'order' => 'DESC'
	);	
	$attachments = get_posts ( $args );

	// get video link from post meta
	$page_portfolio_video_link = get_post_meta ( get_the_ID() , 'hb_portfolio_video_link' , true );

	// get featured image
	$thumb = get_post_thumbnail_id(); 
	$image = hb_resize( $thumb, '', 480, 360, true );
	$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( get_the_ID() ), 'original') ;

	// get portfolio filters
	$term_list = wp_get_post_terms(get_the_ID(), 'portfolio_skills', array("fields" => "slugs"));
	$terms = implode(" ",$term_list);
	$terms = " ".$terms;
	$terms = strtolower($terms);

	$terms_h5 = implode(" + ",$term_list);

	// set the size class
	switch ( $page_portfolio_columns ) {
		case "2" :  $page_portfolio_size_class = "col-6 ";
		break;
		case "3" :  $page_portfolio_size_class = "col-4 ";
		break;
		case "4" :  $page_portfolio_size_class = "col-3 ";
		break;
	}

	echo '<div class="'.$page_portfolio_size_class.'from-the-portfolio-gal'.$terms.'">';

	// print image or video
	 
	
	if ( $page_portfolio_video_link ) {
		echo '<a href="'. get_src_from_embedded_link ( $page_portfolio_video_link ).'" class="from-the-portfolio-sec-header fancy-iframe" rel="portfolio_'.$rand_num.'">';		
	} else if ( $thumb ) {
		echo '<a href="'.$full_thumb[0].'" class="from-the-portfolio-sec-header fancybox" rel="portfolio_'.$rand_num.'">';	
	}
	
	if ( $thumb ) 
		echo '<img src="' . $image['url'] .'" />';

?>
<!-- START .overlay-info -->
	<div class="overlay-info">
		<!-- START .overlay-inner -->
		<div class="overlay-inner">
			<!-- START .overlay-content -->
			<div class="overlay-content">
				<h2 class="portfolio-title"><?php the_title(); ?></h2>
				<h5><?php echo $terms_h5; ?></h5>
			</div>
			<!-- END .overlay-content -->
		</div>
		<!-- END .overlay-inner -->
	</div>
<!-- END .overlay-info -->
<?php 
echo '</a>';
echo '</div>';
endwhile; 

if ( $attachments ) { ?>
<div class="hidden">
	<?php foreach ( $attachments as $attachment ) {
		$full_thumb = wp_get_attachment_image_src( $attachment->ID , 'original') ;
		$image = hb_resize( null, $full_thumb[0] , 930, 698, true );
	?>
	<a href="<?php echo $full_thumb[0]; ?>" class="fancybox" rel="portfolio_<?php echo $rand_num; ?>">
		<img src="<?php echo $image['url']; ?>"/>
	</a>
	<?php } ?>
</div>
<?php }	?>

</div>
<!-- END #portfolio-container-sec -->

</div>
<!-- END .portfolio-wrapper -->
<?php }
?>