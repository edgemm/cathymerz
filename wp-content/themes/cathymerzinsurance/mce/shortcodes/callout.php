<script type="text/javascript">
var CalloutDialog = {
	local_ed : 'ed',
	init : function(ed) {
		CalloutDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertCallout(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var size = jQuery('select#action-size').val();
		var last = jQuery('select#action-last').val();
		var link = jQuery('input#action-link').val();
		var title = jQuery('input#action-title').val();
		var description = jQuery('input#action-description').val();		
		var btntitle = jQuery('input#action-btntitle').val();
		var btnrounded = jQuery('select#action-btnrounded').val();
		var btncolor = jQuery('select#action-btncolor').val();
		var btnsize = jQuery('select#action-btnsize').val();
		var newtab = jQuery('select#action-newtab').val();
		var icon = jQuery('input#action-icon').val();
		var flipleft = jQuery('input#action-flipleft').val();
		var flipright = jQuery('input#action-flipright').val();
		var content = jQuery('textarea#action-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[callout';
		
		output += ' size=\"' + size + '\"';
		if ( last == 'true' ) output += ' last_column=\"true\"';
		if ( title ) output += ' title=\"' + title + '\"';
		if ( description ) output += ' description=\"' + description + '\"';
		
		if ( btntitle ) output += ' button_title=\"' + btntitle + '\"';
		if ( link ) output += ' button_link=\"' + link + '\"';
		output += ' button_size=\"' + btnsize + '\"';
		output += ' button_rounded=\"' + btnrounded + '\"';
		output += ' button_color=\"' + btncolor + '\"';
		if ( newtab == 'true' ) output += ' button_in_new_tab=\"true\"';
		if ( icon ) output += ' button_icon=\"' + icon + '\"';
		if ( flipleft == 'true' ) output += ' flip_left_edge=\"true\"';
		if ( flipright == 'true' ) output += ' flip_right_edge=\"true\"';
		
		
					
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(CalloutDialog.init, CalloutDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="action-title">Callout Title</label>
            <input type="text" name="action-title" value="" id="action-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="action-description">Callout Description</label>
            <input type="text" name="action-description" value="" id="action-description" />
        </div>
		
		
		<div class="form-section clearfix">
            <label for="action-size">Choose Size</label>
            <select name="action-size" id="action-size" size="1">
                <option value="col-1"> 1/12 </option>
                <option value="col-2"> 2/12 </option>
                <option value="col-3"> 3/12 </option>
                <option value="col-4"> 4/12 </option>
                <option value="col-5"> 5/12 </option>
                <option value="col-6"> 6/12 </option>
                <option value="col-7"> 7/12 </option>
                <option value="col-8"> 8/12 </option>
                <option value="col-9"> 9/12 </option>
                <option value="col-10"> 10/12 </option>
                <option value="col-11"> 11/12 </option>
                <option value="col-12" selected="selected"> 12/12 </option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="action-last">Is Last In Row</label>
            <select name="action-last" id="action-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="action-btntitle">Button Title</label>
            <input type="text" name="action-btntitle" value="" id="action-btntitle" />
        </div>
		
		<div class="form-section clearfix">
            <label for="action-link">Button Link</label>
            <input type="text" name="action-link" value="" id="action-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="action-icon">Button Icon<br/><small>Leave empty for no icon.</small></label>
            <input type="text" name="action-icon" value="" id="action-icon" />
        </div>
        
		<div class="form-section clearfix">
            <label for="action-btnsize">Button Size</label>
            <select name="action-btnsize" id="action-btnsize" size="1">
                <option value="small">Small</option>
                <option value="normal" selected="selected">Normal</option>
                <option value="large">Large</option>
                <option value="xlarge">Extra Large</option>
                <option value="mega">Mega</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="action-btncolor">Button Color</label>
            <select name="action-btncolor" id="action-btncolor" size="1">
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="orange" selected="selected">Orange</option>
                <option value="grey">Grey</option>
                <option value="purple">Purple</option>
                <option value="cyan">Cyan</option>
                <option value="black">Black</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="action-btnrounded">Rounded Button</label>
            <select name="action-btnrounded" id="action-btnrounded" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="action-flipleft">Flip Left Edge</label>
            <select name="action-flipleft" id="action-flipleft" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="action-flipright">Flip Right Edge</label>
            <select name="action-flipright" id="action-flipright" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
    
    <a href="javascript:CalloutDialog.insert(CalloutDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>