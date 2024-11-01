<?php

/**
 * Gets remote address
 *
 * @return remote address string
 */
function calc_weight_get_remote_address() {
	$remote_addr = getenv('HTTP_CLIENT_IP')?getenv('HTTP_CLIENT_IP'):
			getenv('HTTP_X_FORWARDED_FOR')?getenv('HTTP_X_FORWARDED_FOR'):
			getenv('HTTP_X_FORWARDED')?getenv('HTTP_X_FORWARDED'):
			getenv('HTTP_FORWARDED_FOR')?getenv('HTTP_FORWARDED_FOR'):
			getenv('HTTP_FORWARDED')?getenv('HTTP_FORWARDED'):getenv('REMOTE_ADDR');

	$remote_addr = str_replace('for=', '', $remote_addr);

	return $remote_addr;
}

function calc_weight_format_time($str, $na = '-', $out_format='g:i A', $in_format='H:i') {
	if (empty($str))
		return $na;

	$dt = DateTime::createFromFormat($in_format, $str);

	if (!$dt)
		return $str;

	return $dt->format($out_format);
}

function calc_weight_build_url ($params, $url = '') {
	if (empty ($url)) {
		list ($url) = explode ('?', $_SERVER['REQUEST_URI']);
		$get = http_build_query($params);
		return $url = '?'.$get;
	} else {

		$get = http_build_query($params);
		return $url.'?'.$get;
	}
}

function calc_weight_get_option ($opt_name, $default_val, $convert_func='intval') {
	$opt = get_option($opt_name, $default_val);
	return !empty($opt)?$convert_func($opt):$default_val;
}

function calc_weight_get_option_from_arr ($opt_name, $opt_key, $default_val, $convert_func='intval') {
	$opt = get_option($opt_name);
	return !empty($opt)&& array_key_exists($opt_key, $opt)?$convert_func($opt[$opt_key]):$default_val;
}

function calc_weight_boolval($val) {
	if (!empty($val)) {
		 $val = strtolower(strval($val));

		 return ($val=="true" || $val=="1");
	}
    return false;
}

?>