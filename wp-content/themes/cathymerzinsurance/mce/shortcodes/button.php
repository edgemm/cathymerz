<script type="text/javascript">
var ButtonDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ButtonDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var title = jQuery('input#button-title').val();
		var link = jQuery('input#button-link').val();
		var color = jQuery('select#button-color').val();
		var size = jQuery('select#button-size').val();		
		var icon = jQuery('input#button-icon').val();
		var rounded = jQuery('select#button-rounded').val();
		var blank = jQuery('select#button-blank').val();		 

		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[button';
		
		if(title){
			output += ' title=\"'+title+'\"';
		}
		
		if (color != 'orange') {
			output += ' color=\"'+color+'\"';
		}
		
		if (size != 'large') {
			output += ' size=\"'+size+'\"';
		}
				
		if (link != "") {
			output += ' link=\"'+link+'\"';
		}

		if ( rounded == 'false') output += ' in_new_tab=\"false\"';

		if ( rounded == 'true' ) output+=' rounded=\"true\"';
		
		output += ' icon=\"'+icon+'\"';
				
		
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="button-title">Button Title</label>
            <input type="text" name="button-title" value="" id="button-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="button-link">Button Link</label>
            <input type="text" name="button-link" value="" id="button-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="button-icon">Button Icon<br/><small>Leave empty for no icon.</small></label>
            <input type="text" name="button-icon" value="" id="button-icon" />
        </div>

        <div class="form-section clearfix">
            <label for="button-rounded">Rounded Button</label>
            <select name="button-rounded" id="button-rounded" size="1">
                <option value="true">Yes</option>
                <option value="false" selected="selected">No</option>
            </select>
        </div>

        <div class="form-section clearfix">
            <label for="button-blank">Open Link In New Tab/Window.</label>
            <select name="button-blank" id="button-blank" size="1">
                <option value="true" selected="selected">Yes</option>
                <option value="false">No</option>
            </select>
        </div>
        
		<div class="form-section clearfix">
            <label for="button-size">Button Size</label>
            <select name="button-size" id="button-size" size="1">
                <option value="small">Small</option>
                <option value="normal" selected="selected">Normal</option>
                <option value="large">Large</option>
                <option value="xlarge">Extra Large</option>
                <option value="mega">Mega</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="button-color">Button Color</label>
            <select name="button-color" id="button-color" size="1">
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="orange">Orange</option>
                <option value="grey">Grey</option>
                <option value="purple">Purple</option>
                <option value="cyan">Cyan</option>
                <option value="black">Black</option>
                <option value="" selected="selected"> Default </option>
            </select>
        </div>
    
    <a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>