<?php

/* Meta box setup function. */
function smartstaff_staff_member_meta_boxes_setup() {
	
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'smartstaff_staff_member_add_post_meta_boxes' );
	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'smartstaff_staff_member_details_save', 10, 2 );
}

/* Save the meta box’s post metadata. */
function smartstaff_staff_member_details_save( $post_id, $post ) {
	
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['smartstaff_staff_member_details_nonce'] ) || !wp_verify_nonce( $_POST['smartstaff_staff_member_details_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	
	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['department_hotel_link'] ) ? sanitize_text_field( $_POST['department_hotel_link'] ) : '' );
	
	/* Get the meta key. */
	$meta_key = 'department_hotel_link';
	
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	
	/* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	
	/* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

function smartstaff_staff_member_add_post_meta_boxes() {
	
	add_meta_box(
		'smartstaff_staff_member_details',      // Unique ID
		esc_html__( 'Contact Details', 'smartstaff' ),    // Title
		'smartstaff_staff_member_details_box',   // Callback function
		'staff-member',         // Admin page (or post type)
		'normal',         // Context
		'high'         // Priority
	);
	
	add_meta_box(
		'smartstaff_staff_member_connection',      // Unique ID
		esc_html__( 'Connection', 'smartstaff' ),    // Title
		'smartstaff_staff_member_connection_box',   // Callback function
		'staff-member',         // Admin page (or post type)
		'normal',         // Context
		'high'         // Priority
	);
}

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'smartstaff_staff_member_meta_boxes_setup' );
add_action( 'load-post-new.php', 'smartstaff_staff_member_meta_boxes_setup' );

/* Display the post meta box. */
function smartstaff_staff_member_details_box( $post ) { ?>
	
	<?php wp_nonce_field( basename( __FILE__ ), 'smartstaff_staff_member_details_nonce' ); ?>
	
	<p>
		<div>
            <label>Mobile Number</label>
        </div>
	</p>
<?php }

/* Display the post meta box. */
function smartstaff_staff_member_connection_box( $post ) { ?>
	
	<?php wp_nonce_field( basename( __FILE__ ), 'smartstaff_staff_member_connection_nonce' ); ?>

    <p>
    <div>
        <label>Invited</label>
    </div>
    <div>
        <label>Enabled</label>
    </div>
    <div>
        <label>Questionnaires</label>
    </div>
    </p>
<?php }
