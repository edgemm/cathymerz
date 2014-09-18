<script type="text/javascript">
var SeparatorDialog = {
	local_ed : 'ed',
	init : function(ed) {
		SeparatorDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSeparator(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var icon = jQuery('input#separator-icon').val();
		var text = jQuery('input#separator-text').val();
		var small = jQuery('select#separator-small').val();
		var totop = jQuery('select#separator-totop').val();
		var title = jQuery('input#separator-title').val();
		
		 
		// setup the output of our shortcode
		output = '[separator';
		if ( icon ) {
			output += ' icon=\"' + icon + '\"';
		} else if ( text ) {
			output += ' text=\"' + text + '\"';
		} else if ( small=="true" ) {
			output += ' small=\"true\"';
		} else if ( totop=="true" ) {
			output += ' to_top=\"true\"';
		}
		
		if ( title ) output+= ' hover_text=\"'+title+'\"';
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SeparatorDialog.init, SeparatorDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="separator-title">Separator Hover Text</label>
            <input type="text" name="separator-title" value="" id="separator-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="separator-icon">Separator Icon</label>
            <input type="text" name="separator-icon" value="" id="separator-icon" />
        </div>	
		
		<div class="form-section clearfix">
            <label for="separator-text">Separator Text</label>
            <input type="text" name="separator-text" value="" id="separator-text" />
        </div>	

		<div class="form-section clearfix">
            <label for="separator-small">Small Separator</label>
            <select name="separator-small" id="separator-small" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>		
		
		<div class="form-section clearfix">
            <label for="separator-totop">To Top</label>
            <select name="separator-totop" id="separator-totop" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
    <a href="javascript:SeparatorDialog.insert(SeparatorDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>