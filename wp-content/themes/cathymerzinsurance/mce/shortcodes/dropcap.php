<script type="text/javascript">
var DropcapDialog = {
	local_ed : 'ed',
	init : function(ed) {
		DropcapDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertDropcap(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var content = jQuery('textarea#dropcap-content').val();
		
				 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[dropcap]';
		
		if ( content ) output += content;
		else output += mceSelected;
		
		output += '[/dropcap]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(DropcapDialog.init, DropcapDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="dropcap-content">Dropcap Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="dropcap-content" value="" id="dropcap-content"></textarea>
        </div>
		
        
    <a href="javascript:DropcapDialog.insert(DropcapDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>