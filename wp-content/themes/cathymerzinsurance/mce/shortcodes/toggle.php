<script type="text/javascript">
var ToggleDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ToggleDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertToggle(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var title = jQuery('input#toggle-title').val();
		var content = jQuery('textarea#toggle-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[toggle';
		
		if ( title ) {
			output+=' title=\"'+title+'\"';
		}
		
		if (content) {
			output+= ']'+content;
		} else {
			output+= ']' + mceSelected;
		}
		
		output+='[/toggle]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ToggleDialog.init, ToggleDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">Toggle Title.</label>
            <input type="text" name="toggle-title" value="" id="toggle-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="toggle-content">Toggle Content</label>
            <textarea type="text" name="toggle-content" value="" id="toggle-content"></textarea>
        </div>
        
    <a href="javascript:ToggleDialog.insert(ToggleDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>