<?php
/*
    Plugin Name: Kamaldhari Practical Yagnik
    Plugin URI: #
    Description: Kamaldhari Practical Test by Yagnik || REST API || WooCommerce Add-on
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

class KamalDhariPractical {

    function __construct() {
        // Hook for admin notices
        // add_action('admin_notices', array($this, 'check_woocommerce_active'));
				// register_activation_hook( $file:string, $callback:callable )
				// register_activation_hook(__FILE__, array($this, 'check_woocommerce_active'));

        // Hook to initialize plugin if WooCommerce is active
        add_action('admin_init', array($this, 'check_woocommerce_active'));
        // add_action('init', array($this, 'initialize_plugin'));
    }

    /**
     * Check if WooCommerce is active
     */
    function check_woocommerce_active() {
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            if (current_user_can('activate_plugins')) {
                $plugin = 'woocommerce/woocommerce.php';
                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');
                $activate_url = wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin=' . $plugin . '&plugin_status=all&paged=1&s'), 'activate-plugin_' . $plugin);

                if (file_exists(WP_PLUGIN_DIR . '/' . $plugin)) {
                    echo '<div class="notice notice-warning is-dismissible">
                            <p>WooCommerce is required for <b>Kamaldhari Practical Yagnik Plugin</b>. <br><br> <a href="' . $activate_url . '" class="button button-primary">Activate WooCommerce</a>.</p>
                          </div>';
                } else {
                    echo '<div class="notice notice-warning is-dismissible">
                            <p>WooCommerce is required for <b>Kamaldhari Practical Yagnik Plugin</b>. <br><br> <a href="' . $install_url . '" class="button button-primary">Install WooCommerce</a>.</p>
                          </div>';
                }
            }
					deactivate_plugins( plugin_basename( __FILE__ ) );
        }
    }

    /**
     * Initialize the plugin
     */
    function initialize_plugin() {
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            // enqueue scripts
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 20);

            // include files
            add_action('init', array($this, 'include_files'));
        }
    }

    /**
     * Enqueue scripts and styles.
     */
    function enqueue_scripts() {
        // enqueue css
        wp_enqueue_style('kdpt-shortcode-style', KDPT_ADDON_DIR . 'assets/css/kamal-dhari-practical-test.css');
        // enqueue js
        wp_enqueue_script('kdpt-shortcode-js', KDPT_ADDON_DIR . 'assets/js/kamal-dhari-practical-test.js', array('jquery'), '', true);
    }

    /**
     * Require files include for 
     */
    function include_files() {
        /* Shortcode file */    
        $files = [
            'inc/rest-api.php',
        ];

        foreach ($files as $file) {
            $filepath = KDPT_PATH . $file;
            if (file_exists($filepath)) {
                require_once $filepath;
            }
        }
    }

    /**
     * Not in use
     * Load plugin textdomain.
     */
    function load_textdomain() {
        load_plugin_textdomain('kamal-dhari-practical-test', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}

// Call Main class
new KamalDhariPractical();
