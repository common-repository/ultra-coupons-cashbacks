<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class 


UPC_Toolbar_Links
 *
 * Adds links to admin toolbar
 *
 * @since 1.0
 */
class UPC_Toolbar_Links {

	/**
	 * 


UPC_Toolbar_Links constructor.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		add_action( 'admin_bar_menu', array( $this, 'upc_toolbar_quick_menu' ), 333 );

	}

	/**
	 * Toolbar quick menu.
	 *
	 * @param $wp_admin_bar
	 *
	 * @since 1.0
	 */
	public function upc_toolbar_quick_menu( $wp_admin_bar ) {

		$iconurl = UPC_Plugin::instance()->plugin_assets . 'img/coupon24.png';

		$iconspan = '<span class="custom-icon" style="
                    float:left; width:24px !important; height:24px !important;
                     margin-left: 5px !important; margin-top: 5px !important; margin-right: 5px !important;
                     background-image:url(' . $iconurl . ');"></span>';

		//$title = __( 'Coupons', 'upc-coupon' );
		$title = __( 'Ultra Promocode', 'upc-coupon' );

		$args = array(
			'id'    => 'upc_toolbar',
			'title' => $iconspan . $title,
			'href'  => admin_url() . 'edit.php?post_type=upc_coupons',
		);
		$wp_admin_bar->add_node( $args );

		$args = array(
			'id'     => 'upc_toolbar_coupons',
			'title'  => __( 'All Coupons', 'upc-coupon' ),
			'href'   => admin_url() . 'edit.php?post_type=upc_coupons',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );

		$args = array(
			'id'     => 'upc_toolbar_new',
			'title'  => __( 'Add New Coupon', 'upc-coupon' ),
			'href'   => admin_url() . 'post-new.php?post_type=upc_coupons',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );

		$args = array(
			'id'     => 'upc_toolbar_categories',
			'title'  => __( 'Coupon Categories', 'upc-coupon' ),
			'href'   => admin_url() . 'edit-tags.php?taxonomy=categories&post_type=upc_coupons',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );
                
        $args = array(
			'id'     => 'upc_toolbar_vendors',
			'title'  => __( 'Coupon Vendors', 'upc-coupon' ),
			'href'   => admin_url() . 'edit-tags.php?taxonomy=store&post_type=upc_coupons',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );
                
		$args = array(
			'id'     => 'upc_toolbar_settings',
			'title'  => __( 'Settings', 'upc-coupon' ),
			'href'   => admin_url() . 'edit.php?post_type=upc_coupons&page=upc_coupon_settings',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );
		$args = array(
			'id'     => 'upc_my_testing',
			'title'  => __( 'Testing', 'upc-coupon' ),
			'href'   => admin_url() . 'edit.php?post_type=upc_coupons&page=upc_my_testing',
			'parent' => 'upc_toolbar'
		);
		$wp_admin_bar->add_node( $args );


	}

}