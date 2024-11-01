<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This adds the coupon inserter button.
 *
 * @since 1.0
 */
function upc_add_coupon_button() {

	?>
    <a class='thickbox button upc_button_link' id='upc_add_shortcode'
       title='<?php echo __( "Insert Coupon Shortcode", "upc-coupon" ); ?>'
       href='#TB_inline?width=783&height=400&inlineId=upc_coupon_container'><span
                class="upc_icon"></span><?php echo __( 'Add Coupon', 'upc-coupon' ); ?></a>

	<?php
}
