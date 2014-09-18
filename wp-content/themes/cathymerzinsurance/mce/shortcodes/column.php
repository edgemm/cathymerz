<script type="text/javascript">
var ColumnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ColumnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertColumn(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var size = jQuery('select#column-size').val();
		var bottommargin = jQuery('select#column-nomargin').val();
		var last = jQuery('select#column-last').val();
		var content = jQuery('textarea#column-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		output += '[column';
		
		if(size!='col-12') {
			output += ' size=\"'+size+'\"';
		}
		
		if (last!="false") {
			output += ' last_column=\"'+last+'\"';
		}
		
		if (bottommargin!="true") {
			output += ' bottom_margin=\"'+bottommargin+'\"';
		}
		
		if(content) {	
			output += ']'+ content;
		}
		else {
			output += ']' + mceSelected;
		}
					
		output += '[/column]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ColumnDialog.init, ColumnDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="column-size">Choose Size</label>
            <select name="column-size" id="column-size" size="1">
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
            <label for="column-last">Is Last In Row</label>
            <select name="column-last" id="column-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="column-nomargin">Has Bottom Margin</label>
            <select name="column-nomargin" id="column-nomargin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="column-content">Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="column-content" value="" id="column-content"></textarea>
        </div>
        
    <a href="javascript:ColumnDialog.insert(ColumnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>