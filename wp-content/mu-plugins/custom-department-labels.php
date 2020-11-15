<?php

add_filter( "taxonomy_labels_department", function($labels){
	if(!isset($_REQUEST['post_type'])){
		return $labels;
	}
	
	$page = basename($_SERVER["SCRIPT_FILENAME"], '.php');
	if($page !== 'edit-tags'){
		return $labels;
	}
	
	$requested_post_type = $_REQUEST['post_type'];
	$post_type_obj = get_post_type_object($requested_post_type);
	$labels->name .= " linked to ".$post_type_obj->labels->name;
	
	return $labels;
}, 10, 1 );

