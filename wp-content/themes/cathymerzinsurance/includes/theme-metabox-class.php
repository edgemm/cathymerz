<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author Rilwis <rilwis@gmail.com>
 * @link http://www.deluxeblogtips.com/p/meta-box-script-for-wordpress.html
 * @example meta-box-usage.php Sample declaration and usage of meta boxes
 * @version: 3.2
 *
 * @license GNU General Public License v3.0
 * Meta Box class
 */


class hb_meta_box {

	protected $_meta_box;
	protected $_fields;

	// Create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;

		// assign meta box values to local variables and add it's missed values
		$this->_meta_box = $meta_box;
		$this->_fields = &$this->_meta_box['fields'];
		$this->add_missed_values();

		add_action('add_meta_boxes', array(&$this, 'add'));	// add meta box, using 'add_meta_boxes' for WP 3.0+
		add_action('save_post', array(&$this, 'save'));		// save meta box's data

		// load common css files
		add_action('admin_print_styles', array(&$this, 'js_css'));
	}

	// Load common js, css files for the script
	function js_css() {
		$path = dirname(__FILE__); // get the path to the directory of current file

		// get URL of the directory of current file
		$base_url = get_template_directory_uri(). '/includes/css/';
		$base_js_url = get_template_directory_uri(). '/includes/js/';

		wp_enqueue_style('hb-meta-box', $base_url . 'meta-box.css');
		wp_enqueue_script('hb-hide-meta', $base_js_url . 'hide-meta.js');
	}

	/******************** BEGIN META BOX PAGE **********************/

	// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// Callback function to show fields in meta box
	function show() {

		global $post;

		wp_nonce_field(basename(__FILE__), 'hb_meta_box_nonce');
		echo '<table class="form-table">';

		foreach ($this->_fields as $field) {
			$meta = get_post_meta($post->ID, $field['id'], !$field['multiple']);
			$meta = ($meta !== '') ? $meta : $field['std'];

			$meta = is_array($meta) ? array_map('esc_attr', $meta) : esc_attr($meta);

			echo '<tr>';
			// call separated methods for displaying each type of field
			call_user_func(array(&$this, 'show_field_' . $field['type']), $field, $meta);
			echo '</tr>';
		}
		echo '</table>';
	}

	/******************** END META BOX PAGE **********************/

	/******************** BEGIN META BOX FIELDS **********************/

	function show_field_begin($field, $meta) {
		echo "<th class='hb-label-td'><label class='hb-label' for='{$field['id']}'>{$field['name']}</label></th><td class='hb-field' style='position: relative;'>";
	}

	function show_field_end($field, $meta) {
		echo "{$field['desc']}</td>";
	}

	function show_field_checkbox($field, $meta) {
		global $post;
		$this->show_field_begin($field, $meta);
		$meta = get_post_meta($post->ID, $field['id'], true);
		$check = "";
		if($meta) {
			$check = " checked='checked'";
		}
		echo "<input type='checkbox' class='hb-checkbox' name='{$field['id']}' id={$field['id']}' {$check}/>";
		$this->show_field_end($field, $meta);
	}
	
	function show_field_separator($field, $meta) {		
		$this->show_field_begin($field, $meta);
		echo '<hr class="separator" />';
		$this->show_field_end($field, $meta);
	}

	function show_field_sidebar_list($field, $meta){
		$is_selected = "";
		$data = get_option(OPTIONS);
		$this->show_field_begin($field, $meta);
		$theme_sidebar = array();
		$theme_sidebar[] = array('title' => 'Default Sidebar');
		$dynamic_sidebar = array();
		if ( isset ( $data['hb_sidebar'] ))
		$dynamic_sidebar = $data['hb_sidebar'];
		if(!empty($dynamic_sidebar))
		{
			foreach($dynamic_sidebar as $sidebar)
			{
				$theme_sidebar[] = $sidebar;
			}
		}
		echo "<select class='hb-select' name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
		foreach ( $theme_sidebar as $sidebar ){
			if(strcmp($sidebar['title'], $meta)){
				$is_selected = "";
			} else{
				$is_selected = " selected";
			}
			echo $is_selected;
			echo "<option value='".$sidebar['title']."' name='{$field['id']}' " . $is_selected . ">".$sidebar['title']."</option>";
		}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
	}

	function show_field_text($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<input type='text' class='hb-text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='50' />";
		$this->show_field_end($field, $meta);
	}

	function show_field_textarea($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<textarea class='hb-textarea large-text' name='{$field['id']}' id='{$field['id']}' cols='60' rows='5'>$meta</textarea>";
		$this->show_field_end($field, $meta);
	}

	function show_field_select($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		echo "<select class='hb-select' name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
		foreach ($field['options'] as $key => $value) {
			echo "<option value='$value'" . selected(in_array($value, $meta), true, false) . ">$value</option>";
		}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
	}
	
	function show_field_hb_select($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		echo "<select id='".$field['id']."_select' class='hb-select' name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
		foreach ($field['options'] as $key => $value) {
			echo "<option value='$key'" . selected(in_array($key, $meta), true, false) . ">$value</option>";
		}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
	}

	function show_field_plaintext($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "$meta";
		$this->show_field_end($field, $meta);
	}
	
	function show_field_hb_add_element($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<div class='add-element-btn-wrapper'><a href='#' class='hb-add-element'>Add New Slider Element</a></div>";
		$this->show_field_end($field, $meta);
	}

	function show_field_media_upload ($field, $meta){
		$this->show_field_begin($field, $meta);
		
		
		echo '<input class="hb-upload-input" id="input_'.$field['id'].'" type="text" size="36" name="'.$field['id'].'" value="'.$meta.'" /><input class="hb-input-upload-button" id="'.$field['id'].'_button" type="button" value="Upload Image" /><br/>';
		echo '<div class="hb-upload-image-wrapper">';
		if($meta != '') {
		echo '<img class="hb-image-upload-preview" src="' . $meta . '"/>';
		echo '<a href="#" class="hb-delete-image-button" title="Delete image">x</a>';
		}
		echo '</div>';
		
		//echo '<input class="hb-text upload" id="upload_image" type="text" size="50" name=" upload_image" value="" />';
		//echo '<input class="button upload-button" id="upload_image_button" type="button" value="Upload Image" />';
		//echo '<br />';

		?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			var nameID = '#<?php echo $field['id']; ?>';
			var nameIDbutton = '#<?php echo $field['id']; ?>_button';
			
			jQuery('.hb-delete-image-button').live("click", function () {
				var container = jQuery(this).parent();
				var inputhb = jQuery(this).parent().parent().find('.hb-upload-input');
				
				jQuery(container).fadeOut(500);
				jQuery(inputhb).attr('value','');
			});
	
			jQuery(nameIDbutton).live("click", function() {
				var formfield = jQuery(this).prev('input');
				var imgwrapper = jQuery(this).parent().find('.hb-upload-image-wrapper');
					
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 
				window.restore_send_to_editor = window.send_to_editor;
				window.send_to_editor = function(html) {
				jQuery(formfield).attr('value', '');
				jQuery(imgwrapper).html('');
								 
				imgurl = jQuery('img',html).attr('src');
				jQuery(imgwrapper).html('<img class="hb-image-upload-preview" src="'+ imgurl +'"/><a href="#" class="hb-delete-image-button" title="Delete image">x</a>');
				jQuery(imgwrapper).fadeIn(500);
					 
				jQuery(formfield).attr('value', imgurl);			 
				tb_remove();
				window.send_to_editor = window.restore_send_to_editor;
			}
				
			 return false;
			});
			

			
			 
			});
		</script>
		<?php
		$this->show_field_end($field, $meta);
	}


	
	
	/******************** END META BOX FIELDS **********************/
	
	/******************** BEGIN META BOX SAVE **********************/

	// Save data from meta box
	function save($post_id) {
		global $post_type;
		$post_type_object = get_post_type_object($post_type);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])			// check revision
		|| (!in_array($post_type, $this->_meta_box['pages']))					// check if current post type is supported
		|| (!check_admin_referer(basename(__FILE__), 'hb_meta_box_nonce'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
			return $post_id;
		}

		foreach ($this->_fields as $field) {
			$name = $field['id'];
			$type = $field['type'];
			$old = get_post_meta($post_id, $name, !$field['multiple']);
			$new = isset($_POST[$name]) ? $_POST[$name] : ($field['multiple'] ? array() : '');

			// validate meta value
			if (class_exists('hb_meta_box_Validate') && method_exists('hb_meta_box_Validate', $field['validate_func'])) {
				$new = call_user_func(array('hb_meta_box_Validate', $field['validate_func']), $new);
			}

			// call defined method to save meta value, if there's no methods, call common one
			$save_func = 'save_field_' . $type;
			if (method_exists($this, $save_func)) {
				call_user_func(array(&$this, 'save_field_' . $type), $post_id, $field, $old, $new);
			} else {
				$this->save_field($post_id, $field, $old, $new);
			}
		}
	}

	// Common functions for saving field
	function save_field($post_id, $field, $old, $new) {
		$name = $field['id'];

		delete_post_meta($post_id, $name);
		if ($new === '' || $new === array()) return;

		if ($field['multiple']) {
			foreach ($new as $add_new) {
				add_post_meta($post_id, $name, $add_new, false);
			}
		} else {
			update_post_meta($post_id, $name, $new);
		}

	}


	/******************** END META BOX SAVE **********************/

	/******************** BEGIN HELPER FUNCTIONS **********************/

	// Add missed values for meta box
	function add_missed_values() {
		// default values for meta box
		$this->_meta_box = array_merge(array(
			'context' => 'normal',
			'priority' => 'high',
			'pages' => array('post')
		), $this->_meta_box);

		// default values for fields
		foreach ($this->_fields as &$field) {
			$multiple = in_array($field['type'], array('checkbox_list', 'file', 'image'));
			$std = $multiple ? array() : '';
			$format = 'date' == $field['type'] ? 'yy-mm-dd' : ('time' == $field['type'] ? 'hh:mm' : '');

			$field = array_merge(array(
				'multiple' => $multiple,
				'std' => $std,
				'desc' => '',
				'format' => $format,
				'validate_func' => ''
			), $field);
		}
	}

	// Check if field with $type exists
	function has_field($type) {
		foreach ($this->_fields as $field) {
			if ($type == $field['type']) return true;
		}
		return false;
	}

	// Check if current page is edit page
	function is_edit_page() {
		global $pagenow;
		return in_array($pagenow, array('post.php', 'post-new.php'));
	}

	/******************** END HELPER FUNCTIONS **********************/
}
?>