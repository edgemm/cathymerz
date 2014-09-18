<script type="text/javascript">
var ClearDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ClearDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertClear(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var wrap = jQuery('select#tab-wrap').val();
		var title = jQuery('input#tab-title').val();
		var content = jQuery('textarea#tab-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode		
		output += '[clear]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ClearDialog.init, ClearDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        
    
    <a href="javascript:ClearDialog.insert(ClearDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>