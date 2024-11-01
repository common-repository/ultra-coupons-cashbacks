<?php

// If accessed directly, exit
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * This class builds the short code that
 * will be used to display coupon codes
 * on the front end.
 *
 * @since 1.0
 * @author Jayanthi
 */
class UPC_Short_Code
{
    /**
     * Class constructor.
     * Adds the function to register the shortcode with WordPress.
     *
     * @since 1.0
     */
    public static function init()
    {
        /**
         * Shortcode register function.
         *
         * @since 1.0
         */
        add_shortcode( 'upc_coupon', array( __CLASS__, 'upc_coupon' ) );
        add_shortcode( 'upc_code', array( __CLASS__, 'upc_coupon_code' ) );
        
      
       
		add_shortcode( 'upc_coupon_vertical', array( __CLASS__, 'upc_coupon_vertical' ) );
    
    }
    
    /**
     * Shortcode attributes and arguments to build the shortcode.
     *
     * @param $atts array shortcode attributes.
     *
     * @return string
     *
     * @since 1.0
     */
    public static function upc_coupon( $atts )
    {
        global  $upc_atts ;
        global  $upc_coupon ;
        /**
         * These are the shortcode attributes.
         *
         * @since 1.0
         */
        $upc_atts = shortcode_atts( array(
            'id'    => '',
            'total' => '-1',
        ), $atts, 'upc_coupon' );
        /**
         * Arguments to be used for a custom Query.
         *
         * @since 1.0
         */
        $upc_arg = array(
            'p'              => esc_attr( $upc_atts['id'] ),
            'posts_per_page' => esc_attr( $upc_atts['total'] ),
            'post_type'      => 'upc_coupons',
            'post_status'    => 'publish',
        );
        /**
         * New custom query to get post and post data
         * from the custom coupon post type.
         *
         * @since 1.0
         */
        $upc_coupon = new WP_Query( $upc_arg );
        $output = '';
        //Hide expired coupon feature
        $today = date( 'd-m-Y' );
        $hide_expired_coupon = get_option( 'upc_hide-expired-coupon' );
        while ( $upc_coupon->have_posts() ) {
            $upc_coupon->the_post();
            global  $coupon_id ;
            $template = new UPC_Template_Loader();
            $coupon_id = get_the_ID();
            $expire_date = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
            $coupon_template = get_post_meta( $coupon_id, 'coupon_details_coupon-template', true );
            $coupon_type = get_post_meta( $coupon_id, 'coupon_details_coupon-type', true );
            
            if ( $coupon_type === 'Image' ) {
                ob_start();
                $template->get_template_part( 'shortcode-image' );
                $output = ob_get_clean();
                wp_reset_postdata();
                return $output;
            }
            
            // Hide expired coupon feature (default is Not to hide).
            
            if ( !empty($hide_expired_coupon) || $hide_expired_coupon == "on" ) {
                $expire_date = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
                if ( !empty($expire_date) ) {
                    
                    if ( $coupon_template !== 'Template Four' ) {
                        if ( strtotime( $expire_date ) < strtotime( $today ) ) {
                            continue;
                        }
                    } else {
                        $second_expire_date = get_post_meta( $coupon_id, 'coupon_details_second-expire-date', true );
                        $third_expire_date = get_post_meta( $coupon_id, 'coupon_details_third-expire-date', true );
                        if ( strtotime( $expire_date ) < strtotime( $today ) && strtotime( $second_expire_date ) < strtotime( $today ) && strtotime( $third_expire_date ) < strtotime( $today ) ) {
                            continue;
                        }
                    }
                
                }
            }
            
            
          
                
                if ( $coupon_template == 'Template One' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-template-one' );
                    $output = ob_get_clean();
                } 
                else {
                ob_start();
                $template->get_template_part( 'shortcode-default' );
                $output = ob_get_clean();
              } 
                /*
                elseif ( $coupon_template == 'Template Two' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-two__premium_only' );
                    $output = ob_get_clean();
                } elseif ( $coupon_template == 'Template Three' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-three__premium_only' );
                    // Return Variables.
                    $output = ob_get_clean();
                } elseif ( $coupon_template == 'Template Four' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-four__premium_only' );
                    // Return Variables.
                    $output = ob_get_clean();
                } elseif ( $coupon_template == 'Template Five' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-five__premium_only' );
                    // Return Variables.
                    $output = ob_get_clean();
                } else {
                    
                    if ( $coupon_template == 'Template Six' ) {
                        ob_start();
                        $template->get_template_part( 'shortcode-six__premium_only' );
                        // Return Variables.
                        $output = ob_get_clean();
                    } else {
                        ob_start();
                        $template->get_template_part( 'shortcode-default' );
                        $output = ob_get_clean();
                    }
                
                }   */
            
            
			
	
        
        }
        wp_reset_postdata();
        return $output;
    }
    
