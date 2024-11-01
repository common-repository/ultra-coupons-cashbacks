<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class UPC_Admin_Notices
 *
 * Custom Admin notices for post publish, update or draft.
 *
 * @since 1.0
 */
class UPC_Admin_Notices {

	/**
	 * Adding the filter.
	 *
	 * @since 1.0
	 */
	public static function init() {

		add_filter( 'post_updated_messages', array( __CLASS__, 'coupon_publish_notice' ) );
		add_action( 'admin_notices', array( __CLASS__, 'review_notice' ), 20 );
		add_action( 'wp_ajax_upcReviewNoticeHide', array( __CLASS__, 'upc_hide_review_notify' ) );

	}


	/**
	 * Generating the review notice.
	 *
	 * @since 1.0
	 */
	public static function review_notice() {

		$coupon_count  = wp_count_posts( 'upc_coupons' );
		$coupon_number = $coupon_count->publish;

		if ( $coupon_number >= 10 && get_option( 'upc_review_notify' ) == "no" ) {
			?>
            <div class="

upc-review-notice notice notice-info">
                <p style="font-size: 14px;">
					<?php _e( 'Hey,<br> I noticed you have already created ' . $coupon_number . ' coupons with Ultra Promocode plugin - that’s awesome! Could you please do me a BIG favor and <b>give it a 5-star rating on WordPress</b>? Just to help us spread the word and boost our motivation. <br>~ Jayanthi', 'upc-coupon' ); ?>
                </p>
                <ul>
                    <li><a style="margin-right: 5px; margin-bottom: 5px;" class="button-primary"
                           href="https://wordpress.org/support/plugin/ultra-promocode/reviews/#new-post"
                           target="_blank">Sure,
                            you deserve it.</a>
                        <a style="margin-right: 5px;" class="

upc_HideReview_Notice button" href="javascript:void(0);">
                            I already did.</a>
                        <a class="

upc_HideReview_Notice button" href="javascript:void(0);">No, not good enough.</a>
                    </li>
                </ul>
            </div>
            <script>
                jQuery(document).ready(function ($) {
                    jQuery('.upc_HideReview_Notice').click(function () {
                        var data = {'action': 'upcReviewNoticeHide'};
                        jQuery.ajax({
                            url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                            type: "post",
                            data: data,
                            dataType: "json",
                            async: !0,
                            success: function (notice_hide) {
                                if (notice_hide == "success") {
                                    jQuery('.upc-review-notice').slideUp('fast');
                                }
                            }
                        });
                    });
                });
            </script>
			<?php

		}

	}

	/**
	 * Hides the review notice.
	 *
	 * @since 1.0
	 */
	static function upc_hide_review_notify() {

		update_option( 'upc_review_notify', 'yes' );
		echo json_encode( array( "success" ) );
		exit;

	}

	/**
	 * Adding the custom notices.
	 *
	 * @param $messages
	 *
	 * @return mixed
	 *
	 * @since 1.0
	 */
	public static function coupon_publish_notice( $messages ) {

		$post = get_post();

		$full_coupon = '<b>' . __( 'Full Coupon:', 'upc-coupon' ) . '</b> [

upc_coupon id=' . $post->ID . ']';
		$only_code   = '<b>' . __( 'Only Coupon Code:', 'upc-coupon' ) . '</b> [

upc_code id=' . $post->ID . ']';

		$messages['

upc_coupons'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Coupon updated.', 'upc-coupon' ),
			2  => '',
			3  => '',
			4  => __( 'Coupon updated.', 'upc-coupon' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Coupon restored to revision from %s', 'upc-coupon' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf(
				__( 'Coupon published. <br><br> Here are the shortcodes for this coupon: %s and %s ', 'upc-coupon' ),
				$full_coupon, $only_code
			),
			7  => __( 'Coupon saved.', 'upc-coupon' ),
			8  => __( 'Coupon submitted.', 'upc-coupon' ),
			9  => sprintf(
				__( 'Coupon scheduled for: <strong>%1$s</strong>.', 'upc-coupon' ),
				date_i18n( __( 'M j, Y @ G:i', 'upc-coupon' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Coupon draft updated.', 'upc-coupon' )
		);

		return $messages;

	}
}