<script type="text/javascript">
var IconDialog = {
	local_ed : 'ed',
	init : function(ed) {
		IconDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertIcon(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var size = jQuery('input#icon-size').val();
		var color = jQuery('input#icon-color').val();
		var icon = jQuery('input#icon-icon').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[icon';
		if ( icon ) output += ' icon=\"'+icon+'\"';
		if ( size ) output += ' size=\"'+size+'\"';
		if ( color ) output += ' color=\"'+color+'\"';
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(IconDialog.init, IconDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="icon-icon">Font Awesome Icon</label>
            <input type="text" name="icon-icon" value="" id="icon-icon" />
        </div>
		
        <div class="form-section clearfix">
            <label for="icon-size">Icon Size <br/><small>Always write down px, pt, em...</small></label>
            <input type="text" name="icon-size" value="" id="icon-size" />
        </div>
		
		<div class="form-section clearfix">
            <label for="icon-color">Icon Color <br/><small>Hex Color</small></label>
            <input type="text" name="icon-color" value="" id="icon-color" />
        </div>
    <a href="javascript:IconDialog.insert(IconDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>