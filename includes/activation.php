<?php 

    function calc_weight_compatible_version() {
	    if ( version_compare(PHP_VERSION, '5.3', '<') ) {
    	    return false;
	    }

	    return true;
	}

	function calc_weight_activation_check() {
		if ( !calc_weight_compatible_version() ) {
	        wp_die( sprintf( __( '%s requires PHP %s or higher!', 'wp-calc-weight' ), 'WP-Calc-Weight', '5.3' ) );
    	}
	}

	function calc_weight_install_options() {

		global $calc_weight_opt_version;

		update_option( 'wp-calc-weight-opt_version', $calc_weight_opt_version );
        update_option( 'wp-calc-weight-show_header', '1');
        update_option( 'wp-calc-weight-round_up_calc', '0');
		update_option( 'wp-calc-weight-meas_system', '0');
	}

	function calc_weight_deactivation() {}

?>