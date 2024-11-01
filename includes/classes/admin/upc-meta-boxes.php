<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class constructs the meta box for coupon add page.
 *
 * @since 1.0
 */
class UPC_Meta_Boxes {

	/**
	 * Post types on which metabox will be added.
	 *
	 * @var array post types.
	 * @since 1.0
	 */
	private $post_types = array(
		'upc_coupons',
	);

	/**
	 * Setting up the fields for the metabox.
	 *
	 * @var array Fields.
	 * @since 1.0
	 */
	private $upc_fields = array();

	/**
	 * Class construct method.
	 * Adding actions to WordPress hooks.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );

		$this->upc_fields = array(
			array(
				'id'      => 'coupon-type',
				'label'   => __( 'Coupon Type', 'upc-coupon' ),
				'type'    => 'select',
				'help'    => __( 'Coupon Type. Coupon will display a coupon code which will be copied when user clicks on it. Deal will display a link to get the deal instead of coupon code.', 'upc-coupon' ),
				'options' => array(
					'Coupon',
					'Deal',
					'Image'
				),
			),
			array(
				'id'    => 'coupon-code-text',
				'label' => __( 'Coupon Code', 'upc-coupon' ),
				'type'  => 'buttontext',
				'help'  => __( 'Put your coupon code here. This will be copied when user clicks on it.', 'upc-coupon' )
			),
			array(
				'id'    => 'second-coupon-code-text',
				'label' => __( 'Second Coupon Code', 'upc-coupon' ),
				'type'  => 'temp4-buttontext',
				'help'  => __( 'Put your coupon code here. This will be copied when user clicks on it.', 'upc-coupon' )
			),
			array(
				'id'    => 'third-coupon-code-text',
				'label' => __( 'Third Coupon Code', 'upc-coupon' ),
				'type'  => 'temp4-buttontext',
				'help'  => __( 'Put your coupon code here. This will be copied when user clicks on it.', 'upc-coupon' )
			),
		/*	array(
				'id'    => 'deal-button-text',
				'label' => __( 'Deal Button Text', 'upc-coupon' ),
				'type'  => 'dealtext',
				'help'  => __( 'Deal button text. Put something like Get this Deal.', 'upc-coupon' )
			),   */
			array(
				'id'    => 'link',
				'label' => __( 'Link', 'upc-coupon' ),
				'type'  => 'text',
				'help'  => __( 'Link to be opened when clicked on coupon code. You can use your affiliate links.', 'upc-coupon' )
			),
			array(
				'id'    => 'second-link',
				'label' => __( 'Second Link', 'upc-coupon' ),
				'type'  => 'temp4-text',
				'help'  => __( 'Link to be opened when clicked on coupon code. You can use your affiliate links.', 'upc-coupon' )
			),
			array(
				'id'    => 'third-link',
				'label' => __( 'Third Link', 'upc-coupon' ),
				'type'  => 'temp4-text',
				'help'  => __( 'Link to be opened when clicked on coupon code. You can use your affiliate links.', 'upc-coupon' )
			),
			array(
				'id'    => 'discount-text',
				'label' => __( 'Discount Amount/Text', 'upc-coupon' ),
				'type'  => 'text',
				'help'  => __( 'Discount amount or text to be shown. Example: 60% Off.', 'upc-coupon' )
			),
			array(
				'id'    => 'second-discount-text',
				'label' => __( 'Discount Amount/Text (Second Code)', 'upc-coupon' ),
				'type'  => 'temp4-text',
				'help'  => __( 'Discount amount or text to be shown. Example: 60% Off.', 'upc-coupon' )
			),
			array(
				'id'    => 'third-discount-text',
				'label' => __( 'Discount Amount/Text (Third Code)', 'upc-coupon' ),
				'type'  => 'temp4-text',
				'help'  => __( 'Discount amount or text to be shown. Example: 60% Off.', 'upc-coupon' )
			),
			array(
				'id'    => 'description',
				'label' => __( 'Description', 'upc-coupon' ),
				'type'  => 'textarea',
				'help'  => __( 'A little description so users know what the coupon code or deal is about.', 'upc-coupon' )
			),
			array(
				'id'      => 'show-expiration',
				'label'   => __( 'Coupon/Deal Expiration', 'upc-coupon' ),
				'type'    => 'select',
				'help'    => __( 'Choose whether you want to show coupon/deal expiration.', 'upc-coupon' ),
				'options' => array(
					'Show',
					'Hide'
				)
			),
			array(
				'id'    => 'expire-date',
				'label' => __( 'Expiration Date', 'upc-coupon' ),
				'type'  => 'expiredate',
				'help'  => __( 'Choose a date this coupon will expire. If you leave this blank, shortcode will show the message Doesn\'t expire.', 'upc-coupon' )
			),
			array(
				'id'    => 'second-expire-date',
				'label' => __( 'Expiration Date (Second Coupon)', 'upc-coupon' ),
				'type'  => 'temp4-expiredate',
				'help'  => __( 'Choose a date this coupon will expire. If you leave this blank, shortcode will show the message Doesn\'t expire.', 'upc-coupon' )
			),
			array(
				'id'    => 'third-expire-date',
				'label' => __( 'Expiration Date (Third Coupon)', 'upc-coupon' ),
				'type'  => 'temp4-expiredate',
				'help'  => __( 'Choose a date this coupon will expire. If you leave this blank, shortcode will show the message Doesn\'t expire.', 'upc-coupon' )
			),
			array(
				'id'    => 'expire-time',
				'label' => __( 'Expiration Time', 'upc-coupon' ),
				'type'  => 'expiretime',
				'help'  => __( 'Choose expiration time of the coupon.', 'upc-coupon' )
			),
			array(
				'id'      => 'hide-coupon',
				'label'   => __( 'Hide Coupon ', 'upc-coupon' ),
				'type'    => 'select',
				'help'    => __( 'whether the coupon is verified?', 'upc-coupon' ),
				'options' => array(
					'No',
					'Yes'
				)
			),
			array(
				'id'       => 'template-five-theme',
				'label'    => __( 'Coupon Theme', 'upc-coupon' ),
				'type'     => 'colorpicker',
				'tr_class' => 'coupon-code-field coupon-deal-field template-five-theme-field',
				'help'     => '',
				'default'  => '#18e06e'
			),
			array(
				'id'       => 'template-six-theme',
				'label'    => __( 'Coupon Theme', 'upc-coupon' ),
				'type'     => 'colorpicker',
				'tr_class' => 'coupon-code-field coupon-deal-field template-six-theme-field',
				'help'     => '',
				'default'  => '#18e06e'
			),
			array(
				'id'      => 'coupon-template',
				'label'   => __( 'Template ', 'upc-coupon' ),
				'type'    => 'select',
				'help'    => __( 'Choose coupon shortcode template.', 'upc-coupon' ),
				'options' => array(
					'Default',
				     'Template One'
					// , 'Template Two',
					// 'Template Three',
					// 'Template Four',
					// 'Template Five',
					// 'Template Six'
				)
			),
			array(
				'id'       => 'coupon-image-input',
				'label'    => __( 'Coupon Image', 'upc-coupon-image' ),
				'type'     => 'coupon-image-row',
				'help'     => __( 'Choose your coupon image', 'upc-coupon' ),
				'tr_class' => 'coupon-image-field',
				'help'     => ''
			),
			array(
				'id'       => 'coupon-image-print',
				'label'    => __( 'Show Coupon Print link', 'upc-coupon' ),
				'type'     => 'select',
				'tr_class' => 'coupon-image-field',
				'options'  => array(
					'Yes',
					'No'
				),
				'help'     => ''
			),
			array(
				'id'          => 'coupon-image-width',
				'label'       => __( 'Coupon Image width', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-image-field',
				'placeholder' => 'e.g 60% or 200px',
				'help'        => ''
			),
			array(
				'id'          => 'coupon-image-height',
				'label'       => __( 'Coupon Image height', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-image-field',
				'placeholder' => 'e.g 60% or 200px',
				'help'        => ''
			),
			array(
				'id'          => 'coupon-rating-count',
				'label'       => __( 'Coupon Rating Count', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-rating-count',
				'placeholder' => 'e.g 400 or 540',
				'help'        => ''
			),
			array(
				'id'          => 'coupon-rating-value',
				'label'       => __( 'Coupon Rating Value', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-rating-value',
				'placeholder' => 'e.g  3.5 or 4',
				'help'        => ''
			),
			array(
				'id'          => 'coupon-tags',
				'label'       => __( 'Coupon Tags', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-tags',
				'placeholder' => 'e.g electronics, mobile',
				'help'        => ''
			),
			array(
				'id'          => 'you-save',
				'label'       => __( 'Amount Saved', 'upc-coupon' ),
				'type'        => 'text',
				'tr_class'    => 'coupon-tags',
				'placeholder' => 'e.g 200 , 300',
				'help'        => ''
			)
		);
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 *
	 * @since 1.0
	 */
	public function add_meta_boxes() {
		foreach ( $this->post_types as $post_type ) {
			add_meta_box(
				'coupon-details',
				__( 'Coupon Details', 'upc-coupon' ),
				array( $this, 'add_meta_box_callback' ),
				$post_type,
				'normal',
				'core'
			);
		}
	}

	/**
	 * Generating the HTML for the meta box.
	 *
	 * @param object $post WordPress post object.
	 *
	 * @since 1.0
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'coupon_details_data', 'coupon_details_nonce' );
		$this->generate_upc_fields( $post );
	}

	/**
	 * Generating the field's HTML for the meta box.
	 *
	 * @param array $post post data.
	 *
	 * @since 1.0
	 */
	public function generate_upc_fields( $post ) {
		$expire_date_format = get_option( 'upc_expiry-date-format' );
		if ( empty( $expire_date_format ) ) {
			$expire_date_format = 'dd-mm-yy';
		}
		$output           = '';
		$help             = '';

		foreach ( $this->upc_fields as $upc_field ) {
			$tr_class = '';
			if ( ! empty( $upc_field['tr_class'] ) ) {
				$tr_class = $upc_field['tr_class'];
			}
			$type     = $upc_field['type'];
			$label    = '<label for="' . $upc_field['id'] . '">' . $upc_field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'coupon_details_' . $upc_field['id'], true );
			switch ( $upc_field['type'] ) {

				case 'dealtext':
					$input = sprintf(
						'<input type="text" name="%s" id="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']

					);
					break;
				

				case 'buttontext':
					$input = sprintf(
						'<input type="text" name="%s" id="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']
					);
					break;
				case 'temp4-buttontext':
					$input = sprintf(
						'<input type="text" name="%s" id="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']
					);
					break;

				case 'temp4-text':
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s"><br><i style="font-size: 12px">%s</i>',
						$upc_field['type'] !== 'color' ? 'class="regular-text"' : '',
						$upc_field['id'],
						$upc_field['id'],
						'text',
						$db_value,
						$upc_field['help']
					);
					break;
				case 'date':
					$input = sprintf(
						'<input type="%s" name="%s" id="%s" value="%s" /><br><i style="font-size: 12px">%s</i>',
						$upc_field['type'],
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']
					);
					break;

				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s"><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$upc_field['help']
					);
					foreach ( $upc_field['options'] as $key => $value ) {
						$field_value = ! is_numeric( $key ) ? $key : $value;
						$input       .= sprintf(
							'<option %s value="%s">%s</option>',
							$db_value === $field_value ? 'selected' : '',
							$field_value,
							$value
						);
					}
					$input .= '</select>';
					break;

				case 'textarea':
					if ( $upc_field['id'] == 'description' ):
						ob_start();
						/**
						* Add Editor to description field
						* 
						* @since 2.5.0.2
						*/
						$settings = array(
					   		'wpautop' => false, 
					   		'media_buttons' => false,
							'tinymce' => true,
							'textarea_rows' => 5,
							'editor_height' => 150,
							'teeny' => false,
							'quicktags' => false,
							'textarea_name' => "description"
						);
						wp_editor( $db_value, 'description' ,$settings);
						echo '<br><i style="font-size: 12px">' . $upc_field["help"] . '</i>';
						$input = ob_get_clean();
					else:
						$input = sprintf(
							'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea><br><i style="font-size: 12px">%s</i>',
							$upc_field['id'],
							$upc_field['id'],
							$db_value,
							$upc_field['help']
						);
					endif;
					break;

				case 'expirationcheck':
					$input = sprintf(
						'<input type="checkbox" name="%s" id="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']
					);
					break;

