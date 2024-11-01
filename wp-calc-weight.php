<?php
/*
Plugin Name: WP Calc Weight
Plugin URI: https://www.jarvis365.com
Description: Ideal Weight Calculator Plugin.
Author: Jarvis365
Author URI: https://www.jarvis365.com
Text Domain: wp-calc-weight
Domain Path: /languages
Version: 0.3.2
Minimum PHP: 5.3.0
*/

/*
    Copyright 2018 jarvis365.com (email: jarvisplugins@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$calc_weight_opt_version='1.1';

include_once( plugin_dir_path( __FILE__ ) . '/includes/functions.php' );
include_once( plugin_dir_path( __FILE__ ) . '/includes/activation.php' );

function calc_weight_set_locale( $locale ) {
    if (!is_admin()) {
	
		global $wpdb;

	    $public_locale = get_option('wp-calc-weight-public_locale');

	    return !empty($public_locale)?$public_locale:$locale;
	}

    return $locale;
}

add_action( 'plugins_loaded', 'calc_weight_load_plugin_textdomain' );
 
function calc_weight_load_plugin_textdomain() {
	global $locale;

	load_textdomain( 'wp-calc-weight', dirname(__FILE__) . '/languages/wp-calc-weight-'.calc_weight_set_locale( $locale ).'.mo' );
}

if (is_admin()) {
	include_once( plugin_dir_path( __FILE__ ) . '/admin/admin.php' );

	register_activation_hook(__FILE__, 'calc_weight_activation_check');
	register_activation_hook(__FILE__, 'calc_weight_install_options');

	register_deactivation_hook(__FILE__, 'calc_weight_deactivation');
	
	add_action('admin_menu', 'calc_weight_admin_menu');

	add_action('admin_enqueue_scripts', 'calc_weight_admin_enqueue_scripts');

} else {

	include_once( plugin_dir_path( __FILE__ ) . '/public/public.php' );

	add_shortcode('calc-weight', 'calc_weight_print');

	add_action('init', 'calc_weight_register_script');

	add_action('wp_enqueue_scripts', 'calc_weight_enqueue_script');
}

function calc_weight_update_check() {
	global $calc_weight_opt_version;

    if ( get_option( 'wp-calc-weight-opt_version', '1.0' ) != $calc_weight_opt_version ) {
        calc_weight_install_options();
    }
}
add_action( 'plugins_loaded', 'calc_weight_update_check' );
?>