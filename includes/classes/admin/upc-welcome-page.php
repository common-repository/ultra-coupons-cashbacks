<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class 

UPC_Welcome_Page
 *
 * Adds the welcome page.
 *
 * @since 1.0
 */
class UPC_Welcome_Page {

	/**
	 * Initializing actions.
	 *
	 * @since 1.0
	 */
	public static function init() {

		add_action( 'admin_menu', array( __CLASS__, 'upc_welcome_menu_page' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'upc_styles' ) );
		add_action( 'admin_head', array( __CLASS__, 'remove_menu_entry' ) );

	}

	/**
	 * Menu item of the page.
	 *
	 * @since 1.0
	 */
	public static function 

upc_welcome_menu_page() {

		global $upc_sub_menu;

		$upc_sub_menu = add_submenu_page(
			'index.php',
			__( 'Ultra Promocode', 'upc-coupon' ),
			__( 'Ultra Promocode', 'upc-coupon' ),
			'read',
			'upc_welcome_menu_page',
			array(
				__CLASS__,
				'UPC_Welcome_Page_content'
			)
		);

	}

	/**
	 * Welcome page content.
	 *
	 * @since 1.0
	 */
	public static function UPC_Welcome_Page_content() {

		require_once( 
UPC_Plugin::instance()->plugin_includes . 'functions/admin/upc-welcome-page-content.php' );

	}

	/**
	 * Necessary styles.
	 *
	 * @param $hook
	 *
	 * @since 1.0
	 */
	public static function upc_styles( $hook ) {

		global $upc_sub_menu;

		// Add style to the welcome page only.
		if ( $hook != $upc_sub_menu ) {
			return;
		}
		// Welcome page styles.
		wp_enqueue_style('upc_welcome_style',
			



UPC_Plugin::instance()->plugin_assets . 'admin/css/welcome.css',
			array(),
			UPC_Plugin::PLUGIN_VERSION,
			'all'
		);

	}

	/**
	 * Removes the menu item.
	 *
	 * @since 1.0
	 */
	static function remove_menu_entry() {

		remove_submenu_page( 'index.php', 'upc_welcome_menu_page' );

	}

}