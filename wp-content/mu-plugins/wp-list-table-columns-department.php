<?php

function cpt_department_columns( $columns ) {
	$columns['title'] = 'Department';
	unset($columns['categories']);
	unset($columns['date']);
	$columns["hotel"] = "Hotel";
	//	$columns["total_staff_members"] = "Departments";
	//	$columns["total_questionnaires"] = "Departments";
	$columns["date"] = 'Date';
	return $columns;
}
add_filter('manage_edit-department_columns', 'cpt_department_columns');

function department_hotel_column( $colname, $cptid ) {
	if ( $colname != 'hotel'){
		return;
	}
	$default = '<i>None</i>';
	$hotel_id = get_post_meta( $cptid, 'department_hotel_link', true );
	if(!$hotel_id){
		echo $default;
		return;
	}
	
	$hotel = get_post($hotel_id);
	echo "<a href='" . get_edit_post_link( $hotel->ID ) . "'>".$hotel->post_title."</a>";
}
add_action('manage_department_posts_custom_column', 'department_hotel_column', 10, 2);
