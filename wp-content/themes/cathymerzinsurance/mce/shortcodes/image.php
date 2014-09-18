<script type="text/javascript">
var ImageDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ImageDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertImage(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var width = jQuery('input#image-width').val();
		var height = jQuery('input#image-height').val();
		var rel = jQuery('input#image-rel').val();
		var whiteframe = jQuery('select#image-frame').val();
		var align = jQuery('select#image-align').val();
		var content = jQuery('textarea#image-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[hb_image';
		
		if(width) output += ' width=\"'+width+'\"';
		if(height) output += ' height=\"'+height+'\"';
		if(whiteframe == 'false') output += ' white_frame=\"false\"';
		if(align != 'left' ) output += ' align=\"'+align+'\"';
		if(rel) output += ' fancybox_rel=\"'+rel+'\"';
		
		output += ']';
		
		if (content) output += content;
		else output += mceSelected;
		
		output += '[/hb_image]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ImageDialog.init, ImageDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
       
		<div class="form-section clearfix">
            <label for="image-content">Image URL</label>
            <textarea type="text" name="image-content" value="" id="image-content"></textarea>
        </div>
		
        <div class="form-section clearfix">
            <label for="image-width">Image Width</label>
            <input type="text" name="image-width" value="" id="image-width" />
        </div>
		
        <div class="form-section clearfix">
            <label for="image-height">Image Height</label>
            <input type="text" name="image-height" value="" id="image-height" />
        </div>
		
		<div class="form-section clearfix">
            <label for="image-frame">Include Image Frame</label>
            <select name="image-frame" id="image-frame" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="image-align">Align</label>
            <select name="image-align" id="image-align" size="1">
                <option value="left" selected="selected">Left</option>
                <option value="center">Center</option>
                <option value="right">Right</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="image-rel">Image FancyBox Rel. <br/><small>If you want to group images into one fancybox, put the sam FancyBox Rel in them.</small></label>
            <input type="text" name="image-rel" value="" id="image-rel" />
        </div>
		
    <a href="javascript:ImageDialog.insert(ImageDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>