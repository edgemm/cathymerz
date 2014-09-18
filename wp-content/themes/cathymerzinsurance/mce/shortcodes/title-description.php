<script type="text/javascript">
var TitleDescriptionDialog = {
	local_ed : 'ed',
	init : function(ed) {
		TitleDescriptionDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertTitleDescription(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var content = jQuery('textarea#titledesc-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[title_description]';
		
		if (content) {
			output+= content;
		} else {
			output+= mceSelected;
		}
		
		output+='[/title_description]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(TitleDescriptionDialog.init, TitleDescriptionDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="titledesc-content">Content</small></label>
            <textarea type="text" name="titledesc-content" value="" id="titledesc-content"></textarea>
        </div>
        
    <a href="javascript:TitleDescriptionDialog.insert(TitleDescriptionDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>