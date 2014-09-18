<script type="text/javascript">
var FocusTextDialog = {
	local_ed : 'ed',
	init : function(ed) {
		FocusTextDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertFocusText(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var content = jQuery('textarea#focus-sep-content').val();
		
				 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode		
		output += '[focus_color]';
		
		if ( content ) output += content;
		else output += mceSelected;
		
		output += '[/focus_color]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(FocusTextDialog.init, FocusTextDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="focus-sep-content">Focused Text Content<br /></label>
            <textarea type="text" name="focus-sep-content" value="" id="focus-sep-content"></textarea>
        </div>
		
        
    <a href="javascript:FocusTextDialog.insert(FocusTextDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>