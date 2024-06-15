<?php
/*
	Plugin Name: kamaldhari Practical Yagnik
	Plugin URI: #
	Description: kamaldhari Practical Test by Yagnik || REST API || WooCommerce Add-on
	Version: 1.0
	Author: Dev
	Author URI: #
*/

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
* Define Plugin URL and Directory Path
*/
define('KDPT_ADDON_DIR', plugins_url('/', __FILE__));  // Define Plugin URL
define('KDPT_PATH', plugin_dir_path(__FILE__));        // Define Plugin Directory Path
define('KDPT_DOMAIN', 'kamal-dhari-practical-test');   // Define Text Domain

// Path to ACF zip file
define('ACF_ZIP_FILE', plugin_dir_path(__FILE__) . 'depended-folder/advanced-custom-fields.zip');

class KamalDhariPractical {

	function __construct() {
	
			// enqueue scripts
			add_action( 'wp_enqueue_scripts', array( $this , 'kamal_dhari_practical_test_scripts' ), 20 );

			// include files
			add_action( 'init', array( $this , 'kamal_dhari_practical_test_include_files') );

	}

	/**
	 * Enqueue scripts and styles.
	 *
	 */
	function kamal_dhari_practical_test_scripts() {
		
		// enqueue css
		wp_enqueue_style('dtms-shortcode-style', KDPT_ADDON_DIR . 'assets/css/kamal-dhari-practical-test.css');
		// enqueue js
		wp_enqueue_script( 'dtms-shortcode-js', KDPT_ADDON_DIR . 'assets/js/kamal-dhari-practical-test.js', array('jquery'), '', true );	
	}

	/**
	 * Require files include for 
	 */
	function kamal_dhari_practical_test_include_files(){

		/* Shortcode file */
		require_once KDPT_PATH . 'inc/pricing-table.php';
		
	}

	/**
	 * Not in used
	 * Load plugin textdomain.
	 */
	function kamal_dhari_practical_test_addon_plugin_textdomain() {
		load_plugin_textdomain( 'kamal-dhari-practical-test', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	
	}

}

// Call Main class
new KamalDhariPractical();