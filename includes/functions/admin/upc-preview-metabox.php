<?php

/**
 * Builds the coupon preview meta box.
 *
 * @since 1.0
 */

$post_id                  = get_the_ID();
$title                    = get_the_title();
$description              = get_post_meta( $post_id, 'coupon_details_description', true );
$coupon_thumbnail         = get_the_post_thumbnail_url( $post_id );
$coupon_type              = get_post_meta( $post_id, 'coupon_details_coupon-type', true );
$discount_text            = get_post_meta( $post_id, 'coupon_details_discount-text', true );
$second_discount_text     = get_post_meta( $post_id, 'coupon_details_second-discount-text', true );
$third_discount_text      = get_post_meta( $post_id, 'coupon_details_third-discount-text', true );
$link                     = get_post_meta( $post_id, 'coupon_details_link', true );
$coupon_code              = get_post_meta( $post_id, 'coupon_details_coupon-code-text', true );
$second_coupon_code       = get_post_meta( $post_id, 'coupon_details_second-coupon-code-text', true );
$third_coupon_code        = get_post_meta( $post_id, 'coupon_details_third-coupon-code-text', true );
$deal_text                = get_post_meta( $post_id, 'coupon_details_deal-button-text', true );
$coupon_hover_text        = get_option( 'upc_coupon-hover-text' );
$deal_hover_text          = get_option( 'upc_deal-hover-text' );
$button_class             = '.upc-btn-' . $post_id;
$no_expiry                = get_option( 'upc_no-expiry-message' );
$expire_text              = get_option( 'upc_expire-text' );
$expired_text             = get_option( 'upc_expired-text' );
$hide_coupon_text         = get_option( 'upc_hidden-coupon-text' );
$hide_coupon_button_color = get_option( 'upc_hidden-coupon-button-color' );
$hidden_coupon_hover_text = get_option( 'upc_hidden-coupon-hover-text' );
$show_expiration          = get_post_meta( $post_id, 'coupon_details_show-expiration', true );
$today                    = date( 'd-m-Y' );
$time_now                 = time();
$expire_date              = get_post_meta( $post_id, 'coupon_details_expire-date', true );
$second_expire_date       = get_post_meta( $post_id, 'coupon_details_second-expire-date', true );
$third_expire_date        = get_post_meta( $post_id, 'coupon_details_third-expire-date', true );
$expire_time              = get_post_meta( $post_id, 'coupon_details_expire-time', true );
$expireDateFormat         = get_option( 'upc_expiry-date-format' );
$expire_date_format       = date( "m/d/Y", strtotime( $expire_date ) );
$hide_coupon              = get_post_meta( $post_id, 'coupon_details_hide-coupon', true );
$coupon_image_id          = get_post_meta( $post_id, 'coupon_details_coupon-image-input', true );
$coupon_image_src         = wp_get_attachment_image_src( $coupon_image_id, 'full' );
$upc_template_five_theme = get_post_meta( $post_id, 'coupon_details_template-five-theme', true );
$upc_template_six_theme  = get_post_meta( $post_id, 'coupon_details_template-six-theme', true );
$upc_dummy_coupon_img   = UPC_Plugin::instance()->plugin_assets .'admin/img/coupon-200x200.png';
$upc_text_to_show        = get_option( 'upc_text-to-show' );
$upc_custom_text         = get_option( 'upc_custom-text' );

if ( $upc_text_to_show == 'description' ) {
	$upc_custom_text = $description;
} else {
	if ( empty( $upc_custom_text ) ) {
		$upc_custom_text = __( "Click on 'Copy' to Copy the Coupon Code.", 'upc-coupon' );
	}
}


/*
$uploads = wp_upload_dir();
$dafault_coupon_img=$uploads['baseurl'].'/default.png';

*/


$img_path=UPC_Plugin::instance()->plugin_assets.'img/default.png';
//echo "plugin dir ".$img_path;
$dafault_coupon_img=UPC_Plugin::instance()->plugin_assets.'img/default.png';





?>

<!--
<style>
    .upc-coupon-button-type .coupon-code-upc .get-code-upc {
        background-color: <?php echo $hide_coupon_button_color; ?>;
    }

    .upc-coupon-button-type .coupon-code-upc .get-code-upc:after {
        border-left-color: <?php echo $hide_coupon_button_color; ?>;
    }
</style>  -->
<span class="upc-default-img"
      default-img="<?php echo UPC_Plugin::instance()->plugin_assets . 'img/icon-128x128.png'; ?>"
      style="display:none;">

</span>

