<script type="text/javascript">
var ShortcodeSeparatorDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ShortcodeSeparatorDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSeparatorShortcode(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var content = jQuery('textarea#sepshort-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[separator_shortcode]';
		
		if (content) {
			output+= content;
		} else {
			output+= mceSelected;
		}
		
		output+='[/separator_shortcode]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ShortcodeSeparatorDialog.init, ShortcodeSeparatorDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="sepshort-content">Separator Shortcode Content</small></label>
            <textarea type="text" name="sepshort-content" value="" id="sepshort-content"></textarea>
        </div>
        
    <a href="javascript:ShortcodeSeparatorDialog.insert(ShortcodeSeparatorDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>