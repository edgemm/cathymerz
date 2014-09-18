<script type="text/javascript">
var ServiceColumnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ServiceColumnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertServiceColumn(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var layers = jQuery('select#service-layers').val();
		var size = jQuery('select#service-size').val();
		var last = jQuery('select#service-last').val();
		var title = jQuery('input#service-title').val();
		var icon = jQuery('input#service-icon').val();
		var link = jQuery('input#service-link').val();
		var content = jQuery('textarea#service-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[service title=\"';
		
		if(title){
			output += title+'\"';
		} else {
			output += 'Title\"';
		}
		
		if(size!='col-12') {
			output += ' size=\"'+size+'\"';
		}
		
		if (last=="true") {
			output += ' last_column=\"'+last+'\"';
		}
		if (layers!="true") {
			output += ' layers=\"'+layers+'\"';
		}		
		
		if (link != "") {
			output += ' link=\"'+link+'\"';
		}		
		
		output += ' icon=\"'+icon+'\"';
				
		if(content) {	
			output += ']'+ content;
		}
		else {
			output += ']' + mceSelected;
		}
					
		output += '[/service]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ServiceColumnDialog.init, ServiceColumnDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="service-title">Service Column Title</label>
            <input type="text" name="service-title" value="" id="service-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service-link">Service Column Title Link</label>
            <input type="text" name="service-link" value="" id="service-link" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service-icon">Service Column Icon<br/><small>Leave empty for no icon.</small></label>
            <input type="text" name="service-icon" value="" id="service-icon" />
        </div>
		
		<div class="form-section clearfix">
            <label for="service-content">Service Column Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="service-content" value="" id="service-content"></textarea>
        </div>
		
		<div class="form-section clearfix">
            <label for="service-size">Choose Size</label>
            <select name="service-size" id="service-size" size="1">
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
            <label for="service-last">Is Last In Row</label>
            <select name="service-last" id="service-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="service-layers">Add Layers Style</label>
            <select name="service-layers" id="service-layers" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
    
    <a href="javascript:ServiceColumnDialog.insert(ServiceColumnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>