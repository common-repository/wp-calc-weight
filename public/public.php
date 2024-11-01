<?php

$calc_weight_front_idx=0;

function calc_weight_register_script() {

    wp_register_script( 'wp-calc-weight-script-calc', plugins_url('/js/wp-calc-weight-min.js', __FILE__), array('jquery'), '0.2' );

}

function calc_weight_enqueue_script() {
	
    wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');

    wp_enqueue_script( 'wp-calc-weight-script-calc' );

    wp_enqueue_style( 'jquery-ui-css', plugins_url('/css/jquery.ui.css', __FILE__));
    wp_enqueue_style ( 'wp-calc-weight-main-style', plugins_url( '/css/style.css', __FILE__ ), array(), '0.2');
}

function calc_weight_i18n() {
	__('Ideal weight', 'wp-calc-weight'); 
}

function calc_weight_print($atts, $content = null) {
	global $calc_weight_front_idx;
	global $calc_weight_types;

	$lang = 'ru';

	$btn_calc_name=__('Calculate', 'wp-calc-weight');

	$calculator = array(
		'round_up_calc' => get_option( 'wp-calc-weight-round_up_calc'),
		'custom_header' => get_option( 'wp-calc-weight-custom_header'),
		'show_header' => get_option( 'wp-calc-weight-show_header'),
		'advert_js' => get_option( 'wp-calc-weight-advert_js'),
		'btn_calc_name' => get_option( 'wp-calc-weight-btn_calc_name'),
		'meas_system' => get_option( 'wp-calc-weight-meas_system')
	);

    $title_label="Ideal weight";

    if (!empty($calculator['custom_header']))
        $title_label=$calculator['custom_header'];

    if (!empty($calculator['btn_calc_name']))
		$btn_calc_name=$calculator['btn_calc_name'];

	$custom_css=json_decode(get_option('wp-calc-weight-custom_css'), true);

	$show_header=$calculator['show_header'];

	if (isset($atts['show_header']))
		$show_header = strtolower(trim($atts['show_header']))=='yes';

	$age='';

	if (isset($atts['age']))
		$age = intval(trim($atts['age']));

	$gender='male';
	if (isset($atts['gender']))
		$gender = strtolower(trim($atts['gender']))=='male'?'male':'female';

	$height='';

	if (isset($atts['height']))
		$height = intval(trim($atts['height']));

	ob_start();

?>	

<style type="text/css">
/* <![CDATA[ */
<?php 
 if (isset($custom_css['basic'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> {
<?php
 	foreach ($custom_css['basic'] as $key => $value){
 		echo $key.': '.$value.((strpos($key, 'size') !== false)?'px':'')."\n";
 	}
?>
}
<?php
	if ($key=='border-color') {
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .btn-switcher .switcher__button--active, 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .btn-switcher .switcher__button--active:hover {
    background: <?php echo $value; ?>;
}
<?php
	}
 }
 if (isset($custom_css['btn_calc'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .calc_weight_button {
<?php
	if (isset($custom_css['btn_calc']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['btn_calc'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }
 if (isset($custom_css['btn_calc_hover'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .calc_weight_button:hover {
<?php
	if (isset($custom_css['btn_calc_hover']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['btn_calc_hover'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }
 if (isset($custom_css['btn_reset'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .calc_weight_reset_button {
<?php
	if (isset($custom_css['btn_reset']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['btn_reset'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }
 if (isset($custom_css['btn_reset_hover'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> .calc_weight_reset_button:hover {
<?php
	if (isset($custom_css['btn_reset_hover']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['btn_reset_hover'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }
 if (isset($custom_css['input'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> input[type="text"], 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> input[type="tel"], 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> input[type="number"], 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> input[type="date"], 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> select, 
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> textarea {
<?php
	if (isset($custom_css['input']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['input'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }

 if (isset($custom_css['table_head'])){
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> table.table-schedule th {
<?php
	if (isset($custom_css['table_head']['background-color'])){
?>	
	background-image: none;
<?php
    }
 	foreach ($custom_css['table_head'] as $key => $value){
 		echo $key.': '.$value." !important;\n";
 	}
?>
}
<?php
 }
?>
#wp_calc_weight_<?php echo $calc_weight_front_idx; ?> input[type="text"].result {
	background-color: inherit !important;
}

/* ]]> */
</style>

<?php
    include ( plugin_dir_path( __FILE__ ) .'/templates/public/idealweight.php');

    $output = ob_get_clean();

    $calc_weight_front_idx++;

    return $output;
}
?>