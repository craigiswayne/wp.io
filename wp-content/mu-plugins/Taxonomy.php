<?php
namespace craigiswayne\wordpress;

class TaxonomyArgs {
	public $show_admin_column = true;
}

class Taxonomy {

	private static $config_file = 'cw_taxonomies.json';
	private static $registered_callback = false;
	private static $_pending = [];
	
	public static function boot(){
		self::import();
	}
	
	public static function import(){
		$definition_file_path = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.self::$config_file;
		if(!file_exists($definition_file_path)){
			error_log(self::class.': no config file found... skipping importing', 0);
			return;
		}
		
		$definition_file = file_get_contents($definition_file_path);
		
		$json = json_decode($definition_file);
		
		if($json === null){
			return wp_die(self::class.' Importer Error: Invalid Syntax');
		}
		
		foreach( $json as $singular_name => $args ){
			$args = $args ?? new \stdClass();
			self::create($singular_name, $args);
		}
	}
	
	/**
	 * @param string $singularName Should be in normal case, i.e. no dashes, not lowercase. This factory will apply the necessary filters where applicable
	 * @param \stdClass $args
	 */
	public static function create(string $key, \stdClass $args = null) {
		$singular = ucwords($key);
		$plural = $singular.'s';
		$slug = sanitize_title($key);
		
		$labels = array(
			'name'					=> _x( $plural, $singular, 'craigiswayne' ),
			'singular_name'			=> _x( $singular, 'Taxonomy singular name', 'craigiswayne' ),
			'search_items'			=> __( "Search $plural", 'craigiswayne' ),
			'popular_items'			=> __( "Popular $plural", 'craigiswayne' ),
			'all_items'				=> __( "All $plural", 'craigiswayne' ),
			'parent_item'			=> __( "Parent $singular", 'craigiswayne' ),
			'parent_item_colon'		=> __( "Parent $singular", 'craigiswayne' ),
			'edit_item'				=> __( "Edit $singular", 'craigiswayne' ),
			'update_item'			=> __( "Update $singular", 'craigiswayne' ),
			'add_new_item'			=> __( "Add New $singular", 'craigiswayne' ),
			'new_item_name'			=> __( "New $singular", 'craigiswayne' ),
			'add_or_remove_items'	=> __( "Add or remove $plural", 'craigiswayne' ),
			'choose_from_most_used'	=> __( "Choose from most used $plural", 'craigiswayne' ),
			'menu_name'				=> __( $plural, 'craigiswayne' ),
		);
		
		$register_args = array(
			'description'       => $plural,
			'labels'			=> $labels,
			'public' 			=> true,
			'show_in_nav_menus'	=> true,
			'show_admin_column' => true,
			'hierarchical'		=> true,
			'show_tagcloud'		=> true,
			'show_ui'			=> true,
			'query_var'			=> true,
			'rewrite'			=> true,
			'capabilities'		=> [],
			'post_types'        => $args->post_types ?? ['post']
		);
		
		
		self::$_pending[$slug] = $register_args;
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
			if( taxonomy_exists($slug) ){
				continue;
			}
			register_taxonomy( $slug, $args['post_types'], $args );
		}
	}
}

Taxonomy::boot();
