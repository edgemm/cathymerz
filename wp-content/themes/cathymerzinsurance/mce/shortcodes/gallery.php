<script type="text/javascript">
var GalleryDialog = {
	local_ed : 'ed',
	init : function(ed) {
		GalleryDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertGallerey(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var number = jQuery('input#gallery-number').val();
		var size = jQuery('select#gallery-size').val();		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode		
		output += '[hb_gallery';
		if ( number ) output += ' number=\"'+number+'\"';
		output += ' size=\"'+size+'\"';
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(GalleryDialog.init, GalleryDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">

        <div class="form-section clearfix">
            <label for="gallery-number">Number Of Gallery Items</label>
            <input type="text" name="gallery-number" value="" id="gallery-number" />
        </div>
		
		<div class="form-section clearfix">
            <label for="gallery-size">Choose Size</label>
            <select name="gallery-size" id="gallery-size" size="1">
                <option value="col-3" selected="selected"> 3/12 </option>
                <option value="col-4"> 4/12 </option>
                <option value="col-6"> 6/12 </option>
            </select>
        </div>
    
    <a href="javascript:GalleryDialog.insert(GalleryDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>