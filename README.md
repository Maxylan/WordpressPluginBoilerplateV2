=== WooCommerce Excel Products ===
Tags: functionality, e-commerce, sales
Requires at least Wordpress version: 6.1
Tested up to Wordpress version: 6.1
Min-required PHP Version: 8.1.2
Min-required MySQL Version: 8.0.31
Stable plugin version: 1.0.0a
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin that adds excel-products, a new product-type thats created by uploading or creating an excel-dokument.

== Description ==
TODO!

A plugin that adds excel-products, a new product-type thats created by uploading or creating an excel-dokument.

Plugin built on top of a plugin template called "WordPress-Plugin-Boilerplate" (https://github.com/devinvinson/WordPress-Plugin-Boilerplate/).
Credit to those lovely folks.

=== Developer Notes ===
<br>These are files-of-interest if you just want to quickly jump into development.<br>
woocommerce-newseed-wcexcel.php				- Plugin Entrypoint<br>
woocommerce-newseed-wcexcel.class.php		- Core plugin class <-- Define all hooks here.<br>
/includes/									- Contains all of the non-core logic for the plugin.<br>
/includes/classes/wcexcel-public.class.php	- Contains all of the public-facing hook callbacks and logic.<br>
/includes/classes/wcexcel-admin.class.php	- Contains all of the wp-admin-facing hook callbacks and logic.<br>
/includes/services/wcexcel-ajax.class.php	- Contains all of the AJAX hook callbacks and HTTP logic.<br>

== Installation ==

1. Upload this plugin to the "/wp-content/plugins/" directory
2. Activate the plugin through the 'Plugins' menu in WordPress' Backend

== Changelog ==

= 1.0.0a =<br>
Init commit. Boilerplate.

== Upgrade Notice ==

No upgrades yet.