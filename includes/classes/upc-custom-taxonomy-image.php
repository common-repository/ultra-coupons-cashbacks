<?php
// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPCD Custom Taxonomy
 * This class is used to register a new taxonomy.
 *
 * @since 1.0
 * @author Webnox
 */
class UPC_Custom_Taxonomy_Image {

	/**
	 * this function registers hooks for upload image field
	 *
	 * @since 2.3
	 */
	public static function register( $taxonomy ) {
		
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_wp_media_library' ) );
		
			
		
		//register field
		add_action( $taxonomy . '_add_form_fields', array( __CLASS__, 'show_addtag_field' ), 10, 2 );
	
	   add_action( 'created_' . $taxonomy, array( __CLASS__, 'save_image_field' ), 10, 2 );
		 
	
		add_action( $taxonomy . '_edit_form_fields', array( __CLASS__, 'show_image_field' ), 10, 2 );
		//save field
		 add_action( 'edited_' . $taxonomy, array( __CLASS__, 'save_image_field' ), 10, 2 );
		 
		
		 
		 
		 //start my testing
		
	add_filter("manage_edit-store_columns",array(__CLASS__, 'theme_columns'),10,2); 
     add_filter("manage_store_custom_column", array(__CLASS__,'manage_theme_columns'), 10, 3);
 
  //   add_filter( 'manage_edit-store_sortable_columns', array(__CLASS__,'my_vendor_sortable_columns' ));
	
	 add_action( 'pre_get_posts', array(__CLASS__,'store_custom_orderby' ),10,2);
	
	   
	
	
	
			// end my testing
		 
	}
	

	
	
	
	
	function theme_columns($theme_columns) {
  
  
  $columns = array(
		'cb' => '<input type="checkbox" />',
		'name' => __( 'Name' ),
		'header_icon' => __( 'Image' ),
		'slug' => __( 'slug' ),
		'description' => __('Description'),
		'posts' => __( 'Count' )
	);
	return $columns;
	
	
}
	
	function manage_theme_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'store');
	//echo "$ theme ";
	//print_r($theme);
	$term_meta=get_option("taxonomy_term_$theme->term_id");
           
		    $your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
			
	       $logo=$your_img_src[0];
		  // echo 'path '.$theme->term_id;
     switch ($column_name) {
        case 'header_icon': 
           	
            $out .= '<img src="'.$logo.'" width="70px" height="60px"/>'; 
		   //$out .='image vgh';
            break;
 
        default:
            break;
    } 
    return $out;    
}
	
	function my_vendor_sortable_columns($columns)
	{
		$columns['custom_taxonomy'] = 'store';
		$columns['posts'] = 'posts';

	  return $columns;
        
	}
	
	
	function store_custom_orderby( $query ) {
  if ( ! is_admin() )
    return;

  $orderby = $query->get( 'orderby');

  if ( 'posts' == $orderby ) {
    $query->set( 'meta_key', 'posts' );
    $query->set( 'orderby', 'meta_value_num' );
  }
  else  if ( 'name' == $orderby ) {
    $query->set( 'meta_key', 'name' );
    $query->set( 'orderby', 'meta_value_num' );
  }
 

}




	/**
	 * this function creates upload field for image
	 *
	 * @since 2.3
	 */
	public static function load_wp_media_library() {
		wp_enqueue_media();
	}

	
	//start my function

	
	//end my fucntion
	
	/**
	 * this function checks if jQuery exits to added it
	 *
	 * @since 2.3
	 */
	
	
	

