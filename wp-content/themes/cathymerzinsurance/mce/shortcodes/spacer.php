<script type="text/javascript">
var SpacerDialog = {
	local_ed : 'ed',
	init : function(ed) {
		SpacerDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSpacer(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var height = jQuery('input#spacer-height').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[spacer';
		if ( height ) {
			output+= ' height=\"'+height+'\"';
		}
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SpacerDialog.init, SpacerDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        
        <div class="form-section clearfix">
            <label for="spacer-height">Spacer Height.<br/><small>Note: Always write px, em or other.</small></label>
            <input type="text" name="spacer-height" value="" id="spacer-height" />
        </div>
        
    
    <a href="javascript:SpacerDialog.insert(SpacerDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>