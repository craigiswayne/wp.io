<?php
//<editor-fold desc="Deregister Post PostType">
/**
 * Disables the built in post post type
 * @param $args
 * @param $postType
 *
 * @return mixed
 */
function remove_default_post_type($args, $postType) {
	if ($postType === 'post' || $postType === 'page') {
		$args['public']                = false;
		$args['show_ui']               = false;
		$args['show_in_menu']          = false;
		$args['show_in_admin_bar']     = false;
		$args['show_in_nav_menus']     = false;
		$args['can_export']            = false;
		$args['has_archive']           = false;
		$args['exclude_from_search']   = true;
		$args['publicly_queryable']    = false;
		$args['show_in_rest']          = false;
	}
	
	return $args;
}
add_filter('register_post_type_args', 'remove_default_post_type', 0, 2);
//</editor-fold>
