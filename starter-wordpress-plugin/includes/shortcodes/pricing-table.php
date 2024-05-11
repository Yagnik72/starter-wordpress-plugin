<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pricing Table Shortcode.
 *
 */
class  GRSA_Pricing_Table_Shortcode {

    function __construct() {

		// action for price table shortcode
		add_shortcode( 'gs-pricing-table', array( $this, 'gs_pricing_table_function') );
		
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
			<div class="gs-pricing-table-main">
				<h1>We are working on <b>Pricing Table</b>.</h1>
			</div>
		<?php

		// return buffering output
		return ob_get_clean();
	}
}
new GRSA_Pricing_Table_Shortcode();