<!-- Default Preview -->
<div class="upc-coupon-preview upc-coupon upc-coupon-default upc-coupon-id-<?php echo $post_id; ?>">
    <div class="upc-col-1-8">
	
        <div class="upc-coupon-discount-text">
			<?php if ( ! empty( $discount_text ) ) {
				echo $discount_text;
			} else {
				echo __( 'Discount Text', 'upc-coupon' );
			} ?>
        </div>
        <div class="coupon-type">
			
					
		                <?php
							echo $coupon_type;
				
			 ?>
        </div>
    </div>
    <div class="upc-coupon-content upc-col-7-8">
        <div class="upc-coupon-header">
            <div class="upc-col-3-4">
                <div class="upc-coupon-title"><?php if ( ! empty( $title ) ) {
						echo $title;
					} else {
						echo __( 'Sample Coupon Code', 'upc-coupon' );
					} ?>
                </div>
            </div>
            <div class="upc-col-1-4">
                <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
				
				    
                  <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                       class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                       title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
						   echo $hidden_coupon_hover_text;
					   } else {
						   _e( 'Click Here to Show Code', 'upc-coupon' );
					   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                        <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
					
		                       echo $coupon_code;
							  
							  
	                        } else {
		                        echo __( 'COUPONCODE', 'upc-coupon' );
							   
							 
							   
							   
	                        } ?></span>
                        <span class="get-code-upc">
                            <?php
                            if ( ! empty( $hide_coupon_text ) ) {
	                            echo $hide_coupon_text;
                            }
							else {
	                            echo __( 'Show Code', 'upc-coupon' );
                            }
                            ?>
                        </span>
                    </a>  
                </div>
                <div class="upc-coupon-not-hidden">
                    <div class="upc-coupon-code">
                      <!--  <button class="upc-btn masterTooltip upc-coupon-button"
                                title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
							        echo $coupon_code;
						        } else {
							        echo __( 'COUPONCODE', 'upc-coupon' );
						        } ?>">
                            <span class="upc_coupon_icon"></span> <span
                                    class="coupon-code-button"><?php if ( ! empty( $coupon_code ) ) {
									echo $coupon_code;
								} else {
									echo __( 'COUPONCODE', 'upc-coupon' );
								} ?></span>
                        </button>  -->
						 <button class="btn btn-success">GET CODE</button>
                    </div>
                    <div class="upc-deal-code">
                        <button class="upc-btn masterTooltip upc-deal-button"
                                title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
							        echo $deal_text;
						        } else {
							        echo __( 'Claim This Deal', 'upc-coupon' );
						        } ?>">
                            <span class="upc_deal_icon"></span><span
                                    class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
									echo $deal_text;
								} else {
									echo __( 'Claim This Deal', 'upc-coupon' );
								} ?></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="upc-extra-content">
            <div class="upc-col-3-4">
                <div class="upc-coupon-description">
					<?php if ( ! empty( $description ) ) {
						echo $description;
					} else {
						echo __( 'This is the description of the coupon code. Additional details of what the coupon or deal is.', 'upc-coupon' );
					} ?>
                </div>
            </div>

            <div class="upc-col-1-4">
				<?php
				if ( $show_expiration !== 'Hide' ) { ?>
                    <div class="with-expiration1 <?php echo empty( $expire_date ) ? 'hidden' : ''; ?>">
                        <div class="upc-coupon-expire expire-text-block1 <?php echo strtotime( $expire_date ) < strtotime( $today ) ? 'hidden' : ''; ?>">
							<?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </div>
                        <div class="upc-coupon-expired expired-text-block1 <?php echo strtotime( $expire_date ) >= strtotime( $today ) ? 'hidden' : ''; ?>">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </div>
                    </div>
                    <div class="upc-coupon-expire without-expiration1 <?php echo empty( $expire_date ) ? '' : 'hidden'; ?>">
						<?php if ( ! empty( $no_expiry ) ) {
							echo $no_expiry;
						} else {
							echo __( "Doesn't expire", 'upc-coupon' );
						} ?>
                    </div>
					<?php
				} else {
					echo '';
				} ?>
            </div>
        </div>
    </div>
</div>

<!-- Template One Preview -->
<div class="upc-coupon-preview upc-coupon1 upc-coupon-one upc-coupon-id-<?php echo $post_id; ?>">
    <div class="upc-col-1-8">
        <div class="upc-coupon-discount-text">
			<?php if ( ! empty( $discount_text ) ) {
				echo $discount_text;
			} else {
				echo __( 'Discount Text', 'upc-coupon' );
			} ?>
        </div>
        <div class="coupon-type">
			
				<img src="<?php echo $dafault_coupon_img;?>"  width="100px" height="50px"/>
		
        </div>
    </div>
    <div class="upc-coupon-content upc-col-7-8">
        <div class="upc-coupon-header">
            <div class="upc-col-3-4">
                <div class="upc-coupon-title"><?php if ( ! empty( $title ) ) {
						echo $title;
					} else {
						echo __( 'Sample Coupon Code', 'upc-coupon' );
					} ?>
                </div>
            </div>
            <div class="upc-col-1-4">
                <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                    <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                       class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                       title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
						   echo $hidden_coupon_hover_text;
					   } else {
						   _e( 'Click Here to Show Code', 'upc-coupon' );
					   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                        <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
		                        echo $coupon_code;
	                        } else {
		                        echo __( 'COUPONCODE', 'upc-coupon' );
	                        } ?></span>
                        <span class="get-code-upc">
                            <?php
                            if ( ! empty( $hide_coupon_text ) ) {
	                            echo $hide_coupon_text;
                            } else {
	                            echo __( 'Show Code', 'upc-coupon' );
                            }
                            ?>
                        </span>
                    </a>
                </div>
                <div class="upc-coupon-not-hidden">
                    <div class="upc-coupon-code">
                      <!--  <button class="upc-btn masterTooltip upc-coupon-button"
                                title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
							        echo $coupon_code;
						        } else {
							        echo __( 'COUPONCODE', 'upc-coupon' );
						        } ?>">
                            <span class="upc_coupon_icon"></span> <span
                                    class="coupon-code-button"><?php if ( ! empty( $coupon_code ) ) {
									echo $coupon_code;
								} else {
									echo __( 'COUPONCODE', 'upc-coupon' );
								} ?></span>
                        </button> -->
						<button class="btn btn-success">GET CODE</button>
                    </div>
                    <div class="upc-deal-code">
                        <button class="masterTooltip upc-deal-button btn btn-success" 
                                title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
							        echo $deal_text;
						        } else {
							        echo __( 'Claim This Deal', 'upc-coupon' );
						        } ?>">
                          <!--  <span class="upc_deal_icon"></span> --><span
                                    class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
									echo $deal_text;
								} else {
									echo __( 'Claim This Deal', 'upc-coupon' );
								} ?></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="upc-extra-content">
            <div class="upc-col-3-4">
                <div class="upc-coupon-description">
					<?php if ( ! empty( $description ) ) {
						echo $description;
					} else {
						echo __( 'This is the description of the coupon code. Additional details of what the coupon or deal is.', 'upc-coupon' );
					} ?>
                </div>
            </div>

            <div class="upc-col-1-4">
				<?php
				if ( $show_expiration !== 'Hide' ) { ?>
                    <div class="with-expiration1 <?php echo empty( $expire_date ) ? 'hidden' : ''; ?>">
                        <div class="upc-coupon-expire expire-text-block1 <?php echo strtotime( $expire_date ) < strtotime( $today ) ? 'hidden' : ''; ?>">
							<?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </div>
                        <div class="upc-coupon-expired expired-text-block1 <?php echo strtotime( $expire_date ) >= strtotime( $today ) ? 'hidden' : ''; ?>">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </div>
                    </div>
                    <div class="upc-coupon-expire without-expiration1 <?php echo empty( $expire_date ) ? '' : 'hidden'; ?>">
						<?php if ( ! empty( $no_expiry ) ) {
							echo $no_expiry;
						} else {
							echo __( "Doesn't expire", 'upc-coupon' );
						} ?>
                    </div>
					<?php
				} else {
					echo '';
				} ?>
            </div>
        </div>
    </div>
