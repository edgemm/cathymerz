<script type="text/javascript">
var TestimonialDialog = {
	local_ed : 'ed',
	init : function(ed) {
		TestimonialDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertTestimonial(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var columns = jQuery('select#testimonial-columns').val();
		var random = jQuery('select#testimonial-random').val();
		var number = jQuery('input#testimonial-number').val();
		
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[testimonials';
		
		output += ' columns=\"'+columns+'\"';
		if (number) output += ' number=\"'+number+'\"';
		if ( random == 'true' ) output += ' random=\"true\"';
		else output += ' random=\"false\"';
		
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(TestimonialDialog.init, TestimonialDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="testimonial-number">Testimonial number (count)</label>
            <input type="text" name="testimonial-number" value="" id="testimonial-number" />
        </div>
		
		<div class="form-section clearfix">
            <label for="testimonial-columns">Choose number of columns</label>
            <select name="testimonial-columns" id="testimonial-columns" size="1">
                <option value="2"> 2 </option>
                <option value="3" selected="selected"> 3 </option>
                <option value="4"> 4 </option>
            </select>
        </div>
		
    <a href="javascript:TestimonialDialog.insert(TestimonialDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>