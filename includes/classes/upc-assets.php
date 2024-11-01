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
 * Assets class.
 * This loads the necessary styles and scripts.
 *
 * @since 1.0
 */
class UPC_Assets {

	/**
	 * Adding the assets with WordPress
	 *
	 * @since 1.0
	 */
	public static function UPC_Assets_init() {

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'upc_stylesheets' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'upc_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'upc_admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'upc_admin_stylesheets' ) );

	}

	/**
	 * Stylesheets for the coupon shortcode ,widgets and custom css.
	 *
	 * @since 2.2.2
	 */
	public static function upc_stylesheets() {

		wp_enqueue_style( 'upc-style', UPC_Plugin::instance()->plugin_assets . 'css/style.css', false, UPC_Plugin::PLUGIN_VERSION );

		
		
		
		$custom_css = get_option( 'upc_custom-css' ); 

		$coupon_type_color = get_option( 'upc_coupon-type-bg-color' );
		$coupon_border_color = get_option( 'upc_dt-border-color' );

		$hide_featured_image = get_option( 'upc_hide-archive-thumbnail' );

		if ( $hide_featured_image === 'on' ) {
			
			$custom_style = "

				#upc_coupon_ul li.upc_coupon_li {
					min-height: initial;
				}
				
				.upc_coupon_li_inner {
					height: auto;
				}

				.upc_coupon_li_content {
					height: auto;
					padding: 10px;
				}

			";

			$custom_style = preg_replace( '/\s+/', ' ', $custom_style );

			wp_add_inline_style( 'upc-style', $custom_style  );

		}

		$inline_style = "
                    
			.coupon-type {
				background-color: {$coupon_type_color};
			}

			.deal-type {
				background-color: {$coupon_type_color};
			}

			.upc-coupon {
				border-color: {$coupon_border_color};
			}

		";

		$inline_style = preg_replace( '/\s+/', ' ', $inline_style );

		wp_add_inline_style( 'upc-style', $inline_style  );

		$custom_css = preg_replace( '/\s+/', ' ', $custom_css );

		wp_add_inline_style( 'upc-style', $custom_css  );

	

	}

	/**
	 * Scripts for the coupon shortcode.
	 *
	 * @since 1.0
	 */
	public static function upc_scripts() {

		wp_register_script( 'upc-main-js', UPC_Plugin::instance()->plugin_assets . 'js/main.js', array( 'jquery' ), UPC_Plugin::PLUGIN_VERSION, true );
			
		wp_register_script( 'upc-clipboardjs', UPC_Plugin::instance()->plugin_assets . 'js/clipboard.min.js', null, 
   UPC_Plugin::PLUGIN_VERSION, false );

		wp_enqueue_script( 'upc-main-js' );
		wp_enqueue_script( 'upc-clipboardjs' );
		
		

		
		
                
        //To make sure that "ajax_url" is defined in main.js
        wp_localize_script( 'upc-main-js', 'upc_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		
        $word_count = get_option( 'upc_words-count' );
		if ( empty( $word_count ) ) {
			$word_count = 30;
		}

		$copy_button_text = get_option( 'upc_copy-button-text' );
		$after_copy_text  = get_option( 'upc_after-copy-text' );
		$vote_success = get_option( 'upc_coupon-vote-success' );
		$vote_failed = get_option( 'upc_coupon-vote-fail' );
		$vote_already = get_option( 'upc_coupon-vote-already' );

		if ( ! empty( $vote_success ) ) {
			$vote_success_message = $vote_success;
		} else {
			$vote_success_message = __( 'You have voted successfully!', 'upc-coupon' );
		}

		if ( ! empty( $vote_failed ) ) {
			$vote_failed_message = $vote_failed;
		} else {
			$vote_failed_message = __( 'Voting failed!', 'upc-coupon' );
		}

		if ( ! empty( $vote_already ) ) {
			$vote_already_message = $vote_already;
		} else {
			$vote_already_message = __( 'You have voted already!', 'upc-coupon' );
		}

		if ( ! empty( $copy_button_text ) ) {
			$button_text = $copy_button_text;
		} else {
			$button_text = __( 'Copy', 'upc-coupon' );
		}

		if ( ! empty( $after_copy_text ) ) {
			$after_copy = $after_copy_text;
		} else {
			$after_copy = __( 'Copied', 'upc-coupon' );
		}

		wp_localize_script( 'upc-main-js', 'upc_main_js', array(
			'minutes'      => __( 'minutes', 'upc-coupon' ),
			'seconds'      => __( 'seconds', 'upc-coupon' ),
			'hours'        => __( 'hours', 'upc-coupon' ),
			'day'          => __( 'day', 'upc-coupon' ),
			'week'         => __( 'week', 'upc-coupon' ),
			'expired_text' => __( 'This offer has expired!', 'upc-coupon' ),
			'word_count'   => $word_count,
			'button_text'  => $button_text,
			'after_copy'   => $after_copy,
			'vote_success' => $vote_success_message,
			'vote_fail' => $vote_failed_message,
			'vote_already' => $vote_already_message
		) );

		 wp_enqueue_script( 'upc-countdown-js',UPC_Plugin::instance()->plugin_assets . 'js/jquery.countdown.min.js', false,UPC_Plugin::PLUGIN_VERSION, false );
		 
		 
		 
		 
		


		 
		/*if ( wcad_fs()->is_plan__premium_only( 'pro' ) or wcad_fs()->can_use_premium_code() ) {
			wp_enqueue_script( 'upc-countdown-js', 



UPC_Plugin::instance()->plugin_assets . 'js/jquery.countdown.min.js', false,

UPC_Plugin::PLUGIN_VERSION, false );
		} */

	}

	/**
	 * Stylesheets for admin area.
	 *
	 * @since 1.0
	 */
	public static function upc_admin_stylesheets( $hook_suffix ) {

		/**
		 * Loading script only where necessary.
		 *
		 * @since 1.2
		 */
		$custom_post_type = 'upc_coupons';

		if ( in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) {

			$screen = get_current_screen();

			if ( is_object( $screen ) && $custom_post_type == $screen->post_type ) {

				wp_enqueue_style( 'upc-jquery-ui-style', 



UPC_Plugin::instance()->plugin_assets . 'admin/css/jquery-ui.css', false, 



UPC_Plugin::PLUGIN_VERSION );

			}
		}

		if ( in_array( $hook_suffix, array( 'edit.php', 'post.php', 'post-new.php' ) ) ) {

			$screen = get_current_screen();

			if ( is_object( $screen ) && $custom_post_type == $screen->post_type ) {

				wp_enqueue_style( 'upc-admin-style', 



UPC_Plugin::instance()->plugin_assets . 'admin/css/admin.css', false, 



UPC_Plugin::PLUGIN_VERSION );
				wp_enqueue_style( 'upc-admin-style', 



UPC_Plugin::instance()->plugin_assets . 'admin/css/select2.min.css', false, 



UPC_Plugin::PLUGIN_VERSION );

			}
		}

		if ( in_array( $hook_suffix, array( 'edit.php', 'post.php', 'post-new.php' ) ) ) {

			wp_enqueue_style( 'upc-admin-style', 



UPC_Plugin::instance()->plugin_assets . 'admin/css/admin.css', false, 



UPC_Plugin::PLUGIN_VERSION );

		}

		$coupon_type_color = get_option( '

upc_coupon-type-bg-color' );
		$coupon_border_color = get_option( '

upc_dt-border-color' );

		$inline_style = "
                    
			.coupon-type {
				background-color: {$coupon_type_color};
			}

			.deal-type {
				background-color: {$coupon_type_color};
			}

			.upc-coupon {
				border-color: {$coupon_border_color};
			}

		";

		$inline_style = preg_replace( '/\s+/', '', $inline_style );

		wp_add_inline_style( '

upc-admin-style', $inline_style  );

	}

	/**
	 * Scripts for admin area.
	 *
	 * @since 1.0
	 */
	public static function upc_admin_scripts( $hook_suffix ) {

		/**
		 * Loading script only where necessary.
		 *
		 * @since 1.2
		 */
		$custom_post_type ='upc_coupons';

		if ( in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) {

			$screen = get_current_screen();

			if ( is_object( $screen ) && $custom_post_type == $screen->post_type ) {

				wp_enqueue_script( 'jquery-ui-datepicker' );
				wp_enqueue_script( 'upc-jquery-ui-timepicker', 
       UPC_Plugin::instance()->plugin_assets . 'admin/js/jquery-ui-timepicker.js',array( 'jquery' ), 
	   UPC_Plugin::PLUGIN_VERSION, false );
				wp_enqueue_script( 'upc-countdown-js', 
     UPC_Plugin::instance()->plugin_assets . 'js/jquery.countdown.min.js', false, 
     UPC_Plugin::PLUGIN_VERSION, false );
				//To add custom javascript code to tinymce editor at initiation 
				add_filter( 'tiny_mce_before_init', array( __CLASS__, 'upc_tiny_mce' ) );
				// color Picker
				wp_enqueue_style('upc-color-style', UPC_Plugin::instance()->plugin_assets . 'admin/css/colorpicker.css', false);
				wp_enqueue_script('upc-color-script', UPC_Plugin::instance()->plugin_assets . 'admin/js/colorpicker.js', array('jquery'), UPC_Plugin::PLUGIN_VERSION, true);

			}

		}

		wp_enqueue_script( 'upc-admin-js', 
UPC_Plugin::instance()->plugin_assets . 'admin/js/admin.js', array(
			'jquery',
			'jquery-ui-datepicker',
			'wp-color-picker'
		), 



UPC_Plugin::PLUGIN_VERSION, false );


	}
        
    /**
     * to add custom javascript code tinymce Editor at initiation
     *
     * @since 2.6.2
     * @param array $initArray
     * @return array
     */
    public static function upc_tiny_mce( $initArray ) {
            
        /*
         * change description dynamically in live preview
         * 
         * VERY IMPORTANT: don't change the spaces in this code !!!!
         * @since 2.6.2
         */
        $initArray['toolbar1'] = "bold,italic,underline,bullist,numlist,alignleft,aligncenter,alignright,link,unlink";
        $initArray['toolbar2'] = '';
        $initArray['setup'] = <<<JS
[function(ed) {
        ed.on('KeyUp', function (e) {
            var description = tinyMCE.activeEditor.getContent();
            $('.upc-coupon-description').html(description);
        });
        ed.on('Change', function (e) {
            var description = tinyMCE.activeEditor.getContent();
            $('.upc-coupon-description').html(description);
        });            
    
}][0]
JS;
        return $initArray;
    }
}
