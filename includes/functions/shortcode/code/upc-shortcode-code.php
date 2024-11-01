<?php
// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the Coupon Code.
 *
 * @since 1.4
 */
function upc_shortcode_code() {

	global $coupon_id;
	$coupon_id                = get_the_ID();
	$description              = get_post_meta( $coupon_id, 'coupon_details_description', true );
	$link                     = get_post_meta( $coupon_id, 'coupon_details_link', true );
	$coupon_code              = get_post_meta( $coupon_id, 'coupon_details_coupon-code-text', true );
	$deal_text                = get_post_meta( $coupon_id, 'coupon_details_deal-button-text', true );
	$coupon_type              = get_post_meta( $coupon_id, 'coupon_details_coupon-type', true );
	$coupon_hover_text        = get_option( 'upc_coupon-hover-text' );
	$deal_hover_text          = get_option( 'upc_deal-hover-text' );
	$button_class             = '.upc-code-btn-' . $coupon_id;
	$hide_coupon_text         = get_option( 'upc_hidden-coupon-text' );
	$hidden_coupon_hover_text = get_option( 'upc_hidden-coupon-hover-text' );
	$copy_button_text         = get_option( 'upc_copy-button-text' );
	$hide_coupon              = get_post_meta( $coupon_id, 'coupon_details_hide-coupon', true );
	$hide_coupon_button_color = get_option( 'upc_hidden-coupon-button-color' );

	$upc_text_to_show = get_option( 'upc_text-to-show' );
	$upc_custom_text  = get_option( 'upc_custom-text' );

	if ( $upc_text_to_show == 'description' ) {
		$upc_custom_text = $description;
	} else {
		if ( empty( $upc_custom_text ) ) {
			$upc_custom_text = __( "Click on 'Copy' to Copy the Coupon Code.", 'upc-coupon' );
		}
	}
	if ( $coupon_type == 'Coupon' ) {

		if ( wcad_fs()->is_plan__premium_only( 'pro' ) or wcad_fs()->can_use_premium_code() ) {

			if ( $hide_coupon == 'Yes' ) {

				$template = new UPC_Template_Loader();
				$template->get_template_part( 'hide-coupon__premium_only' );

			} else { ?>

                <div class="upc-coupon-code">
                    <a rel="nofollow"
                       class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                       title="<?php
					   if ( ! empty( $coupon_hover_text ) ) {
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
                </div>

			<?php } ?>
            <script type="text/javascript">
                var clip = new Clipboard('.upc-btn-<?php echo $coupon_id; ?>');
            </script>
		<?php } else {
			?>
            <div class="upc-coupon-code">
                <a rel="nofollow"
                   class="<?php echo 'upc-btn-' . $coupon_id; ?> masterTooltip upc-btn upc-coupon-button"
                   title="<?php
				   if ( ! empty( $coupon_hover_text ) ) {
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
            </div>
			<script type="text/javascript">
                var clip = new Clipboard('.upc-btn-<?php echo $coupon_id; ?>');
            </script>
		<?php }
	} elseif ( $coupon_type == 'Deal' ) {
		?>
        <div class="upc-coupon-code">
            <a rel="nofollow" class="<?php echo 'upc-btn-' . $coupon_id; ?> upc-btn masterTooltip upc-deal-button"
               title="<?php
			   if ( ! empty( $deal_hover_text ) ) {
				   echo $deal_hover_text;
			   } else {
				   echo __( "Click Here To Get This Deal", 'upc-coupon' );
			   }
			   ?>" href="<?php echo $link; ?>" target="_blank">
                <span class="upc_deal_icon"></span><?php echo $deal_text; ?>
            </a>
        </div>
	<?php } ?>


	<?php
}

//my function
//genearing popup for  confiming  vendor and coupon data
add_action('wp_ajax_upc_confirmation_form','upc_confirmation_form');
add_action('wp_ajax_nopriv_upc_confirmation_form','upc_confirmation_form');
function upc_confirmation_form()
{
	$coupon_id=$_POST['coupon_id'];
	$merchant_id=$_POST['merchant_id'];
	
	     $title                     = get_the_title($coupon_id);
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
	
	
	
	//getting vendor info
	$term_list = wp_get_post_terms($coupon_id, 'store', array("fields" => "all"));
	
//print_r($term_list);
	
//	echo "Term Id ".$term_list[0]->term_id;
	$t_id=$term_list[0]->term_id; 
	
	
	/*
	 $uploads = wp_upload_dir();
 
 $dafault_coupon_img=$uploads['baseurl'].'/default.png';
 */
 $dafault_coupon_img=$plugin_dir.'/'.PLUGIN_NAME.'/assets/img/default.png';
	
   $vendor_name=ucfirst($term_list[0]->name);	
	$term_meta = get_option( "taxonomy_term_$t_id" );
		$your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
		
		$you_have_image=is_array($your_img_src);
	
	
	       if($you_have_image)
		 $vendor_image=$your_img_src[0];
		 else
			 $vendor_image=$dafault_coupon_img;
	
	 $output=' <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content get_modal_content">
      <div class="modal-header">
         <div class="upc_modal_heading" >
		  <h4>'.$discount_text." ".$title.'</h4>
		   </div>
		  <button type="button" class="close" id="modal_close_btn" data-dismiss="modal">&times;</button>
      </div>
	  <div class="upc_imag_tag" align="center">
         <img src="'.$vendor_image.'" align="center" class="img-responsive"/>
		 </div>
      <div class="modal-body pop_up_content">';
	    
              $output .='<div class="input_box_class">';
				   
				   if ( ! empty( $expire_text ) ) {
										//echo $expire_text . ' ' . $expire_date;
										$output .='<label>Expires  </label>'.$expire_text . ' '.$expire_date.'</br>';
									} else 
									{
										
									//	$output .='<label>Expires   :</label>'.$expire_date;
									$output .='<p class="expired_date">Expires   '.$expire_date.'</p>';
										
									}
									
			/* 	$output .='<ul>';
						  if($description)
						 $output .='<li>'.$description.'</li>';
					     if($discount_text)
							  $output .='<li>'. $discount_text .'</li>';
						  $output .='</ul>'; */
						  
						/*
						  if($description)
						 $output .='<p class="popup_product_description">'.$description.'</p>';
					 
					     if($discount_text)
							  $output .='<p class="expired_date">'. $discount_text .'</p>';
						  */
						 
						  if($coupon_type == 'Coupon')
						  {
						  
                     if($hide_coupon='no')
					 {
						 $output .='<div class="upc_popup_btn_tag">
						 <p id="copied" style="display:none; color:orange;">Code Copied</p>
						   
						        <input type="text" value="'.$coupon_code.'" id="upc_myInput" readonly>
							
								</br></br>
                               <button onclick="upc_myFunction()" class="btn btn-primary">Copy Text</button>
							   <a href="'.$link.'" class="btn btn-primary" target="__blank">Go To'.$vendor_name.'</a>
							   </div>';
					 }
					 else
					 {
						  $output .='<div class="upc_popup_btn_tag">
						  <input type="hidden" value="'.$link.'"  id="hide_code" />
						 <button class="btn btn-primary" id="hide_code_click" onclick="upc_myhideFunction()" data-clipboard-text="'.$coupon_code.'" >Go To '.$vendor_name.'</button>
						 
						 </div>';
						
					 }
         
						  }else
						  {
							   $output .='<div class="upc_popup_btn_tag">
						      <a href="'.$link.'" class="btn btn-primary" target="__blank">Go To '.$vendor_name.'</a>
						 </div>';
						  }							  
	$output .='</div>
      </div>
      <div class="modal-footer popup_footer">
        <button type="button" class="btn btn-primary popup_footer_btn" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>';
    
	echo $output;  
	
	exit();
}

