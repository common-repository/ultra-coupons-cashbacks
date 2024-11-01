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
$coupon_code               = get_post_meta( $coupon_id,'coupon_details_coupon-code-text', true );
$deal_text                 = get_post_meta( $coupon_id,'coupon_details_deal-button-text', true );
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
$coupon_share              = get_option( 'upc_coupon-social-share' );
$show_expiration           = get_post_meta( $coupon_id, 'coupon_details_show-expiration', true );
$today                     = date( 'd-m-Y' );
$expire_date               = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
$hide_coupon               = get_post_meta( $coupon_id, 'coupon_details_hide-coupon', true );
$dt_coupon_type_name 	   = get_option( 'upc_dt-coupon-type-text' );
$dt_deal_type_name 	  	   = get_option( 'upc_dt-deal-type-text' );
$disable_coupon_title_link = get_option( 'upc_disable-coupon-title-link' );
$upc_text_to_show         = get_option( 'upc_text-to-show' );
$upc_custom_text          = get_option( 'upc_custom-text' );

if ( $upc_text_to_show == 'description' ) {
	$upc_custom_text = $description;
} else {
	if ( empty( $upc_custom_text ) ) {
		$upc_custom_text = __( "Click on 'Copy' to Copy the Coupon Code.", 'upc-coupon' );
	}
}

wp_enqueue_script( 'upc-clipboardjs' );
$template = new UPC_Template_Loader();


$vendor_list = get_terms('store');
$category_list=get_terms('categories');
//print_r($vendor_list);


 $uploads = wp_upload_dir();
 
 $dafault_coupon_img=$uploads['baseurl'].'/default.png';
	
	
	$term_list = wp_get_post_terms($post->ID, 'store', array("fields" => "all"));
	
//print_r($term_list);
	
//	echo "Term Id ".$term_list[0]->term_id;
	$t_id=$term_list[0]->term_id; 
	
   $vendor_name=ucfirst($term_list[0]->name);	
	$term_meta = get_option( "taxonomy_term_$t_id" );
		$your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
		
		$you_have_image=is_array($your_img_src); //check whether it has an image or not
		if(is_array($your_img_src))
			$logo=$your_img_src[0];
		else
			$logo=$dafault_coupon_img;
		
     $vendor_term_id=$t_id;
	 $bg_img=$iconurl = UPC_Plugin::instance()->plugin_assets . 'img/bg.jpg';
	 $permalink=get_permalink($coupon_id );
	
//echo "deal ciupon text ".$deal_text;




 
?>





<div id="pg-130-10" class="mypanel-grid-cell">
       <div id="panel-130-2-0-0" class="so-panel widget widget_media_image panel-first-child" data-index="2">
            <div class="panel-widget-style panel-widget-style-for-130-2-0-0">
             <img width="120" height="50" src="<?php echo $logo;?>" class="image wp-image-255  attachment-full size-full" alt="" style="max-width: 100%; height: auto;">
                    </div>
                    </div>
                    <div id="panel-130-2-0-1" class="so-panel widget widget_sow-editor panel-last-child" data-index="3">
                    <div class="so-widget-sow-editor so-widget-sow-editor-base">
  <div class="siteorigin-widget-tinymce textwidget">
	<h5 class="myproduct-title">
	<a href="<?php echo $permalink;?>"><?php echo $title; ?></a></h5>
<p><span style="color: green;"><?php echo $discount_text;   ?></span></p>
<p><span class="offer-info"><?php echo $coupon_type; ?></span></p>
</div>
</div>
</div>
</div>


<!-- my custom template  start-->



<!--

 
<div class="upc-coupon upc-coupon-default upc-coupon-id-<?php echo $coupon_id; ?>">
    <div class="upc-col-1-8">
        <div class="upc-coupon-discount-text">
			<?php echo str_replace( " ", "<br>", $discount_text ); ?>
        </div>
		<?php if ( $coupon_type == 'Coupon' ) { ?>
            <div class="coupon-type">
				<?php
					if ( !empty( $dt_coupon_type_name ) ) {
						echo $dt_coupon_type_name;
					} else {
						echo __( 'Coupon', 'upc-coupon' );
					}
				?>
            </div>
		<?php } elseif ( $coupon_type == 'Deal' ) { ?>
            <div class="deal-type">
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
				<?php if ( $coupon_type == 'Coupon' ) {
				 ?>
                        <div class="upc-coupon-code">
                            <a rel="nofollow" href="<?php echo $link; ?>"
                               class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                               target="_blank"
                               title="<?php if ( ! empty( $coupon_hover_text ) ) {
								   echo $coupon_hover_text;
							   } else {
								   echo __( "Click To Copy Coupon", 'upc-coupon' );
							   } ?>"
                               data-clipboard-text="<?php echo $coupon_code; ?>">
                                <span class="upc_coupon_icon"></span> <?php echo $coupon_code; ?>
                                <span id="coupon_code_<?php echo $coupon_id; ?>"
                                      style="display:none;"><?php echo $coupon_code; ?></span>
                            </a>
                        </div>  
						
						
						
						<?php

					

				} elseif ( $coupon_type == 'Deal' ) { ?>
                    <div class="upc-coupon-code">
                        <a class="<?php echo 'upc-btn-' . $coupon_id; ?> upc-btn masterTooltip upc-deal-button"
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
            <div class="upc-col-3-4">
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
-->

