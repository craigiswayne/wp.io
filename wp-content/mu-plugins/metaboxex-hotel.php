<?php

/* Meta box setup function. */
function linked_departments_box_setup() {
	add_action( 'add_meta_boxes', 'hotel_linked_departments' );
}

function hotel_linked_departments() {
	
	add_meta_box(
		'hotel_linked_departments',      // Unique ID
		esc_html__( 'Linked Departments', 'smartstaff' ),    // Title
		'show_linked_departments_box',   // Callback function
		'hotel',         // Admin page (or post type)
		'normal',         // Context
		'high'         // Priority
	);
}

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'linked_departments_box_setup' );
//add_action( 'load-post-new.php', 'linked_departments_box_setup' );

/* Display the post meta box. */
function show_linked_departments_box( $post ) {
	$departments = get_posts( [ 'numberposts'      => -1,
	                       'orderby'          => 'date',
	                       'order'            => 'DESC',
	                       'post_type'        => 'department',
	                       'meta_key'         => 'department_hotel_link',
	                       'meta_value'       => $post->ID,
	                       'suppress_filters' => true
    ]);
	
	if(count($departments) === 0){
	    echo '<i>None</i>';
	    return;
    }
	
	?>
    
    
    <table class="wp-list-table widefat striped table-view-list">
	<?php foreach($departments as $key => $val): ?>
    <tr>
        <td><?= $key+1; ?></td>
        <td><a href="<?= get_edit_post_link($val->ID) ?>"><?= $val->post_title; ?></a></td>
    </tr>
    <?php endforeach; ?>
    </table>
    <?php
}
