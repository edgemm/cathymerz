<script type="text/javascript">
var FromBlogDialog = {
	local_ed : 'ed',
	init : function(ed) {
		FromBlogDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertFromBlog(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var category = jQuery('input#blog-cats').val();
		var number = jQuery('input#blog-number').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[blog';
		if (number) output += ' number=\"'+number+'\"';
		if (category) output += ' category=\"'+category+'\"';
		
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(FromBlogDialog.init, FromBlogDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
       
	   <div class="form-section clearfix">
            <label for="blog-number">Number Of Blog Posts</label>
            <input type="text" name="blog-number" value="" id="blog-number" />
        </div>
		
		<div class="form-section clearfix">
            <label for="blog-cats">Only From Blog Category</label>
            <input type="text" name="blog-cats" value="" id="blog-cats" />
        </div>
		
		
    <a href="javascript:FromBlogDialog.insert(FromBlogDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>