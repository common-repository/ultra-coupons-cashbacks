<?php

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * This is contains the main plugin class
 * which contains everything.
 *
 * @since 1.0
 * @author Webnox
 */
// Checking is the class already exists.
if ( ! class_exists( 'UPC_Plugin' ) ) {

	/**
	 * Class 



UPC_Plugin
	 * This is the main plugin class.
	 *
	 * @since 1.0
	 */
	class UPC_Plugin {

		/**
		 * Setting up constant that we will use later
		 * throughout our class.
		 *
		 * @since 1.0
		 */
		const PLUGIN_VERSION = '1.0';
		const CUSTOM_POST_TYPE = 'upc_coupons';
		const CUSTOM_TAXONOMY = 'categories';
        const VENDOR_TAXONOMY = 'store';
		const TEXT_DOMAIN = 'upc-coupon';
		const NAME_SINGULAR = 'Coupon';
		const NAME_PLURAL = 'Coupons';
		const TAXONOMY_SINGULAR = 'Coupon Category';
		const TAXONOMY_PLURAL = 'Coupon Categories';
        const VENDOR_SINGULAR = 'Coupon Vendor';
        const VENDOR_PLURAL = 'Coupon Vendors';
		const MENU_NAME='Ultra Promocode';
		/**
		 * Instance to instantiate object.
		 *
		 * @var $instance
		 */
		protected static $instance;

		/**
		 * Plugin directory.
		 *
		 * @var string $plugin_dir_path holds the plugin directory path.
		 * @since 1.0
		 */
		public $plugin_dir_path;

		/**
		 * Plugin directory URI.
		 *
		 * @var string $plugin_dir_uri holds the plugin directory URI.
		 * @since 1.0
		 */
		public $plugin_dir_uri;

		/**
		 * Plugin assets URI.
		 *
		 * @var string $plugin_assets holds the path to plugin assets.
		 * @since 1.0
		 */
		public $plugin_assets;

		/**
		 * Plugin includes path.
		 *
		 * @var string $plugin_includes holds the path to plugin includes.
		 * @since 1.0
		 */
		public $plugin_includes;

		/**
		 * Plugin classes path.
		 *
		 * @var string $plugin_classes holds the path to plugin classes.
		 * @since 1.0
		 */
		public $plugin_classes;

		/**
		 * Singleton pattern, making only one instance of the class.
		 *
		 * @since 1.00
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				$className      = __CLASS__;
				self::$instance = new $className;
			}

			return self::$instance;
		}

		/**
		 * 



UPC_Plugin constructor.
		 * Adds necessary stuff when plugin
		 * is activated.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			/**
			 * These are the necessary directory, we'll need
			 * throughout plugin.
			 *
			 * @since 1.0
			 */
			 
			$this->plugin_dir_path = trailingslashit( dirname( plugin_dir_path( __FILE__ ) ) );
			$this->plugin_dir_uri  = trailingslashit( dirname( plugin_dir_url( __FILE__ ) ) );
			$this->plugin_assets   = $this->plugin_dir_uri . trailingslashit( 'assets' );
			$this->plugin_includes = $this->plugin_dir_path . trailingslashit( 'includes' );
			$this->plugin_classes  = $this->plugin_includes . trailingslashit( 'classes' );
			
			
		//	wp_enqueue_script( 'bootstrap_js', $this->plugin_assets  . 'js/bootstrap.min.js', array(), '1.0.0', true );
		}

		/**
		 * Activation function. Runs this when plugin is activated.
		 *
		 * @since 1.0
		 */
		public static function upc_activate() {

	

			/**
			 * Checking if the user has the permissions.
			 */
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			// Adds the option to check if user is notified for review.
			add_option( 'upc_review_notify', 'no' );
			add_option( 'upc_popup-goto-link', 'on' );

			/**
			 * Loading the class here to avoid errors.
			 *
			 * @since 1.0
			 */
			



   UPC_Plugin::instance()->loadClasses();

			/**
			 * Registering the custom post type when plugin is activated.
			 *
			 * @since 1.0
			 */
			



    UPC_Plugin::instance()->custom_post_type_register();

			/**
			 * Clear the permalinks after the post type has been registered.
			 *
			 * @since 1.0
			 */
			flush_rewrite_rules();

			/**
			 * Adds the welcome page.
			 *
			 * @since 1.0
			 */
			//UPC_Welcome_Page::upc_welcome_activate();
		}

		/**
		 * Deactivation. Runs when the plugin is deactivated.
		 *
		 * @since 1.0
		 */
		public static function upc_deactivate() {

			/**
			 * Checking if the user has the permissions.
			 */
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			// Delets the option to check if user is notified for review.
			delete_option( 'upc_review_notify' );

			/**
			 * Clear the permalinks to remove our post type's rules.
			 *
			 * @since 1.0
			 */
			flush_rewrite_rules();

			//add_action( 'after_uninstall', 'wcad_fs_uninstall_cleanup' );

			/**
			 * Welcome page transient remove.
			 *
			 * @since 1.0
			 */
			//UPC_Welcome_Page::upc_welcome_deactivate();
		}

		/**
		 * This function initializes necessary files, classes
		 * and functions.
		 *
		 * @since 1.0
		 */
		public static function init() {

			/**
			 * Adding actions using proper functions.
			 *
			 * @since 1.0
			 */
			add_action( 'init', array( __CLASS__, 'loadClasses' ), 10 );
			add_action( 'init', array( __CLASS__, 'custom_taxonomy_register' ) );
			add_action( 'init', array( __CLASS__, 'custom_post_type_register' ) );
			add_action( 'widgets_init', array( __CLASS__, 'upc_widget_register' ), 20 );
			add_filter( 'wp_enqueue_scripts', array( __CLASS__, 'load_jquery' ), 1 );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_jquery' ) );
			add_filter( 'wp_head', array( __CLASS__, 'load_jquery' ) );

		

		}
		/**
		 * this function checks if jQuery exits to added it
		 *
		 * @since 2.2.2
		 */
		public static function load_jquery() {

			if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {

				//Enqueue
				wp_enqueue_script( 'jquery', false, array(), false, false );
			}

		}

		/**
		 * This function loads the auto-loader which
		 * loads all the classes.
		 *
		 * @since 1.0
		 */
		public static function loadClasses() {

			/**
			 * Including the auto loader file.
			 * This loads all the classes so we can use them
			 * whenever we want.
			 *
			 * @since 1.0
			 */
			include UPC_Plugin::instance()->plugin_includes . 'autoloader.php';

			/**
			 * Registering the autoloader to autoload classes.
			 *
			 * @since 1.0
			 */
			


   UPC_Autoloader::register();

			/**
			 * Adding the admin classes to initialize.
			 *
			 * @since 1.0
			 */
			self::upc_admin_classes();

			/**
			 * Adding the shortcode class to initialize.
			 *
			 * @since 1.0
			 */
			self::shortcode_class();

             /**
             * Adding the ajax class to initialize.
             * 
             * @since 2.5.0.1
             */
            self::ajax_class();
                        
			/**
			 * Welcome page.
			 *
			 * @since 1.0
			 */
			

   UPC_Welcome_Page::init();

			/**
			 * Adds the links to toolbar.
			 *
			 * @since 1.0
			 */
			new UPC_Toolbar_Links();
		}

		/**
		 * This function registers the custom coupon
		 * code post type.
		 *
		 * @since 1.0
		 */
		public static function custom_post_type_register() {

			/**
			 * This generates the lables for the custom post type.
			 * Passing the arguments for the static method of the
			 * post type class.
			 *
			 * @since 1.0
			 */
			$labels = UPC_Custom_Post_Type::post_type_labels(
				self::NAME_SINGULAR, self::NAME_PLURAL, self::TEXT_DOMAIN,
				self::MENU_NAME);

			/**
			 * This method registers the custom post type
			 * with WordPress.
			 *
			 * @since 1.0
			 */
			


UPC_Custom_Post_Type::post_type_register(
				self::CUSTOM_POST_TYPE, self::NAME_SINGULAR, $labels, self::TEXT_DOMAIN
			);

			/**
			 * Instantiating the custom post type class.
			 * Custom Post type name is passed.
			 *
			 * @since 1.0
			 */
			new UPC_Custom_Post_Type( self::CUSTOM_POST_TYPE );
		}

		/**
		 * This function generates the labels for the
		 * custom taxonomy and registers it with WordPress.
		 *
		 * @since 1.0
		 */
		public static function custom_taxonomy_register() {
                    /**
                     * Category
                     */
			/**
			 * Generating the labels for the custom taxonomy.
			 */
			$labels = UPC_Custom_Taxonomy::taxonomy_labels(
				self::TAXONOMY_SINGULAR, self::TAXONOMY_PLURAL, self::TEXT_DOMAIN
			);

			/**
			 * Registering the custom taxonomy with WordPress.
			 */
			

UPC_Custom_Taxonomy::register_taxonomy(
				self::CUSTOM_TAXONOMY, self::CUSTOM_POST_TYPE, $labels, 'categories');
			

			

UPC_Custom_Taxonomy_Image::register( self::CUSTOM_TAXONOMY );
                        
                    /**
                     * Vendor
                     */
                        /**
			 * Generating the labels for the custom taxonomy.
			 */
			$labels = UPC_Custom_Taxonomy::taxonomy_labels(
				self::VENDOR_SINGULAR, self::VENDOR_PLURAL, self::TEXT_DOMAIN
			);

			/**
			 * Registering the vendor taxonomy with WordPress.
			 */
			

UPC_Custom_Taxonomy::register_taxonomy(self::VENDOR_TAXONOMY, self::CUSTOM_POST_TYPE, $labels, 'store');

			

UPC_Custom_Taxonomy_Image::register( self::VENDOR_TAXONOMY );
		}

		/**
		 * Registering the Widget.
		 *
		 * @since 1.2
		 */
		public static function upc_widget_register() {

			/**
			 * Including the Widget class.
			 *
			 * @since 1.2
			 */
			include UPC_Plugin::instance()->plugin_classes . 'upc-coupon-widget.php';

			/**
			 * Register widget with WordPress.
			 *
			 * @since 1.2
			 */
			register_widget( 'UPC_Coupon_Widget' );
		}

		/**
		 * This function loads the necessary admin classes by
		 * instantiating the classes.
		 *
		 * @since 1.0
		 */
		public static function upc_admin_classes() {

		
			/**
			 * Including the necessary actions.
			 *
			 * @since 1.0
			 */
			include UPC_Plugin::instance()->plugin_includes . '/functions/admin/actions/' . 'upc-admin-actions.php';


			/**
			 * Instantiation of settings page class.
			 * Adds the settings page.
			 *
			 * @since 1.0
			 */
		

				new UPC_Settings_Page();

			

			/**
			 * Loading the import page.
			 *
			 * @since 2.3.2
			 */
		

			new UPC_Import_Page();

			

			/**
			 * This instantiation adds the custom meta boxes
			 * to the custom post type we registered.
			 *
			 * @since 1.0
			 */
		
				new UPC_Meta_Boxes();

			new UPC_Admin_Dashboard();

                        

			/**
			 * Shows the shortcodes after coupon is published.
			 *
			 * @since 1.0
			 */
			new UPC_Shortcode_Metabox();

			/**
			 * Adds the help shortocode in new coupon screen.
			 *
			 * @since 2.3.2
			 */
			new UPC_Help_Metabox();

			/**
			 * Adds the preview metabox.
			 *
			 * @since 1.0
			 */
		new UPC_Preview_Metabox();

			/**
			 * This adds the add coupon button to the post and
			 * page editors.
			 *
			 * Inserts the shortcode.
			 *
			 * @since 1.0
			 */
			

 UPC_Shortcode_Inserter::upc_shortcode_insert();

			/**
			 * This adds the custom columns in
			 * custom post type admin scree.
			 *
			 * @since 1.0
			 */
			

UPC_Admin_Columns::upc_columns_init();

			/**
			 * This loads the necessary stylesheets and
			 * scripts.
			 *
			 * @since 1.0
			 */
UPC_Assets::UPC_Assets_init();

			/**
			 * Shows the shortcodes in admin notices when post Published.
			 *
			 * @since 1.0
			 */
	UPC_Admin_Notices::init();
		}

		/**
		 * This function loads the shortcode class and
		 * related files with the class.
		 *
		 * @since 1.0
		 */
		public static function shortcode_class() {

			/**
			 * Including the necessary actions.
			 *
			 * @since 1.0
			 */
			include UPC_Plugin::instance()->plugin_includes . '/functions/shortcode/code/actions/' . 'upc-shortcode-code-actions.php';
			/**
			 * Instantiation of shortcode class.
			 * This registers the shortcode with WordPress.
			 *
			 * @since 1.0
			 */
			UPC_Short_Code::init();
		}
                
        /**
		 * This function loads the ajax class
		 *
		 * @since 2.5.0.1
		 */
        public static function ajax_class() {
			
			/**
            * Load the ajax events
            * 
            * @since 2.5.0.1
            */
            UPC_AJAX::LoadEvents();
			
			
			
		
		}

		/**
		 * Free Pro Trial Page for Free Users.
		 * @since 2.6.2
		 */
			

	}

}
//my testing



 
wp_enqueue_script('jquery_datatable',UPC_Plugin::instance()->plugin_assets .'js/jquery.dataTables.min.js',array( 'jquery' ),UPC_Plugin::PLUGIN_VERSION,true);
 wp_enqueue_style('jquery_datatable_style',UPC_Plugin::instance()->plugin_assets .'css/jquery.dataTables.min.css',false, UPC_Plugin::PLUGIN_VERSION );
		
		
		
		
add_action('wp_ajax_get_subscriber_info','get_subscriber_info');
 function get_subscriber_info()
 {
	     $template = new UPC_Template_Loader();
	            ob_start();
                $template->get_template_part( 'dashboard/subscriber_details' );
				//echo file_get_contents('pages/'.$page.'.php');
                $output = ob_get_clean();
                wp_reset_postdata();
                echo $output ; 
				exit();
 }