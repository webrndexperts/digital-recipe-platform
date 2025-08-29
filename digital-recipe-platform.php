<?php
/**
 * Plugin Name: Digital Recipe Platform
 * Description: Building a modern recipe platform that demonstrates advanced WordPress development skills, using custom post type, slider and shortcode.
 * Version: 1.0.0
 * Author: Suneel Kumar.
 * Domain Path: /languages
 * Author URI: https://rndexperts.com/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define constants
define( 'DRP_PATH', plugin_dir_path( __FILE__ ) );
define( 'DRP_URL', plugin_dir_url( __FILE__ ) );
define( 'DRP_VERSION', '1.0.0' );

// // Load includes
require_once DRP_PATH . 'includes/class-recipe-cpt.php';
require_once DRP_PATH . 'includes/class-recipe-taxonomies.php';
require_once DRP_PATH . 'includes/class-recipe-shortcode.php';
require_once DRP_PATH . 'includes/assets.php';
// require_once DRP_PATH . 'includes/activator.php';

/**
 * Initialize the DRP plugin.
 *
 * This function is hooked into the plugin bootstrap process.
 * It performs the following:
 *  1. Registers the custom post type (DRP_Recipe_CPT) if available.
 *  2. Registers custom taxonomies (DRP_Recipe_Taxonomies) if available.
 *  2. Registers custom shortcode (DRP_Recipe_Shortcode).
 *  3. Hooks the asset enqueue function (drp_enqueue_assets) to `wp_enqueue_scripts`.
 *  4. Registers the Gutenberg block located in this plugin's directory.
 *
 * @return void
 */
function drp_init_plugin() {
    if ( class_exists( 'DRP_Recipe_CPT' ) ) {
        ( new DRP_Recipe_CPT() )->register();
    }

    if ( class_exists( 'DRP_Recipe_Taxonomies' ) ) {
        ( new DRP_Recipe_Taxonomies() )->register();
    }

    ( new DRP_Recipe_Shortcode() )->register();

    if ( function_exists( 'drp_enqueue_assets' ) ) {
        add_action( 'wp_enqueue_scripts', 'drp_enqueue_assets' );
    }

    register_block_type( __DIR__ );
}


add_action( 'init', 'drp_init_plugin' );

// Hooks for lifecycle
// register_activation_hook( __FILE__, [ 'DRP_Activator', 'activate' ] );
// register_uninstall_hook( __FILE__, [ 'DRP_Activator', 'uninstall' ] );