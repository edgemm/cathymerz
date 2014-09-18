<script type="text/javascript">
var InfoboxDialog = {
	local_ed : 'ed',
	init : function(ed) {
		InfoboxDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertInfobox(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var size = jQuery('select#infobox-size').val();
		var color = jQuery('select#infobox-color').val();
		var closable = jQuery('select#infobox-closable').val();
		var bottommargin = jQuery('select#infobox-nomargin').val();
		var last = jQuery('select#infobox-last').val();
		var content = jQuery('textarea#infobox-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[infobox';
		
		if(size) {
			output += ' size=\"'+size+'\"';
		}
		
		if (last!="false") {
			output += ' last_column=\"'+last+'\"';
		}
		
		if (bottommargin!="true") {
			output += ' bottom_margin=\"'+bottommargin+'\"';
		}
		
		if (closable!="true") {
			output += ' closable=\"'+closable+'\"';
		}
		
		output+= ' color=\"'+color+'\"';
		
		if(content) {	
			output += ']'+ content;
		}
		else {
			output += ']' + mceSelected;
		}
					
		output += '[/infobox]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(InfoboxDialog.init, InfoboxDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="infobox-size">Choose Size</label>
            <select name="infobox-size" id="infobox-size" size="1">
            	<option value="" selected="selected"> Fit Parent </option>
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
                <option value="col-12"> 12/12 </option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="infobox-color">Infobox Color</label>
            <select name="infobox-color" id="infobox-color" size="1">
                <option value="green" selected="selected">Green</option>
                <option value="red">Red</option>
                <option value="blue">Blue</option>
                <option value="orange">Orange</option>
                <option value="grey">Grey</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="infobox-closable">Choose if this infobox can close</label>
            <select name="infobox-closable" id="infobox-closable" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="infobox-last">Is Last In Row</label>
            <select name="infobox-last" id="infobox-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="infobox-nomargin">Has Bottom Margin</label>
            <select name="infobox-nomargin" id="infobox-nomargin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="infobox-content">Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="infobox-content" value="" id="infobox-content"></textarea>
        </div>
        
    <a href="javascript:InfoboxDialog.insert(InfoboxDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>