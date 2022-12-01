<?php

/**
 * Contains the plugin's AJAX-Endpoints.
 *
 * @link       https://newseed.se
 * @since      1.0.0
 *
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/services
 */

/**
 * Contains the plugin's AJAX-Endpoints.
 *
 * @since      1.0.0
 * @package    woocommerce-newseed-wcexcel
 * @subpackage woocommerce-newseed-wcexcel/includes/services
 * @author     Max Olsson <max@newseed.se>
 */
class WCExcel_Ajax {

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
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version           The version of this plugin.
	 * @param	   string    $version           The global debug flag.
	 */
	public function __construct( $plugin_name, $version, $debug ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->debug = $debug;

	}

}
