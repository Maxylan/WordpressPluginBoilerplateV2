<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://newseed.se
 * @since      1.0.0
 *
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/classes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/classes
 * @author     Max Olsson <max@newseed.se>
 */
class WCExcel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

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
	 * @since   1.0.0
	 * @param	string  $plugin_name       The name of the plugin.
	 * @param	string  $version           The version of this plugin.
	 * @param	string  $version           The global debug flag.
	 */
	public function __construct( $plugin_name, $version, $debug ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->debug = $debug;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-public-styles', WCEXCEL_DIRECTORY_URL . 'assets/css/wcexcel-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . '-public', WCEXCEL_DIRECTORY_URL . 'assets/js/wcexcel-public.js', array( 'jquery' ), $this->version, false );

	}

}