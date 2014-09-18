<script type="text/javascript">
var PricingTableDialog = {
	local_ed : 'ed',
	init : function(ed) {
		PricingTableDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertPricingTable(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var isprice = jQuery('select#pricing-isprice').val();
		var content = jQuery('textarea#pricing-content').val();
		var wrap = jQuery('select#pricing-wrap').val();
		var section = jQuery('select#pricing-section').val();
		var layers = jQuery('select#pricing-layers').val();
		var title = jQuery('input#pricing-title').val();
		var infocus = jQuery('select#pricing-focus').val();
		var size = jQuery('select#pricing-size').val();
		var last = jQuery('select#pricing-last').val();
		var bottom_margin = jQuery('select#pricing-nomargin').val();
		var btntitle = jQuery('input#pricing-btntitle').val();
		var btnlink = jQuery('input#pricing-btnlink').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		if (section=='true') output += '[pricing_wrap]';
		if (wrap=='true') { 
			output+= '[pricing_item';
			if (layers=='false') output+= ' layers=\"false\"';
			if (title) output+= ' title=\"'+title+'\"';
			if (infocus=='true') output+= ' focus=\"true\"';
			if (last=='true') output += ' last_colum=\"true\"';
			if (bottom_margin=='false') output+= ' bottom_margin=\"false\"';
			output += ' size=\"'+size+'\"';
			if (btntitle) output+= ' button_title=\"'+btntitle+'\"';
			if (btnlink) output+= ' button_link=\"'+btnlink+'\"';
			output += ']';
		}
		output+='[pricing_row';
		if(isprice=='true') output+= ' is_price=\"true\"';
		output+=']';
		
		if(content) output+=content;
		else output+=mceSelected;
		output+='[/pricing_row]';
		
		
		if (wrap=='true') output+= '[/pricing_item]';		
		if (section=='true') output += '[/pricing_wrap]';
		
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(PricingTableDialog.init, PricingTableDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
        
		<div class="form-section clearfix">
            <label for="pricing-section">New Pricing Section. <br/><small>Choose Yes if you're creating a new pricing section. Otherwise you're creating a pricing table inside an existing section. This is just a wrap around all pricing elements.</small></label>
            <select name="pricing-section" id="pricing-section" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-wrap">New Pricing Table. <br/><small>Choose Yes if you're creating a new pricing table. Otherwise you're creating a row inside an existing pricing table.</small></label>
            <select name="pricing-wrap" id="pricing-wrap" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-title">Pricing Table Title</label>
            <input type="text" name="pricing-title" value="" id="pricing-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-layers">Add Layers Style</label>
            <select name="pricing-layers" id="pricing-layers" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-focus">Is In Focus</label>
            <select name="pricing-focus" id="pricing-focus" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
       <div class="form-section clearfix">
            <label for="pricing-size">Choose Size</label>
            <select name="pricing-size" id="pricing-size" size="1">
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
            <label for="pricing-last">Is Last In Row</label>
            <select name="pricing-last" id="pricing-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-nomargin">Has Bottom Margin</label>
            <select name="pricing-nomargin" id="pricing-nomargin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-btntitle">Pricing Table Button Title.( Optional )</label>
            <input type="text" name="pricing-btntitle" value="" id="pricing-btntitle" />
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-btnlink">Pricing Table Button Link. ( Optional )</label>
            <input type="text" name="pricing-btnlink" value="" id="pricing-btnlink" />
        </div>
		
		<div class="form-section clearfix">
            <label for="pricing-isprice">This row is price.<br/> <small>A highlighted row</small></label>
            <select name="pricing-isprice" id="pricing-isprice" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="pricing-content">Row Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="pricing-content" value="" id="pricing-content"></textarea>
        </div>
		
    
    <a href="javascript:PricingTableDialog.insert(PricingTableDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>