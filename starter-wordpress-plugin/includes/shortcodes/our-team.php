<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pricing Table Shortcode.
 *
 */
class GRSA_Our_Team_Shortcode {

    function __construct() {

		// action for Our Team shortcode
		add_shortcode( 'gs-our-team', array( $this, 'gs_our_team_function') );
		
	}

	/**
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function gs_our_team_function() {
		// Turn on output buffering
		ob_start();
		?>
			<div class="gs-our-team-main">
				<h1>We are working on <b>Our Team</b>.</h1>
			</div>
		<?php

		// return buffering output
		return ob_get_clean();
	}
}
new GRSA_Our_Team_Shortcode();