<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

delete_option( 'wp-calc-weight-opt_version');
delete_option( 'wp-calc-weight-public_locale');
delete_option( 'wp-calc-weight-round_up_calc');
delete_option( 'wp-calc-weight-custom_header');
delete_option( 'wp-calc-weight-show_header');
delete_option( 'wp-calc-weight-advert_js');
delete_option( 'wp-calc-weight-custom_css');
delete_option( 'wp-calc-weight-btn_calc_name');
delete_option( 'wp-calc-weight-meas_system');

?>