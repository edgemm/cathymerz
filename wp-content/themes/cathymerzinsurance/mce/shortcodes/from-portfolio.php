<script type="text/javascript">
var PortfolioDialog = {
	local_ed : 'ed',
	init : function(ed) {
		PortfolioDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertPorftolio(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var size = jQuery('select#portfolio-size').val();
		var number = jQuery('input#portfolio-number').val();
		var slugs = jQuery('input#portfolio-slugs').val();
		
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		output += '[portfolio';
		
		if (slugs) output+=' category=\"'+slugs+'\"';
		if (number)	output+= ' number=\"'+number+'\"';
		output+= ' size=\"'+size+'\"';
		output+=']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(PortfolioDialog.init, PortfolioDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="portfolio-size">Choose Size</label>
            <select name="portfolio-size" id="portfolio-size" size="1">
				<option value="col-3"> 3/12 </option>
                <option value="col-4" selected="selected"> 4/12 </option>
                <option value="col-6"> 6/12 </option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="portfolio-slugs">Portfolio Category Slugs. <br/><small>Separate slugs with commas. Portfolio items in these categories will appear. (Optional - you can leave out slugs)</small></label>
            <input type="text" name="portfolio-slugs" value="" id="portfolio-slugs" />
        </div>
		
		<div class="form-section clearfix">
            <label for="portfolio-number">Number of portfolio items to show</label>
            <input type="text" name="portfolio-number" value="" id="portfolio-number" />
        </div>
        
    <a href="javascript:PortfolioDialog.insert(PortfolioDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>