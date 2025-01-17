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
 * @since 1.2
 */
global $coupon_id;
$title                     = get_the_title();
$description               = get_post_meta( $coupon_id, 'coupon_details_description', true );
$discount_text             = get_post_meta( $coupon_id, 'coupon_details_discount-text', true );
$coupon_type               = get_post_meta( $coupon_id, 'coupon_details_coupon-type', true );
$link                      = get_post_meta( $coupon_id, 'coupon_details_link', true );
$coupon_code               = get_post_meta( $coupon_id, 'coupon_details_coupon-code-text', true );
$deal_text                 = get_post_meta( $coupon_id, 'coupon_details_deal-button-text', true );
$coupon_hover_text         = get_option( 'upc_coupon-hover-text' );
$deal_hover_text           = get_option( 'wpcd_deal-hover-text' );
$button_class              = 'upc-btn-' . $coupon_id;
$no_expiry                 = get_option( 'wpcd_no-expiry-message' );
$expire_text               = get_option( 'wpcd_expire-text' );
$expired_text              = get_option( 'wpcd_expired-text' );
$hide_coupon_text          = get_option( 'wpcd_hidden-coupon-text' );
$hidden_coupon_hover_text  = get_option( 'wpcd_hidden-coupon-hover-text' );
$copy_button_text          = get_option( 'wpcd_copy-button-text' );
$coupon_title_tag          = get_option( 'upc_coupon-title-tag', 'h1' );
$coupon_share              = get_option( 'upc_coupon-social-share' );
$show_expiration           = get_post_meta( $coupon_id, 'coupon_details_show-expiration', true );
$today                     = date( 'd-m-Y' );
$expire_date               = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
$hide_coupon               = get_post_meta( $coupon_id, 'coupon_details_hide-coupon', true );
$dt_coupon_type_name 	   = get_option( 'wpcd_dt-coupon-type-text' );
$dt_deal_type_name 	  	   = get_option( 'wpcd_dt-deal-type-text' );
$disable_coupon_title_link = get_option( 'wpcd_disable-coupon-title-link' );
$wpcd_text_to_show         = get_option( 'wpcd_text-to-show' );
$wpcd_custom_text          = get_option( 'wpcd_custom-text' );

if ( $wpcd_text_to_show == 'description' ) {
	$wpcd_custom_text = $description;
} else {
	if ( empty( $wpcd_custom_text ) ) {
		$wpcd_custom_text = __( "Click on 'Copy' to Copy the Coupon Code.", 'upc-coupon' );
	}
}

wp_enqueue_script( 'upc-clipboardjs' );
$template = new UPC_Template_Loader();




$vendor_list = get_terms('store');
$category_list=get_terms('categories');
   //print_r($vendor_list);

  /*
 $uploads = wp_upload_dir();
 
 $dafault_coupon_img=$uploads['baseurl'].'/default.png'; */
 $dafault_coupon_img=$plugin_dir.'/'.PLUGIN_NAME.'/assets/img/default.png';
	
	
	$term_list = wp_get_post_terms($post->ID, 'store', array("fields" => "all"));
	
//print_r($term_list);
	
//	echo "Term Id ".$term_list[0]->term_id;
	$t_id=$term_list[0]->term_id; 
	
   $vendor_name=ucfirst($term_list[0]->name);	
	$term_meta = get_option( "taxonomy_term_$t_id" );
		$your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
		
		$you_have_image=is_array($your_img_src); //check whether it has an image or not
		
     $vendor_term_id=$t_id;

?>

