<script type="text/javascript">
var ReadMoreTypeDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ReadMoreTypeDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertReadMoreButton(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var link = jQuery('input#read-more-link').val();
		var ribbon = jQuery('select#read-more-ribbon').val();
		var title = jQuery('input#read-more-title').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		
		output += '[read_more_button';
		if ( link ) {
			output+= ' link=\"'+link+'\"';
		} 
		if ( ribbon == 'true' ) output += ' ribbon=\"true\"';
		output += ']';
		
		if ( title ) output+=title;
		else output+=mceSelected;
		
		output+='[/read_more_button]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ReadMoreTypeDialog.init, ReadMoreTypeDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        
		<div class="form-section clearfix">
            <label for="read-more-title">Title for the button</label>
            <input type="text" name="read-more-title" value="" id="read-more-title" />
        </div>
        
        <div class="form-section clearfix">
            <label for="read-more-link">Link for the button</small></label>
            <input type="text" name="read-more-link" value="" id="read-more-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="read-more-ribbon">Ribbon Style</label>
            <select name="read-more-ribbon" id="read-more-ribbon" size="1">
                <option value="false" selected="selected"> False </option>
                <option value="true"> True </option>
            </select>
        </div>
    
    <a href="javascript:ReadMoreTypeDialog.insert(ReadMoreTypeDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>