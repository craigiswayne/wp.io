<?php
namespace craigiswayne\wordpress;

class PostTypeArgs {
	public static $menu_icon = 'dashicons-book-alt';
	public static $taxonomies = ['category'];
}

class PostType {
	
	public static $definition_file = 'cw_post_types.json';
	private static $registered_callback = false;
	private static $_pending = [];
	
	public static function init(){
		self::import();
	}
	
	private static function import(){
		$definition_file_path = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.self::$definition_file;
		if(!file_exists($definition_file_path)){
			return;
		}
		
		$definition_file = file_get_contents($definition_file_path);
		
		$json = json_decode($definition_file);
		foreach( $json as $singular_name => $args ){
			$args = $args ?? new \stdClass();
			if(isset($args->enabled) && $args->enabled === false){
				self::disable($singular_name);
				continue;
			}
			self::create($singular_name, $args);
		}
	}
	
	/**
	 * @param string $singularName Should be in normal case, i.e. no dashes, not lowercase. This factory will apply the necessary filters where applicable
	 * @param \stdClass $args
	 */
	public static function create(string $singularName, \stdClass $args = null) {
		$slug = sanitize_title($singularName);
		$plural = $args->plural ?? $singularName.'s';
		
		$registerArgs = array(
			'labels'        => array(
				'name'               => __( $plural, $slug ),
				'singular_name'      => __( $singularName, $slug ),
				'menu_name'          => __( $plural, $slug ),
				'name_admin_bar'     => __( $plural, $slug ),
				'add_new'            => __( 'Add New', $slug ),
				'add_new_item'       => __( "Add New $plural", $slug ),
				'edit_item'          => __( "Edit $singularName", $slug ),
				'new_item'           => __( "New $singularName", $slug ),
				'view_item'          => __( "View $singularName", $slug ),
				'search_items'       => __( "Search $plural", $slug ),
				'not_found'          => __( "No $plural found", $slug ),
				'not_found_in_trash' => __( "No $plural found in trash", $slug ),
				'all_items'          => __( "All $plural", $slug ),
				'archive_title'      => __( $plural, $slug ),
			),
			/**
			 * @see: https://developer.wordpress.org/resource/dashicons/#building
			 */
			'menu_icon'     => $args->menu_icon ?? PostTypeArgs::$menu_icon,
//			'menu_position' => 6,
			'public'        => true,
			'has_archive'   => true,
			'hierarchical'  => false,
			'supports'      => array( 'title', 'thumbnail', 'excerpt', 'revisions' ),
			'rewrite'       => array( 'slug' => $slug ),
			'show_in_rest'  => true,
			/**
			 * @example ['category']
			 */
			'taxonomies'    => $args->taxonomies ?? PostTypeArgs::$taxonomies
		);
		self::$_pending[$slug] = $registerArgs;
		self::register_callback();
	}
	
	private static function disable($post_type){
		// TODO
	}

	/**
	 * Registers the WordPress hook
	 */
	private static function register_callback(){
		if(self::$registered_callback){
			return;
		}
		add_action('init', array(self::class,'register_all'));
		self::$registered_callback = true;
	}
	
	/**
	 * Does the actual registration of the post types
	 */
	public static function register_all(){
		foreach(self::$_pending as $slug => $args){
			if( post_type_exists($slug) ){
				continue;
			}
			register_post_type($slug, $args);
		}
	}
}

PostType::init();
