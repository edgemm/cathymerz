<script type="text/javascript">
var SocialDialog = {
	local_ed : 'ed',
	init : function(ed) {
		SocialDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSocial(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var wrap = jQuery('select#social-wrap').val();
		var tabbed = jQuery('select#social-new-tab').val();
		var type = jQuery('select#social-type').val();
		var link = jQuery('input#social-link').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		if(wrap == 'true') {
			output += '[social]';
		}
		
		output += '[social_icon';
				
		output += ' type=\"'+type+'\"';
		if ( link ) output += ' link=\"'+link+'\"';
		if ( tabbed == false ) output += ' in_new_tab=\"false\"';
		output += ']';
		
		if(wrap == 'true') {
			output += '[/social]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SocialDialog.init, SocialDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        <div class="form-section clearfix">
		
            <label for="social-wrap">New Social Section. <br/><small>Choose Yes if you're creating a new social section. Otherwise you're creating a social icon inside an existing section.</small></label>
            <select name="social-wrap" id="social-wrap" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
		</div>
		
		<div class="form-section clearfix">
			<label for="social-type">Select Social Network</label>
            <select name="social-type" id="social-type" size="1">
                <option value="facebook" selected="selected">Facebook</option>
                <option value="twitter">Twitter</option>
                <option value="googleplus">Google Plus</option>
                <option value="apple">Apple</option>
                <option value="delicious">Delicious</option>
                <option value="deviantart">DeviantArt</option>
                <option value="digg">Digg</option>
                <option value="lastfm">LastFM</option>
                <option value="pinterest">Pinterest</option>
                <option value="reddit">Reddit</option>
                <option value="skype">Skype</option>
                <option value="stumbleupon">StumbleUpon</option>
                <option value="youtube">YouTube</option>
                <option value="dribbble">Dribbble</option>
                <option value="flickr">Flickr</option>
                <option value="forrst">Forrst</option>
                <option value="github">Github</option>
                <option value="linkedin">LinkedIn</option>
                <option value="rss">RSS</option>
                <option value="vimeo">Vimeo</option>
            </select>	
		</div>
		
		<div class="form-section clearfix">
            <label for="social-link">Link To Selected Social Network Profile.</label>
            <input type="text" name="social-link" value="" id="social-link" />
		</div>

		<div class="form-section clearfix">
			<label for="social-new-tan">Open In New Tab.</label>
			<select name="social-new-tab" id="social-new-tab" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>			
			
        </div>
    
    <a href="javascript:SocialDialog.insert(SocialDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>