</div>
<!-- Template Two Preview -->
<div class="upc-coupon-preview upc-coupon-two">
    <div class="upc-col-two-1-4">
		<?php if ( has_post_thumbnail() ) { ?>
            <figure>
                <img class="upc-coupon-two-img upc-get-fetured-img" src="<?php echo $coupon_thumbnail; ?>">
            </figure>
		<?php } else { ?>
            <figure>
                <img class="upc-coupon-two-img upc-get-fetured-img"
                     src="<?php echo UPC_Plugin::instance()->plugin_assets . 'img/icon-128x128.png'; ?>">
            </figure>
		<?php } ?>
        <div class="upc-coupon-two-discount-text">
			<?php if ( ! empty( $discount_text ) ) {
				echo $discount_text;
			} else {
				echo __( 'Discount Text', 'upc-coupon' );
			} ?>
        </div>
    </div>
    <div class="upc-col-two-3-4">
        <div class="upc-coupon-two-header">
            <div>
                <h4><?php if ( ! empty( $title ) ) {
						echo $title;
					} else {
						echo __( 'Sample Coupon Code', 'upc-coupon' );
					} ?></h4>
            </div>
        </div>
        <div class="upc-coupon-two-info">
            <div class="upc-coupon-two-title">
                <b class="expires-on">
                    <span><?php
	                    if ( ! empty( $expire_text ) ) {
		                    echo $expire_text;
	                    } else {
		                    echo __( 'Expires on: ', 'upc-coupon' );
	                    }
	                    ?>
                    </span>
                    <span class="upc-coupon-two-countdown" id="clock_two_<?php echo $post_id; ?>"></span>
                </b>
				<?php if ( ! $expire_date ) {
					//$expire_date        = date( 'd/m/Y' );
					$expire_date_format = date( 'd/m/Y' );
				} ?>
                <script type="text/javascript">
                    var hasDate = "<?php echo empty( $expire_date ) ? 'no' : 'yes';?>";
                    if (hasDate === 'no')
                        jQuery('#clock_two_<?php echo $post_id; ?>').hide();

                    var $clock = jQuery('#clock_two_<?php echo $post_id; ?>').countdown('<?php echo $expire_date_format . ' ' . $expire_time; ?>', function (event) {
                        var format = '%M <?php echo __( 'minutes', 'upc-coupon' ); ?> %S <?php echo __( 'seconds', 'upc-coupon' ); ?>';
                        if (event.offset.hours > 0) {
                            format = "%H <?php echo __( 'hours', 'upc-coupon' ); ?> %M <?php echo __( 'minutes', 'upc-coupon' ); ?> %S <?php echo __( 'seconds', 'upc-coupon' ); ?>";
                        }
                        if (event.offset.totalDays > 0) {
                            format = "%-d <?php echo __( 'day', 'upc-coupon' ); ?>%!d " + format;
                        }
                        if (event.offset.weeks > 0) {
                            format = "%-w <?php echo __( 'week', 'upc-coupon' ); ?>%!w " + format;
                        }
                        jQuery(this).html(event.strftime(format));

                        if (event.offset.weeks == 0 && event.offset.totalDays == 0 && event.offset.hours == 0 && event.offset.minutes == 0 && event.offset.seconds == 0) {
                            jQuery(this).addClass('upc-countdown-expired').html('<?php echo __( 'This offer has expired!', 'upc-coupon' ); ?>');
                        } else {
                            jQuery(this).html(event.strftime(format));
                            jQuery('#clock_two_<?php echo $post_id; ?>').removeClass('upc-countdown-expired');
                        }
                    });

                    jQuery("#expire-time").change(function () {
                        jQuery('#clock_two_<?php echo $post_id; ?>').show();
                        var coup_date = jQuery("#expire-date").val();
                        if (coup_date.indexOf("-") >= 0) {
                            var dateAr = coup_date.split('-');
                            coup_date = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
                        }
                        selectedDate = coup_date + ' ' + jQuery("#expire-time").val();
                        $clock.countdown(selectedDate.toString());
                    });
                </script>
                <b class="never-expire" style="display: none;">
                    <?php if ( ! empty( $no_expiry ) ) : ?>
                            <b><?php echo $no_expiry; ?></b>
                    <?php else : ?>
                            <b><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></b>
                    <?php endif; ?>
                </b>
            </div>
            <div class="upc-coupon-two-coupon">
                <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                    <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                       class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                       title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
						   echo $hidden_coupon_hover_text;
					   } else {
						   _e( 'Click Here to Show Code', 'upc-coupon' );
					   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                        <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
		                        echo $coupon_code;
	                        } else {
		                        echo __( 'COUPONCODE', 'upc-coupon' );
	                        } ?></span>
                        <span class="get-code-upc">
                            <?php
                            if ( ! empty( $hide_coupon_text ) ) {
	                            echo $hide_coupon_text;
                            } else {
	                            echo __( 'Show Code', 'upc-coupon' );
                            }
                            ?>
                        </span>
                    </a>
                </div>
                <div class="upc-coupon-not-hidden">
                    <div class="upc-coupon-code">
                        <button class="upc-btn masterTooltip upc-coupon-button"
                                title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
							        echo $coupon_code;
						        } else {
							        echo __( 'COUPONCODE', 'upc-coupon' );
						        } ?>">
                            <span class="upc_coupon_icon"></span> <span
                                    class="coupon-code-button"><?php if ( ! empty( $coupon_code ) ) {
									echo $coupon_code;
								} else {
									echo __( 'COUPONCODE', 'upc-coupon' );
								} ?></span>
                        </button>
                    </div>
                    <div class="upc-deal-code">
                        <button class="upc-btn masterTooltip upc-deal-button"
                                title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                                data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
							        echo $deal_text;
						        } else {
							        echo __( 'Claim This Deal', 'upc-coupon' );
						        } ?>">
                            <span class="upc_deal_icon"></span><span
                                    class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
									echo $deal_text;
								} else {
									echo __( 'Claim This Deal', 'upc-coupon' );
								} ?></span>
                        </button>
                    </div>
                </div>
            </div>
            <div id="clear"></div>
        </div>
        <div id="clear"></div>
        <div class="upc-coupon-description">
			<?php if ( ! empty( $description ) ) {
				echo $description;
			} else {
				echo __( 'This is the description of the coupon code. You can add additional details about the coupon here, what the coupon or deal is.', 'upc-coupon' );
			} ?>
        </div>
    </div>
