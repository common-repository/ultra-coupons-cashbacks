<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shows the shortcodes after coupon is published.
 *
 * @since 1.0
 */
class UPC_Shortcode_Metabox {

	private $screens = array('upc_coupons',
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
		global $post;

		if ( $post->post_status == 'publish' ) {
			foreach ( $this->screens as $screen ) {
				add_meta_box(
					'shortcodes',
					__( 'Coupon Shortcodes', 'upc-coupon' ),
					array( $this, 'add_meta_box_callback' ),
					$screen,
					'side',
					'high'
				);
			}
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
		wp_nonce_field( 'shortcodes_data', 'shortcodes_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 *
	 * @since 1.0
	 */
	public function generate_fields( $post ) {
		$output = '';
		$output .= '<b>' . __( 'Full Coupon', 'upc-coupon' ) . ':</b> [

upc_coupon id=' . $post->ID . ']' . '<br><br>';
		$output .= '<span class="only-coupon-code"><b>' . __( 'Only Coupon Code', 'upc-coupon' ) . ':</b> [

upc_code id=' . $post->ID . ']</span>';
          $output .= '<b>' . __( 'Vertical  Style Coupon', 'upc-coupon' ) . ':</b> [upc_coupon_vertical id=' . $post->ID . ']' . '<br><br>';

		echo $output;
	}

}
