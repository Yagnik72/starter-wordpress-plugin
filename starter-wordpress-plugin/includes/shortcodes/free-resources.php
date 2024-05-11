<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Free Resources Shortcode.
 *
 */
class GRSA_Free_Resources_Shortcode {

    function __construct() {

		// action for Free Resources shortcode
		add_shortcode( 'gs-free-resources', array( $this, 'gs_free_resources_function') );
		
	}

	/**
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function gs_free_resources_function() {
		// Turn on output buffering
		ob_start();
		?>
			<div class="gs-free-resources-main">
				<h1>We are working on <b>Free Resources</b>.</h1>
			</div>
		<?php

		// return buffering output
		return ob_get_clean();
	}
}
new GRSA_Free_Resources_Shortcode();