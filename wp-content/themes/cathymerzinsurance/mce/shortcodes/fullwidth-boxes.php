<script type="text/javascript">
var FullwidhtBoxesDialog = {
	local_ed : 'ed',
	init : function(ed) {
		FullwidhtBoxesDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertFullwidthBox(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var wrap = jQuery('select#fullwidthbox-wrap').val();
		var last_column = jQuery('select#fullwidthbox-lastcolumn').val();
		var new_tab = jQuery('select#fullwidthbox-newtab').val();
		var title = jQuery('input#fullwidthbox-title').val();
		var size = jQuery('select#fullwidthbox-size').val();
		var icon = jQuery('input#fullwidthbox-icon').val();
		var link = jQuery('input#fullwidthbox-link').val();
		var margintop = jQuery('input#fullwidthbox-margintop').val();
		var content = jQuery('textarea#fullwidthbox-content').val();
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
				
		if(wrap == 'true') {
			output += '[boxes';
			if ( margintop ) output += ' margin_top=\"' + margintop + '\"';
			output += ']';
		}
		
				output += '[box';
					
				if( title ){
					output += ' title=\"'+title+'\"';
				} 
				if( link ){
					output += ' link=\"'+link+'\"';
				} 
				if( icon ){
					output += ' icon=\"'+icon+'\"';
				} 
				output += ' size=\"'+size+'\"';
				
				if( last_column == "true" ){
					output += ' last_column=\"true\"';
				} 
				if( new_tab == "true" ){
					output += ' new_tab=\"true\"';
				} 
					
				
				if(content) {	
					output += ']'+ content;
				}
				else {
					output += ']' + mceSelected;
				}
					
				output += '[/box]';
		
		if(wrap == 'true') {
			output += '[/boxes]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(FullwidhtBoxesDialog.init, FullwidhtBoxesDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        <div class="form-section clearfix">
            <label for="fullwidthbox-wrap">New Boxes Area. <br/><small>Choose Yes if you're creating a new fullwidth boxes section. Otherwise you're creating an item inside an existing boxes section.</small></label>
            <select name="fullwidthbox-wrap" id="fullwidthbox-wrap" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
        <div class="form-section clearfix">
            <label for="fullwidthbox-title">Title</label>
            <input type="text" name="fullwidthbox-title" value="" id="fullwidthbox-title" />
        </div>
		<div class="form-section clearfix">
            <label for="fullwidthbox-link">Title Link</label>
            <input type="text" name="fullwidthbox-link" value="" id="fullwidthbox-link" />
        </div>
		<div class="form-section clearfix">
            <label for="fullwidthbox-icon">Icon</label>
            <input type="text" name="fullwidthbox-icon" value="" id="fullwidthbox-icon" />
        </div>
		<div class="form-section clearfix">
            <label for="fullwidthbox-size">Box Size</small></label>
            <select name="fullwidthbox-size" id="fullwidthbox-size" size="1">
                <option value="one-fourth" selected="selected">One Fourth</option>
                <option value="one-third">One Third</option>
                <option value="">Fullwidth</option>
            </select>
        </div>
		<div class="form-section clearfix">
            <label for="fullwidthbox-lastcolumn">Last in Row</small></label>
            <select name="fullwidthbox-lastcolumn" id="fullwidthbox-lastcolumn" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		<div class="form-section clearfix">
            <label for="fullwidthbox-newtab">Open Link in New Tab<br /><small>In case the title has a link, choose whether to open it in new tab.</small></small></label>
            <select name="fullwidthbox-newtab" id="fullwidthbox-newtab" size="1">
                 <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
        <div class="form-section clearfix">
            <label for="fullwidthbox-content">Fullwidth Box Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="fullwidthbox-content" value="" id="fullwidthbox-content"></textarea>
        </div>
    
    <a href="javascript:FullwidhtBoxesDialog.insert(FullwidhtBoxesDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>