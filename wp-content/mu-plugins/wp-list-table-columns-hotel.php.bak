<?php
function cpt_hotel_columns( $columns ) {
	$columns['title'] = 'Hotel';
	unset($columns['categories']);
	unset($columns['date']);
	$columns["total_departments"] = "Departments";
	$columns["total_staff_members"] = "Staff Members";
	$columns["total_questionnaires"] = "Questionnaires";
	$columns["date"] = 'Date';
	return $columns;
}
add_filter('manage_edit-hotel_columns', 'cpt_hotel_columns');

function display_total_departments( $colname, $cptid ) {
	if ( $colname != 'total_departments'){
		return;
	}
	$departments = get_posts( [ 'numberposts'      => -1,
	                            'orderby'          => 'date',
	                            'order'            => 'DESC',
	                            'post_type'        => 'department',
	                            'meta_key'         => 'department_hotel_link',
	                            'meta_value'       => $cptid,
	                            'suppress_filters' => true
	]);
	echo count($departments) ?? 0;
}
add_action('manage_hotel_posts_custom_column', 'display_total_departments', 10, 2);
