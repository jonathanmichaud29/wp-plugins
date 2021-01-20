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
class Wppb_Plugin_Slug_Post_Types {

  public function create_custom_post_type() {
    $aOptions = array(
			'labels'              => array(
				'name'                => __('WPPB Plugin Names ', 'textdomain'),
				'singular_name'       => __('WPPB Plugin Name', 'textdomain'),
			),
			'description'         => 'Replace default WP "Blog" Post Type',
			'public'              => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'rest_base'           => 'wppb_plugin_slug',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'menu_position'       => 1,
			#'menu_icon'          => 'data:image/svg+xml;base64,',
      'supports'            => array('excerpt'), # 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
			'taxonomies'         => array(),
			'has_archive'         => true,
      'rewrite'             => array(
				'slug'                => 'wppb_plugin_slug',
				'with_front'          => true,
				'feeds'               => true,
				'pages'               => true,
			),
			'query_var'           => 'wppb_plugin_slug',
			'can_export'          => true,
			'delete_with_user'    => false,
			#'template'           => array(),
			'template_lock'       => false,
			'_builtin'            => false
		);

		#$mResult = register_post_type('wppb_plugin_slug', $aOptions);

		/**
		 * Register Taxonomies if any
		 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		$aTaxonomies = array(
			array(
				'taxonomy'          => 'plugin_taxonomy',
				'plural'            => 'Technologies',
				'single'            => 'Technology',
				'post_types'        => array( 'wppb_plugin_slug' ),
				'hierarchical'			=> false,
				'rewrite'						=> array(
					'slug'							=> 'plugin-taxonomy',
				)
			),
		);
		foreach ( $aTaxonomies as $aTaxonomy ) {
			#$this->__register_taxonomy( $aTaxonomy );
		}

	}
	
	private function __register_taxonomy( $aFields ) {

		$labels = array(
				'name'                       => $aFields['plural'],
				'singular_name'              => $aFields['single'],
				'menu_name'                  => $aFields['plural'],
				'all_items'                  => sprintf( __( 'All %s' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'edit_item'                  => sprintf( __( 'Edit %s' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'view_item'                  => sprintf( __( 'View %s' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'update_item'                => sprintf( __( 'Update %s' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'add_new_item'               => sprintf( __( 'Add New %s' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'new_item_name'              => sprintf( __( 'New %s Name' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'parent_item'                => sprintf( __( 'Parent %s' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'parent_item_colon'          => sprintf( __( 'Parent %s:' , 'PLUGIN_NAME' ), $aFields['single'] ),
				'search_items'               => sprintf( __( 'Search %s' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'popular_items'              => sprintf( __( 'Popular %s' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'separate_items_with_commas' => sprintf( __( 'Separate %s with commas' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'add_or_remove_items'        => sprintf( __( 'Add or remove %s' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'choose_from_most_used'      => sprintf( __( 'Choose from the most used %s' , 'PLUGIN_NAME' ), $aFields['plural'] ),
				'not_found'                  => sprintf( __( 'No %s found' , 'PLUGIN_NAME' ), $aFields['plural'] ),
		);

		$args = array(
			'label'                 => $aFields['plural'],
			'labels'                => $labels,
			'hierarchical'          => ( isset( $aFields['hierarchical'] ) )          ? $aFields['hierarchical']          : true,
			'rewrite'               => ( isset( $aFields['rewrite'] ) )               ? $aFields['rewrite']               : true,
			'meta_box_cb'           => ( isset( $aFields['meta_box_cb'] ) )           ? $aFields['meta_box_cb']           : false,
			/* 'public'                => ( isset( $aFields['public'] ) )                ? $aFields['public']                : true,
			'show_ui'               => ( isset( $aFields['show_ui'] ) )               ? $aFields['show_ui']               : true,
			'show_in_nav_menus'     => ( isset( $aFields['show_in_nav_menus'] ) )     ? $aFields['show_in_nav_menus']     : true,
			'show_tagcloud'         => ( isset( $aFields['show_tagcloud'] ) )         ? $aFields['show_tagcloud']         : true,
			
			'show_admin_column'     => ( isset( $aFields['show_admin_column'] ) )     ? $aFields['show_admin_column']     : true,
			'show_in_quick_edit'    => ( isset( $aFields['show_in_quick_edit'] ) )    ? $aFields['show_in_quick_edit']    : true,
			'update_count_callback' => ( isset( $aFields['update_count_callback'] ) ) ? $aFields['update_count_callback'] : '',
			'show_in_rest'          => ( isset( $aFields['show_in_rest'] ) )          ? $aFields['show_in_rest']          : true,
			'rest_base'             => $aFields['taxonomy'],
			'rest_controller_class' => ( isset( $aFields['rest_controller_class'] ) ) ? $aFields['rest_controller_class'] : 'WP_REST_Terms_Controller',
			'query_var'             => $aFields['taxonomy'],
			
			'sort'                  => ( isset( $aFields['sort'] ) )                  ? $aFields['sort']                  : '', */
		);

		#register_taxonomy( $aFields['taxonomy'], $aFields['post_types'], $args );

	}
}
