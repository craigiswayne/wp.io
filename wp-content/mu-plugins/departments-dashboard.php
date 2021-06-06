<?php

use craigiswayne\wordpress\Capabilities;

/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page(){
	add_menu_page(
		__( 'Departments Dashboard', 'craigiswayne' ),
		'Departments',
		Capabilities::$exist,
		'departments-dashboard',
		'departments_dashboard',
		'dashicons-networking',
		8
	);
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

/**
 * Display a custom menu page
 */
function departments_dashboard(){
//	esc_html_e( 'Departments Dashboard', 'craigiswayne' );
//	$tax = get_taxonomy( 'department' );
//	$wp_list_table = _get_list_table( 'WP_Terms_List_Table' );
//	$pagenum       = $wp_list_table->get_pagenum();
	require_once(__DIR__.DIRECTORY_SEPARATOR.'departments-dashboard.phtml');
}
