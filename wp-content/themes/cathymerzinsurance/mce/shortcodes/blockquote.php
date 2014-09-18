<script type="text/javascript">
var BlockquoteDialog = {
	local_ed : 'ed',
	init : function(ed) {
		BlockquoteDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertBlockquote(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		
		var content = jQuery('textarea#blockquote-content').val();
		
				 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[blockquote]';
		
		if ( content ) {
			output +=  content;
		} else {
			output+= mceSelected;
		}
		
		output += '[/blockquote]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(BlockquoteDialog.init, BlockquoteDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="blockquote-content">Blockquote Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="blockquote-content" value="" id="blockquote-content"></textarea>
        </div>
		
        
    <a href="javascript:BlockquoteDialog.insert(BlockquoteDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>