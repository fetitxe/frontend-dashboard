<?php
if ( ! defined('ABSPATH')) {
    exit;
}
/**
 * @return mixed|void
 */
function fed_config() {
	return apply_filters( 'fed_config', array(
		'plugin_api' => 'https://buffercode.com/api/fed/plugins',
	) );
}

/**
 * @return mixed|void
 */
function fed_get_dependent_plugins() {
	return apply_filters( 'fed_dependent_plugins', array(
		'frontend-dashboard-captcha',
		'frontend-dashboard-custom-post',
		'frontend-dashboard-pages',
		'frontend-dashboard-templates',
	));
}