<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * When clicked this button inserts the coupon shortcode.
 *
 * @since 1.0
 */
function upc_shortcode_insert_button() {
	?>
        <div class="upc_shortcode_insert-bt">
            <input type="button" id="coupon-submit" onclick="UpcCouponInsertFree();"
                   class="button-primary" value="Insert Coupon Shortcode" name="submit"/>
        </div>
	<?php 
}