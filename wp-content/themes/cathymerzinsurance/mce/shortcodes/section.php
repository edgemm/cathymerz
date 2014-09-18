<script type="text/javascript">
var SectionDialog = {
	local_ed : 'ed',
	init : function(ed) {
		SectionDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSection(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 		 
		var content = jQuery('textarea#section-content').val();
		
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[section]';
		
				
		if(content) {	
			output += content;
		}
		else {
			output += mceSelected;
		}
					
		output += '[/section]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SectionDialog.init, SectionDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
	
	<div class="form-section clearfix">
            <label for="section-content">Section Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="section-content" value="" id="section-content"></textarea>
     </div>
		
    <a href="javascript:SectionDialog.insert(SectionDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>