<div class="upc-coupon1 upc-coupon-default upc-coupon-id-<?php echo $coupon_id; ?>">

    <div class="upc-col-1-8">
        <div class="upc-coupon-discount-text">
			<?php echo str_replace( " ", "<br>", $discount_text ); ?>
        </div>
		<?php if ( $coupon_type == 'Coupon' ) { ?>
            <div class="coupon-type1">
				<?php
					if ( !empty( $dt_coupon_type_name ) ) {
						echo $dt_coupon_type_name;
					} else {
						echo __( 'Coupon', 'upc-coupon' );
					}
				?>
            </div>
		<?php } elseif ( $coupon_type == 'Deal' ) { ?>
            <div class="deal-type1">
				<?php
					if ( !empty( $dt_deal_type_name ) ) {
						echo $dt_deal_type_name;
					} else {
						echo __( 'Deal', 'upc-coupon' );
					}
				?>
            </div>
		<?php } ?>
    </div>
    <div class="upc-coupon-content upc-col-7-8">
        <div class="upc-coupon-header">
            <div class="upc-col-1-4">
				<?php if ( $coupon_type == 'Coupon' )
					{
						/*
					if ( wcad_fs()->is_plan__premium_only( 'pro' ) or wcad_fs()->can_use_premium_code() ) {
						if ( $hide_coupon == 'Yes' ) {
							$template->get_template_part( 'hide-coupon__premium_only' );

						} else {  */?>
                        <!--    <div class="upc-coupon-code">
                                <a rel="nofollow" href="<?php echo $link; ?>"
                                   class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                                   target="_blank"
                                   title="<?php if ( ! empty( $coupon_hover_text ) ) {
									   echo $coupon_hover_text;
								   } else {
									   echo __( "Click To Copy Coupon", 'upc-coupon' );
								   } 
								   ?>"
                                   data-clipboard-text="<?php echo $coupon_code; ?>">
                                    <span class="upc_coupon_icon"></span> <?php echo $coupon_code; ?>
                                    <span id="coupon_code_<?php echo $coupon_id; ?>"
                                          style="display:none;"><?php echo $coupon_code; ?></span>
                                </a>
                            </div> -->
						<?php 
						// }	} else {  end if?>
                        <div class="upc-coupon-code">
						
						 <?php
					echo '<button class="btn btn-success get_code upc_copy_class" id="copy" merchant_id="'.$vendor_term_id.'" coupon_id="'.$coupon_id.'">GET CODE</button>';
					?>
						
						
						
                      <!--      <a rel="nofollow" href="<?php echo $link; ?>"
                               class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                               target="_blank"
                               title="<?php if ( ! empty( $coupon_hover_text ) ) {
								   echo $coupon_hover_text;
							   } else {
								   echo __( "Click To Copy Coupon", 'upc-coupon' );
							   } 
							   ?>"
                               data-clipboard-text="<?php echo $coupon_code; ?>">
                                <span class="upc_coupon_icon"></span> <?php echo $coupon_code; ?>
                                <span id="coupon_code_<?php echo $coupon_id; ?>"
                                      style="display:none;"><?php echo $coupon_code; ?></span>
                            </a>  -->
							
							
							
							
							
                        </div>

					<?php //} end else

				} elseif ( $coupon_type == 'Deal' ) { ?>
                    <div class="upc-coupon-code">
					
					  
					 <?php
					  echo '<button class="btn btn-success get_code upc_copy_class" id="copy" url="'.$link.'" merchant_id="'.$vendor_term_id.'" coupon_id="'.$coupon_id.'">'.$deal_text.'</button>'
					 ?>
					
					
                      <!--  <a class="<?php echo 'upc-btn-' . $coupon_id; ?> upc-btn masterTooltip upc-deal-button"
                           title="<?php if ( ! empty( $deal_hover_text ) ) {
							   echo $deal_hover_text;
						   } else {
							   echo __( "Click Here To Get This Deal", 'upc-coupon' );
						   } ?>" href="<?php echo $link; ?>" target="_blank">
                            <span class="wpcd_deal_icon"></span><?php echo $deal_text; ?>
                        </a>  -->
                    </div>

				<?php } ?>
            </div>
            <div class="upc-col-3-4">
				<?php
					if ( 'on' === $disable_coupon_title_link ) { ?>
						<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
							<?php echo $title; ?>
                		</<?php echo esc_html( $coupon_title_tag ); ?>>
			 		<?php } else { ?>
						<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
						<a href="<?php echo $link; ?>" target="_blank" rel="nofollow" class="get_code upc_copy_class" id="copy" url="<?php echo $link; ?>" merchant_id="<?php echo $vendor_term_id?>" coupon_id="<?php echo $coupon_id ?>"><?php echo $title; ?></a>
                		</<?php echo esc_html( $coupon_title_tag ); ?>>
					<?php } 
				?>
            </div>

        </div>
        <div class="upc-extra-content">
            <div class="upc-col-3-4">
                <div class="upc-coupon-description">
                    <span class="upc-full-description"><?php echo $description; ?></span>
                    <span class="upc-short-description"></span>
                    <a href="#" class="upc-more-description"><?php echo __( 'More', 'upc-coupon' ); ?></a>
                    <a href="#" class="upc-less-description"><?php echo __( 'Less', 'upc-coupon' ); ?></a>
                </div>
            </div>
            <div class="upc-col-1-4">
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
    <script type="text/javascript">
        var clip = new Clipboard('.<?php echo $button_class; ?>');
    </script>
    <div class="clearfix"></div>
    <?php
        if ( $coupon_share === 'on' ) {
	        $template->get_template_part('social-share');
        }
        $template->get_template_part('vote-system');
    ?>
</div>
