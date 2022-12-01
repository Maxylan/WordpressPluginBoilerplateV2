<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @author            Max Olsson <max@newseed.se>
 * @link              https://newseed.se
 * @since             1.0.0
 * @package           woocommerce-newseed-wcexcel
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Excel Products
 * Plugin URI:        https://newseed.se
 * Description:       A plugin that adds excel-products, a new product-type thats created by uploading or creating an excel-dokument.
 * Version:           1.0.0a
 * Author:            NewSeed IT-Solutions
 * Author URI:        https://newseed.se
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcexcel
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'WCEXCEL_PLUGIN_VERSION', '1.0.0a' );

/**
 * Plugin name/identifier.
 */
define( 'WCEXCEL_PLUGIN_NAME', 'WooCommerce Excel Products' );

/**
 * Debug/Development flag.
 */
define( 'WCEXCEL_DEVELOPMENT_MODE', true );

/**
 * Plugin Directory
 */
define( 'WCEXCEL_DIRECTORY', wp_normalize_path(trailingslashit(__DIR__)) );

/**
 * Plugin Directory URL
 */
define( 'WCEXCEL_DIRECTORY_URL', plugin_dir_url(__FILE__) );

/**
 * Plugin Directory relative to the Wordpress root.
 */
define( 'WCEXCEL_DIRECTORY_RELATIVE', 'wp-content/plugins/'.trailingslashit(dirname(__DIR__)) );

/**
 * The code that runs during plugin activation.
 * This action is documented in woocommerce-newseed-wcexcel-activator.class.php
 */
function activate_wcexcel() {
	require_once WCEXCEL_DIRECTORY . 'woocommerce-newseed-wcexcel-activator.class.php';
	WCExcel_Activator::activate();
} register_activation_hook( __FILE__, 'activate_wcexcel' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in woocommerce-newseed-wcexcel-deactivator.class.php
 */
function deactivate_wcexcel() {
	require_once WCEXCEL_DIRECTORY . 'woocommerce-newseed-wcexcel-deactivator.class.php';
	WCExcel_Deactivator::deactivate();
} register_deactivation_hook( __FILE__, 'deactivate_wcexcel' );

/**
 * The core plugin class that loads all dependencies and defines all hooks.
 */
require WCEXCEL_DIRECTORY . 'woocommerce-newseed-wcexcel.class.php';

/**
 * Global Plugin Object.
 * 
 * Lets other parts of the plugin access all public methods in wcexcel
 * and it's members.
 * 
 * @var 	WCExcel		$wcexcel	Global Plugin Object.
 * @since 	1.0.0
 */
$wcexcel = null;

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcexcel() {

	global $wcexcel;

	/**
	 * Weird fix for windows machines only.
	 * $wcexcel needs to create an instance of WCExcel here or else 
	 * it's null when method run() is called.
	 */
	$wcexcel = new WCExcel();
	$wcexcel->run();

	// Register "wcexcel" text-domain. (Needs to be done from a script in the plugin root) @since 1.0.0
	add_action( 'plugins_loaded', function () { // If loading domain is not successfull, log it if the plugin is in dev-mode.
		if ( !load_plugin_textdomain( 'wcexcel', false, '/'.trailingslashit(dirname(__DIR__)).'lang' ) && WCEXCEL_DEVELOPMENT_MODE ) {
			error_log('Warn: WC-Excel could not load custom text domain! Translations will be missing! Check if the path to /lang/ is correct, it needs to be relative to WP_PLUGIN_DIR ('.WP_PLUGIN_DIR.')');
		}
	});

}

// Start execution of WCExcel.
run_wcexcel();