				case 'expiredate':
					$input = sprintf(
						'<input type="text" data-expiredate-format="%s" name="%s" id="%s" placeholder="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$expire_date_format,
						$upc_field['id'],
						$upc_field['id'],
						$expire_date_format,
						$db_value,
						$upc_field['help']
					);
					break;

				case 'temp4-expiredate':
					$input = sprintf(
						'<input type="text" data-expiredate-format="%s" name="%s" id="%s" placeholder="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$expire_date_format,
						$upc_field['id'],
						$upc_field['id'],
						$expire_date_format,
						$db_value,
						$upc_field['help']
					);
					break;

				case 'expiretime':
					$input = sprintf(
						'<input type="text" name="%s" id="%s" value="%s"/><br><i style="font-size: 12px">%s</i>',
						$upc_field['id'],
						$upc_field['id'],
						$db_value,
						$upc_field['help']
					);
					break;

				case 'coupon-image-row' :
					$id    = $upc_field['id'];
					$input = '';
					//Get upload url
					$upload_link = esc_url( get_upload_iframe_src( 'image', $db_value ) );
					// Get the image src
					$img_src      = wp_get_attachment_image_src( $db_value, 'full' );
					$you_have_img = is_array( $img_src );
					//img container
					$input .= '<div class="coupon-img-container" style="width:70%;">';
					if ( $you_have_img ) {
						$input .= '<img src="' . $img_src[0] . '" alt="" style="max-width:100%;"/>';
					}
					$input .= '</div>';
					//add image or remove
					$input .= '<div class="hide-if-no-js">';
					$input .= '<a class="upload-coupon-img button media-button ' . ( $you_have_img ? 'hidden' : '' ) . '" >' . __( 'Upload Coupon Image', 'upc-coupon' ) . '</a>';
					$input .= '<a class="red-text delete-coupon-img button media-button ' . ( $you_have_img ? '' : 'hidden' ) . '">' . __( 'Remove Coupon Image', 'upc-coupon' ) . '</a>';
					$input .= '</div>';
					//hidden input
					$input .= '<input class="' . $id . '" id="' . $id . '" name="' . $id . '" type="hidden" value="' . $db_value . '"/>
					';
					break;
				case 'colorpicker':
					$value = empty( $db_value ) ? $upc_field['default'] : $db_value;
					$input = '<div id="' . esc_attr( $upc_field['id'] ) . '" class="upc_colorSelectors">
	                    <div data-color="' . $value . '" style="background-color:' . $value . ';"></div>
	                    <input id="' . $upc_field['id'] . '" name="' . $upc_field['id'] . '" type="hidden" value="' . $value . '"/>
	                    </div>';
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s" placeholder="%s"><br><i style="font-size: 12px">%s</i>',
						$upc_field['type'] !== 'color' ? 'class="regular-text"' : '',
						$upc_field['id'],
						$upc_field['id'],
						$upc_field['type'],
						$db_value,
						( empty( $upc_field['placeholder'] ) ? '' : $upc_field['placeholder'] ),
						( empty( $upc_field['help'] ) ? '' : $upc_field['help'] )
					);
			}
			$output .= $this->row_format( $type, $label, $input, $tr_class );
		}
		echo '<table class="form-table"><tbody>' . $output . $help . '</tbody></table>';
		echo "<script>
				jQuery('#expire-time').timepicker({
					controlType: 'select',
					oneLine: true,
					timeFormat: 'h:m tt',
					showButtonPanel: false
				});
			 </script>";

	

	}

	/**
	 * Generates the HTML for table rows.
	 *
	 * @since 1.0
	 */
	public function row_format( $type, $label, $input, $tr_class = '' ) {
		return sprintf(
			'<tr id="%s" class="%s"><th scope="row">%s</th><td>%s</td></tr>',
			$type,
			$tr_class,
			$label,
			$input
		);
	}

	/**
	 * Hooks into WordPress' save_post function.
	 *
	 * @since 1.0
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['coupon_details_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['coupon_details_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'coupon_details_data' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		foreach ( $this->upc_fields as $upc_field ) {
			if ( isset( $_POST[ $upc_field['id'] ] ) ) {
				switch ( $upc_field['type'] ) {
					case 'email':
						$_POST[ $upc_field['id'] ] = sanitize_email( $_POST[ $upc_field['id'] ] );
						break;
					case 'text':
						if($upc_field['id'] == 'link')
                                                    $_POST[ $upc_field['id'] ] = esc_url( $_POST[ $upc_field['id'] ] );
                                                else
                                                    $_POST[ $upc_field['id'] ] = sanitize_text_field( $_POST[ $upc_field['id'] ] );
                                                break;
				}

				$field_checker = 'coupon_details_' . $upc_field['id'];

				if ( $field_checker == 'coupon_details_hide-coupon' ) {
					update_post_meta( $post_id, 'coupon_details_' . $upc_field['id'], $_POST[$upc_field['id']] );
				} elseif ( $field_checker == 'coupon_details_coupon-template' ) {
					update_post_meta( $post_id, 'coupon_details_' . $upc_field['id'], $_POST[$upc_field['id']] );
				} else {
					update_post_meta( $post_id, 'coupon_details_' . $upc_field['id'], $_POST[ $upc_field['id'] ] );
				}

			} else if ( $upc_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'coupon_details_' . $upc_field['id'], '0' );
			}
		}
	}

}