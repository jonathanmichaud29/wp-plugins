<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.wppb-author-uri.com
 * @since      1.0.0
 *
 * @package    Wppb_Plugin_Slug
 * @subpackage Wppb_Plugin_Slug/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wppb_Plugin_Slug
 * @subpackage Wppb_Plugin_Slug/includes
 * @author     WPPB Author Name <wppb.author@email.com>
 */
class Wppb_Plugin_Slug_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		# https://developer.wordpress.org/reference/functions/register_post_type/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wppb-plugin-slug-post_types.php';
		$plugin_post_types = new Wppb_Plugin_Slug_Post_Types();
		$plugin_post_types->create_custom_post_type();
		flush_rewrite_rules();
	}

}
