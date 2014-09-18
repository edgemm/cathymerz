<script type="text/javascript">
var NewsletterDialog = {
	local_ed : 'ed',
	init : function(ed) {
		NewsletterDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertNewsletter(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var size = jQuery('select#newsletter-size').val();
		var bottommargin = jQuery('select#newsletter-nomargin').val();
		var last = jQuery('select#newsletter-last').val();
		var blueletter = jQuery('select#newsletter-blueletter').val();
		var leftedge = jQuery('select#newsletter-leftedge').val();
		var rightedge = jQuery('select#newsletter-rightedge').val();		
		var title = jQuery('input#newsletter-title').val();
		var description = jQuery('input#newsletter-description').val();
		var content = jQuery('textarea#newsletter-content').val();
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[newsletter_mailchimp';
		
		if (title) output+= ' title=\"'+title+'\"';
		if (description) output+=' description=\"'+description+'\"';
		if(size!='col-6') output += ' size=\"'+size+'\"';
		if (last!="false") output += ' last_column=\"'+last+'\"';
		if (bottommargin!="true") output += ' bottom_margin=\"'+bottommargin+'\"';
		if (blueletter == "true" ) output += ' blue_letter=\"true\"';
		if (leftedge == "true" ) output += ' flip_left_edge=\"true\"';
		if (rightedge == "true" ) output += ' flip_right_edge=\"true\"';
		
		if(content) {	
			output += ']'+ content;
		}
		else {
			output += ']' + mceSelected;
		}
					
		output += '[/newsletter_mailchimp]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(NewsletterDialog.init, NewsletterDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		<div class="form-section clearfix">
            <label for="newsletter-title">Newsletter Title</label>
            <input type="text" name="newsletter-title" value="" id="newsletter-title" />
        </div>
		
		<div class="form-section clearfix">
            <label for="newsletter-description">Newsletter Description</label>
            <input type="text" name="newsletter-description" value="" id="newsletter-description" />
        </div>
		
		<div class="form-section clearfix">
            <label for="newsletter-content">Mailchimp Embedded Sign Up Form.</label>
            <textarea type="text" name="newsletter-content" value="" id="newsletter-content"></textarea>
        </div>
		
		
		<div class="form-section clearfix">
            <label for="newsletter-size">Choose Size</label>
            <select name="newsletter-size" id="newsletter-size" size="1">
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
            <label for="newsletter-last">Is Last In Row</label>
            <select name="newsletter-last" id="newsletter-last" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="newsletter-nomargin">Has Bottom Margin</label>
            <select name="newsletter-nomargin" id="newsletter-nomargin" size="1">
                <option value="false">No</option>
                <option value="true" selected="selected">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="newsletter-blueletter">Blue Letter Style</label>
            <select name="newsletter-blueletter" id="newsletter-blueletter" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
        <div class="form-section clearfix">
            <label for="newsletter-leftedge">Fold Left Edge</label>
            <select name="newsletter-leftedge" id="newsletter-leftedge" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="newsletter-rightedge">Fold Right Edge</label>
            <select name="newsletter-rightedge" id="newsletter-rightedge" size="1">
                <option value="false" selected="selected">No</option>
                <option value="true">Yes</option>
            </select>
        </div>
    <a href="javascript:NewsletterDialog.insert(NewsletterDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>