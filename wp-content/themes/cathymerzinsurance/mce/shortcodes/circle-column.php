<script type="text/javascript">
var CircleFeatureDialog = {
	local_ed : 'ed',
	init : function(ed) {
		CircleFeatureDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertCircleFeature(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values

		var size = jQuery('select#circle-size').val();
		var last = jQuery('select#circle-last').val();
		var color = jQuery('select#circle-color').val();
		var title = jQuery('input#circle-title').val();
		var icon = jQuery('input#circle-icon').val();
		var number = jQuery('input#circle-number').val();
		var bottom_margin = jQuery('select#circle-margin').val();
		var link = jQuery('input#circle-link').val();
		var content = jQuery('textarea#circle-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[circle_feature';
		
		if (title) output += ' title=\"'+title+'\"';
		if (link) output += ' link=\"'+link+'\"';
		if (number) output += ' number=\"'+number+'\"';
		if ( bottom_margin == 'false' ) output+= ' bottom_margin=\"false\"';
		if ( last == 'true' )  output+= ' last_column=\"true\"';
		if ( icon ) output += ' icon=\"' + icon + '\"';
		output+= ' size=\"'+size+'\"';
		output+= ' color=\"'+color+'\"';
		output+=']';

		if (content) output+=content;
		else output+=mceSelected;
		
		output += '[/circle_feature]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(CircleFeatureDialog.init, CircleFeatureDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="circle-title">Circle Feature Column Title</label>
            <input type="text" name="circle-title" value="" id="circle-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-link">Circle Feature Column Title Link</label>
            <input type="text" name="circle-link" value="" id="circle-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-number">Number That Goes Into The Circle Feature</label>
            <input type="text" name="circle-number" value="" id="circle-number" />
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-icon">Icon That Goes Into The Circle Feature</label>
            <input type="text" name="circle-icon" value="" id="circle-icon" />
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-content">Circle Feature Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="circle-content" value="" id="circle-content"></textarea>
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-size">Choose Size</label>
            <select name="circle-size" id="circle-size" size="1">
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
            <label for="circle-color">Color</label>
            <select name="circle-color" id="circle-color" size="1">
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="orange">Orange</option>
                <option value="" selected="selected">Default</option>
                <option value="grey">Grey</option>
                <option value="purple">Purple</option>
                <option value="cyan">Cyan</option>
                <option value="black">Black</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="circle-last">Is Last In Row</label>
            <select name="circle-last" id="circle-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="circle-margin">Has Bottom Margin</label>
            <select name="circle-margin" id="circle-margin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
    
    <a href="javascript:CircleFeatureDialog.insert(CircleFeatureDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>