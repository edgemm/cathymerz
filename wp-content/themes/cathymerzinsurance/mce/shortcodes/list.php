<script type="text/javascript">
var ListDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ListDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertList(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var wrap = jQuery('select#list-wrap').val();
		var size = jQuery('select#list-size').val();
		var icon = jQuery('input#list-icon').val();
		var color = jQuery('input#list-color').val();
		var content = jQuery('textarea#list-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		if(wrap == 'true') {
			output += '[list]';
		}
		
				output += '[list_item';
				
				if ( size ) output+=' size=\"'+size+'\"';
				if ( icon ) output += ' icon=\"'+icon+'\"';
				if ( color ) output += ' hex_color=\"'+color+'\"';
				output += ']';
				if ( content ) output += content;
				else output += mceSelected;
				
			
					
				output += '[/list_item]';
		
		if(wrap == 'true') {
			output += '[/list]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ListDialog.init, ListDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        <div class="form-section clearfix">
            <label for="list-wrap">New List. <br/><small>Choose Yes if you're creating a new List. Otherwise you're creating an item inside an existing list.</small></label>
            <select name="list-wrap" id="list-wrap" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="list-icon">Enter List Item Icon</label>
            <input type="text" name="list-icon" value="" id="list-icon" />
        </div>
		
		<div class="form-section clearfix">
            <label for="list-color">Enter List Item Icon Color. <br/><small>Enter Hex Color</small></label>
            <input type="text" name="list-color" value="" id="list-color" />
        </div>
		
        <div class="form-section clearfix">
            <label for="list-size">Choose Icon Size</label>
            <select name="list-size" id="list-size" size="1">
                <option value="" selected="selected"> Normal </option>
                <option value="large"> Large </option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="list-content">List Item Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="list-content" value="" id="list-content"></textarea>
        </div>
    
    <a href="javascript:ListDialog.insert(ListDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>