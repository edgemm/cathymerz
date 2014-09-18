<script type="text/javascript">
var Service2ColumnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		Service2ColumnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertService3Column(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var boxed = jQuery('select#service2-boxed').val();
		var newtab = jQuery('select#service2-newtab').val();
		var title = jQuery('input#service2-title').val();
		var icon = jQuery('input#service2-icon').val();
		var link = jQuery('input#service2-link').val();
		var content = jQuery('textarea#service2-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[service_type_2';
		
		if ( title ) output += ' title=\"' + title + '\"';
		if ( link ) output += ' link=\"' + link + '\"';
		if ( icon ) output += ' icon=\"' + icon + '\"';
		if ( boxed=="true") output += ' boxed=\"true\"';
		if ( newtab=="true") output += ' new_tab=\"true\"';
				
		if(content) {	
			output += ']'+ content;
		}
		else {
			output += ']' + mceSelected;
		}
					
		output += '[/service_type_2]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(Service2ColumnDialog.init, Service2ColumnDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="service2-title">Service Column Title</label>
            <input type="text" name="service2-title" value="" id="service2-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service2-link">Service Column Title Link</label>
            <input type="text" name="service2-link" value="" id="service2-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service2-icon">Service Column Icon<br/><small>Leave empty for no icon.</small></label>
            <input type="text" name="service2-icon" value="" id="service2-icon" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service2-content">Service Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="service2-content" value="" id="service2-content"></textarea>
        </div>
		
		<div class="form-section clearfix">
            <label for="service2-boxed">Boxed Service</label>
            <select name="service2-boxed" id="service2-boxed" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="service2-newtab">Open Link in New Tab</label>
            <select name="service2-newtab" id="service2-newtab" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
    
    <a href="javascript:Service2ColumnDialog.insert(Service2ColumnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>