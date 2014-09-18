<script type="text/javascript">
var FlexsliderDialog = {
	local_ed : 'ed',
	init : function(ed) {
		FlexsliderDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertFlexslider(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var title = jQuery('input#flexslider-title').val();		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[flexslider';
		
		if ( title ) {
			output+=' name=\"'+title+'\"';
		}
		
		output+=']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(FlexsliderDialog.init, FlexsliderDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">Flexslider Name</label>
            <input type="text" name="flexslider-title" value="" id="flexslider-title" />
        </div>
		
    <a href="javascript:FlexsliderDialog.insert(FlexsliderDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>