	<?php

	/**
	 *
	 * This exits from the script if it's accessed
	 * directly from somewhere else.
	 *
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * This is the only code Shortcode template.
	 *
	 * @since 1.4
	 */

	/**
	 * Setting up globals.
	 *
	 * @since 1.4
	 */

	global $upc_code_atts;
	global $upc_coupon_code;


	/**
	 * Loop to get post.
	 *
	 * @since 1.4
	 */

	while ( $upc_coupon_code->have_posts() ) {

		global $post;

		$upc_coupon_code->the_post();

		do_action( 'upc_shortcode_code_show' );

	} //End while


	/**
	 * Restore original Post Data
	 * Resetting the loop.
	 *
	 * @since 1.4
	 */
	wp_reset_postdata();