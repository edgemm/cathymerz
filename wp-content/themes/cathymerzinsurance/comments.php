<?php
/**
 * @package WordPress
 * @subpackage Notable
 */
 
global $data;
?>
<div class="clear"></div>
<!-- BEGIN .separator -->
<div class="separator">
	<div class="separator-icon"><span class="icon-comments-alt"></span></div>
</div>
<!-- END .separator --> 

<div class="comments-wrapper clearfix" id="comments">
	<!-- Comments Title -->
	<h4>
	<?php 
		$num_comments = get_comments_number();
		comments_number( __('There are no comments so far', 'hbthemes'), __('There is 1 comment so far', 'hbthemes'), __('There are % comments so far', 'hbthemes') );
	?>
	</h4>
       
	<?php if ($num_comments != 0) { ?>
	<ul class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=hb_format_comment' ); ?>				
	</ul>
	<?php } ?>

	<div class="blog-comment-pagination clearfix">	
	<?php paginate_comments_links(array('prev_text' => '<span>&larr;&nbsp;</span> Previous', 'next_text' => 'Next <span> &nbsp; &rarr;</span>')); ?>
	</div>
	<div class="clear"></div>
	
	<?php if ( $num_comments > 0 ) { ?>
	<div class="spacer"></div>
	<?php } ?>

	<!-- BEGIN #respond -->
	<div id="respond">
			
		<div class="separator-small"></div>
		<div class="spacer"></div>
		
		<h4><?php comment_form_title( __('Leave a Comment', 'framework'), __('Leave a Comment to %s', 'framework') ); ?></h4>
		<span><?php if ( isset ( $data['hb_respond_title'] ) ) echo $data['hb_respond_title']; ?></span>

	</div>
	<!-- END #respond -->

		
	<!-- Respond Script -->
	<script>
		jQuery(document).ready(function(){
			jQuery("#commentform").validate();
		});
	</script>
		
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) : ?>		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'hbthemes'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'hbthemes').'">', '</a>') ?></p>		
		<?php else : ?>
			
			<p>
				<input class="required requiredField" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
				<label for="author"><?php _e('Name', 'hbthemes') ?> <small><?php _e("*", 'hbthemes'); ?></small></label>
			</p>
			<p>
				<input class="required requiredField email" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
				<label for="email"><?php _e('Email', 'hbthemes') ?> <small><?php _e("*", 'hbthemes'); ?></small></label>
			</p>		
			<p>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
				<label for="url"><?php _e('Website', 'hbthemes') ?></label>
			</p>
			
		<?php endif; ?>
			
		<p>
			<textarea class="required requiredField" name="comment" id="comment" cols="55" rows="10" tabindex="4"></textarea>
		</p>
		<p class="form-disclaimer"><small><?php _e("Don't worry. We never use your email for spam.", 'hbthemes'); ?></small></p>
		<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></small></p>-->
			
		<p class="no-margin">
			<button name="submit" class="button btn-large btn-orange" type="submit" id="submit" tabindex="5"><?php _e('Submit Comment', 'hbthemes'); ?></button>
		</p>
		
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>
		
	</form>

</div>

<?php	
function hb_format_comment($comment, $args, $depth) {
	$isByAuthor = false;
	global $data;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
     
      <?php echo get_avatar($comment,$size='35'); ?>
      
      <div class="comment-author vcard">
         <?php printf('%s', get_comment_author_link()) ?> 
		 <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('Author','hbthemes') ?></span><?php } ?>
      </div>

      <div class="comment-meta">
	  	<?php printf('%1$s ago ', human_time_diff( get_comment_time('U'), current_time('timestamp') ) ); ?>
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'before' => '&middot; ' , 'max_depth' => $args['max_depth']))) ?>
		<?php edit_comment_link('Edit', '&middot; ', ''); ?>
	</div>
      
      <div class="comment-inner">      
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'hbthemes') ?></em>
		<br />
		<?php endif; ?>
  
		<?php comment_text() ?>
        
		</div>      
	</div>

<?php } ?>