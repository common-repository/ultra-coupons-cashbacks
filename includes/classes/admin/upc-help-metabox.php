<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shows the shortcodes after coupon is published.
 *
 * @since 2.3.2
 */
class UPC_Help_Metabox {

	private $screens = array('upc_coupons',);
	private $fields = array();

	/**
	 * Class construct method.
	 *
	 * @since 2.3.2
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 *
	 * @since 2.3.2
	 */
	public function add_meta_boxes() {
		global $post;

		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'help',
				__( 'Help', 'upc-coupon' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'side',
				'high'
			);
		}

	}

	/**
	 * Generates the HTML for the meta box
	 *
	 * @param object $post WordPress post object
	 *
	 * @since 2.3.2
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'shortcodes_data', 'shortcodes_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 *
	 * @since 2.3.2
	 */
	public function generate_fields( $post ) {
		$output = '';
		$output .= '<p style="font-size: 14px;">' . __( 'If you have any questions or confusions, please check our ', 'upc-coupon' ) . '<a target="_blank" href="https://ultrapromocode.com/knowledgebase/">' . __( 'Knowledgebase', 'upc-coupon' ) . '</a>' . __( ' or', 'upc-coupon' ) . '<a target="_blank" href="https://ultrapromocode.com/contact-us/">' . __( ' contact us', 'upc-coupon' ) . '</a>.</p>';
		$output .= '<p style="font-size: 14px;">' . __( 'We also need your help to make this plugin even more better. If you have any specific feature in mind, please ', 'upc-coupon' ) . '<a target="_blank" href="https://ultrapromocode.com/submit-new-feature-request/">' . __( 'submit a feature request', 'upc-coupon' ) . '</a>.</p>';
		$output .= '<p style="font-size: 14px;">' . __( 'We would love to work on your ideas.', 'upc-coupon' ) . '</p>';
		$output .= '<i>~Jayanthi</i><br>';
		$output .= '<i>~ Developer, Ultra Promocode</i>';

		echo $output;
	}

}
