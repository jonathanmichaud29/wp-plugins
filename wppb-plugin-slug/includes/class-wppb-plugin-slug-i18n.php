<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.wppb-author-uri.com
 * @since      1.0.0
 *
 * @package    Wppb_Plugin_Slug
 * @subpackage Wppb_Plugin_Slug/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wppb_Plugin_Slug
 * @subpackage Wppb_Plugin_Slug/includes
 * @author     WPPB Author Name <wppb.author@email.com>
 */
class Wppb_Plugin_Slug_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wppb-plugin-slug',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
