
<?php
/**
 * Plugin Name: WP Animated GIF Resizing
 * Plugin URI:  http://wordpress.org/plugins
 * Description: Allows Animated GIFs to be resized without losing animation
 * Version:     0.1.0
 * Author:      Aaron Brazell
 * Author URI:  http://technosailor.com
 * Text Domain: wpag
 * Domain Path: /languages
 * License:     GPL-2.0+
 */

// Useful global constants
define( 'WPAG_VERSION', '0.1.0' );
define( 'WPAG_URL',     plugin_dir_url( __FILE__ ) );
define( 'WPAG_PATH',    dirname( __FILE__ ) . '/' );
define( 'WPAG_INC',     WPAG_PATH . 'includes/' );

// Includes
require_once( WPAG_PATH . 'vendor/autoload.php' );
require_once WPAG_INC . 'setup.php';
require_once WPAG_INC . 'class-media.php';

// Activation/Deactivation
register_activation_hook( __FILE__, '\WPAG\Setup\activate' );
register_deactivation_hook( __FILE__, '\WPAG\Setup\deactivate' );

\WPAG\Setup\setup();