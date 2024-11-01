<?php
error_reporting( error_reporting() & ~E_NOTICE );

function calc_weight_admin_enqueue_scripts($hook) {
	if (strpos($hook, 'page_calc_weight') === false) {
	    return;
    }

    wp_enqueue_style( 'jquery-ui-css', plugins_url('/css/jquery.ui.css', __FILE__));
    wp_enqueue_style( 'calc-weight-admin-css', plugins_url('/css/style.css', __FILE__));
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'custom-script-handle', plugins_url( '/js/calc-weight-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

function calc_weight_admin_menu() {
	add_menu_page( __('Wp-Calc-Weight','wp-calc-weight'), __('Wp-Calc-Weight','wp-calc-weight'), 'manage_options', 'calc_weight', 'calc_weight_render_settings_page' );

	add_submenu_page( 'calc_weight', __('Settings','wp-calc-weight'), __('Settings','wp-calc-weight'), 'manage_options', 'calc_weight', 'calc_weight_render_settings_page');

	add_submenu_page( 'calc_weight', __('FAQ','wp-calc-weight'), __('FAQ','wp-calc-weight'), 'manage_options', 'calc_weight_faq', 'calc_weight_render_faq_page');
	add_submenu_page( 'calc_weight', __("What's new",'wp-calc-weight'), __("What's new",'wp-calc-weight'), 'manage_options', 'calc_weight_whats_new', 'calc_weight_render_whats_new_page');

	add_action( 'admin_init', 'calc_weight_register_settings' );
}

function calc_weight_render_whats_new_page() {
	global $wpdb;

	include_once dirname( __FILE__ ) . '/whats_new.php';
}

function calc_weight_register_settings() {
	register_setting( 'wp-calc-weight-settings-group', 'wp-calc-weight-public_locale' );
}

function calc_weight_render_settings_page() {

	if (isset ($_POST['submit'])) {

		update_option( 'wp-calc-weight-public_locale', $_POST['wp-calc-weight-public_locale'] );
		update_option( 'wp-calc-weight-round_up_calc', $_POST['round_up_calc'] );

		update_option( 'wp-calc-weight-custom_header', $_POST['custom_header'] );
		update_option( 'wp-calc-weight-show_header', $_POST['show_header'] );

        update_option( 'wp-calc-weight-btn_calc_name', $_POST['btn_calc_name'] );
        update_option( 'wp-calc-weight-meas_system', $_POST['meas_system'] );

		update_option( 'wp-calc-weight-advert_js', $_POST['advert_js'] );

		$custom_css = array('basic'=>array(), 'btn_calc'=>array(), 'btn_reset'=>array(), 'input'=>array(), 'field_spec'=>array(), 'table_head'=>array());

		$basic_font_size=trim (isset($_POST['basic_font_size'])?$_POST['basic_font_size']:'');
		if (!empty($basic_font_size))
			$custom_css['basic']['font-size'] = intval($basic_font_size);

		$basic_border_color=trim (isset($_POST['basic_border_color'])?$_POST['basic_border_color']:'');
		if (!empty($basic_border_color))
			$custom_css['basic']['border-color'] = $basic_border_color;


		$btn_calc_background=trim (isset($_POST['btn_calc_background'])?$_POST['btn_calc_background']:'');
		if (!empty($btn_calc_background))
			$custom_css['btn_calc']['background-color'] = $btn_calc_background;

		$btn_calc_color = trim (isset($_POST['btn_calc_color'])?$_POST['btn_calc_color']:'');
		if (!empty($btn_calc_color))
			$custom_css['btn_calc']['color'] = $btn_calc_color;

		$btn_calc_hover_color = trim (isset($_POST['btn_calc_hover_color'])?$_POST['btn_calc_hover_color']:'');
		if (!empty($btn_calc_hover_color))
			$custom_css['btn_calc_hover']['color'] = $btn_calc_hover_color;


		$btn_reset_background=trim (isset($_POST['btn_reset_background'])?$_POST['btn_reset_background']:'');
		if (!empty($btn_reset_background))
			$custom_css['btn_reset']['background-color'] = $btn_reset_background;

		$btn_reset_color = trim (isset($_POST['btn_reset_color'])?$_POST['btn_reset_color']:'');
		if (!empty($btn_reset_color))
			$custom_css['btn_reset']['color'] = $btn_reset_color;

		$btn_reset_display = trim (isset($_POST['btn_reset_display'])?$_POST['btn_reset_display']:'');
		if (!empty($btn_reset_display))
			$custom_css['btn_reset']['display'] = $btn_reset_display;

		$btn_reset_hover_color = trim (isset($_POST['btn_reset_hover_color'])?$_POST['btn_reset_hover_color']:'');
		if (!empty($btn_reset_hover_color))
			$custom_css['btn_reset_hover']['color'] = $btn_reset_hover_color;


		$table_head_background=trim (isset($_POST['table_head_background'])?$_POST['table_head_background']:'');
		if (!empty($table_head_background))
			$custom_css['table_head']['background-color'] = $table_head_background;

		$table_head_color = trim (isset($_POST['table_head_color'])?$_POST['table_head_color']:'');
		if (!empty($table_head_color))
			$custom_css['table_head']['color'] = $table_head_color;


		$input_background=trim (isset($_POST['input_background'])?$_POST['input_background']:'');
		if (!empty($input_background))
			$custom_css['input']['background-color'] = $input_background;

		$input_color = trim (isset($_POST['input_color'])?$_POST['input_color']:'');
		if (!empty($input_color))
			$custom_css['input']['color'] = $input_color;

		$input_border_color=trim (isset($_POST['input_border_color'])?$_POST['input_border_color']:'');
		if (!empty($input_border_color))
			$custom_css['input']['border-color'] = $input_border_color;

		update_option( 'wp-calc-weight-custom_css', json_encode($custom_css) );
	}

	$toEdit = array ();
	$custom_css=json_decode(get_option('wp-calc-weight-custom_css'), true);

	if (isset($custom_css['basic'])) {
		$toEdit['basic_font_size'] = $custom_css['basic']['font-size'];
		$toEdit['basic_border_color'] = $custom_css['basic']['border-color'];
	}

	if (isset($custom_css['btn_calc'])) {
		$toEdit['btn_calc_background'] = $custom_css['btn_calc']['background-color'];
		$toEdit['btn_calc_color'] = $custom_css['btn_calc']['color'];
	}
	if (isset($custom_css['btn_calc_hover'])) {
		$toEdit['btn_calc_hover_color'] = $custom_css['btn_calc_hover']['color'];
	}

	if (isset($custom_css['btn_reset'])) {
		$toEdit['btn_reset_background'] = $custom_css['btn_reset']['background-color'];
		$toEdit['btn_reset_color'] = $custom_css['btn_reset']['color'];
		$toEdit['btn_reset_display'] = $custom_css['btn_reset']['display'];
	}
	if (isset($custom_css['btn_reset_hover'])) {
		$toEdit['btn_reset_hover_color'] = $custom_css['btn_reset_hover']['color'];
	}

	if (isset($custom_css['table_head'])) {
		$toEdit['table_head_background'] = $custom_css['table_head']['background-color'];
		$toEdit['table_head_color'] = $custom_css['table_head']['color'];
	}

	if (isset($custom_css['input'])) {
		$toEdit['input_background'] = $custom_css['input']['background-color'];
		$toEdit['input_color'] = $custom_css['input']['color'];
		$toEdit['input_border_color'] = $custom_css['input']['border-color'];
	}

	require plugin_dir_path( __FILE__ ) . '/settings.php';
}

function calc_weight_render_faq_page() {
	include_once dirname( __FILE__ ) . '/faq.php';
}


?>