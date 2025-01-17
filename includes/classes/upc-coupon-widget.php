<?php
// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ultra Promocode Widget Class
 *
 * @since 1.2
 */
class UPC_Coupon_Widget extends WP_Widget {

	/**
	 *  This function sets up the widgets.
	 *
	 * @since 1.2
	 */
	public function __construct() {
		// Setting the widget details.
		$widget_details = array(
			'classname'   => 'upc-coupon-widget',
			'description' => __( 'Add Coupons and Deals to your widget areas.', 'upc-coupon' )
		);

		// Creating the widget.
		parent::__construct( 'ultra-promocode-widget', 'Ultra Promocode Widget', $widget_details );
	}

	/**
	 * This function displays the widget controls in Widget Admin Screen.
	 *
	 * @since 1.2
	 */
	public function form( $instance ) {

		$coupon_name   = ( isset( $instance['coupon_name'] ) ? $instance['coupon_name'] : '' );
		$category_name = ( isset( $instance['category_name'] ) ? $instance['category_name'] : '' );
		do_action( 'upc_widget_help_info_display' );
		?>
        <div class="coupon_select_list">
            <p>
                <label for="coupon_category_filter_select_widget">
					<?php echo __( 'Select the category', 'upc-coupon' ); ?>
                </label>
                <input autocomplete="off" placeholder="<?php echo __( 'Search the Category', 'upc-coupon' ); ?>"
                       value="<?php echo $category_name; ?>" id="coupon_category_filter_select_widget"
                       list="<?php echo $this->get_field_id( 'category_id' ); ?>"
                       name="<?php echo $this->get_field_name( 'category_name' ); ?>"
                       class="widefat coupon_category_filter_select_widget">
                <datalist id="<?php echo $this->get_field_id( 'category_id' ); ?>">
					<?php
					$terms = get_terms( 'categories' );

					foreach ( $terms as $term ) {
						$term = (array) $term;
						?>
                        <option value="<?php echo $term['name']; ?>"><?php echo $term['name']; ?></option>
					<?php } ?>
                    <option value="all-categories" <?php selected( 'all-categories', $category_name ); ?> ><?php echo __( 'All Categories', 'upc-coupon' ); ?></option>
                </datalist>
            </p>
            <p>
                <label for="coupon_select_widget">
					<?php echo __( 'Select the Coupon you want to insert', 'upc-coupon' ); ?>
                </label>
                <input autocomplete="off" class="widefat" name="<?php echo $this->get_field_name( 'coupon_name' ); ?>"
                       id="coupon_select_widget" list="<?php echo $this->get_field_id( 'coupon_name' ); ?>"
                       value="<?php echo $coupon_name; ?>"
                       placeholder="<?php echo __( 'Select the Coupon', 'upc-coupon' ); ?>">
                <datalist id="<?php echo $this->get_field_id( 'coupon_name' ); ?>">
					<?php

					$terms_name = array();
					foreach ( $terms as $term ) {
						array_push( $terms_name, $term->name );

						$args = array(
							'post_type' => 'upc_coupons',
							'tax_query' => array(
								array(
									'taxonomy' => 'categories',
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
							),
						);

						$coupons = new WP_Query( $args );
						if ( $coupons->have_posts() ) {
							while ( $coupons->have_posts() ) : $coupons->the_post();
								?>
                                <option category-title="<?php echo $term->name; ?>"
                                        coupon-id="<?php the_ID(); ?>"
                                        value="<?php the_title(); ?>"></option>
								<?php
							endwhile;
							wp_reset_postdata();
						}
					}
					//the coupons with no category
					$args = array(
						'post_type'   => 'upc_coupons',
						'post_status' => 'publish'
					);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
							?>
                            <option category-title="all-categories"
                                    coupon-id="<?php the_ID(); ?>"
                                    value="<?php the_title(); ?>"></option>
							<?php
						endwhile;
						wp_reset_postdata();
					}
					?>
                </datalist>
            </p>
        </div>
        <script>
            (function ($) {
                $('body').trigger('upc_add_widget');
            })(jQuery);
        </script>
		<?php
	}

	/**
	 * This function updates the widget control options.
	 *
	 * @since 1.2
	 */
	public function update( $new_instance, $old_instance ) {

		$instance                  = array();
		$instance['coupon_name']   = $new_instance['coupon_name'];
		$instance['category_name'] = $new_instance['category_name'];

		return $instance;
	}

	/**
	 * This function outputs the widget according to user settings.
	 *
	 * @since 1.2
	 */
	public function widget( $args, $instance ) {

		wp_enqueue_script( 'upc-main-js' );

		global $upc_coupon;
		$widget_coupon_name = $instance['coupon_name'];

		if( empty( $widget_coupon_name ) ) {
			return;
		}
		
		/**
		 * New custom query to get post and post data by its title
		 *
		 * @since 2.3.1
		 */
		$upc_coupon = get_page_by_title( $widget_coupon_name, OBJECT, '

upc_coupons' );

		/**
		 * Arguments to be used for a custom Query.
		 *
		 * @since 1.2
		 */
		$upc_arg = array(
			'p'              => $upc_coupon->ID,
			'posts_per_page' => '1',
			'post_type'      => 'upc_coupons',
			'post_status'    => 'publish',
		);

		/**
		 * New custom query to get post and post data
		 * from the custom coupon post type.
		 *
		 * @since 1.2
		 */
		$upc_coupon = new WP_Query( $upc_arg );
		// Hide expired coupon feature.
		$today               = date( 'd-m-Y' );
		$hide_expired_coupon = get_option( '

upc_hide-expired-coupon' );

		while ( $upc_coupon->have_posts() ) {

			$upc_coupon->the_post();

			global $coupon_id;
			$template  = new UPC_Template_Loader();
			$coupon_id = get_the_ID();

			// Hide expired coupon feature (default is Not to hide).
			if ( ! empty( $hide_expired_coupon ) || $hide_expired_coupon == "on" ) {
				$expire_date = get_post_meta( $coupon_id, 'coupon_details_expire-date', true );
				if ( ! empty( $expire_date ) ) {
					if ( strtotime( $expire_date ) < strtotime( $today ) ) {
						continue;
					}
				}
			}
			$coupon_template = get_post_meta( $coupon_id, 'coupon_details_coupon-template', true );

			if ( wcad_fs()->is_plan__premium_only( 'pro' ) or wcad_fs()->can_use_premium_code() ) {

				if ( $coupon_template == 'Template One' ) {

					$template->get_template_part( 'widget-one__premium_only' );

				} elseif ( $coupon_template == 'Template Two' ) {

					$template->get_template_part( 'widget-two__premium_only' );

				} elseif ( $coupon_template == 'Template Three' ) {

					$template->get_template_part( 'widget-three__premium_only' );

				} elseif ( $coupon_template == 'Template Five' ) {

					$template->get_template_part( 'widget-five__premium_only' );

				} elseif ( $coupon_template == 'Template Six' ) {

					$template->get_template_part( 'widget-six__premium_only' );

				} else {

					$template->get_template_part( 'widget-default' );
				}

			} else {

				$template->get_template_part( 'widget-default' );
			}
		}

		wp_reset_postdata();
	}

}