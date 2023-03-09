<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Testimonials Shortcode.
 *
 */
class GRSA_Testimonials_Shortcode {

    function __construct() {

		// action for testimonials shortcode
		add_shortcode( 'gs-testimonials', array( $this, 'gs_pricing_table_function') );
		
	}

	/**
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function gs_pricing_table_function() {
		// Turn on output buffering
		ob_start();
		?>
			<div class="gs-testimonials-main">
				<h1>We are working on <b>Testimonials</b>.</h1>
			</div>
		<?php

		// return buffering output
		return ob_get_clean();
	}
}
new GRSA_Testimonials_Shortcode();