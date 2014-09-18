<script type="text/javascript">
var IconColumnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		IconColumnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertIconColumn(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values

		var size = jQuery('select#icon-column-size').val();
		var last = jQuery('select#icon-column-last').val();
		var title = jQuery('input#icon-column-title').val();
		var link = jQuery('input#icon-column-link').val();
		var bottom_margin = jQuery('select#icon-column-margin').val();
		var icon = jQuery('input#icon-column-icon').val();
		var content = jQuery('textarea#icon-column-content').val();
		var color = jQuery ('input#icon-column-color').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[icon_column';
		
		if (title) output += ' title=\"'+title+'\"';
		if (link) output += ' link=\"'+link+'\"';
		if (icon) output += ' icon=\"'+icon+'\"';
		if ( bottom_margin == 'false' ) output+= ' bottom_margin=\"false\"';
		if ( last == 'true' )  output+= ' last_column=\"true\"';
		if ( icon ) output += ' color=\"'+color+'\"';
		output+= ' size=\"'+size+'\"';
		output+=']';

		if (content) output+=content;
		else output+=mceSelected;
		
		output += '[/icon_column]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(IconColumnDialog.init, IconColumnDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="icon-column-title">Icon Column Title</label>
            <input type="text" name="icon-column-title" value="" id="icon-column-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="icon-column-link">Icon Column Title Link</label>
            <input type="text" name="icon-column-link" value="" id="icon-column-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="icon-column-icon">Specify Icon</label>
            <input type="text" name="icon-column-icon" value="" id="icon-column-icon" />
        </div>

        <div class="form-section clearfix">
            <label for="icon-column-color">Specify Icon Color <br/><small>Enter Any Hex Color</small></label>
            <input type="text" name="icon-column-color" value="" id="icon-column-color" />
        </div>
		
		<div class="form-section clearfix">
            <label for="icon-column-content">Icon Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="icon-column-content" value="" id="icon-column-content"></textarea>
        </div>
		
		<div class="form-section clearfix">
            <label for="icon-column-size">Choose Size</label>
            <select name="icon-column-size" id="icon-column-size" size="1">
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
            <label for="icon-column-last">Is Last In Row</label>
            <select name="icon-column-last" id="icon-column-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="icon-column-margin">Has Bottom Margin</label>
            <select name="icon-column-margin" id="icon-column-margin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
    
    <a href="javascript:IconColumnDialog.insert(IconColumnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>