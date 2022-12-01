<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://newseed.se
 * @since      1.0.0
 *
 * @package    woocommerce-newseed-wcexcel
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    woocommerce-newseed-wcexcel
 * @author     Max Olsson <max@newseed.se>
 */
class WCExcel {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCExcel_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The internal name for the plugin, works as a unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * If the current environment is a development environment or not.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bool		$debug		If true it will let through a lot more error_logs for the 
	 * 									developers to investigate in wp-content/debug.log
	 */
	protected $debug;

	/**
	 * The part of WCExcel responsible for all the admin-facing-functionality.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCExcel_Admin    $plugin_admin    Object.
	 */
	protected $plugin_admin;

	/**
	 * The part of WCExcel responsible for all HTTP Services like cron, ajax and simple API Endpoints.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCExcel_Ajax    $plugin_ajax    Object.
	 */
	protected $plugin_ajax;

	/**
	 * The part of WCExcel responsible for all the public-facing-functionality.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCExcel_Public    $plugin_public    Object.
	 */
	protected $plugin_public;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Sets the plugin name, version and more as properties that can be used 
	 * throughout the plugin. Load the dependencies, set the hooks for the 
	 * admin and public-facing side of the site and register products.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WCEXCEL_PLUGIN_VERSION' ) ) {
			$this->version = WCEXCEL_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = defined('WCEXCEL_PLUGIN_NAME') ? WCEXCEL_PLUGIN_NAME:'WCExcel';
		$this->debug = defined('WCEXCEL_DEVELOPMENT_MODE') ? WCEXCEL_DEVELOPMENT_MODE:false;

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_ajax_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WCExcel_Loader. Orchestrates the hooks of the plugin.
	 * - WCExcel_Admin. Defines all hooks for the admin area.
	 * - WCExcel_Ajax. Defines all hooks for ajax and other HTTP functionality.
	 * - WCExcel_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WCEXCEL_DIRECTORY . 'woocommerce-newseed-wcexcel-loader.class.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WCEXCEL_DIRECTORY . 'includes/classes/wcexcel-admin.class.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WCEXCEL_DIRECTORY . 'includes/services/wcexcel-ajax.class.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WCEXCEL_DIRECTORY . 'includes/classes/wcexcel-public.class.php';

		$this->loader = new WCExcel_Loader();

		$this->plugin_admin = new WCExcel_Admin( 
			$this->get_plugin_name(), 
			$this->get_version(), 
			$this->debug(), 
		);

		$this->plugin_ajax = new WCExcel_Ajax( 
			$this->get_plugin_name(), 
			$this->get_version(),
			$this->debug() 
		);

		$this->plugin_public = new WCExcel_Public( 
			$this->get_plugin_name(), 
			$this->get_version(),
			$this->debug()
		);
		
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		if ( is_admin() ) {
			$this->loader->add_action( 'admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles' );
			$this->loader->add_action( 'admin_enqueue_scripts', $this->plugin_admin, 'enqueue_scripts' );
		}

	}

	/**
	 * Register all of the hooks related to AJAX Endpoints.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_ajax_hooks() {

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->loader->add_action( 'wp_enqueue_scripts', $this->plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->plugin_public, 'enqueue_scripts' );

		/**
		 * Add frontend shortcodes.
		 */ 
		add_shortcode( 'editor_button', array( $this->plugin_public, 'create_editor_button' ) );
		
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of WordPress.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WCExcel_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * If the current environment is a development environment or not.
	 *
	 * If true it will let through a lot more error_logs for the developers to investigate 
	 * in wp-content/debug.log
	 * 
	 * NOTE TO DEVELOPERS READING THIS!
	 * Use your own judgement for when to restrict error_logging with if ($this->debug).
	 * Some errors are more valuable to log than others.
	 * 
	 * @since     1.0.0
	 * @return    bool		$debug    Returns the Debug-mode flag.
	 */
	public function debug() {
		return $this->debug;
	}

	/**
	 * Retrieve an instance of the WCExcel Admin Object responsible for all the admin-facing-functionality.
	 *
	 * @since     1.0.0
	 * @return    WCExcel_Admin    Admin-facing-functionality of the plugin.
	 */
	public function admin() {
		return $this->plugin_admin;
	}

	/**
	 * Retrieve an instance of the WCExcel Ajax Object that defines all AJAX-Endpoint methods.
	 *
	 * @since     1.0.0
	 * @return    WCExcel_Ajax    AJAX Endpoints.
	 */
	public function ajax() {
		return $this->plugin_ajax;
	}

	/**
	 * Retrieve an instance of the WCExcel Public Object responsible for all the public-facing-functionality.
	 * 
	 * @since     1.0.0
	 * @return    WCExcel_Public    Public-facing-functionality of the plugin.
	 */
	public function public() {
		return $this->plugin_public;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @return   void
	 */
	public function run() {
		$this->loader->run();
	}

}
