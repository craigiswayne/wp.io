<?php
namespace craigiswayne\wordpress;

class PostType {
	
	public static $definition_file = "f2_post_types.json";
	private static $registered_callback = false;
	private static $_pending = [];
	
	public static function init(){
		$definition_file_path = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.self::$definition_file;
		if(file_exists($definition_file_path)){
			
			$definition_file = file_get_contents($definition_file_path);
			
			$jsonIterator = new \RecursiveIteratorIterator(
				new \RecursiveArrayIterator(json_decode($definition_file, TRUE)),
				\RecursiveIteratorIterator::SELF_FIRST);
			
			foreach ($jsonIterator as $singular_name => $options) {
				if(!is_array($options)) {
					continue;
				}
				self::create($singular_name);
			}
		}
	}
	
	/**
	 * @param string $singularName Should be in normal case, i.e. no dashes, not lowercase. This factory will apply the necessary filters where applicable
	 * @param array $options
	 */
	public static function create(string $singularName, array $options = []) {
		$slug = sanitize_title($singularName);
		$plural = $options->plural ?? $singularName.'s';
		
		$args = array(
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
			'menu_icon'     => 'dashicons-book-alt',
//			'menu_position' => 6,
			'public'        => true,
			'has_archive'   => true,
			'hierarchical'  => false,
			'supports'      => array( 'title', 'thumbnail', 'excerpt', 'revisions' ),
			'rewrite'       => array( 'slug' => $slug ),
			'show_in_rest'  => true,
			'rest_base'     => $slug,
			'taxonomies'    => array( 'category' )
		);
		self::$_pending[$slug] = $args;
		self::register_callback();
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
