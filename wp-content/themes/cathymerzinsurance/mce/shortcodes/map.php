<script type="text/javascript">
var MapDialog = {
	local_ed : 'ed',
	init : function(ed) {
		MapDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertMap(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var width = jQuery('input#map-width').val();
		var height = jQuery('input#map-height').val();
		var maplink = jQuery('textarea#map-link').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		output += '[map';
		
		if ( width ) output+= ' width=\"'+width+'\"';
		if ( height ) output+= ' height=\"'+height+'\"';

		output += ']';
		if (maplink) output+=maplink;
		else output+=mceSelected;
		
		output+='[/map]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(MapDialog.init, MapDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">

		<div class="form-section clearfix">
            <label for="map-width">Enter map width.</br><small>Optional</small></label>
            <input type="text" name="map-width" value="" id="map-width" />
        </div>
		
		<div class="form-section clearfix">
            <label for="map-height">Enter map height.</br><small>Optional</small></label>
            <input type="text" name="map-height" value="" id="map-height" />
        </div>
		
		<div class="form-section clearfix">
            <label for="map-link">Entire Embedded Map Code (including iframe).<br/><small>Note: Be careful to paste the embedded code in HTML view if you're not using this textarea.</small></label>
            <textarea type="text" name="map-link" value="" id="map-link"></textarea>
        </div>
		
    <a href="javascript:MapDialog.insert(MapDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>