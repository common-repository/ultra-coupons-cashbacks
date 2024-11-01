<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adding the path to necessary files.
 *
 * @since 1.4
 */
$path = trailingslashit( dirname( plugin_dir_path( __FILE__ ) ) );

/**
 * Requiring necessary files to add necessary actions.
 *
 * @since 1.4
 */
require_once $path . 'upc-shortcode-code.php';

/**
 * Adding the actions to use them later on
 * building the shortcode.
 *
 * @since 1.4
 */
add_action( 'upc_shortcode_code_show', 'upc_shortcode_code', 10 );