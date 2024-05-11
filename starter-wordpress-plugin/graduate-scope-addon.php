<?php
/*
Plugin Name: Graduate Scope Addon
Plugin URI: #
Description: Graduate Scope Addon for Custom Shortcodes [gs-pricing-table] [gs-testimonials] [gs-our-team] [gs-free-resources]
Version: 1.0
Author: Graduate Scope
Author URI: #
*/

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
* Define Plugin URL and Directory Path
*/
define('GRSA_ADDON_DIR', plugins_url('/', __FILE__));  // Define Plugin URL
define('GRSA_PATH', plugin_dir_path(__FILE__));        // Define Plugin Directory Path
define('GRSA_DOMAIN', 'graduate-scope-shortcodes');   // Define Text Domain


class GraduateScopeAddon {

	function __construct() {
		
		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this , 'graduate_scope_scripts' ), 20 );

		// include files
		add_action( 'init', array( $this , 'graduate_scope_shortcode_include_files') );
		
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 */
	function graduate_scope_scripts() {
		
		// enqueue css
		wp_enqueue_style('grsa-shortcode-style', GRSA_ADDON_DIR . 'assets/css/graduate-scope-shortcode.css');
		// enqueue js
		wp_enqueue_script( 'grsa-shortcode-js', GRSA_ADDON_DIR . 'assets/js/graduate-scope-shortcode.js', array('jquery'), '', true );	
	}

	/**
	 * Require files.
	 *
	 * Graduate scope register shortcodes.
	 *
	 */
	function graduate_scope_shortcode_include_files(){

		/* Shortcode file */
		require_once GRSA_PATH . 'includes/shortcodes/pricing-table.php';
		require_once GRSA_PATH . 'includes/shortcodes/testimonials.php';
		require_once GRSA_PATH . 'includes/shortcodes/free-resources.php';
		require_once GRSA_PATH . 'includes/shortcodes/our-team.php';
		
	}

	/**
	 * Not in used
	 * 
	 * Load plugin textdomain.
	 */
	function graduate_scope_addon_plugin_textdomain() {
		load_plugin_textdomain( 'graduate-scope-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	
		
		if (!did_action('ACF/loaded')) {
		// add_action('admin_notices', 'graduate_scope_addon_widget_fail_load');
			// return;
		}
	}

}

// Call Main class
new GraduateScopeAddon();