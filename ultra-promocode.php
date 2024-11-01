<?php

/**
 * Plugin Name: Free WP Affiliate Coupon Plugin
 * Plugin URI: https://ultrapromocode.com/
 * Version: 1.0
 * Description: Best WordPress Coupon Plugin. Generate more affiliate sales with Ultra promocode cashback offers.
 * Author: Webnox 
 * Author URI:https://webnox.in/webnoxteam/
 * Author Email: contact@webnox.in
 * Text Domain: upc-coupon
 * License: GPLv2 or later
 *
 * @package 

upc_coupon
 * @author Webnox
 */
// If accessed directly, exit.
if ( !defined( 'ABSPATH' ) ) {
    die;
}
/**
 * Loading translation.
 */


// Loading SDK.

if ( !function_exists( 'wcad_fs' ) ) {
    /**
     * Configure freemius
     */
    function wcad_fs()
    {
        global  $wcad_fs ;
        
          define("PLUGIN_NAME", plugin_basename(dirname(__FILE__)));
            // Include Freemius SDK.
            
            $wcad_fs =  array(
               //default 1200
                'slug'           => 'ultra-promocode',
                'type'           => 'plugin',
    
                'menu'           => array(
                'slug'       => 'edit.php?post_type=upc_coupons',
                'first-path' => 'index.php?page=upc_welcome_menu_page',
                    
            )
              
             );
			     return $wcad_fs;
        }  
         
    
    }
	
    
    // Init SDK.
    wcad_fs();
    // Signal that SDK was initiated.
    do_action( 'wcad_fs_loaded' );



// Requiring the main plugin file.
require_once dirname( __FILE__ ) . '/includes/main.php';
// Instantiating the main class plugin.




UPC_Plugin::instance();
// Initialing hooks, functions, classes.




UPC_Plugin::init();
register_activation_hook( __FILE__, array( 'UPC_Plugin', 'upc_activate' ) );
register_deactivation_hook( __FILE__, array( 'UPC_Plugin', 'upc_deactivate' ) );

//my testing

