<script type="text/javascript">
var HeadingDialog = {
	local_ed : 'ed',
	init : function(ed) {
		HeadingDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertHeading(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var focused = jQuery('select#heading-focus').val();
		var type = jQuery('select#heading-type').val();
		var content = jQuery('textarea#heading-content').val();
		
				 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		
		output += '['+type;
		if ( focused == 'true' ) output+='_focus_heading';
		output += ']';
		
		if ( content ) output += content;
		else output += mceSelected;
		
		output += '[/'+type;
		if ( focused == 'true' ) output+='_focus_heading';
		output+= ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(HeadingDialog.init, HeadingDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		
		<div class="form-section clearfix">
            <label for="heading-focus">Focus heading</label>
            <select name="heading-focus" id="heading-focus" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="heading-type">Heading</label>
            <select name="heading-type" id="heading-type" size="1">
                <option value="h1" selected="selected">h1</option>
                <option value="h2">h2</option>
                <option value="h3">h3</option>
                <option value="h4">h4</option>
                <option value="h5">h5</option>
                <option value="h6">h6</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="heading-content">Heading Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="heading-content" value="" id="heading-content"></textarea>
        </div>
		
        
    <a href="javascript:HeadingDialog.insert(HeadingDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>