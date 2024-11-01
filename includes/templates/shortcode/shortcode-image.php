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
 * This is the default Shortcode template.
 *
 * @since 2.3
 */

global $coupon_id;

$upc_coupon_image_id  = get_post_meta( $coupon_id, 'coupon_details_coupon-image-input', true );
$upc_coupon_image_src = wp_get_attachment_image_src( $upc_coupon_image_id, 'full' );
$upc_link             = get_post_meta( $coupon_id, 'coupon_details_link', true );
$upc_show_print       = get_post_meta( $coupon_id, 'coupon_details_coupon-image-print', true );
$upc_image_width      = get_post_meta( $coupon_id, 'coupon_details_coupon-image-width', true );
$upc_image_height     = get_post_meta( $coupon_id, 'coupon_details_coupon-image-height', true );
if ( is_array( $upc_coupon_image_src ) ) {
	$upc_coupon_image_src = $upc_coupon_image_src[0];
} else {
	$upc_coupon_image_src = '';
}
?>

<div class="upc-coupon-image-wrapper">
  <!--  <style>
        .upc-coupon-image {
            text-align: center;
            margin: 0px auto;
        }

        .upc-coupon-image img {
            display: inline-block;
            max-width: 100%;
            max-height: 100%;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            padding: 10px;
            border: 2px dashed #000000;
        }

        .coupon-image-print-link {
            font-size: 16px;
            display: inline-block;
            color: blue;
            line-height: 26px;
            cursor: pointer;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            text-decoration: underline;
        }

        .coupon-image-print-link:hover {
            color: blue !important;
            text-decoration: underline;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }
    </style>  -->
    <div class="upc-coupon-image"
         style="width: <?php echo $upc_image_width; ?>; height: <?php echo $upc_image_height; ?>">
        <a href="<?php echo $upc_link; ?>" target="_blank">
            <img src="<?php echo $upc_coupon_image_src; ?>"
                 alt="<?php _e( 'Coupon image not uploaded', 'upc-coupon' ); ?>">
        </a>
    </div>

	<?php if ( $upc_show_print != 'No' ): ?>
        <div style="text-align:center">
            <a class="coupon-image-print-link"
               onclick="upc_print_coupon_img('<?php echo $upc_coupon_image_src; ?>')"><?php _e( 'Click To Print', 'upc-coupon' ); ?></a>
        </div>
        <script>
            function upc_print_coupon_img(url) {
                if (!url) return;
                var win = window.open("");
                win.document.write('<img style="max-width:100%" src="' + url + '" onload="window.print();window.close()" />');
                win.focus()
            }
        </script>
	<?php endif; ?>
</div>