<?php
/**
 * Default Widget Template
 */

global $coupon_id;
$title                     = get_the_title();
$description               = get_post_meta( $coupon_id, 'coupon_details_description', true );
$discount_text             = get_post_meta( $coupon_id, 'coupon_details_discount-text', true );
$coupon_type               = get_post_meta( $coupon_id, 'coupon_details_coupon-type', true );
$link                      = get_post_meta( $coupon_id, 'coupon_details_link', true );
$coupon_code               = get_post_meta( $coupon_id,'coupon_details_coupon-code-text'                                , true );
$deal_text                 = get_post_meta( $coupon_id,'coupon_details_deal-button-text',true );
$coupon_hover_text         = get_option( 'upc_coupon-hover-text' );
$deal_hover_text           = get_option( 'upc_deal-hover-text' );
$button_class              = 'upc-btn-' . $coupon_id;
$no_expiry                 = get_option( 'upc_no-expiry-message' );
$expire_text               = get_option( 'upc_expire-text' );
$expired_text              = get_option( 'upc_expired-text' );
$hide_coupon_text          = get_option( 'upc_hidden-coupon-text' );
$hidden_coupon_hover_text  = get_option( 'upc_hidden-coupon-hover-text' );
$copy_button_text          = get_option( 'upc_copy-button-text' );
$coupon_title_tag          = get_option( 'upc_coupon-title-tag', 'h1' );
$disable_coupon_title_link = get_option( 'upc_disable-coupon-title-link' );
$show_expiration           = get_post_meta( $coupon_id, 'coupon_details_show-expiration', true );
$today                     = date( 'd-m-Y' );
$expire_date               = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
$hide_coupon               = get_post_meta( $coupon_id, 'coupon_details_hide-coupon', true );
$upc_text_to_show 		   = get_option( 'upc_text-to-show' );
$upc_custom_text  		   = get_option( 'upc_custom-text' );

if ( $upc_text_to_show == 'description' ) {
	$upc_custom_text = $description;
} else {
	if ( empty( $upc_custom_text ) ) {
		$upc_custom_text = __( "Click on 'Copy' to Copy the Coupon Code.", 'upc-coupon' );
	}
}

