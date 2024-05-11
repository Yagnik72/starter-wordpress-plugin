<?php
/*
Plugin Name: Mydental Touch Social (photos, blog, testimonials)
Plugin URI: #
Description: Mydental Touch Social (photos, blog, testimonials)
Version: 1.0
Author: mydental-photos-blog-testimonials
Author URI: 
*/

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
* Define Plugin URL and Directory Path
*/
define('MPBT_ADDON_DIR_IMAGE_URI', plugins_url('/assets/image', __FILE__));  // Define Plugin URL
define('MPBT_ADDON_DIR', plugins_url('/', __FILE__));  // Define Plugin URL
define('MPBT_PATH', plugin_dir_path(__FILE__));        // Define Plugin Directory Path
define('MPBT_DOMAIN', 'mydental-photos-blog-testimonials-plugin-cpt');   // Define Text Domain

// Register the activation hook
register_activation_hook( __FILE__,function(){

	if(empty(get_option( 'mydental_photos_blog_testimonials_options'))) {
		update_option('mydental_photos_blog_testimonials_options',array ( 'button_background_color' => '#253039', 'button_text_color' => '#9dc3cf', 'border_light' => '#ffffff', 'border_dark' => '#000000', 'text_color' => '#043b68', 'font_family' => '"Outfit", sans-serif', 'first_screen_title' => 'consultation', 'first_screen_text' => 'Use our Consultation Tool to get matched with personalized treatment options for your unique concerns.', 'first_screen_button_text' => 'start my consultation', 'first_screen_left_image' => '49', 'second_screen_title' => 'consultation', 'second_screen_text' => 'To receive confidential treatment recommendations, please first select male or female, then click on the appropriate body area on the model to the right, and select your cosmetic concerns.', 'second_screen_subtitle_text' => 'Pick Your Model', 'third_screen_left_title' => 'How To!', 'third_screen_left_text' => 'First, select the areas of your cosmetic concerns, then press “add to consultation”. When you’ve completed selecting all of your concerns, press “finish consultation”.', 'body_man_abdomen' => 'Abdomen ', 'body_man_chest' => 'Chest ', 'body_man_thighs' => 'Thighs ', 'body_man_arms' => 'Arms ', 'body_man_lower_legs' => 'Leg', 'body_man_neck' => 'Neck ', 'body_man_upper_face_forhead' => 'Forehead and eyes', 'body_man_lower_face_chin' => 'Chin ', 'body_man_midface' => 'Nose and Cheeks', 'body_man_lips' => 'Lip ', 'body_man_back' => 'Man Back', 'body_man_lower_legs_calves' => 'Calves ', 'body_man_hands' => 'Hands ', 'body_woman_abdomen' => 'Abdomen ', 'body_woman_chest' => 'Chest ', 'body_woman_arms' => 'Arms ', 'body_woman_thighs' => 'Thighs ', 'body_woman_lower_legs' => 'Legs ', 'body_woman_neck' => 'Neck', 'body_woman_upper_face_forhead' => 'Forehead and eyes', 'body_woman_lower_face_chin' => 'Chin ', 'body_woman_midface' => 'Nose and Cheeks', 'body_woman_lips' => 'Lips ', 'body_woman_back' => 'Woman Back ', 'body_woman_buttocks' => 'Buttocks', 'body_woman_hands' => 'Hands ', 'admin_email' => '', 'email_body' => '', ));
	}
	
});


class MydentalTouchSocialPlugin {

	function __construct() {
		
		$this->adminFiles();

		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this , 'virtual_plugin_scripts' ), 20 );
		
		// include files
		add_action( 'init', array( $this , 'virtual_plugin_shortcode_include_files') );

		add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'your_plugin_settings_link'));

	}

	// Add settings link to plugin listing
	public function your_plugin_settings_link($links) {
		$settings_link = '<a href="admin.php?page=mydental-photos-blog-testimonials-settings">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}


	public function adminFiles(){
		
		function Setting_() {
			
		}

		require_once MPBT_PATH . 'includes/admin/mydental-photos-blog-testimonials-admin-option.php';

	}
	


	/**
	 * Enqueue scripts and styles.
	 *
	 */
	function virtual_plugin_scripts() {
		
		// enqueue css
		wp_register_style('mpbt-shortcode-style', MPBT_ADDON_DIR . 'assets/css/mydental-photos-blog-testimonials-plugin-cpt.css', time());
		$stylt = "
		:root {
			--widget-text-color: ".esc_attr(get_option('mydental_photos_blog_testimonials_options')['text_color']).";
			--wpvcp-primary: ".esc_attr(get_option('mydental_photos_blog_testimonials_options')['button_text_color']).";
			--wpvcp-bg: ".esc_attr(get_option('mydental_photos_blog_testimonials_options')['button_background_color']).";
			--wpvcp-white: ".esc_attr(get_option('mydental_photos_blog_testimonials_options')['border_light']).";
			--wpvcp-black: ".esc_attr(get_option('mydental_photos_blog_testimonials_options')['border_dark']).";
		  } .outfit p { font-family:".(get_option('mydental_photos_blog_testimonials_options')['font_family'])." }";
		wp_add_inline_style( 'mpbt-shortcode-style', $stylt );

		
		wp_register_script( 'mpbt-shortcode-js', MPBT_ADDON_DIR . 'assets/js/mydental-photos-blog-testimonials-plugin-cpt.js', array('jquery'), '', true );
		wp_localize_script( 'mpbt-shortcode-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}


	/**
	 * Require files.
	 *
	 * Graduate scope register shortcodes.
	 *
	 */
	function virtual_plugin_shortcode_include_files(){

		/* Shortcode file */
		require_once MPBT_PATH . 'includes/shortcodes/mydental-photos-blog-testimonials-shortcode.php';
		
	}

	/**
	 * Not in used
	 * 
	 * Load plugin textdomain.
	 */
	function virtual_plugin_addon_plugin_textdomain() {
		load_plugin_textdomain( 'mpbt-plugin-cpt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	

	}

}

// Call Main class
new MydentalTouchSocialPlugin();