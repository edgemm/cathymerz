<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

global $data;

get_header();
?>
<!-- START .page-not-found-box -->
<div class="page-not-found-box">
	<h1 class="aligncenter"><?php echo $data['hb_error_title']; ?></h1>
	<h3 class="aligncenter"><?php echo $data['hb_error_description']; ?></h3>
			
	<?php if ( $data['hb_enable_search'] ) { ?>
		<div class="separator"><div class="separator-icon" title="<?php echo $data['hb_error_separator_icon_title']; ?>"><span class="<?php echo $data['hb_error_separator_icon']; ?>"></span></div></div>
				
		<?php if ( $data['hb_error_search_title'] ) { ?>
			<h4 class="aligncenter"><?php echo $data['hb_error_search_title']; ?></h4>
		<?php } ?>
		
		<form action="<?php echo home_url( '/' ); ?>" role="search" method="get" id="search-404">
		<input type="text" placeholder="<?php _e('Search the website','hbthemes'); ?>" name="s" id="search"/>
		<input type="submit" id="submit-search" value=" "/>  
		</form>      
	<?php } ?>
            
</div>	
<!-- END .page-not-found-box -->	
<?php
get_footer();
?>