    /**
     * Builds the only coupon code shortcode.
     *
     * @param $atts
     *
     * @return string
     *
     * @since 1.0
     */
    public static function upc_coupon_code( $atts )
    {
        global  $upc_code_atts ;
        global  $upc_coupon_code ;
        /**
         * These are the shortcode attributes.
         *
         * @since 1.4
         */
        $upc_code_atts = shortcode_atts( array(
            'id'    => '',
            'total' => '-1',
        ), $atts, 'upc_code' );
        /**
         * Arguments to be used for a custom Query.
         *
         * @since 1.4
         */
        $upc_code_arg = array(
            'p'              => esc_attr( $upc_code_atts['id'] ),
            'posts_per_page' => esc_attr( $upc_code_atts['total'] ),
            'post_type'      => 'upc_coupons',
            'post_status'    => 'publish',
        );
        /**
         * New custom query to get post and post data
         * from the custom coupon post type.
         *
         * @since 1.4
         */
        $upc_coupon_code = new WP_Query( $upc_code_arg );
        $template = new UPC_Template_Loader();
        ob_start();
        $template->get_template_part( 'shortcode-code' );
        // Return Variables
        return ob_get_clean();
    }
    public static function upc_coupon_vertical( $atts )
    {
        global  $upc_atts ;
        global  $upc_coupon ;
        /**
         * These are the shortcode attributes.
         *
         * @since 1.0
         */
        $upc_atts = shortcode_atts( array(
            'id'    => '',
            'total' => '-1',
        ), $atts, 'upc_coupon' );
        /**
         * Arguments to be used for a custom Query.
         *
         * @since 1.0
         */
        $upc_arg = array(
            'p'              => esc_attr( $upc_atts['id'] ),
            'posts_per_page' => esc_attr( $upc_atts['total'] ),
            'post_type'      => 'upc_coupons',
            'post_status'    => 'publish',
        );
        /**
         * New custom query to get post and post data
         * from the custom coupon post type.
         *
         * @since 1.0
         */
        $upc_coupon = new WP_Query( $upc_arg );
        $output = '';
        //Hide expired coupon feature
        $today = date( 'd-m-Y' );
        $hide_expired_coupon = get_option( 'upc_hide-expired-coupon' );
        while ( $upc_coupon->have_posts() ) {
            $upc_coupon->the_post();
            global  $coupon_id ;
            $template = new UPC_Template_Loader();
            $coupon_id = get_the_ID();
            $expire_date = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
            $coupon_template = get_post_meta( $coupon_id, 'coupon_details_coupon-template', true );
            $coupon_type = get_post_meta( $coupon_id, 'coupon_details_coupon-type', true );
            
            if ( $coupon_type === 'Image' ) {
                ob_start();
                $template->get_template_part( 'shortcode-image' );
                $output = ob_get_clean();
                wp_reset_postdata();
                return $output;
            }else
				ob_start();
                    $template->get_template_part( 'shortcode-coupon-vertical' );
                    $output = ob_get_clean();
					
					 
					  wp_reset_postdata();
        return $output;
			}
            
            // Hide expired coupon feature (default is Not to hide).
            
           
            
            
        // echo " *************************************  Coupon Template ".$coupon_template;
                
             
            
             
			
			
			/* if ( $coupon_template == 'Template One' ) {
                    ob_start();
                    $template->get_template_part( 'shortcode-template-one' );
                    $output = ob_get_clean();
                }
				else
				{
			 ob_start();
                $template->get_template_part( 'shortcode-default' );
                $output = ob_get_clean();
				} */
        
        
       
    }
    

}