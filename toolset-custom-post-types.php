<?php
/**
 * Plugin Name: Toolset Custom Post Types
 * Plugin URI: http://makss.ca/plugins/toolset-custom-post-types
 * Description: GUI for registering custom post types
 * Author: Maks Sherstobitow
 * Version: 0.1
 * Author URI: http://makss.ca
 */

class Toolset_Custom_Post_Types_Plugin {
	private static $instance = null;
	private $admin_page_name = 'toolset-custom-post-types';
	private $admin_page_fullname = null;
	private $labels = null;
	private $option = null;
	private $taxonomies = null;
	private $toolset = null;
	private $toolset_features = null;
	private $toolset_plugin_path = 'toolset/toolset.php';
	private $toolset_features_plugin_path = 'toolset-features/toolset-features.php';
	private $post_types = null;
	private $post_types_with_builtin = null;
	private $url = null;
	public static $textdomain = 'toolset_custom_post_types';
	private $theme_path = null;

	/**
	 * Init class instance
	 */
	public function __construct() {
		if ( is_admin() ) {
			// Load plugin textdomain
			load_plugin_textdomain( self::$textdomain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
			// Add actions
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			// Init labels values
			$this->labels = array(
				'name' => array( '', __('Name', self::$textdomain), __( 'General name for the post type, usually plural', self::$textdomain ) ),
				'singular_name' => array( '', __('Singular name', self::$textdomain), __( 'Name for one object of this post type', self::$textdomain ) ),
				'menu_name' => array( '', __('Menu name', self::$textdomain), __( 'The menu name text. This string is the name to give menu items', self::$textdomain ) ),
				'name_admin_bar' => array( '', __('Admin bar name', self::$textdomain), __( 'Name given for the Add New dropdown on admin bar', self::$textdomain ) ),
				'all_items' => array( '', __('<b>All items</b> text', self::$textdomain), __( 'The all items text used in the menu', self::$textdomain ) ),
				'add_new' => array( __( 'Add new', self::$textdomain ), __('<b>Add new</b> text', self::$textdomain), __( 'The add new text', self::$textdomain ) ),
				'add_new_item' => array( __( 'Add new', self::$textdomain ) , __('<b>Add new item</b> text', self::$textdomain), __( 'The add new item text', self::$textdomain ) ),
				'edit_item' => array( __( 'Edit item', self::$textdomain ), __('<b>Edit item</b> text', self::$textdomain), __( 'The edit item text', self::$textdomain ) ),
				'new_item' => array( __( 'New item', self::$textdomain ), __('<b>New item</b> text', self::$textdomain), __( 'The new item text', self::$textdomain ) ),
				'view_item' => array( __( 'View item', self::$textdomain ), __('<b>View item</b> text', self::$textdomain), __( 'The view item text', self::$textdomain ) ),
				'search_items' => array( __( 'Search items', self::$textdomain ),  __('<b>Search items</b> text', self::$textdomain), __( 'The view item text', self::$textdomain ) ),
				'not_found' => array( __( 'No items found', self::$textdomain ),  __('<b>Not found in trash</b> text', self::$textdomain), __( 'The not found text', self::$textdomain ) ),
				'not_found_in_trash' => array( __( 'No items found in Trash', self::$textdomain ), __('<b>Not found in trash</b> text', self::$textdomain), __( 'The not found in trash text', self::$textdomain ) ),
				'parent_item_colon' => array( __( 'Parent Item', self::$textdomain ), __('<b>Parent item colon</b> text', self::$textdomain), __( 'The view item text', self::$textdomain ) )
			);
		}
	}

	/**
	 * Set default option value
	 */
	public static function activation_hook() {
		if ( !get_option( self::$textdomain ) )
			update_option( self::$textdomain, array() );
	}

	/**
	 * Gets toolset_plugin instance
	 *
	 * Return toolset_plugin instance if Toolset plugin is exist and activated
	 *
	 * @return toolset_plugin
	 */
	private function toolset() {
		if ( $this->toolset != null )
			return $this->toolset;
		if ( is_plugin_active( $this->toolset_plugin_path ) )
			$this->toolset = Toolset_Plugin::instance();
		return $this->toolset;
	}

	/**
	 * Gets toolset_features instance
	 *
	 * Return toolset_plugin instance if Toolset plugin is exist and activated
	 *
	 * @return toolset_plugin
	 */
	private function toolset_features() {
		if ( $this->toolset_features != null )
			return $this->toolset_features;
		if ( is_plugin_active( $this->toolset_features_plugin_path ) )
			$this->toolset_features = new Toolset_Features_Plugin();
		return $this->toolset_features;
	}

	/**
	 * Inits settings for admin area
	 *
	 * Inits settings for admin area only, enqueues scripts and styles
	 */
	public function admin_init() {
		$this->theme_path = get_stylesheet_directory();
		$this->save_post_data();
		$this->url = plugins_url( basename( __DIR__ ) );
		// Enqueue scripts and styles
		if ( isset( $_GET['page'] ) && ( $_GET['page'] == $this->admin_page_name  || $_GET['page'] == $this->admin_page_name . '-edit' ) ) {
			wp_enqueue_style( self::$textdomain . '_css', $this->url . '/assets/css/production.min.css', array( 'wp-admin' ) );
			wp_enqueue_script( self::$textdomain . '_js', $this->url . '/assets/js/production.min.js', array( 'jquery' ) );
		}
	}

	/**
	 * Adds menu item for plugin page
	 *
	 * Adds menu item for plugin page. If Toolset plugin is available the menu item will be displayed under "Toolset" menu item else under "Settings" menu item.
	 */
	public function admin_menu() {
		if ( !$this->toolset() )
			add_options_page( __( 'Custom Post Types', self::$textdomain ), __( 'Toolset Custom Post Types', self::$textdomain ), 'manage_options', $this->admin_page_name, array( $this, 'admin_page' ) );
		else
			$this->admin_page_fullname = $this->toolset()->add_toolset_page( __( 'Custom Post Types', self::$textdomain ), __( 'Custom Post Types', self::$textdomain ), 'manage_options', $this->admin_page_name, array( $this, 'admin_page' ) );
		add_submenu_page( null, __( 'Edit Custom Post Type', self::$textdomain ), __( 'Edit Custom Post Type', self::$textdomain ), 'manage_options', $this->admin_page_name . '-edit', array( $this, 'edit_page' ) );
	}

	/**
	 * Renders admin page
	 */
	public function admin_page() {
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.', self::$textdomain ) );
		require 'templates/admin.php';
	}

	/**
	 * Renders "add/edit custom post type" page
	 */
	public function edit_page() {
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.', self::$textdomain ) );
		$cpts = $this->option();
		if ( isset( $_GET['post-type'] ) && isset( $cpts[$_GET['post-type']] ) ) {
			$cpt = 	$cpts[$_GET['post-type']];
			$post_type = $_GET['post-type'];
		} else {
			$cpt = require dirname( __FILE__ ) . '/configs/new-custom-post-type.php';
			$post_type = 'new_custom_post_type';
		}

		require 'templates/edit.php';
	}

	/**
	 * Get post types
	 *
	 * Get available post types except "attachment", "revision", "nav_menu_item"
	 */
	public function post_types($with_biltin = false) {
		if (!$with_biltin) {
			if ( $this->post_types == null ) {
				$this->post_types = get_post_types();
			}
			if (!$with_biltin) {
				unset( $this->post_types['attachment'] );
				unset( $this->post_types['revision'] );
				unset( $this->post_types['nav_menu_item'] );
			}
			return $this->post_types;
		} else {

			if ( $this->post_types_with_builtin == null ) {
				$this->post_types_with_builtin = get_post_types(array('_builtin' => true));
			}
			return $this->post_types_with_builtin;
		}
	}

	/**
	 * Save data from POST request
	 */
	private function save_post_data($check_nonce = true) {

		$data = $this->is_post();
		if ( !$data )
			return;

		$keys = array_keys( $data );
		$post_type = reset( $keys );

		 if ($check_nonce)
		 	check_admin_referer( self::$textdomain . '_' . $post_type );

		// Init instance post types
		$this->post_types(true);

		if (isset($data['submit']))
			unset($data['submit']);

		$cpt = $data[$post_type];
		if (isset($cpt['delete']) && $cpt['delete'])
			$this->delete($post_type);

		$cpt['post_type'] = strtolower( substr( $cpt['post_type'], 0, 20 ) );
		$cpt['post_type'] = str_replace( ' ', '_', trim( $cpt['post_type'] ) );
		$cpt['post_type'] = str_replace( array('"', "'"), '', $cpt['post_type'] );
		if ( !$cpt['post_type'] || in_array( $cpt['post_type'], $this->post_types_with_builtin ) ) {
			$cpt['post_type'] = 'NoName_'.time();
		}

		$cpt['capability_type'] = strtolower( $cpt['capability_type'] );
		$cpt['capability_type'] = str_replace( ' ', '_', trim( $cpt['capability_type'] ) );
		$cpt['capability_type'] = str_replace( array('"', "'"), '', $cpt['capability_type'] );

		foreach ($cpt['capabilities'] as $capability_base => $capability_value) {
			$cpt['capabilities'][$capability_base] = strtolower( $capability_value );
			$cpt['capabilities'][$capability_base] = str_replace( ' ', '_', trim( $capability_value ) );
			$cpt['capabilities'][$capability_base] = str_replace( array('"', "'"), '', $capability_value );
		}

		$cpt['description'] = ( $temp = $this->sanitize( $cpt['description'] ) ) ? $temp : '';
		$cpt['label'] = ( $temp = $this->sanitize( $cpt['label'] ) ) ? $temp : $cpt['post_type'];

		if (!count($cpt['labels']))
			$cpt['labels'] = array();

		$cpt['labels']['name'] = ( $temp = $this->sanitize( $cpt['labels']['name'] ) ) ? $temp : $cpt['label'];
		$cpt['labels']['singular_name'] = ( $temp = $this->sanitize( $cpt['labels']['singular_name'] ) ) ? $temp : $cpt['labels']['name'];
		$cpt['labels']['menu_name'] = ( $temp = $this->sanitize( $cpt['labels']['menu_name'] ) ) ? $temp : $cpt['labels']['name'];
		$cpt['labels']['name_admin_bar'] = ( $temp = $this->sanitize( $cpt['labels']['name_admin_bar'] ) ) ? $temp : $cpt['labels']['name'];
		$cpt['labels']['all_items'] = ( $temp = $this->sanitize( $cpt['labels']['all_items'] ) ) ? $temp : $cpt['labels']['name'];
		$cpt['labels']['add_new'] = ( $temp = $this->sanitize( $cpt['labels']['add_new'] ) ) ? $temp : __( 'Add new', self::$textdomain );
		$cpt['labels']['add_new_item'] = ( $temp = $this->sanitize( $cpt['labels']['add_new_item'] ) ) ? $temp : __( 'Add new', self::$textdomain );
		$cpt['labels']['edit_item'] = ( $temp = $this->sanitize( $cpt['labels']['edit_item'] ) ) ? $temp : __( 'Edit item', self::$textdomain );
		$cpt['labels']['new_item'] = ( $temp = $this->sanitize( $cpt['labels']['new_item'] ) ) ? $temp : __( 'New item', self::$textdomain );
		$cpt['labels']['view_item'] = ( $temp = $this->sanitize( $cpt['labels']['view_item'] ) ) ? $temp : __( 'View item', self::$textdomain );
		$cpt['labels']['search_items'] = ( $temp = $this->sanitize( $cpt['labels']['search_items'] ) ) ? $temp : __( 'Search items', self::$textdomain );
		$cpt['labels']['not_found'] = ( $temp = $this->sanitize( $cpt['labels']['not_found'] ) ) ? $temp : __( 'No items found', self::$textdomain );
		$cpt['labels']['not_found_in_trash'] = ( $temp = $this->sanitize( $cpt['labels']['not_found_in_trash'] ) ) ? $temp : __( 'No items found in Trash', self::$textdomain );
		$cpt['labels']['parent_item_colon'] = ( $temp = $this->sanitize( $cpt['labels']['parent_item_colon'] ) ) ? $temp : __( 'Parent Item', self::$textdomain );

		// Update Toolset Features post formats data if Toolset Features Plugin is available
		if ( $this->toolset_features() && isset( $cpt['post-formats'] ) ) {
			$post_formats_options = $this->toolset_features->option();
			if ( !$post_formats_options || !is_array( $post_formats_options ) )
				$post_formats_options = array();
			if ( !isset( $post_formats_options['post-formats'] ) )
				$post_formats_options['post-formats'] = array();
			if ( isset( $post_formats_options['post-formats'][$post_type] ) )
				unset( $post_formats_options['post-formats'][$post_type] );
			$post_formats_options['post-formats'][$cpt['post_type']] = $cpt['post-formats'];
			$this->toolset_features->save_post_data($post_formats_options, false);
			unset( $cpt['post-formats'] );
		}

		$data = $this->option();
		if ( isset($data[$post_type] ) ) {
			unset( $data[$post_type] );
		}
		$data[$cpt['post_type']] = $cpt;
		update_option( self::$textdomain, $data );
		$this->create_file_cache();

		wp_redirect( admin_url() . '/admin.php?page=toolset-custom-post-types-edit&post-type=' . $cpt['post_type']);
		exit;
	}

	/**
	 * Delete passed custom post type from DB
	 */
	private function delete($post_type) {
		$data = $this->option();
		if ( isset($data[$post_type] ) ) {
			unset( $data[$post_type] );
			update_option( self::$textdomain, $data );
			$this->create_file_cache();
		}
		wp_redirect( admin_url() . '/admin.php?page=toolset-custom-post-types');
		exit;
	}

	/**
	 * Creates file to save scriptt to register custo post types
	 */
	private function create_file_cache() {
		$this->option(true);
		$post_formats_enabled = false;
		$thumbnails_enabled = false;
		$code = '<?php ';
		foreach ($this->option as $cpt) {
			if (!$cpt['enabled'])
				continue;

			if ($cpt['show_in_sub_menu'])
				$cpt['show_in_menu'] = $cpt['show_in_sub_menu'];
			else
				$cpt['show_in_menu'] = (bool)$cpt['show_in_menu'];

			if ($cpt['query_var_string'])
				$cpt['query_var'] = $cpt['query_var_string'];

			if ($cpt['rewrite_slug']) {
				$cpt['rewrite'] = array(
					'slug' => $cpt['rewrite_slug'],
					'with_front' => (bool)$cpt['rewrite_with_front'],
					'feeds' => (bool)$cpt['rewrite_feeds'],
					'pages' => (bool)$cpt['rewrite_pages']
				);
			} else
				$cpt['rewrite'] = (bool)$cpt['rewrite'];

			$taxonomies = array();
			foreach ($cpt['taxonomies'] as $taxonomy => $enabled) {
				if ($enabled)
					$taxonomies[] = $taxonomy;
			}
			unset($cpt['taxonomies']);
			if (count($taxonomies))
				$cpt['taxonomies'] = $taxonomies;

			if (!$cpt['capability_type'])
				unset( $cpt['capability_type'] );


			$capabilities = array();
			foreach ($cpt['capabilities'] as $capability_base => $capability_value) {
				if ($capability_value)
					$capabilities[$capability_base] = $capability_value;
			}
			unset($cpt['capabilities']);
			if (count($capabilities))
				$cpt['capabilities'] = $capabilities;

			$cpt['public'] = (bool)$cpt['public'];
			$cpt['exclude_from_search'] = (bool)$cpt['exclude_from_search'];
			$cpt['publicly_queryable'] = (bool)$cpt['publicly_queryable'];
			$cpt['show_ui'] = (bool)$cpt['show_ui'];
			$cpt['show_in_nav_menus'] = (bool)$cpt['show_in_nav_menus'];
			$cpt['show_in_admin_bar'] = (bool)$cpt['show_in_admin_bar'];
			$cpt['hierarchical'] = (bool)$cpt['hierarchical'];
			$cpt['has_archive'] = (bool)$cpt['has_archive'];
			$cpt['query_var'] = (bool)$cpt['query_var'];
			$cpt['can_export'] = (bool)$cpt['can_export'];

			$supports = array();
			foreach ($cpt['supports'] as $support => $enabled) {
				if ($enabled)
					$supports[] = $support;
			}
			if (in_array( 'thumbnail', $supports ))
				$thumbnails_enabled = true;

			unset($cpt['supports']);
			if (count($supports))
				$cpt['supports'] = $supports;

			$messages = $cpt['messages'];
			foreach ($messages as $index => $message) {
				if (!trim($message))
					unset($messages[$index]);
			}

			unset($cpt['enabled']);
			unset($cpt['show_in_sub_menu']);
			unset($cpt['rewrite_slug']);
			unset($cpt['rewrite_with_front']);
			unset($cpt['rewrite_feeds']);
			unset($cpt['rewrite_pages']);
			unset($cpt['messages']);
			unset($cpt['query_var_string']);
			unset($cpt['delete']);

			$code .= '$' . $cpt['post_type'] . '_args = ' . var_export($cpt, 1) . ';';
			$code .= 'register_post_type( "' . $cpt['post_type'] . '", $' . $cpt['post_type'] . '_args );';


			// Add post formats code
			if (!$this->toolset_features() && in_array( 'post-formats', $cpt['supports'] ) ) {
				$code .= ' add_post_type_support( "' . $cpt['post_type'] . '", "post-formats" );';
				$post_formats_enabled = true;
			}

			if (count($messages))
				$code .= require dirname( __FILE__ ) . '/configs/messages-filter-template.php';
		}

		if ($post_formats_enabled)
			$code .= "add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );";

		if ($thumbnails_enabled)
			$code .= "add_theme_support( 'post-thumbnails' );";


		// Create file with custom post types registering
		$url = wp_nonce_url(  admin_url() . '/admin.php?page=toolset-custom-post-types-edit&post-type=' . $cpt['post_type'], self::$textdomain );
		if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
			wp_die( __( 'Sorry, the plugin can not write data to your server filesystem. ', self::$textdomain) );
		}
		if ( !WP_Filesystem($creds) ) {
			request_filesystem_credentials($url, '', true, false, null);
			return;
		}

		global $wp_filesystem;
		$wp_filesystem->put_contents(
		  get_stylesheet_directory() . '/toolset/custom-post-types.php',
		  $code,
		  FS_CHMOD_FILE // predefined mode settings for WP files
		);

    	flush_rewrite_rules();
	}

