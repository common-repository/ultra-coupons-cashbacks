<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shows the coupon_preview after coupon is published.
 *
 * @since 1.0
 */
class UPC_Preview_Metabox {

	private $screens = array(
		'upc_coupons',
	);
	private $fields = array();

	/**
	 * Class construct method.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 *
	 * @since 1.0
	 */
	public function add_meta_boxes() {

		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'coupon_preview',
				__( 'Coupon Preview', 'upc-coupon' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'normal',
				'low'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 *
	 * @param object $post WordPress post object
	 *
	 * @since 1.0
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'coupon_preview_data', 'coupon_preview_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 *
	 * @since 1.0
	 */
	public function generate_fields( $post ) {

		$output = '';

		ob_start();

		include 



UPC_Plugin::instance()->plugin_includes . 'functions/admin/upc-preview-metabox.php';

		$output .= ob_get_clean();

		echo $output;
	}

}