public static function show_addtag_field($tag)
{
	  $t_id      = $tag->term_id; // Get the ID of the term you're editing  
		$term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
		
		
		
		
	
		$your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
		// For convenience, see if the array is valid
		
		$you_have_img = is_array( $your_img_src );
		//$you_have_img =  $your_img_src ;
		
		
		
		
	
			// end my testing
		
		?>

		
		     	<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="prologue_id"><?php _e('Vendor Prologue '); ?></label>  
    </th>  
    <td>  
	
	<!--
	<textarea name="term_meta[prologue_id]" id="term_meta[prologue_id]" rows="5" cols="40"><?php echo $term_meta['prologue_id'] ? $term_meta['prologue_id'] : ''; ?> 
	             </textarea>
	<p>The description is not prominent by default; however, some themes may show it.</p>  -->
	
	
	    <?php
		$name='term_meta[prologue_id]';
		$value=$term_meta['prologue_id'] ? $term_meta['prologue_id'] : '';
		wp_editor($value, 'prologue_description', array('textarea_name' => $name));
		?>
	</br>
	 <span class="description"><?php _e('This Field contains Description about Vendor '); ?></span>  

    </td>  
</tr>  
		
		
		
		
		     	<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="epilogue_id"><?php _e('Vendor Epilogue  '); ?></label>  
    </th>  
    <td>  
	
	
	 
	    <?php
		$name='term_meta[epilogue_id]';
		$value=$term_meta['epilogue_id'] ? $term_meta['epilogue_id'] : '';
		wp_editor($value, 'epilogue_description', array('textarea_name' => $name));
		?>
	
	 
	</br>
	 <span class="description"><?php _e('This Field contains  Vendor conclusion '); ?></span>  

    </td>  
</tr>  
		
		 		     	<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="use_ful_tips"><?php _e('Useful Tips  '); ?></label>  
    </th>  
    <td>  
	
	 <textarea class="use_ful_tips" name="term_meta[use_ful_tips]" id="term_meta[use_ful_tips]" style="width: 100%;
    height: 160px;"></textarea>
	 
	    
	
	 
	</br>
	 <span class="description"><?php _e('This Field contains  some useful and important information  about vendor '); ?></span>  

    </td>  
</tr>  
		
		
		
		
		     	 
		
		
		
		
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="image_id"><?php _e( 'Image', 'upc-coupon' ); ?></label>
            </th>
            <td>
                <input type="hidden" class="custom-img-id" name="term_meta[image_id]" id="term_meta[image_id]" size="25"
                       style="width:60%;"
                       value="<?php echo $term_meta['image_id'] ? $term_meta['image_id'] : ''; ?>"><br/>
                <!-- Your image container -->
                <div class="custom-img-container" style="width:250px;">
					<?php if ( $you_have_img ) : ?>
                        <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:100%;"/>
					<?php endif; ?>
                </div>
                <!-- Your add & remove image links -->
                <p class="hide-if-no-js">
                    <a class="upload-custom-img button <?php if ( $you_have_img ) {
						echo 'hidden';
					} ?>">
						<?php _e( 'Upload image' ) ?>
                    </a>
                    <a style="color:red" class="delete-custom-img button <?php if ( ! $you_have_img ) {
						echo 'hidden';
					} 
					?>" href="#">
						<?php _e( 'Remove this image' ) ?>
                    </a>
                </p>
                <span class="description"><?php _e( 'The uploaded image will show up in all the coupons archive/category shortcodes with empty featured images.' ); ?></span>
            </td>
			 
        </tr>
		
		

		    
			<tr class="form-field">  
				<th scope="row" valign="top">  
					<label for="epilogue_id"><?php _e('Vendor Rating Count  '); ?></label>  
				</th>  
				<td>  
				
		 <input type="text" class="custom-img-id" name="term_meta[rating_count]" id="term_meta[rating_count]"
                       style="width:60%;" placeholder="values like. 200,500"
                       value="<?php echo $term_meta['rating_count'] ? $term_meta['rating_count'] : ''; ?>"><br/>
				 
				
				 <span class="description"><?php _e('This Field contains Total  Rating Countin numbers(ie 500). '); ?></span>  

				</td>  
			</tr>  
			<tr class="form-field">  
			<td>
					<label for="epilogue_id"><?php _e('Vendor Rating Value'); ?></label>  
				 </td>
				<td>  
				
		 <input type="text" class="custom-img-id" name="term_meta[rating_value]" id="term_meta[rating_value]" 
                       style="width:60%;" placeholder="values like 24.6,78.7"
                       value="<?php echo $term_meta['rating_value'] ? $term_meta['rating_value'] : ''; ?>"><br/>
				 
				
				 <span class="description"><?php _e('This Field contains Total  Rating Countin numbers(ie 500). '); ?></span>  

				</td>  
			</tr>  
		  
		
		
		<tr>
		<button class="btn btn-primary" id="upc_add_refrresh_btn">Refresh</button>
		</tr>
