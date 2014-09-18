<script type="text/javascript">
var AnimationDialog = {
	local_ed : 'ed',
	init : function(ed) {
		AnimationDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertAnimation(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		
		var animation_type = jQuery('select#animation-type').val();
		var duration = jQuery('input#animation-duration').val();
		var delay = jQuery('input#animation-delay').val();
		var iteration = jQuery('input#animation-iteration').val();
		var content = jQuery('textarea#animation-content').val();
		
				 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode		
		output += '[animate';
		output += ' animation=\"'+animation_type+'\"';
		if ( duration ) output += ' duration=\"'+duration+'\"';
		if ( delay ) output += ' delay=\"'+delay+'\"';
		if ( iteration ) output += ' iteration=\"'+iteration+'\"';
		output += ']';
		if ( content ) output += content;
		else output += mceSelected;
		output += '[/animate]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(AnimationDialog.init, AnimationDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		
		
		<div class="form-section clearfix">
            <label for="animation-type">Animation Type</label>
            <select name="animation-type" id="animation-type" size="1">
                <option value="flash" selected="selected">Flash</option>
                <option value="shake">Shake</option>
                <option value="bounce">Bounce</option>
                <option value="tada">Tada</option>
                <option value="swing">Swing</option>
                <option value="wobble">Wobble</option>
                <option value="wiggle">Wiggle</option>
                <option value="pulse">Pulse</option>
                <option value="flip">Flip</option>
                <option value="flipInX">Flip In X</option>
                <option value="flipOutX">Flip Out X</option>
                <option value="flipInY">Flip In Y</option>
                <option value="flipOutY">Flip Out Y</option>
                <option value="fadeIn">Fade In</option>
                <option value="fadeInUp">Fade In Up</option>
                <option value="fadeInDown">Fade In Down</option>
                <option value="fadeInLeft">Fade In Left</option>
                <option value="fadeInRight">Fade In Right</option>
                <option value="fadeInUpBig">Fade In Up Big</option>
                <option value="fadeInDownBig">Fade In Down Big</option>
                <option value="fadeInLeftBig">Fade In Left Big</option>
                <option value="fadeInRightBig">Fade In Right Big</option>
                <option value="fadeOut">Fade Out</option>
                <option value="fadeOutDown">Fade Out Down</option>
                <option value="fadeOutUp">Fade Out Up</option>
                <option value="fadeOutLeft">Fade Out Left</option>
                <option value="fadeOutRight">Fade Out Right</option>
                <option value="fadeOutUpBig">Fade Out Up Big</option>
                <option value="fadeOutDownBig">Fade Out Down Big</option>
                <option value="fadeOutLeftBig">Fade Out Left Big</option>
                <option value="fadeOutRightBig">Fade Out Right Big</option>
                <option value="bounceIn">Bounce In</option>
                <option value="bounceInUp">Bounce In Up</option>
                <option value="bounceInDown">Bounce In Down</option>
                <option value="bounceInLeft">Bounce In Left</option>
                <option value="bounceInRight">Bounce In Right</option>
                <option value="bounceOut">Bounce Out</option>
                <option value="bounceOutUp">Bounce Out Up</option>
                <option value="bounceOutDown">Bounce Out Down</option>
                <option value="bounceOutLeft">Bounce Out Left</option>
                <option value="bounceOutRight">Bounce Out Right</option>
                <option value="rotateIn">Rotate In</option>
                <option value="rotateInUpLeft">Rotate In Up Left</option>
                <option value="rotateInDownLeft">Rotate In Down Left</option>
                <option value="rotateInUpRight">Rotate In Up right</option>
                <option value="rotateInDownRight">Rotate In Down right</option>
                <option value="rotateOut">Rotate Out</option>
                <option value="rotateOutUpLeft">Rotate Out Up Left</option>
                <option value="rotateOutDownLeft">Rotate Out Down Left</option>
                <option value="rotateOutUpRight">Rotate Out Up Right</option>
                <option value="rotateOutDownRight">Rotate Out Down Right</option>
                <option value="rollIn">Roll In</option>
                <option value="rollOut">Roll Out</option>
            </select>
        </div>
		
		<div class="form-section clearfix">
            <label for="animation-duration">Animation Duration<br/><small>Animation time in seconds. Note: Always write 's' after the number.</small></label>
            <input type="text" name="animation-duration" value="" id="animation-duration" />
        </div>
		
		<div class="form-section clearfix">
            <label for="animation-delay">Animation Delay<br/><small>Animation will start after entered time in seconds. Note: Always write 's' after the number.</small></label>
            <input type="text" name="animation-delay" value="" id="animation-delay" />
        </div>
		
		<div class="form-section clearfix">
            <label for="animation-iteration">Animation Iteration<br/><small>Enter how many times will the animation repeat.</small></label>
            <input type="text" name="animation-iteration" value="" id="animation-iteration" />
        </div>
		
		<div class="form-section clearfix">
            <label for="animation-content">Animation Content<br /><small>Leave Blank To Use Selected Text From Content</small></label>
            <textarea type="text" name="animation-content" value="" id="animation-content"></textarea>
        </div>
		
        
    <a href="javascript:AnimationDialog.insert(AnimationDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>