</div>

<!-- Template Three Preview -->
<div class="upc-coupon-preview upc-coupon-three">
    <div class="upc-coupon-three-content">
        <h4 class="upc-coupon-three-title"><?php if ( ! empty( $title ) ) {
				echo $title;
			} else {
				echo __( 'Sample Coupon Code', 'upc-coupon' );
			} ?></h4>
        <div class="upc-coupon-description">
			<?php if ( ! empty( $description ) ) {
				echo $description;
			} else {
				echo __( 'This is the description of the coupon code. You can add additional details about the coupon here, what the coupon or deal is.', 'upc-coupon' );
			} ?>
        </div>
    </div>
    <div class="upc-coupon-three-info">
        <div class="upc-coupon-three-info-left">
			<?php
			if ( $show_expiration !== 'Hide' ) { ?>
                <div class="with-expiration1 <?php echo empty( $expire_date ) ? 'hidden' : ''; ?>">
                    <div class="upc-coupon-three-expire expire-text-block1 <?php echo strtotime( $expire_date ) >= strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-three-expire-text"><?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?></p>
                    </div>
                    <div class="upc-coupon-three-expire expired-text-block1 <?php echo strtotime( $expire_date ) < strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-three-expired">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </p>
                    </div>
                </div>
                <div class="upc-coupon-three-expire without-expiration1 <?php echo empty( $expire_date ) ? '' : 'hidden'; ?>">
					<?php if ( ! empty( $no_expiry ) ) { ?>
                        <p><?php echo $no_expiry; ?></p>
					<?php } else { ?>
                        <p><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></p>
					<?php }
					?>
                </div>
				<?php
			} else {
				echo '';
			}
			?>
        </div>
        <div class="upc-coupon-three-coupon">
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                   class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                   title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
					   echo $hidden_coupon_hover_text;
				   } else {
					   _e( 'Click Here to Show Code', 'upc-coupon' );
				   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                    <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
		                    echo $coupon_code;
	                    } else {
		                    echo __( 'COUPONCODE', 'upc-coupon' );
	                    } ?></span>
                    <span class="get-code-upc">
                        <?php
                        if ( ! empty( $hide_coupon_text ) ) {
	                        echo $hide_coupon_text;
                        } else {
	                        echo __( 'Show Code', 'upc-coupon' );
                        }
                        ?>
                    </span>
                </a>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code">
                    <button class="upc-btn masterTooltip upc-coupon-button"
                            title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
						        echo $coupon_code;
					        } else {
						        echo __( 'COUPONCODE', 'upc-coupon' );
					        } ?>">
                        <span class="upc_coupon_icon"></span> <span
                                class="coupon-code-button"><?php if ( ! empty( $coupon_code ) ) {
								echo $coupon_code;
							} else {
								echo __( 'COUPONCODE', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
                <div class="upc-deal-code">
                    <button class="upc-btn masterTooltip upc-deal-button"
                            title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						        echo $deal_text;
					        } else {
						        echo __( 'Claim This Deal', 'upc-coupon' );
					        } ?>">
                        <span class="upc_deal_icon"></span><span
                                class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
								echo $deal_text;
							} else {
								echo __( 'Claim This Deal', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template Four Preview -->
<div class="upc-coupon-preview upc-coupon-four">
    <div class="upc-coupon-four-content">
        <h4 class="upc-coupon-four-title"><?php if ( ! empty( $title ) ) {
				echo $title;
			} else {
				echo __( 'Sample Coupon Code', 'upc-coupon' );
			} ?></h4>
        <div class="upc-coupon-description">
			<?php if ( ! empty( $description ) ) {
				echo $description;
			} else {
				echo __( 'This is the description of the coupon code. You can add additional details about the coupon here, what the coupon or deal is.', 'upc-coupon' );
			} ?>
        </div>
    </div>

    <!-- start first coupon -->
	 
	
	
    <div class="upc-coupon-four-info">
        <div class="upc-coupon-four-coupon">

            <div class="upc-four-discount-text"><?php echo $discount_text; ?></div>
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                   class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                   title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
					   echo $hidden_coupon_hover_text;
				   } else {
					   _e( 'Click Here to Show Code', 'upc-coupon' );
				   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                    <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
		                    echo $coupon_code;
	                    } else {
		                    echo __( 'COUPONCODE', 'upc-coupon' );
	                    } ?></span>
                    <span class="get-code-upc">
                        <?php
                        if ( ! empty( $hide_coupon_text ) ) {
	                        echo $hide_coupon_text;
                        } else {
	                        echo __( 'Show Code', 'upc-coupon' );
                        }
                        ?>
                    </span>
                </a>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code">
                    <button class="upc-btn masterTooltip upc-coupon-button"
                            title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
						        echo $coupon_code;
					        } else {
						        echo __( 'COUPONCODE', 'upc-coupon' );
					        } ?>">
                        <span class="upc_coupon_icon"></span> <span
                                class="coupon-code-button"><?php if ( ! empty( $coupon_code ) ) {
								echo $coupon_code;
							} else {
								echo __( 'COUPONCODE', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
                <div class="upc-deal-code">
                    <button class="upc-btn masterTooltip upc-deal-button"
                            title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						        echo $deal_text;
					        } else {
						        echo __( 'Claim This Deal', 'upc-coupon' );
					        } ?>">
                        <span class="upc_deal_icon"></span><span
                                class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
								echo $deal_text;
							} else {
								echo __( 'Claim This Deal', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="upc-coupon-four-info-left">
			<?php
			if ( $show_expiration !== 'Hide' ) { ?>
                <div class="with-expiration1 <?php echo empty( $expire_date ) ? 'hidden' : ''; ?>">
                    <div class="upc-coupon-four-expire expire-text-block1 <?php echo strtotime( $expire_date ) >= strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-four-expire-text"><?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?></p>
                    </div>
                    <div class="upc-coupon-four-expire expired-text-block1 <?php echo strtotime( $expire_date ) < strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-four-expired">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </p>
                    </div>
                </div>
                <div class="upc-coupon-four-expire without-expiration1 <?php echo empty( $expire_date ) ? '' : 'hidden'; ?>">
					<?php if ( ! empty( $no_expiry ) ) { ?>
                        <p><?php echo $no_expiry; ?></p>
					<?php } else { ?>
                        <p><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></p>
					<?php }
					?>
                </div>
			<?php } else {
				echo '';
			}
			?>
        </div>
    </div> 
	
    <!-- end first coupon -->

    <!-- start second coupon -->
    <div class="upc-coupon-four-info">
        <div class="upc-coupon-four-coupon">
            <div class="upc-four-discount-text"><?php echo $second_discount_text; ?></div>
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                   class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                   title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
					   echo $hidden_coupon_hover_text;
				   } else {
					   _e( 'Click Here to Show Code', 'upc-coupon' );
				   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                    <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $second_coupon_code ) ) {
		                    echo $second_coupon_code;
	                    } else {
		                    echo __( 'COUPONCODE', 'upc-coupon' );
	                    } ?></span>
                    <span class="get-code-upc">
                        <?php
                        if ( ! empty( $hide_coupon_text ) ) {
	                        echo $hide_coupon_text;
                        } else {
	                        echo __( 'Show Code', 'upc-coupon' );
                        }
                        ?>
                    </span>
                </a>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code">
                    <button class="upc-btn masterTooltip upc-coupon-button"
                            title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $second_coupon_code ) ) {
						        echo $second_coupon_code;
					        } else {
						        echo __( 'COUPONCODE', 'upc-coupon' );
					        } ?>">
                        <span class="upc_coupon_icon"></span> <span
                                class="coupon-code-button"><?php if ( ! empty( $second_coupon_code ) ) {
								echo $second_coupon_code;
							} else {
								echo __( 'COUPONCODE', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
                <div class="upc-deal-code">
                    <button class="upc-btn masterTooltip upc-deal-button"
                            title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						        echo $deal_text;
					        } else {
						        echo __( 'Claim This Deal', 'upc-coupon' );
					        } ?>">
                        <span class="upc_deal_icon"></span><span
                                class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
								echo $deal_text;
							} else {
								echo __( 'Claim This Deal', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="upc-coupon-four-info-left">
			<?php
			if ( $show_expiration !== 'Hide' ) { ?>
                <div class="with-expiration-4-2 <?php echo empty( $second_expire_date ) ? 'hidden' : ''; ?>">
                    <div class="upc-coupon-four-expire expire-text-block2 <?php echo strtotime( $second_expire_date ) >= strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-four-expire-text"><?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $second_expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $second_expire_date . '</span>';
							}
							?></p>
                    </div>
                    <div class="upc-coupon-four-expire expired-text-block2 <?php echo strtotime( $second_expire_date ) < strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-four-expired">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $second_expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $second_expire_date . '</span>';
							}
							?>
                        </p>
                    </div>
                </div>
                <div class="upc-coupon-four-expire without-expiration-4-2 <?php echo empty( $second_expire_date ) ? '' : 'hidden'; ?>">
					<?php if ( ! empty( $no_expiry ) ) { ?>
                        <p><?php echo $no_expiry; ?></p>
					<?php } else { ?>
                        <p><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></p>
					<?php }
					?>
                </div>
				<?php
			} else {
				echo '';
			}
			?>
        </div>
    </div>
    <!-- end second coupon -->

    <!-- start third coupon -->
    <div class="upc-coupon-four-info">
        <div class="upc-coupon-four-coupon">
            <div class="upc-four-discount-text"><?php echo $third_discount_text; ?></div>
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                   class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                   title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
					   echo $hidden_coupon_hover_text;
				   } else {
					   _e( 'Click Here to Show Code', 'upc-coupon' );
				   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
                    <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $third_coupon_code ) ) {
		                    echo $third_coupon_code;
	                    } else {
		                    echo __( 'COUPONCODE', 'upc-coupon' );
	                    } ?></span>
                    <span class="get-code-upc">
                        <?php
                        if ( ! empty( $hide_coupon_text ) ) {
	                        echo $hide_coupon_text;
                        } else {
	                        echo __( 'Show Code', 'upc-coupon' );
                        }
                        ?>
                    </span>
                </a>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code">
                    <button class="upc-btn masterTooltip upc-coupon-button"
                            title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $third_coupon_code ) ) {
						        echo $third_coupon_code;
					        } else {
						        echo __( 'COUPONCODE', 'upc-coupon' );
					        } ?>">
                        <span class="upc_coupon_icon"></span> <span
                                class="coupon-code-button"><?php if ( ! empty( $third_coupon_code ) ) {
								echo $third_coupon_code;
							} else {
								echo __( 'COUPONCODE', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
                <div class="upc-deal-code">
                    <button class="upc-btn masterTooltip upc-deal-button"
                            title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                            data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						        echo $deal_text;
					        } else {
						        echo __( 'Claim This Deal', 'upc-coupon' );
					        } ?>">
                        <span class="upc_deal_icon"></span><span
                                class="deal-code-button"><?php if ( ! empty( $deal_text ) ) {
								echo $deal_text;
							} else {
								echo __( 'Claim This Deal', 'upc-coupon' );
							} ?></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="upc-coupon-four-info-left">
			<?php
			if ( $show_expiration !== 'Hide' ) { ?>
                <div class="with-expiration-4-3 <?php echo empty( $third_expire_date ) ? 'hidden' : ''; ?>">
                    <div class="upc-coupon-four-expire expire-text-block3 <?php echo strtotime( $third_expire_date ) >= strtotime( $today ); ?>">
                        <p class="upc-coupon-four-expire-text"><?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $third_expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $third_expire_date . '</span>';
							}
							?></p>
                    </div>
                    <div class="upc-coupon-four-expire expired-text-block3 <?php echo strtotime( $third_expire_date ) < strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-four-expired">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $third_expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $third_expire_date . '</span>';
							}
							?>
                        </p>
                    </div>
                </div>
                <div class="upc-coupon-four-expire without-expiration-4-3 <?php echo empty( $third_expire_date ) ? '' : 'hidden'; ?>">
					<?php if ( ! empty( $no_expiry ) ) { ?>
                        <p><?php echo $no_expiry; ?></p>
					<?php } else { ?>
                        <p><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></p>
					<?php }
					?>
                </div>
				<?php
			} else {
				echo '';
			}
			?>
        </div>
    </div>
    <!-- end third coupon -->