</br></br>
        
        <script>
            jQuery(function ($) {
                // Set all variables to be used in scope
                var frame,
                    metaBox = $('#addtag'), // Your meta box id here
                    addImgLink = metaBox.find('.upload-custom-img'),
                    delImgLink = metaBox.find('.delete-custom-img'),
                    imgContainer = metaBox.find('.custom-img-container'),
                    imgIdInput = metaBox.find('.custom-img-id');

                // ADD IMAGE LINK
               // addImgLink.on('click', function (event) {
				$('.upload-custom-img').on('click',function(event){	
                      
					  //alert('upload imag');
                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (frame) {
                        frame.open();
                        return;
                    }

                    // Create a new media frame
                    frame = wp.media({
                        title: 'Select or Upload Media for Your Coupon Category',
                        button: {
                            text: 'Use this media'
                        },
                        multiple: false  // Set to true to allow multiple files to be selected
                    });


                    // When an image is selected in the media frame...
                    frame.on('select', function () {
                             // alert('image selecged');
                        // Get media attachment details from the frame state
                        var attachment = frame.state().get('selection').first().toJSON();

                        // Send the attachment URL to our custom image input field.
                       // imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
                          $('.custom-img-container').append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
						
                        // Send the attachment id to our hidden input
                        imgIdInput.val(attachment.id);
                         // alert(attachment.id);
                        // Hide the add image link
                        addImgLink.addClass('hidden');

                        // Unhide the remove image link
                        delImgLink.removeClass('hidden');
                    });

                    // Finally, open the modal on click
                    frame.open();
                });


                // DELETE IMAGE LINK
                delImgLink.on('click', function (event) {

                    event.preventDefault();

                    // Clear out the preview image
                    imgContainer.html('');

                    // Un-hide the add image link
                    addImgLink.removeClass('hidden');

                    // Hide the delete image link
                    delImgLink.addClass('hidden');

                    // Delete the image id from the hidden input
                    imgIdInput.val('');

                });

            });
        </script>

		<?php
	
	
}
	
	public static function show_image_field( $tag ) {
		
		
		$t_id      = $tag->term_id; // Get the ID of the term you're editing  
		$term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
		
		
		
		
		$your_img_src = wp_get_attachment_image_src( $term_meta['image_id'], 'full' );
		// For convenience, see if the array is valid
		
		$you_have_img = is_array( $your_img_src );
		//$you_have_img =  $your_img_src ;
		

			// end my testing
		
		
		//echo "upc custom taxonomy image ";
		//print_r($tag);
	//	echo "<br>term meta";
	//	print_r($term_meta);
		
		
		?>

		
		
			<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="prologue_id"><?php _e('Vendor Prologue  '); ?></label>  
    </th>  
    <td>  
	
	<!--
	<textarea name="term_meta[prologue_id]" id="term_meta[prologue_id]" rows="5" cols="40"><?php echo $term_meta['prologue_id'] ? $term_meta['prologue_id'] : ''; ?> 
	             </textarea>
	 <p>The description is not prominent by default; however, some themes may show it.</p>  -->
	 
	  
		<?php
		$name='term_meta[prologue_id]';
		$value=$term_meta['prologue_id'] ? $term_meta['prologue_id'] : '';
		wp_editor($value, 'prologue_description', array('textarea_name' => $name));
		?>

	</br>
	 <span class="description"><?php _e('This Field contains  Short conclusion  about Vendor '); ?></span>  

    </td>  
</tr>  


               
		
		
		     	<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="epilogue_id"><?php _e('Vendor Epilogue '); ?></label>  
    </th>  
    <td>  
	
	<!--
	<textarea name="term_meta[epilogue_id]" id="term_meta[epilogue_id]" rows="5" cols="40"><?php echo $term_meta['epilogue_id'] ? $term_meta['epilogue_id'] : ''; ?> 
	             </textarea>
	 <p>The description is not prominent by default; however, some themes may show it.</p> -->
	 
	 
	    <?php
       $name='term_meta[epilogue_id]';
		$value=$term_meta['epilogue_id'] ? $term_meta['epilogue_id'] : '';
		//$name='epilogue_id';
		//$value=$epilogue_id? $epilogue_id : '';
		wp_editor($value, 'epilogue_description', array('textarea_name' => $name));
		?>
	 
	</br>
	 <span class="description"><?php _e('This Field contains  Conclusion about Vendor '); ?></span>  

    </td>  
</tr>  
		
		
		
		  
		 		     	<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="use_ful_tips"><?php _e('Useful Tips  '); ?></label>  
    </th>  
    <td>  
	
	 <textarea class="use_ful_tips" name="term_meta[use_ful_tips]" id="term_meta[use_ful_tips]" style="width: 100%;
    height: 160px;"><?php echo $term_meta['use_ful_tips'] ? $term_meta['use_ful_tips'] : '';  ?></textarea>
	 
	    
	
	 
	</br>
	 <span class="description"><?php _e('This Field contains  some useful and important information  about vendor '); ?></span>  

    </td>  
</tr>  
		
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="image_id"><?php _e( 'Image', 'upc-coupon' ); ?></label>
            </th>
            <td>
                <input type="hidden" class="custom-img-id" name="term_meta[image_id]" id="term_meta[image_id]" size="25"
                       style="width:60%;"
                       value="<?php echo $term_meta['image_id'] ? $term_meta['image_id'] : ''; ?>"><br/>
                <!-- Your image container -->
                <div class="custom-img-container" style="width:250px;">
					<?php if ( $you_have_img ) : ?>
                        <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:100%;"/>
					<?php endif; ?>
                </div>
                <!-- Your add & remove image links -->
                <p class="hide-if-no-js">
                    <a class="upload-custom-img button <?php if ( $you_have_img ) {
						echo 'hidden';
					} ?>">
						<?php _e( 'Upload image' ) ?>
                    </a>
                    <a style="color:red" class="delete-custom-img button <?php if ( ! $you_have_img ) {
						echo 'hidden';
					} 
					?>" href="#">
						<?php _e( 'Remove this image' ) ?>
                    </a>
                </p>
                <span class="description"><?php _e( 'The uploaded image will show up in all the coupons archive/category shortcodes with empty featured images.' ); ?></span>
            </td>
        </tr>
		
		
		
		<tr class="form-field">  
				<th scope="row" valign="top">  
					<label for="epilogue_id"><?php _e('Vendor Rating Count  '); ?></label>  
				</th>  
				<td>  
				
		 <input type="text" class="custom-img-id" name="term_meta[rating_count]" id="term_meta[rating_count]"
                       style="width:60%;" placeholder="values like. 200,500"
                       value="<?php echo $term_meta['rating_count'] ? $term_meta['rating_count'] : ''; ?>"><br/>
				 
				
				 <span class="description"><?php _e('This Field contains Total  Rating Countin numbers(ie 500). '); ?></span>  

				</td>  
			</tr>  
			<tr class="form-field">  
			<td>
					<label for="epilogue_id"><?php _e('Vendor Rating Value'); ?></label>  
				 </td>
				<td>  
				
		 <input type="text" class="custom-img-id" name="term_meta[rating_value]" id="term_meta[rating_value]" 
                       style="width:60%;" placeholder="values like 4 or 4.5"
                       value="<?php echo $term_meta['rating_value'] ? $term_meta['rating_value'] : ''; ?>"><br/>
				 
				
				 <span class="description"><?php _e('This Field contains Total  Rating Countin numbers(ie 500). '); ?></span>  

				</td>  
			</tr>  
		  
		
		
		
		
		

        <script>
            jQuery(function ($) {
                // Set all variables to be used in scope
                var frame,
                    metaBox = $('#edittag'), // Your meta box id here
                    addImgLink = metaBox.find('.upload-custom-img'),
                    delImgLink = metaBox.find('.delete-custom-img'),
                    imgContainer = metaBox.find('.custom-img-container'),
                    imgIdInput = metaBox.find('.custom-img-id');

                // ADD IMAGE LINK
               // addImgLink.on('click', function (event) {
				$('.upload-custom-img').on('click',function(event){	
                      
					  //alert('upload imag');
                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (frame) {
                        frame.open();
                        return;
                    }

                    // Create a new media frame
                    frame = wp.media({
                        title: 'Select or Upload Media for Your Coupon Category',
                        button: {
                            text: 'Use this media'
                        },
                        multiple: false  // Set to true to allow multiple files to be selected
                    });


                    // When an image is selected in the media frame...
                    frame.on('select', function () {
                             // alert('image selecged');
                        // Get media attachment details from the frame state
                        var attachment = frame.state().get('selection').first().toJSON();

                        // Send the attachment URL to our custom image input field.
                       // imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
                          $('.custom-img-container').append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
						  console.log(imgContainer);
                        // Send the attachment id to our hidden input
                        imgIdInput.val(attachment.id);
                         // alert(attachment.id);
                        // Hide the add image link
                        addImgLink.addClass('hidden');

                        // Unhide the remove image link
                        delImgLink.removeClass('hidden');
                    });

                    // Finally, open the modal on click
                    frame.open();
                });


                // DELETE IMAGE LINK
                delImgLink.on('click', function (event) {

                    event.preventDefault();

                    // Clear out the preview image
                    imgContainer.html('');

                    // Un-hide the add image link
                    addImgLink.removeClass('hidden');

                    // Hide the delete image link
                    delImgLink.addClass('hidden');

                    // Delete the image id from the hidden input
                    imgIdInput.val('');

                });

            });
        </script>

		<?php
	}

	/**
	 * this function saves term image id
	 *
	 * @since 2.3
	 */
	 

	public static function save_image_field( $term_id ) {
		  
		//print_r($_POST);
		if (isset( $_POST['term_meta'] ) && '' !== $_POST['term_meta'] ) {
			$t_id      = $term_id;
			$term_meta = get_option( "taxonomy_term_$t_id" );
			$cat_keys  = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['term_meta'][ $key ] ) ) {
					$term_meta[ $key ] = htmlspecialchars_decode(stripslashes($_POST['term_meta'][ $key ]));
				}
			}
			//save the option array  
			update_option( "taxonomy_term_$t_id", $term_meta );
		}
		else
		{
			echo "Term meta is not set";
		}
	}
}