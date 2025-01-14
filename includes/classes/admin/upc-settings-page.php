<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class builds the settings page.
 *
 * @since 1.0
 */
class UPC_Settings_Page {

	/**
	 * Settings base to be added before field ids.
	 *
	 * @var string
	 * @since 1.0
	 */
	private $settings_base;

	/**
	 * Adding the settings, settings fields here.
	 *
	 * @var array
	 * @since 1.0
	 */
	private $settings;

	/**
	 * Constructor method.
	 *
	 * Adding necessary actions to add settings page,
	 * register settings, adding links to plugin list.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		$this->settings_base = 'upc_';

		/**
		 * Initializes the settings.
		 *
		 * @since 1.0
		 */
	//	add_action( 'admin_init', array( $this, 'init' ) );

		/**
		 * Registering the plugin settings.
		 *
		 * @since 1.0
		 */
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		/**
		 * Adding the settings page to the menu.
		 *
		 * @since 1.0
		 */
		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );

		/**
		 * Adding the links to plugins list page.
		 *
		 * @since 1.0
		 */
		add_filter( 'plugin_action_links', array( __CLASS__, 'add_settings_link' ), 10, 2 );


		/**
		 * Load stylesheets and scripts.
		 *
		 * @since 2.2.2
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'load_stylesheet_script' ) );
	}

	/**
	 * Add settings link to plugin list table.
	 *
	 * @param  array $links Existing links
	 *
	 * @return array        Modified links
	 * @since 1.0
	 */
	public static function add_settings_link( $links, $file ) {
		static $plugin;
		if ( ! $plugin ) {
			$plugin = 'ultra-coupons-cashbacks/ultra-promocode.php';
		}
		if ( $file == $plugin ) {
			$settings_link = '<a href="edit.php?post_type=upc_coupons&page=
upc_coupon_settings">' . __( 'Settings', 'upc-coupon' ) . '</a>';
			array_unshift( $links, $settings_link );
		}

		return $links;
	}

	/**
	 * Initialise settings by adding the fields.
	 *
	 * @return void
	 * @since 1.0
	 */
	public function init() {
		$this->settings = $this->settings_fields();
	}

	/**
	 * Build settings fields.
	 *
	 * @return array Fields to be displayed on settings page
	 * @since 1.0
	 */
	private function settings_fields() {

		/**
		 * Tabs setting.
		 *
		 * @since 2.2.2
		 */
		$settings['tabs'] = array(
			array(
				'id'          => 'general',
				'title'       => __( 'Coupon Settings', 'upc-coupon' ),
				'description' => __( 'These are some general coupon settings. You can use the default settings or set your own ones.', 'upc-coupon' )
			),
			array(
				'id'          => 'design',
				'title'       => __( 'Design Settings', 'upc-coupon' ),
				'description' => __( 'Design Settings for coupon templates and other elements.', 'upc-coupon' )
			),
			array(
				'id' => 'voting',
				'title' => __( 'Voting Settings', 'upc-coupon' ),
				'description' => __( 'Configure Voting Settings for Your Coupons.', 'upc-coupon' )
			),
			array(
				'id'          => 'settings-extra',
				'title'       => __( 'Extras', 'upc-coupon' ),
				'description' => __( 'These are some extra settings. You can use the default settings or set your own ones.', 'upc-coupon' )
			),
			array(
				'id'          => 'link',
				'title'       => __( 'Knowledge Base', 'upc-coupon' ),
				'description' => __( 'These are some general settings. You can use the default settings or set your own ones.', 'upc-coupon' ),
				'href'        => 'https://ultrapromocode.com/knowledgebase/'
			),
			array(
				'id'          => 'link',
				'title'       => __( 'Request a Feature', 'upc-coupon' ),
				'description' => __( 'Submit a feature request', 'upc-coupon' ),
				'href'        => 'https://ultrapromocode.com/submit-new-feature-request/'
			),
		);

		/**
		 *  Tabs content.
		 *
		 * @since 2.2.2
		 */
		//each array is a content to a tab
		$settings['tabs_content'] = array(
			array(
				array(
					'id'          => 'words-count',
					'label'       => __( 'Words Count to Add More/Less Link', 'upc-coupon' ),
					'description' => __( 'If coupon description is more than this count, More/Less link will be added. Default is 30 words.', 'upc-coupon' ),
					'type'        => 'number',
					'default'     => 30,
					'placeholder' => 30,
				),
				array(
					'id'          => 'coupon-hover-text',
					'label'       => __( 'Coupon Button Hover Text', 'upc-coupon' ),
					'description' => __( 'Text to show when user hovers on the coupon button. Default is Click To Copy Coupon' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => __( 'Click To Copy Coupon', 'upc-coupon' ),
				),
				array(
					'id'          => 'deal-hover-text',
					'label'       => __( 'Deal Button Hover Text', 'upc-coupon' ),
					'description' => __( 'Text to show when user hovers on the deal button. Default is Click Here To Get This Deal' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => __( 'Click Here To Get This Deal', 'upc-coupon' ),
				),
				array(
					'id'          => 'expire-text',
					'label'       => __( 'Expire Text', 'upc-coupon' ),
					'description' => __( 'Text to show before expire date. Default is \'Expires on:\' ', 'upc-coupon' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => __( 'Expires on:', 'upc-coupon' )
				),
				array(
					'id'          => 'expired-text',
					'label'       => __( 'Expired Text', 'upc-coupon' ),
					'description' => __( 'Text to show before expired date. Default is \'Expired on:\' ', 'upc-coupon' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => __( 'Expired on:', 'upc-coupon' )
				),
				array(
					'id'          => 'no-expiry-message',
					'label'       => __( 'No Expiration Text', 'upc-coupon' ),
					'description' => __( 'Text to show if coupon or deal never expires. Default is \'Doesn\'t expire\'.', 'upc-coupon' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => __( 'Doesn\'t Expire', 'upc-coupon' )
				),
				array(
					'id'          => 'expiry-date-format',
					'label'       => __( 'Expiration Date Format', 'upc-coupon' ),
					'description' => __( 'Choose the date format for expiration date.', 'upc-coupon' ),
					'type'        => 'select',
					'options'     => array(
						'dd-mm-yy' => 'dd-mm-yy',
						'mm/dd/yy' => 'mm/dd/yy',
						'yy/mm/dd' => 'yy/mm/dd'
					),
					'default'     => 'mm/dd/yy'
				),
				array(
					'id'          => 'hide-expired-coupon',
					'label'       => __( 'Hide expired Coupon', 'upc-coupon' ),
					'type'        => 'checkbox',
					'description' => __( 'Hide Coupon when it\'s expired. Default - Not to hide', 'upc-coupon' ),
					'default'     => ''
				),
				array(
					'id'          => 'coupon-title-tag',
					'label'       => __( 'Coupon Title Tag', 'upc-coupon' ),
					'description' => __( 'Choose the heading tag to be used for Coupon Title', 'upc-coupon' ),
					'type'        => 'select',
					'options'     => array(
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
					),
					'default'     => 'h1',
				),
				array(
					'id' => 'coupon-social-share',
					'label' => __( 'Social Share Buttons', 'upc-coupon' ),
					'description' => __( 'Enable Social Share buttons in Coupons', 'upc-coupon' ),
					'type' => 'checkbox',
					'default' => ''
				)
			),
			array(
				array(
					'id'          => 'coupon-type-bg-color',
					'label'       => __( 'Coupon Type Color', 'upc-coupon' ),
					'description' => __( 'Coupon Type Background Color in Default Template.', 'upc-coupon' ),
					'type'        => 'colorpicker',
					'default'     => '#56b151'
				),
				array(
					'id'          => 'dt-border-color',
					'label'       => __( 'Border Color', 'upc-coupon' ),
					'description' => __( 'Border Color in Default Template.', 'upc-coupon' ),
					'type'        => 'colorpicker',
					'default'     => '#000000'
				),
				array(
					'id' 		  => 'custom-css',
					'label'	      => __( 'Custom CSS', 'upc-coupon' ),
					'description' => __( 'Add any custom CSS you want here.', 'upc-coupon' ),
					'type'		  => 'textarea',
					'default' 	  => '',
					'placeholder' => ''
				)
			),
			array(
				array(
					'id' => 'coupon-vote-system',
					'label' => __( 'Vote Buttons', 'upc-coupon' ),
					'description' => __( 'Enable Voting buttons in Coupons', 'upc-coupon' ),
					'type' => 'checkbox',
					'default' => ''
				),
				array(
					'id' => 'coupon-vote-success',
					'label' => __( 'Voting Success Message', 'upc-coupon' ),
					'description' => __( 'Message to Show After User has Voted Successfully', 'upc-coupon' ),
					'type' => 'text',
					'default' => '',
					'placeholder' => __( 'You have voted successfully!', 'upc-coupon' )
				),
				array(
					'id' => 'coupon-vote-fail',
					'label' => __( 'Voting Failed Message', 'upc-coupon' ),
					'description' => __( 'Message to Show If Voting Fails', 'upc-coupon' ),
					'type' => 'text',
					'default' => '',
					'placeholder' => __( 'Voting Failed!', 'upc-coupon' )
				),
				array(
					'id' => 'coupon-vote-already',
					'label' => __( 'Already Voted Message', 'upc-coupon' ),
					'description' => __( 'Message to Show If User has Voted Already', 'upc-coupon' ),
					'type' => 'text',
					'default' => '',
					'placeholder' => __( 'You have voted already!', 'upc-coupon' )
				)
			),
			array(
				array(
					'id'          => 'disable-coupon-title-link',
					'label'       => __( 'Disable Link in Coupon Title', 'upc-coupon' ),
					'description' => __( 'Disable the coupon title link. By default it\'s linked to the link/affiliate link you put when you create a coupon.', 'upc-coupon' ),
					'type'        => 'checkbox',
					'default'     => '',
				),
				array(
					'id' 		  => 'dt-coupon-type-text',
					'label'       => __( 'Coupon Type Name', 'upc-coupon' ),
					'description' => __( 'Text to Show for Coupon Type Name in Default Template. Default is - Coupon.', 'upc-coupon' ),
					'type'		  => 'text',
					'default'	  => __( 'Coupon', 'upc-coupon' ),
					'placeholder' => __( 'Coupon', 'upc-coupon' )
				),
				array(
					'id' 		  => 'dt-deal-type-text',
					'label'       => __( 'Deal Type Name', 'upc-coupon' ),
					'description' => __( 'Text to Show for Deal Type Name in Default Template. Default is - Deal.', 'upc-coupon' ),
					'type'		  => 'text',
					'default'	  => __( 'Deal', 'upc-coupon' ),
					'placeholder' => __( 'Deal', 'upc-coupon' )
				)
			),

		);

		$settings = apply_filters( '

upc_coupon_settings_fields', $settings );

		return $settings;
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item() {

		global $settings_page;
		/**
		 * Adding the settings page under our main menu item.
		 *
		 * @since 1.0
		 */
		$settings_page = add_submenu_page(
			'edit.php?post_type=upc_coupons',
			__( 'Ultra Promocode Settings', 'upc-coupon' ),
			__( 'Settings', 'upc-coupon' ),
			'manage_options',
			'upc_coupon_settings',
			array( $this, 'settings_page' )
		);

	}

	/**
	 * Loads the stylesheets on the settings page.
	 *
	 * @param $hook
	 *
	 * @since 2.1.2
	 */
	public function load_stylesheet_script( $hook ) {

		global $settings_page;

		if ( $hook != $settings_page ) {
			return;
		} else {
			wp_enqueue_style( 'upc-admin-style', 
UPC_Plugin::instance()->plugin_assets . 'admin/css/admin.css', false );

			// color Picker
			wp_enqueue_style( 'upc-color-style', UPC_Plugin::instance()->plugin_assets . 'admin/css/colorpicker.css', false );
			wp_enqueue_script( 'upc-color-script', UPC_Plugin::instance()->plugin_assets . 'admin/js/colorpicker.js', array( 'jquery' ), 
UPC_Plugin::PLUGIN_VERSION, true );

		}

	}

	/**
	 * Register plugin settings.
	 *
	 * @return void
	 * @since 1.0
	 */
	public function register_settings() {

		/**
		 * Registering settings, adding section.
		 *
		 * @since 1.0
		 */
		if ( is_array( $this->settings ) ) {

			/**
			 * display tabs
			 * @since 2.2.2
			 */
			//to cover tabs with div
			global $last;
			$last = count( $this->settings['tabs'] );
			$i    = 0;
			// display tabs
			foreach ( $this->settings['tabs'] as $data ) {
				add_settings_section( $i, '', array( $this, 'settings_section' ), 'upc_settings' );
				$i ++;
			}

			/**
			 * display tabs content
			 * @since 2.2.2
			 */
			$i = 0;
			foreach ( $this->settings['tabs_content'] as $tab_content ) {

				foreach ( $tab_content as $field ) {
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}
					$option_name = $this->settings_base . $field['id'];
					register_setting( 'upc_settings', $option_name, $validation );
					add_settings_field( $field['id'], $field['label'], array(
						$this,
						'display_field'
					), 'upc_settings', $i, array( 'field' => $field ) );
				}
				$i ++;
			}
		}
	}

	/**
	 * Settings section description.
	 *
	 * @param $section
	 *
	 * @since 1.0
	 */
	public function settings_section( $section ) {
		global $last;
		$active = "";
		//before first tab
		if ( $section['id'] == 0 ) {
			$active = 'active';
			echo "<h2 class='nav-tab-wrapper'>";
		}

		//If it's not link
		if ( ! array_key_exists( 'href', $this->settings['tabs'][ $section['id'] ] ) ) {
			echo "<button type='button' class='nav-tab $active'>" . $this->settings['tabs'][ $section['id'] ]['title'] . "</button>";
		} else {
			echo "<a target='_blank' href='" . $this->settings['tabs'][ $section['id'] ]['href'] . "'  class='nav-tab'>" . $this->settings['tabs'][ $section['id'] ]['title'] . "</a>";
		}

		//after last tab
		if ( $section['id'] == $last - 1 ) {
			echo "</h2>";
		}
	}

	/**
	 * Generate HTML for displaying fields.
	 *
	 * @param  array $args Field data
	 *
	 * @return void
	 * @since 1.0
	 */
	public function display_field( $args ) {
		$field       = $args['field'];
		$output      = '';
		$option_name = $this->settings_base . $field['id'];
		$option      = get_option( $option_name );

		$data = '';
		if ( isset( $field['default'] ) ) {
			$data = $field['default'];
			if ( $option ) {
				$data = $option;
			}
		}

		switch ( $field['type'] ) {

			case 'text':
			case 'password':
			case 'number':
				$output .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/>' . "\n";
				break;

			case 'hidden':
				$output .= '<input class="color-picker" id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" value="' . $data . '"/>' . "\n";
				break;

			case 'colorpicker':
				$output .= '<div id="' . esc_attr( $field['id'] ) . '" class="upc_colorSelectors">
                    <div data-color="' . $data . '" style="background-color:' . $data . ';"></div>
                    <input id="upc_color" name="' . esc_attr( $option_name ) . '" type="hidden" value="' . $data . '"/>
                    </div>';
				break;

			case 'text_secret':
				$output .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value=""/>' . "\n";
				break;

			case 'textarea':
				$output .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="5" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>' . "\n";
				break;

			case 'checkbox':
				$checked = '';
				if ( $option && 'on' == $option ) {
					$checked = 'checked="checked"';
				}
				$output .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
				break;

			case 'checkbox_multi':
				foreach ( $field['options'] as $k => $v ) {
					$checked = false;
					if ( in_array( $k, $data ) ) {
						$checked = true;
					}
					$output .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
				break;

			case 'radio':
				foreach ( $field['options'] as $k => $v ) {
					$checked = false;
					if ( $k == $data ) {
						$checked = true;
					}
					$output .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
				break;

			case 'select':
				$output .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
				foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( $k == $data ) {
						$selected = true;
					}
					$output .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
				}
				$output .= '</select> ';
				break;

			case 'select_multi':
				$output .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
				foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( in_array( $k, $data ) ) {
						$selected = true;
					}
					$output .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '" />' . $v . '</label> ';
				}
				$output .= '</select> ';
				break;
		}

		switch ( $field['type'] ) {

			case 'checkbox_multi':
			case 'radio':
			case 'select_multi':
				$output .= '<br/><span class="description">' . $field['description'] . '</span>';
				break;

			default:
				$output .= '<label for="' . esc_attr( $field['id'] ) . '"><span class="description">' . $field['description'] . '</span></label>' . "\n";
				break;
		}

		echo $output;
	}

	/**
	 * Validate individual settings field.
	 *
	 * @param  string $data Inputted value
	 *
	 * @return string       Validated value
	 * @since 1.0
	 */
	public function validate_field( $data ) {
		if ( $data && strlen( $data ) > 0 && $data != '' ) {
			$data = urlencode( strtolower( str_replace( ' ', '-', $data ) ) );
		}

		return $data;
	}

	/**
	 * Load settings page content.
	 *
	 * @return void
	 * @since 1.0
	 */
	public function settings_page() {

		/**
		 * Building the page HTML.
		 *
		 * @since 1.0
		 */
		$output = '<div class="wrap" id="upc_coupon_settings">' . "\n";
		$output .= '<h3 class="setting-title">' . __( 'Ultra Promocode Settings', 'upc-coupon' ) . '</h3>' . "\n";
		$output .= '<h4>' . __( 'This is for only Pro Version', 'upc-coupon' ) . '</h4>' . "\n";
	/*	$output .= '<div class="upc_settings_section">';
		$output .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";
		// Get settings fields
		ob_start();
		settings_fields( 'upc_settings' );
		do_settings_sections( 'upc_settings' );
		$output .= ob_get_clean();
		$output .= '<p class="submit">' . "\n";
		$output .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings', 'upc-coupon' ) ) . '" />' . "\n";
		$output .= '</p>' . "\n";
		$output .= '</form>' . "\n";
		$output .= '</div>';
		$output .= '</div>' . "\n";

		ob_start();

		include UPC_Plugin::instance()->plugin_includes . 'functions/admin/upc-settings-page-extra.php';

		$output .= ob_get_clean();
*/
		echo $output;    
	}

}