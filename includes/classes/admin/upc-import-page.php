<?php
// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UPC_Import_Page {

	/**
	 * 

UPC_Import_Page_Pro constructor.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );

		/**
		 * Load stylesheets and scripts.
		 *
		 * @since 2.3.2
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'load_stylesheet_script' ) );

	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item() {

		global $import_page;
		/**
		 * Adding the import page under our main menu item.
		 *
		 * @since 2.3.2
		 */
		$import_page = add_submenu_page(
			'edit.php?post_type=upc_coupons',__( 'Ultra Promocode: Import Coupons', 'upc-coupon' ),__( 'Import Coupons ', 'upc-coupon' ),
			'manage_options','upc_coupon_import',
			array( $this, 'import_page' )
		);

	}

	/**
	 * Loads the stylesheets on the settings page.
	 *
	 * @param $hook
	 *
	 * @since 2.3.2
	 */
	public function load_stylesheet_script( $hook ) {

		global $import_page;

		// Add style to the welcome page only.
		if ( $hook != $import_page ) {
			return;
		}
		wp_enqueue_style( 'upc-admin-style', UPC_Plugin::instance()->plugin_assets . 'admin/css/admin.css', false );
		wp_enqueue_script( 'upc-admin-js', UPC_Plugin::instance()->plugin_assets . 'admin/js/admin.js', array('jquery',
			'jquery-ui-datepicker',
			'wp-color-picker'
		), 

  UPC_Plugin::PLUGIN_VERSION, false );

	}

	/**
	 * Content for Import Page.
	 *
	 * @since 2.3.2
	 */
	public function import_page() {

		$template = new UPC_Template_Loader();

		ob_start();

		$template->get_template_part( 'import-page' );

		$output = ob_get_clean();

		echo $output;
	}

}