?>
<div class="upc-coupon upc-widget upc-widget-default upc-coupon-id-<?php 
echo $coupon_id;?>">
    <div class="upc-coupon-content upc-col-1-1">
        <div class="upc-coupon-header">
            <div class="upc-col-1-1">
			<?php
				if ( 'on' === $disable_coupon_title_link ) { ?>
					<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
						<?php echo $title; ?>
                	</<?php echo esc_html( $coupon_title_tag ); ?>>
			 	<?php } else { ?>
					<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
						<a href="<?php echo $link; ?>" target="_blank" rel="nofollow"><?php echo $title; ?></a>
                	</<?php echo esc_html( $coupon_title_tag ); ?>>
				<?php } 
			?>
            </div>
            <div class="upc-col-1-1">
				<?php
				if ( $coupon_type == 'Coupon' ) {
					/*if ( wcad_fs()->is_plan__premium_only( 'pro' ) or wcad_fs()->can_use_premium_code() ) {
						if ( $hide_coupon == 'Yes' ) {
							$template = new UPC_Template_Loader();
							$template->get_template_part( 'hide-coupon__premium_only' );
						} else { */ ?>
               <!--     <div class="upc-coupon-code">
                        <a rel="nofollow"
                           class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltipupc-btn upc-coupon-button"
                           title="<?php if ( ! empty( $coupon_hover_text ) ) {
							   echo $coupon_hover_text;
						   } else {
							   echo __( "Click To Copy Coupon", 'upc-coupon' );
						   } 
						   ?>" href="<?php echo $link; ?>" target="_blank"
                           data-clipboard-text="<?php echo $coupon_code; ?>">
                            <span class="upc_coupon_icon"></span> <?php echo $coupon_code; ?>
                            <span id="coupon_code_<?php echo $coupon_id; ?>"
                                  style="display:none;"><?php echo $coupon_code; ?></span>
                        </a>
                    </div> -->
				<?php/* }
				} else {  end if */?>
                    <div class="upc-coupon-code">
                        <a rel="nofollow"
                           class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                           title="<?php if ( ! empty( $coupon_hover_text ) ) {
							   echo $coupon_hover_text;
						   } else {
							   echo __( "Click To Copy Coupon", 'upc-coupon' );
						   } ?>" href="<?php echo $link; ?>" target="_blank"
                           data-clipboard-text="<?php echo $coupon_code; ?>">
                            <span class="upc_coupon_icon"></span> <?php echo $coupon_code; ?>
                            <span id="coupon_code_<?php echo $coupon_id; ?>"
                                  style="display:none;"><?php echo $coupon_code; ?></span>
                        </a>
                    </div>
				<?php //} end else ?>
                    <script type="text/javascript">
                        var clip = new Clipboard('.upc-btn-<?php echo $coupon_id; ?>');
                    </script>
				<?php } elseif ( $coupon_type == 'Deal' ) { ?>
                    <div class="upc-coupon-code">
                        <a rel="nofollow"
                           class="<?php echo 'upc-btn-' . $coupon_id; ?> upc-btnmasterTooltip upc-deal-button"
                           title="<?php if ( ! empty( $deal_hover_text ) ) {
							   echo $deal_hover_text;
						   } else {
							   echo __( "Click Here To Get This Deal", 'upc-coupon' );
						   } ?>" href="<?php echo $link; ?>" target="_blank">
                            <span class="upc_deal_icon"></span><?php echo $deal_text; ?>
                        </a>
                    </div>
				<?php } ?>
            </div>

        </div>

        <div class="upc-extra-content">
            <div class="upc-col-1-1">
                <div class="upc-coupon-description">
                    <span class="upc-full-description"><?php echo $description; ?></span>
                    <span class="upc-short-description"></span>
                    <a href="#" class="upc-more-description"><?php echo __( 'More','upc-coupon' ); ?></a>
                    <a href="#" class="upc-less-description"><?php echo __( 'Less', 'upc-coupon' ); ?></a>
                </div>
            </div>
            <div class="upc-col-1-1">
				<?php
				if ( $coupon_type == 'Coupon' ) {
					if ( $show_expiration == 'Show' ) {
						if ( ! empty( $expire_date ) ) {
							if ( strtotime( $expire_date ) >= strtotime( $today ) ) { ?>
                                <div class="upc-coupon-expire">
									<?php
									if ( ! empty( $expire_text ) ) {
										echo $expire_text . ' ' . $expire_date;
									} else {
										echo __( 'Expires on: ', 'upc-coupon' ) . $expire_date;
									}
									?>
                                </div>
							<?php } elseif ( strtotime( $expire_date ) < strtotime( $today ) ) { ?>
                                <div class="upc-coupon-expired">
									<?php
									if ( ! empty( $expired_text ) ) {
										echo $expired_text . ' ' . $expire_date;
									} else {
										echo __( 'Expired on: ', 'upc-coupon' ) . $expire_date;
									}
									?>
                                </div>
							<?php }
						} else { ?>
                            <div class="upc-coupon-expire">
								<?php if ( ! empty( $no_expiry ) ) {
									echo $no_expiry;
								} else {
									echo __( "Doesn't expire", 'upc-coupon' );
								} ?>
                            </div>
						<?php }
					} else {
						echo '';
					}

				} elseif ( $coupon_type == 'Deal' ) {
					if ( $show_expiration == 'Show' ) {
						if ( ! empty( $expire_date ) ) {
							if ( strtotime( $expire_date ) >= strtotime( $today ) ) { ?>
                                <div class="upc-coupon-expire">
									<?php
									if ( ! empty( $expire_text ) ) {
										echo $expire_text . ' ' . $expire_date;
									} else {
										echo __( 'Expires on: ', 'upc-coupon' ) . $expire_date;
									}
									?>
                                </div>
							<?php } elseif ( strtotime( $expire_date ) < strtotime( $today ) ) { ?>
                                <div class="upc-coupon-expired">
									<?php
									if ( ! empty( $expired_text ) ) {
										echo $expired_text . ' ' . $expire_date;
									} else {
										echo __( 'Expired on: ', 'upc-coupon' ) . $expire_date;
									}
									?>
                                </div>
							<?php }

						} else { ?>

                            <div class="upc-coupon-expire">

								<?php if ( ! empty( $no_expiry ) ) {
									echo $no_expiry;
								} else {
									echo __( "Doesn't expire", 'upc-coupon' );
								}
								?>
                            </div>

						<?php }
					} else {
						echo '';
					}
				} ?>
            </div>
        </div>
    </div>
        <div class="clearfix"></div>
    <?php
        $template = new UPC_Template_Loader();
        $template->get_template_part('vote-system');
    ?>
</div>