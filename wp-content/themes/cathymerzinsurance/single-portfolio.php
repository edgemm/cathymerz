<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// get all vars
$pf_related_posts = get_post_meta ( get_the_ID() , 'hb_enable_related_portfolio' , true );
$pf_item_description_title = get_post_meta ( get_the_ID() , 'hb_portfolio_item_description_title' , true );
$pf_item_detail_enable = get_post_meta ( get_the_ID() , 'hb_portfolio_details_enable' , true );
$pf_item_detail_title = get_post_meta ( get_the_ID() , 'hb_portfolio_details_title' , true );

?>

<?php get_header(); 
if (have_posts()) : while (have_posts()) : the_post();
?>

<?php if ( $pf_item_detail_enable ) { ?>
<!-- START #single-description -->
<div class="col-8" id="single-description">
	<?php if ( $pf_item_description_title ) { ?>
		<h3 class="project-title"><?php echo $pf_item_description_title; ?></h3>
	<?php } ?>

	<?php the_content(); ?>

</div>
<!-- END #single-description -->

<!-- START #single-meta-sidebar -->
<div class="col-4 last-column" id="single-meta-sidebar">
	<?php if ( $pf_item_detail_title ) { ?>
	<h3 class="project-details"><?php echo $pf_item_detail_title; ?></h3>
	<?php } ?>

	<?php add_portfolio_details( get_the_ID() ); ?>
</div>
<!-- END #single-meta-sidebar -->

<?php } else { ?>
	
	<?php if ( $pf_item_description_title ) { ?>
		<h3 class="project-title"><?php echo $pf_item_description_title; ?></h3>
	<?php } ?>

	<?php 
	the_content(); 
} ?>

<?php if ( $pf_related_posts ) { portfolio_related_posts( get_the_ID() ); } ?>

<?php 
endwhile; 
endif; 
?>
<?php get_footer(); ?>