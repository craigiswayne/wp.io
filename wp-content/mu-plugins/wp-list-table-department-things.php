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


/**
 * Fixes Department Column Names to prevent confusion
 */
add_filter('manage_edit-department_columns', function($columns){
	if(!isset($_REQUEST['post_type'])){
		return $columns;
	}
	
	if(!isset($columns['posts'])){
		return $columns;
	}
	
	$post_type = $_REQUEST['post_type'];
	$post_type_obj = get_post_type_object($post_type);
	
	unset($columns['posts']);
	$columns["linked_${post_type}_count"] = $post_type_obj->labels->name;

	return $columns;
}, 10, 2);

function get_department_post_type_link_count($content,$column_name,$term_id){
	if(!isset($_REQUEST['post_type'])){
		return $content;
	}
	
	$post_type = $_REQUEST['post_type'];
	
	if($column_name !== "linked_{$post_type}_count"){
		return $content;
	}
	
	$linked_posts = get_posts(array(
		'post_type' => $post_type,
		'numberposts' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'department',
				'field' => 'term_id',
				'terms' => $term_id, /// Where term_id of Term 1 is "1".
				'include_children' => false
			)
		)
	));
	
	$content = "<a href='" . esc_url( add_query_arg( $_REQUEST, 'edit.php' ) ) . "'>".count($linked_posts)."</a>";
	
	return $content;
}
add_filter('manage_department_custom_column', 'get_department_post_type_link_count',10,3);
