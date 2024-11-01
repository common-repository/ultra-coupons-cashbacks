<?php

// If accessed directly, exit
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 *
 * Check if the necessary class exists, if not
 * then we are requiring the file that holds the
 * class we need.
 *
 */
if ( !class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
/**
 * This class adds custom column to the custom
 * post type list screen.
 *
 * @since 1.0
 *
 */
class UPC_Admin_Columns extends WP_List_Table
{
    /**
     * Initializing the admin columns.
     *
     * @since 1.0
     */
    public static function upc_columns_init()
    {
        /**
         * This filter adds the column to the custom
         * post type admin screen.
         *
         * @since 1.0
         */
        add_filter( 'manage_edit-upc_coupons_columns', array( __CLASS__, 'upc_list_columns' ) );
        /**
         * Setting up the columns to be sortable by orders.
         *
         * @since 1.0
         */
        add_action( 'pre_get_posts', array( __CLASS__, 'setting_orderby' ) );
        /**
         * Custom column cases we'll use to create the
         * columns we'll add.
         *
         * @since 1.0
         */
        add_action(
            'manage_posts_custom_column',
            array( __CLASS__, 'upc_columns_cases' ), 10, 2
        );
        /**
         * Making the columns sortable.
         *
         * @since 1.0
         */
        add_filter(
            'manage_edit-upc_coupons_sortable_columns',
            array( __CLASS__, 'upc_column_sortable' ),10,2
        );
        
     
    
    }
    
    /*
     * This function sets up the columns.
     * Adding the custom fields to the columns.
     *
     * @since 1.0
     * @param array $columns
     */
    public static function upc_list_columns( $columns )
    {
        /**
         * This is an array of all the columns for the
         * custom coupon post type admin screen.
         *
         * @since 1.0
         */
        $upc_columns = array();
        if ( isset( $columns['cb'] ) ) {
            $upc_columns['cb'] = $columns['cb'];
        }
        if ( isset( $columns['title'] ) ) {
            $upc_columns['title'] = __( 'Title', 'upc-coupon' );
        }
        if ( isset( $columns['author'] ) ) {
            $upc_columns['author'] = $columns['author'];
        }
        /**
         * Adding custom fields data to the column array
         *
         * @since 1.0
         */
        $pc_columns['coupon_type'] = __( 'Coupon Type', 'upc-coupon' );
        $upc_columns['coupon_category'] = __( 'Category', 'upc-coupon' );
        $upc_columns['coupon_vendor'] = __( 'Vendor', 'upc-coupon' );
        $upc_columns['id'] = __( 'ID', 'upc-coupon' );
        $upc_columns['coupon_shortcode'] = __( 'Shortcodes', 'upc-coupon' );
        $upc_columns['coupon_expire'] = __( 'Expires', 'upc-coupon' );
        /**
         *
         * This filters the columns headers.
         * Using an array of the column headers.
         *
         */
        if ( has_filter( 'upc_filter_coupon_list_columns' ) ) {
            /**
             * This will filter the admin coupon list columns headers.
             *
             * @param array $

upc_columns an array of column headers.
             *
             */
            $upc_columns = apply_filters( 'upc_filter_coupon_list_columns', $upc_columns, $columns );
        }
        /**
         * Returning columns.
         *
         * @since 1.0
         */
        return $upc_columns;
    }
    
    /**
     * This adds the custom meta data to columns.
     *
     * @since 1.0
     *
     * @param $column
     * @param $post_id
     */
    public static function upc_columns_cases( $column, $post_id )
    {
        /**
         *
         * This contains data from the current post in the loop.
         * This allows us to use data from the post.
         *
         * @since 1.0
         */
        global  $post ;
        /**
         * Showing the custom fields in columns for corresponding
         * post meta data from individual posts.
         *
         * @since 1.0
         */
        switch ( $column ) {
            case 'id':
                echo  $post_id ;
                break;
            case 'coupon_category':
                $terms = get_the_terms( $post_id, 'categories' );
                
                if ( !empty($terms) ) {
                    $out = array();
                    foreach ( $terms as $term ) {
                        $out[] = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( array(
                            'categories' => $term->slug,
                            'post_type'            => $post->post_type,
                        ), 'edit.php' ) ), esc_html( sanitize_term_field(
                            'name',
                            $term->name,
                            $term->term_id,
                            'cpt_coupon_category',
                            'display'
                        ) ) );
                    }
                    echo  join( ', ', $out ) ;
                } else {
                    _e( 'No Category', 'upc-coupon' );
                }
                
                break;
            case 'coupon_vendor':
                $terms = get_the_terms( $post_id, 'store' );
                
                if ( !empty($terms) ) {
                    $out = array();
                    foreach ( $terms as $term ) {
                        $out[] = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( array(
                            'store' => $term->slug,
                            'post_type'          => $post->post_type,
                        ), 'edit.php' ) ), esc_html( sanitize_term_field(
                            'name',
                            $term->name,
                            $term->term_id,
                            'cpt_coupon_vendor',
                            'display'
                        ) ) );
                    }
                    echo  join( ', ', $out ) ;
                } else {
                    _e( 'No Vendor', 'upc-coupon' );
                }
                
                break;
            case 'coupon_shortcode':
                $coupon_type = get_post_meta( $post_id, 'coupon_details_coupon-type', true );
                
                if ( $coupon_type === 'Image' ) {
                    $shortcode = "[upc_coupon id=" . $post_id . "]";
                    echo  $shortcode ;
                } else {
                    $shortcode = "[upc_coupon id=" . $post_id . "]";
                    $code_shortcode = "[upc_code id=" . $post_id . "]";
                    echo  $shortcode . ' <br><br> ' . $code_shortcode ;
                }
                
                break;
            case 'coupon_details_coupon-code':
                $coupon_code = get_post_meta( $post_id, 'coupon_details_coupon-code-text', true );
                echo  $coupon_code ;
                break;
            case 'coupon_details_description':
                $description = get_post_meta( $post_id, 'coupon_details_description', true );
                echo  $description ;
                break;
            case 'coupon_details_link':
                $link = get_post_meta( $post_id, 'coupon_details_link', true );
                echo  $link ;
                break;
            case 'coupon_type':
                $coupon_type = get_post_meta( $post_id, 'coupon_details_coupon-type', true );
                echo  $coupon_type ;
                break;
            case 'coupon_expire':
                $today = date( 'd-m-Y' );
                $expire = get_post_meta( $post_id, 'coupon_details_expire-date', true );
                
                if ( !empty($expire) ) {
                    
                    if ( strtotime( $expire ) >= strtotime( $today ) ) {
                        echo  $expire ;
                    } elseif ( strtotime( $expire ) < strtotime( $today ) ) {
                        echo  __( 'Expired', 'upc-coupon' ) ;
                    }
                
                } else {
                    echo  __( "Doesn't Expire", 'upc-coupon' ) ;
                }
                
                break;
			
        }
        /**
         * Filtering the coupon list column information.
         *
         * @since 1.0
         */
        if ( has_filter( 'upc_filter_column_cases' ) ) {
            /**
             * This filters the admin coupon list columns information
             * for custom coupon post type.
             *
             * @since 1.0
             *
             * @param string $column data to display in the admin columns.
             * @param int    $post_id id of the custom coupon post.
             *
             */
            apply_filters( 'upc_filter_column_cases', $column, $post_id );
        }
    }
    
    /**
     * This will make custom column sortable.
     *
     * @since 1.0
     *
     * @param array $columns array of the custom columns.
     *
     * @return array $columns
     *
     */
    public static function upc_column_sortable( $columns )
    {
        /**
         * Adding the custom fields to columns array.
         *
         * @since 1.0
         */
        $columns['coupon_details_link'] = 'coupon_details_link';
        $columns['coupon_details_coupon-code'] = 'coupon_details_coupon-code';
        $columns['coupon_type'] = 'coupon_details_coupon-type';
        $columns['coupon_expire'] = 'coupon_details_expire-date';
        /**
         * Returning the columns array after adding the custom fields.
         *
         * @since 1.0
         */
        return $columns;
    }
    
    /**
     * Setting the columns sorting order.
     *
     * @param $query
     *
     * @since 1.0
     */
    public static function setting_orderby( $query )
    {
        $orderby = $query->get( 'orderby' );
        
        if ( 'coupon_details_coupon-type' == $orderby ) {
            $query->set( 'meta_key', 'coupon_details_coupon-type' );
            $query->set( 'orderby', 'meta_value' );
        }
        
        
        if ( 'coupon_details_coupon-code' == $orderby ) {
            $query->set( 'meta_key', 'coupon_details_coupon-code-text' );
            $query->set( 'orderby', 'meta_value' );
        }
        
        
        if ( 'coupon_details_link' == $orderby ) {
            $query->set( 'meta_key', 'coupon_details_link' );
            $query->set( 'orderby', 'meta_value' );
        }
        
        
        if ( 'coupon_details_expire-date' == $orderby ) {
            $query->set( 'meta_key', 'coupon_details_expire-date' );
            $query->set( 'orderby', 'meta_value' );
        }
    
    }

}