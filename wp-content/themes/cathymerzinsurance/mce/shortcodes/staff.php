<script type="text/javascript">
var StaffDialog = {
	local_ed : 'ed',
	init : function(ed) {
		StaffDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertStaff(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var columns = jQuery('select#staff-columns').val();
		var number = jQuery('input#staff-number').val();
		var departments = jQuery('input#staff-departments').val();
		 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[staff';
		
		if (departments) output+= ' departments=\"'+departments+'\"';
		output+= ' columns=\"'+columns+'\"';
		if (number) output += ' number=\"'+number+'\"';

		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(StaffDialog.init, StaffDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">

		<div class="form-section clearfix">
            <label for="staff-number">How many staff members to show</label>
            <input type="text" name="staff-number" value="" id="staff-number" />
        </div>
		
		<div class="form-section clearfix">
            <label for="staff-departments">Departments.</br><small>If you wish to display staff members that belong to these deparments. Note: Use slugs, and separate them with commas.</small></label>
            <input type="text" name="staff-departments" value="" id="staff-departments" />
        </div>
		
		<div class="form-section clearfix">
            <label for="staff-columns">Choose number of columns</label>
            <select name="staff-columns" id="staff-columns" size="1">
                <option value="2"> 2 </option>
                <option value="3"> 3 </option>
                <option value="4" selected="selected"> 4 </option>
            </select>
        </div>
		
    <a href="javascript:StaffDialog.insert(StaffDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>