</div>

<!-- Template Five Preview -->
<div class="upc-coupon-preview upc-coupon-five">
    <div class="upc-template-five" style="border-color: <?php echo $upc_template_five_theme; ?>">
        <div class="upc-template-five-holder">
            <div class="upc-template-five-percent-off">
                <p class="upc-coupon-five-discount-text">
					<?php if ( ! empty( $discount_text ) ) {
						echo $discount_text;
					} else {
						echo __( 'Discount Text', 'upc-coupon' );
					} ?>
                </p>
            </div>
            <div class="upc-template-five-pro-img">
                <img data-src="<?php echo $upc_dummy_coupon_img; ?>"
                     src="<?php echo empty( $coupon_thumbnail ) ? $upc_dummy_coupon_img : $coupon_thumbnail; ?>"
                     alt="Coupon">
            </div>

            <div class="upc-template-five-texts">
                <h2 class="upc-coupon-five-title"><?php if ( ! empty( $title ) ) {
						echo $title;
					} else {
						echo __( 'Sample Coupon Code', 'upc-coupon' );
					} ?></h2>
                <p class="upc-coupon-description"><?php if ( ! empty( $description ) ) {
						echo $description;
					} else {
						echo __( 'This is the description of the coupon code. You can add additional details about the coupon here, what the coupon or deal is.', 'upc-coupon' );
					} ?></p>
            </div>
        </div>

        <div class="extra-upc-template-five-holder">
            <div class="upc-template-five-exp" style="background-color: <?php echo $upc_template_five_theme; ?>">
                <!-- <p>Expires On: 12/31/17</p> -->
                <div class="with-expiration1 <?php echo( empty( $expire_date ) ? 'hidden' : '' );
				echo( $show_expiration !== 'Hide' ? '' : ' hide-expire-preview' ); ?> ">
                    <div class="upc-coupon-five-expire expire-text-block1 <?php echo strtotime( $expire_date ) >= strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-five-expire-text"><?php
							if ( ! empty( $expire_text ) ) {
								echo $expire_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expires on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?></p>
                    </div>
                    <div class="upc-coupon-five-expire expired-text-block1 <?php echo strtotime( $expire_date ) < strtotime( $today ) ? '' : 'hidden'; ?>">
                        <p class="upc-coupon-five-expired">
							<?php
							if ( ! empty( $expired_text ) ) {
								echo $expired_text . ' ' . '<span class="expiration-date">' . $expire_date . '</span>';;
							} else {
								echo __( 'Expired on: ', 'upc-coupon' ) . '<span class="expiration-date">' . $expire_date . '</span>';
							}
							?>
                        </p>
                    </div>
                </div>
                <div class="upc-coupon-five-expire without-expiration1 <?php echo( empty( $expire_date ) ? '' : 'hidden' );
				echo( $show_expiration !== 'Hide' ? '' : ' hide-expire-preview' ); ?>">
					<?php if ( ! empty( $no_expiry ) ) { ?>
                        <p><?php echo $no_expiry; ?></p>
					<?php } else { ?>
                        <p><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></p>
					<?php }
					?>
                </div>
            </div>
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                   class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                   title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
					   echo $hidden_coupon_hover_text;
				   } else {
					   _e( 'Click Here to Show Code', 'upc-coupon' );
				   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; ?>">
	                <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
			                echo $coupon_code;
		                } else {
			                echo __( 'COUPONCODE', 'upc-coupon' );
		                } ?></span>
                    <span class="get-code-upc" style="background-color: <?php echo $upc_template_five_theme; ?>">
	                    <?php
	                    if ( ! empty( $hide_coupon_text ) ) {
		                    echo $hide_coupon_text;
	                    } else {
		                    echo __( 'Show Code', 'upc-coupon' );
	                    }
	                    ?>
                        <div style="border-left-color: <?php echo $upc_template_five_theme; ?>"></div>
	                </span>
                </a>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code">
                    <a class="upc-template-five-btn masterTooltip" href="#"
                       title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                       data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
						   echo $coupon_code;
					   } else {
						   echo __( 'COUPONCODE', 'upc-coupon' );
					   } ?>" style="border-color: <?php echo $upc_template_five_theme; ?>">
                        <p class="coupon-code-button"
                           style="color: <?php echo $upc_template_five_theme; ?>"><?php echo( ! empty( $coupon_code ) ? $coupon_code : __( 'COUPONCODE', 'upc-coupon' ) ); ?></p>
                    </a>
                </div>
                <div class="upc-deal-code">
                    <a class="upc-template-five-btn masterTooltip" href="#"
                       title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                       data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						   echo $deal_text;
					   } else {
						   echo __( 'Claim This Deal', 'upc-coupon' );
					   } ?>" style="border-color: <?php echo $upc_template_five_theme; ?>">
                        <p class="deal-code-button" style="color: <?php echo $upc_template_five_theme; ?>">
							<?php if ( ! empty( $deal_text ) ) {
								echo $deal_text;
							} else {
								echo __( 'Claim This Deal', 'upc-coupon' );
							} ?>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template Six Preview -->
