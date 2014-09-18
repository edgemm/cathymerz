<script type="text/javascript">
var VideoDialog = {
	local_ed : 'ed',
	init : function(ed) {
		VideoDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertVideo(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var width = jQuery('input#video-width').val();
		var height = jQuery('input#video-height').val();
		var whiteframe = jQuery('select#video-frame').val();
		var content = jQuery('textarea#video-content').val();
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		output += '[hb_video';
		
		if(width) output += ' width=\"'+width+'\"';
		if(height) output += ' height=\"'+height+'\"';
		if(whiteframe == 'false') output += ' white_frame=\"false\"';
		
		output += ']';
		
		if (content) output += content;
		else output += mceSelected;
		
		output += '[/hb_video]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(VideoDialog.init, VideoDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
       
		<div class="form-section clearfix">
            <label for="video-content">Video URL</label>
            <textarea type="text" name="video-content" value="" id="video-content"></textarea>
        </div>
		
        <div class="form-section clearfix">
            <label for="video-width">Video Width</label>
            <input type="text" name="video-width" value="" id="video-width" />
        </div>
		
        <div class="form-section clearfix">
            <label for="video-height">Video Height</label>
            <input type="text" name="video-height" value="" id="video-height" />
        </div>
		
		<div class="form-section clearfix">
            <label for="video-frame">Include White Frame</label>
            <select name="video-frame" id="video-frame" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
    <a href="javascript:VideoDialog.insert(VideoDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>