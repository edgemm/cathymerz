<script type="text/javascript">
var TooltopDialog = {
	local_ed : 'ed',
	init : function(ed) {
		TooltopDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertTooltip(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var title = jQuery('input#tooltip-title').val();
		var content = jQuery('textarea#tooltip-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[tooltip';
		
		if ( title ) {
			output+=' title=\"'+title+'\"';
		}
		
		if (content) {
			output+= ']'+content;
		} else {
			output+= ']' + mceSelected;
		}
		
		output+='[/tooltip]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(TooltopDialog.init, TooltopDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">Tooltip Title.</label>
            <input type="text" name="tooltip-title" value="" id="tooltip-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="tooltip-content">Tooltip Content</label>
            <textarea type="text" name="tooltip-content" value="" id="tooltip-content"></textarea>
        </div>
        
    <a href="javascript:TooltopDialog.insert(TooltopDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>