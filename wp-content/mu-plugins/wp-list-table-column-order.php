<?php
$targeted_post_types = ['hotel', 'staff-member','questionnaire'];
function reorder_department_column( $columns ) {
	$taxonomy_key = 'taxonomy-department';
	if(!isset($columns[$taxonomy_key])){
		return $columns;
	}
	
	unset($columns[$taxonomy_key]);
	$title_index = array_search('title', array_keys($columns));
	$part_1 = array_slice($columns, 0, $title_index+1);
	$part_2 = array_slice($columns, $title_index+1);
	
	$columns = array_merge($part_1, [$taxonomy_key => 'Departments'], $part_2);
	
	return $columns;
}
foreach($targeted_post_types as $post_type){
	add_filter("manage_edit-${post_type}_columns", 'reorder_department_column');
}

