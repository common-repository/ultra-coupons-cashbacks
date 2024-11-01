<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Little help text that is shown on the coupon inserter popup.
 *
 * @since 1.0
 */
function upc_help_info() { ?>

    <div>
        <i><?php echo __( 'From the list, select the coupon you want to insert then click on Insert Coupon Shortcode button. 	If you have not created any coupons,', 'upc-coupon' ); ?>
            <a href="<?php echo get_admin_url() . 'post-new.php?post_type=upc_coupons'; ?>" target="_blank">
				<?php echo __( 'create one', 'upc-coupon' ); ?>
            </a>
			<?php echo __( 'or', 'upc-coupon' ); ?>
            <a href="<?php echo get_admin_url() . 'edit.php?post_type=upc_coupons'; ?>" target="_blank">
				<?php echo __( 'manage your coupons', 'upc-coupon' ); ?>
            </a>.
        </i>

      
    </div>

<?php }
