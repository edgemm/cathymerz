<script type="text/javascript">
var ScreenDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ScreenDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertScreen(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var size = jQuery('select#screen-size').val();
		var content = jQuery('textarea#screen-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[screen size=\"'+size+'\"]';
		if (content) output+=content;
		else output+=mceSelected;
		output += '[/screen]';
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ScreenDialog.init, ScreenDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
       
	   <div class="form-section clearfix">
            <label for="screen-size">Choose On Which Screen The Content Of This Shortcode Will Be Displayed.</label>
            <select name="screen-size" id="screen-size" size="1">
                <option value="phone"> Phone </option>
                <option value="phone-portrait"> Phone Portrait </option>
                <option value="phone-landscape"> Phone Landscape </option>
                <option value="tablet"> Tablet </option>
                <option value="desktop" selected="selected"> Desktop </option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="screen-content">Content To Be Displayed<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="screen-content" value="" id="screen-content"></textarea>
        </div>
		
    <a href="javascript:ScreenDialog.insert(ScreenDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>