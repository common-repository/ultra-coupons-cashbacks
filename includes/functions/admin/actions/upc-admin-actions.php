<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adding the path to necessary files.
 *
 * @since 1.0
 */
$path = trailingslashit( dirname( plugin_dir_path( __FILE__ ) ) );

/**
 * Requiring necessary files to add necessary actions.
 *
 * @since 1.0
 */
 
require_once $path . 'upc-add-coupon-button.php';
require_once $path . 'upc-help-info.php';
require_once $path . 'upc-widget-help-info.php';
require_once $path . 'upc-shortcode-insert-button.php';

/**
 * Adding the actions to use them later on
 * building the insert button.
 *
 * @since 1.0
 */

add_action( 'upc_add_button', 'upc_add_coupon_button', 10, 2 );
add_action( 'upc_help_info_div', 'upc_help_info', 10, 2 );
add_action( 'upc_widget_help_info_display', 'upc_widget_help_info', 10, 2 );
add_action( 'upc_shortcode_insert_button_div', 'upc_shortcode_insert_button', 10, 2 );


function upc_post_thumbnail_fallback( $content, $post_id, $thumbnail_id = '' ) {
	global $post_type;
	$script_help = '<script>upc_featured_img_func();
	
	 function upc_featured_img_func() {
    var imgSrc = jQuery("#set-post-thumbnail img").attr("src");
    var imgDef = jQuery(".upc-default-img").attr("default-img");
    if (typeof imgDef !== "undefined") {
        if (typeof imgSrc !== "undefined") {
            jQuery(".upc-get-fetured-img").attr("src", imgSrc);
        } else {
            jQuery(".upc-get-fetured-img").attr("src", imgDef);
        }
    }
}

	
	</script>';

	return $content . $script_help;
}

add_filter( 'admin_post_thumbnail_html', 'upc_post_thumbnail_fallback', 10, 3 );