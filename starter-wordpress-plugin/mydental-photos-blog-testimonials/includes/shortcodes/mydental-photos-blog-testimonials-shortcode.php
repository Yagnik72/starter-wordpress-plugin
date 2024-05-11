<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Free Resources Shortcode.
 */
class VCS_Free_Resources_Shortcode {

    function __construct() {

		// action for Free Resources shortcode
		add_shortcode( 'virtual_consultation', array( $this, 'virtual_consultation_plugin_function') );
		
	}

	/**
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function virtual_consultation_plugin_function() {

		wp_enqueue_style('mpbt-shortcode-style');
		wp_enqueue_script( 'mpbt-shortcode-js');

		// Turn on output buffering
		ob_start();

		?>
			<div class="outfit mydental-photos-blog-testimonials-main">
				
			</div>
			
		<?php
		
		// return buffering output
		return ob_get_clean();
	}
}
new VCS_Free_Resources_Shortcode();