	private function sanitize($value) {
		$value = trim( $value );
		$value = str_replace( array( '"', "'" ), '', $value );
		$value = strip_tags( $value );
		$value = stripslashes( $value );
		return $value;
	}

	/**
	 * Check if POST for plugin exists
	 *
	 * @return bool
	 */
	private function is_post() {
		return count( $_POST ) && isset( $_POST[self::$textdomain] ) && is_array( $_POST[self::$textdomain] ) && count( $_POST[self::$textdomain] ) ? $_POST[self::$textdomain] : array() ;
	}

	/**
	 * Gets saved option
	 *
	 * Gets saved option. If option is not exist return null
	 *
	 * @return mixed It may be array, scalar value or null
	 */
	public function option($force = false) {
		if ( $this->option == null || $force) {
			$this->option = get_option( self::$textdomain );
			if ( !$this->option )
				$this->option = array();
		}
		return $this->option;
	}

 	/**
  	* Gets taxonomies
	*
	* @return mixed It may be array, scalar value or null
	*/
	public function taxonomies() {
		if ( $this->taxonomies == null ) {
			$this->taxonomies = get_taxonomies( array(), 'objects' );
			if ( isset( $this->taxonomies[ 'nav_menu' ] ) )
				unset( $this->taxonomies[ 'nav_menu' ] );
			if ( isset( $this->taxonomies[ 'link_category' ] ) )
				unset( $this->taxonomies[ 'link_category' ] );
			if ( isset( $this->taxonomies[ 'post_format' ] ) )
				unset( $this->taxonomies[ 'post_format' ] );
		}
		return $this->taxonomies;
	}


	/**
	 * Notice plugin's data updated
	 */
	public function notice() {
		if ( !$this->is_post() )
			return;
		echo '<div class="updated"><p>';
		echo __( 'Custom Post Types updated', self::$textdomain );
		echo '</p></div>';
	}

}

/**
 * Inits plugin on all plugins loaded
 */
add_action('plugins_loaded', 'toolset_custom_post_types_plugins_loaded');

function toolset_custom_post_types_plugins_loaded() {
	new Toolset_Custom_Post_Types_Plugin();
}

/**
 * Register activation hook
 */
if ( is_admin() ) {
	register_activation_hook( __FILE__, array( 'Toolset_Custom_Post_Types_Plugin', 'activation_hook' ) );
}


/**
 * Registers post types
 */
add_action( 'init', 'toolbox_custom_post_types_register_post_types' );

function toolbox_custom_post_types_register_post_types() {
	$path = get_stylesheet_directory() . '/toolset/custom-post-types.php';
	if (file_exists( $path ) && is_readable( $path ) )
		require $path;
	//var_dump($GLOBALS['wp_post_types']);exit;
}



