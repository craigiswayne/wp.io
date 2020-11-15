<?php
add_filter( 'enter_title_here', function($placeholder, $post){
	
	if($post->post_type === 'hotel'){
		return 'Enter Hotel Name';
	}
	
	if($post->post_type === 'staff-member'){
		return 'Enter Full Name';
	}
	
	return $placeholder;
}, 22, 2);
