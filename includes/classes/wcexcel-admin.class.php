<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://newseed.se
 * @since      1.0.0
 *
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/classes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/classes
 * @author     Max Olsson <max@newseed.se>
 */
class WCExcel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * If the current environment is a development environment or not.
	 * 
	 * NOTE TO DEVELOPERS READING THIS!
	 * Use your own judgement for when to restrict error_logging with if ($this->debug).
	 * Some errors are more valuable to log than others.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bool		$debug		If true it will let through a lot more error_logs for the 
	 * 									developers to investigate in wp-content/debug.log
	 */
	protected $debug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name     	The name of this plugin.
	 * @param    string    $version    			The version of this plugin.
	 * @param	 string    $debug               The global debug flag.
	 * @param    string    $custom_database     Backend Database URI.
	 * @param    string    $api_base    		API URI.
	 */
	public function __construct( $plugin_name, $version, $debug ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->debug = $debug;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-admin-styles', WCEXCEL_DIRECTORY_URL . 'assets/css/ecp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . '-admin', WCEXCEL_DIRECTORY_URL . 'assets/js/ecp-admin.js', array('jquery'), $this->version, true );

	}

}
