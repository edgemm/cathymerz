<script type="text/javascript">
var TabDialog = {
	local_ed : 'ed',
	init : function(ed) {
		TabDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertTab(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var layers = jQuery('select#tab-layers').val();
		var wrap = jQuery('select#tab-wrap').val();
		var title = jQuery('input#tab-title').val();
		var content = jQuery('textarea#tab-content').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		if(wrap == 'true') {
			output += '[tabs';
			if (layers == 'true') {
					output += ' layers=\"true\"';
			}
			output += ']';
		}
		
				output += '[tab title=\"';
				if(title){
					output += title+'\"';
				} else {
					output += 'Title\"';
				}
				
				if(content) {	
					output += ']'+ content;
				}
				else {
					output += ']' + mceSelected;
				}
					
				output += '[/tab]';
		
		if(wrap == 'true') {
			output += '[/tabs]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(TabDialog.init, TabDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        <div class="form-section clearfix">
            <label for="tab-wrap">New Tab. <br/><small>Choose Yes if you're creating a new Tab section. Otherwise you're creating an item inside an existing tab section.</small></label>
            <select name="tab-wrap" id="tab-wrap" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
        <div class="form-section clearfix">
            <label for="tab-title">Tab Item Title</label>
            <input type="text" name="tab-title" value="" id="tab-title" />
        </div>
        <div class="form-section clearfix">
            <label for="tab-content">Tab Item Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="tab-content" value="" id="tab-content"></textarea>
        </div>
        <div class="form-section clearfix">
            <label for="tab-layers">Use Layers Effect <br/><small>Choose Yes if you want to use layers effect.</small></label>
            <select name="tab-layers" id="tab-layers" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
    
    <a href="javascript:TabDialog.insert(TabDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>