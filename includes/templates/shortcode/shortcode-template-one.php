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


$coupon_tag=get_post_meta( $coupon_id,'coupon_details_coupon-tags', true );
$rating_value=get_post_meta( $coupon_id,'coupon_details_coupon-rating-value', true );
$saved_amount=get_post_meta( $coupon_id,'coupon_details_coupon-you-save', true );
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
     $vendor_term_id=$t_id;
	
//echo "deal ciupon text ".$deal_text;

 if($rating_value=='' ||$rating_value>5 ||$rating_value<0)
					 $rating_value=2;

				 if($saved_amount=='')
					 $saved_amount="500";
/* echo "verified ".$hide_coupon ."<br>";
echo "coupon tag ".$coupon_tag."<br>";
echo "Rating value ".$rating_value."<br>"; */
?>


<!-- my custom template  start-->

<div class="upc-coupon row upc-coupon-default upc-coupon-id-<?php echo $coupon_id; ?>">

    <div class="upc-col-1-8">
	   <div class="upc-coupon-discount-text">
			<?php echo str_replace( " ", "<br>", $discount_text ); ?>
        </div>
	 <!--   <div class="upc-coupon-vendor_logo">
         <img src="<?php echo (isset($you_have_image))?$your_img_src[0]:$dafault_coupon_img;?>"  width="50px" height="50px"/>
		 </div> -->
		 
		 <?php  ?>
            <div class="coupon-type">
				<?php
					/* if ( !empty( $dt_coupon_type_name ) ) {
						echo $dt_coupon_type_name;
					} 
					else 
					{
					} */
						?>
						<img src="<?php echo (isset($you_have_image))?$your_img_src[0]:$dafault_coupon_img;?>"  width="100px" height="50px"/>
		                <?php
					
				?>
            </div>
		<?php //elseif ( $coupon_type == 'Deal' ) { ?>
          
		<?php //}  end else if?>
		
		
		
		
		
    </div>
    <div class="upc-coupon-content upc-col-7-8">
        <div class="upc-coupon-header">
            <div class="upc-col-1-4">
			  <div class="coupon-code-upc coupon-detail upc-coupon-button-type upc-coupon-hidden" style="display: block;">
				<?php if ( $coupon_type == 'Coupon' )
					{
						
				 ?>
                     <div class="upc-coupon-code">
					<?php
					echo '<button class="btn btn-success get_code upc_copy_class" id="copy" merchant_id="'.$vendor_term_id.'" coupon_id="'.$coupon_id.'">GET CODE</button>';
					
					
					?>
                          <!--  <a rel="nofollow" href="<?php echo $link; ?>"
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
						
						
						
						<?php

					

				} elseif ( $coupon_type == 'Deal' ) { ?>
                    <div class="upc-coupon-code">
					
					
					 <?php
					  echo '<button class="btn btn-success get_code upc_copy_class" id="copy" url="'.$link.'" merchant_id="'.$vendor_term_id.'" coupon_id="'.$coupon_id.'">GET DEAL</button>';
					  
					  
					  
					  
					 ?>
                    <!--    <a class="<?php echo 'upc-btn-' . $coupon_id; ?> upc-btn masterTooltip upc-deal-button"
                           title="<?php if ( ! empty( $deal_hover_text ) ) {
							   echo $deal_hover_text;
						   } else {
							   echo __( "Click Here To Get This Deal", 'upc-coupon' );
						   } ?>" href="<?php echo $link; ?>" target="_blank">
                            <span class="upc_deal_icon"></span><?php echo $deal_text; ?>
                        </a>  -->
                    </div>

				<?php } ?>
				</div>
            </div>
            <div class="upc-col-3-4">
				<?php
					if ( 'on' === $disable_coupon_title_link ) { ?>
						<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
							<?php echo $title; ?>
                		</<?php echo esc_html($coupon_title_tag ); ?>>
			 		<?php } else { ?>
						<<?php echo esc_html( $coupon_title_tag ); ?> class="upc-coupon-title">
							<a href="<?php echo $link; ?>" target="_blank" rel="nofollow" class="get_code upc_copy_class" id="copy" url="<?php echo $link; ?>" merchant_id="<?php echo $vendor_term_id?>" coupon_id="<?php echo $coupon_id ?>"><?php echo $title; ?></a>
                		</<?php echo esc_html($coupon_title_tag ); ?>>
					<?php } 
				?>
            </div>

        </div>
        <div class="upc-extra-content">
            <div class="upc-col-3-4">
                <div class="upc-coupon-description">
                  <!--  <span class="upc-full-description"><?php echo $description; ?></span>
                    <span class="upc-short-description"></span>
                    <a href="#" class="upc-more-description"><?php echo __( 'More', 'upc-coupon' ); ?></a>
                    <a href="#" class="upc-less-description"><?php echo __( 'Less', 'upc-coupon' ); ?></a> -->
					<span class="tag_class">
					 <label class="tag">Tags : </label>
					 <label class="tag_list"> <?php echo $coupon_tag; ?></label>
					 </span> </br>
					<span class="you_save">
					 <label class="you_save_tag">You Save : </label>
					 <label class="you_save_value"> &#8377;  <?php echo $saved_amount; ?></label>
					 <?php
					 if($hide_coupon="Yes")
					{
						?>
						 <i class="fa fa-check-circle" style="font-size:15px;color:#4CAF50; padding-left:5px;"></i> <label class="verfied">verified</label>  
						<?php
					}
					?>
					 </span>
					
					
					
					
                </div>
				<button class="descriptioncontent" data-id="<?php echo $coupon_id;?>">Show Description</button>
				
				
				
				
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

				} 
				elseif ( $coupon_type == 'Deal' )
				{
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
				
				
				
				
					
				<?php
				
				 
				    echo '<div class="upc-coupon-expired">
					<input type="hidden" id="rating_value" value="'.$rating_value.'"/>
					<b>Ratings: <span id=stars>';
					
					
					 $rating = round($rating_value * 2) / 2;
  

  // Append all the filled whole stars
  for ($i = $rating; $i >= 1; $i--)
    echo '<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // If there is a half a star, append it
  if ($i == .5) echo '<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // Fill the empty stars
  for ($i = (5 - $rating); $i >= 1; $i--)
    echo '<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';
				
					
					
					 echo '</span></b>
					</div>';
					
					
					?>
					
					 
				
				
				
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
	
	
	
	<div class="content_<?php echo $coupon_id;?>  hide   coupon_content">
	<p><?php echo $description; ?></p>
										</div>
		
	
	
</div>

<!-- my custom temp,late end-->





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