<div class="upc-coupon-preview upc-coupon-six" style="border-color: <?php echo $upc_template_six_theme; ?>">
    <div class="upc-coupon-six-holder">
        <div class="upc-coupon-six-percent-off">
            <div class="upc-for-ribbon">
                <div class="upc-ribbon" style="background-color: <?php echo $upc_template_six_theme; ?>">
                    <div class="upc-ribbon-before"
                         style="border-left-color: <?php echo $upc_template_six_theme; ?>"></div>
                    <p class="upc-coupon-six-discount-text">
						<?php if ( ! empty( $discount_text ) ) {
							echo $discount_text;
						} else {
							echo __( '70% OFF', 'upc-coupon' );
						} ?>
                    </p>
                    <div class="upc-ribbon-after"
                         style="border-right-color: <?php echo $upc_template_six_theme; ?>"></div>
                </div>
            </div>
        </div>
        <div class="upc-coupon-six-texts">
            <div class="texts">
                <h2 class="upc-coupon-six-title"><?php if ( ! empty( $title ) ) {
						echo $title;
					} else {
						echo __( 'Sample Coupon Code', 'upc-coupon' );
					} ?>
                </h2>
                <p class="upc-coupon-description"><?php if ( ! empty( $description ) ) {
						echo $description;
					} else {
						echo __( 'This is the description of the coupon code. You can add additional details about the coupon here, what the coupon or deal is.', 'upc-coupon' );
					} ?>
                </p>
            </div>
            <div class="exp" style="border-color: <?php echo $upc_template_six_theme; ?>">
                <p>
                    <b class="expires-on">
						<?php
						if ( ! empty( $expire_text ) ) {
							echo $expire_text;
						} else {
							echo __( 'Expires on: ', 'upc-coupon' );
						}
						?>
                        
                    <span class="upc-coupon-six-countdown" id="clock_six_<?php echo $post_id; ?>"></span>
                        <?php if ( ! $expire_date ) {
                                $expire_date_format = date( 'd/m/Y' );
                        } ?>
                        <script type="text/javascript">
                            var hasDate = "<?php echo empty( $expire_date ) ? 'no' : 'yes';?>";
                            if (hasDate === 'no')
                                jQuery('#clock_six_<?php echo $post_id; ?>').hide();

                            var $clock2 = jQuery('#clock_six_<?php echo $post_id; ?>').countdown('<?php echo $expire_date_format . ' ' . $expire_time; ?>', function (event) {
                                var format = '%M <?php echo __( 'minutes', 'upc-coupon' ); ?> %S <?php echo __( 'seconds', 'upc-coupon' ); ?>';
                                if (event.offset.hours > 0) {
                                    format = "%H <?php echo __( 'hours', 'upc-coupon' ); ?> %M <?php echo __( 'minutes', 'upc-coupon' ); ?> %S <?php echo __( 'seconds', 'upc-coupon' ); ?>";
                                }
                                if (event.offset.totalDays > 0) {
                                    format = "%-d <?php echo __( 'day', 'upc-coupon' ); ?>%!d " + format;
                                }
                                if (event.offset.weeks > 0) {
                                    format = "%-w <?php echo __( 'week', 'upc-coupon' ); ?>%!w " + format;
                                }
                                jQuery(this).html(event.strftime(format));

                                if (event.offset.weeks == 0 && event.offset.totalDays== 0 && event.offset.hours == 0 && event.offset.minutes == 0 && event.offset.seconds == 0) {
                                    jQuery(this).addClass('upc-countdown-expired').html('<?php echo __( 'This offer has expired!', 'upc-coupon' ); ?>');
                                } else {
                                    jQuery(this).html(event.strftime(format));
                                    jQuery('#clock_six_<?php echo $post_id; ?>').removeClass('upc-countdown-expired');
                                }
                            });

                            jQuery("#expire-time").change(function () {
                                jQuery('#clock_six_<?php echo $post_id; ?>').show();
                                var coup_date = jQuery("#expire-date").val();
                                if (coup_date.indexOf("-") >= 0) {
                                    var dateAr = coup_date.split('-');
                                    coup_date = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
                                }
                                selectedDate = coup_date + ' ' + jQuery("#expire-time").val();
                                $clock2.countdown(selectedDate.toString());
                            });
                        </script>
                    </b>
                    <b class="never-expire" style="display: none;">
                        <?php if ( ! empty( $no_expiry ) ) : ?>
                                <b><?php echo $no_expiry; ?></b>
                        <?php else : ?>
                                <b><?php echo __( "Doesn't expire", 'upc-coupon' ); ?></b>
                        <?php endif; ?>

                    </b>
					
                </p>
            </div>
        </div>
        <div class="upc-coupon-six-img-and-btn">
            <div class="item-img">
                <img data-src="<?php echo $upc_dummy_coupon_img; ?>"
                     src="<?php echo empty( $coupon_thumbnail ) ? $upc_dummy_coupon_img : $coupon_thumbnail; ?>"
                     alt="Coupon">
            </div>
            <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden">
                <div class="upc-btn-wrap">
                    <a data-type="code" data-coupon-id="<?php echo $post_id; ?>" href=""
                       class="coupon-button coupon-code-upc masterTooltip" id="coupon-button-<?php echo $post_id; ?>"
                       title="<?php if ( ! empty( $hidden_coupon_hover_text ) ) {
						   echo $hidden_coupon_hover_text;
					   } else {
						   _e( 'Click Here to Show Code', 'upc-coupon' );
					   } ?>" data-position="top center" data-inverted="" data-aff-url="<?php echo $link; 
					 ?>"
                       style="border-color: <?php 
					   echo $upc_template_six_theme; ?>">
	                <span class="code-text-upc" rel="nofollow"><?php if ( ! empty( $coupon_code ) ) {
			                echo $coupon_code;
		                } else {
			                echo __( 'COUPONCODE', 'upc-coupon' );
		                } ?></span>
                        <span class="get-code-upc" style="background-color: <?php echo $upc_template_six_theme; ?>">
	                    <?php
	                    if ( ! empty( $hide_coupon_text ) ) {
		                    echo $hide_coupon_text;
	                    } else {
		                    echo __( 'Show Code', 'upc-coupon' );
	                    }
	                    ?>
                            <div style="border-left-color: <?php echo $upc_template_six_theme; ?>"></div>
	                </span>
                    </a>
                </div>
            </div>
            <div class="upc-coupon-not-hidden">
                <div class="upc-coupon-code upc-btn-wrap">
                    <a class="upc-template-six-btn masterTooltip" href="#"
                       title="<?php echo __( 'Click Here To Copy Coupon', 'upc-coupon' ); ?>"
                       data-clipboard-text="<?php if ( ! empty( $coupon_code ) ) {
						   echo $coupon_code;
					   } else {
						   echo __( 'COUPONCODE', 'upc-coupon' );
					   } ?>" style="border-color: <?php echo $upc_template_six_theme; ?>">
                        <span class="coupon-code-button"
                              style="border-color: <?php echo $upc_template_six_theme; ?>; color: <?php echo $upc_template_six_theme; ?>"><?php echo( ! empty( $coupon_code ) ? $coupon_code : __( 'COUPONCODE', 'upc-coupon' ) ); ?></span>
                    </a>
                </div>
                <div class="upc-deal-code upc-btn-wrap">
                    <a class="upc-template-six-btn masterTooltip" href="#"
                       title="<?php echo __( 'Click Here To Get this deal', 'upc-coupon' ); ?>"
                       data-clipboard-text="<?php if ( ! empty( $deal_text ) ) {
						   echo $deal_text;
					   } else {
						   echo __( 'Claim This Deal', 'upc-coupon' );
					   } ?>" style="border-color: <?php echo $upc_template_six_theme; ?>">
		    			<span class="deal-code-button"
                              style="border-color: <?php echo $upc_template_six_theme; ?>;color: <?php echo $upc_template_six_theme; ?>">
		    				<?php if ( ! empty( $deal_text ) ) {
							    echo $deal_text;
						    } else {
							    echo __( 'Claim This Deal', 'upc-coupon' );
						    } ?>
		    			</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Image Preview -->
<div class="upc-coupon-preview upc-coupon-image">
    <img style="max-width:100%;" src="<?php echo is_array( $coupon_image_src ) ? $coupon_image_src[0] : ''; ?>"
         alt="<?php _e( 'Coupon image not uploaded', 'upc-coupon' ); ?>">
</div>

<!-- Info -->
<p>
    <i><strong><?php echo __( 'Note:', 'upc-coupon' ); ?></strong> <?php echo __( 'This is just to show how the coupon will look. Click to copy functionality, showing hidden coupon will not work here, but it will work on posts, pages where you put the shortcode.', 'upc-coupon' ); ?>
    </i></p>
