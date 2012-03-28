<?php
################################################################################
// CUSTOM POST TYPES
// Register post types and taxonomies
// @Staff
// @Sermons
// @Misc. Custom Post Type Magic
################################################################################


// Register Staff Posts
if ( ! function_exists( 'fs_add_staff' ) ) {
	function fs_add_staff() {
	
		global $fs_options;
	
		// "Staff" Custom Post Type
		$labels = array(
			'name' => _x( 'Staff', 'post type general name' ),
			'singular_name' => _x( 'Staff', 'post type singular name' ),
			'add_new' => _x( 'Add New' ),
			'add_new_item' => __( 'Add New Staff Member' ),
			'edit_item' => __( 'Edit Staff Member' ),
			'new_item' => __( 'New Staff Member' ),
			'view_item' => __( 'View Staff Member' ),
			'search_items' => __( 'Search Staff Members' ),
			'not_found' =>  __( 'No staff members found' ),
			'not_found_in_trash' => __( 'No staff members found in Trash' ), 
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'staff', 'with_front' => false ),
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => null, 
			'has_archive' => true, 
			'taxonomies' => array( 'church-staff' ), 
			'supports' => array( 'title','editor','thumbnail', 'page-attributes' )
		);
		
		register_post_type( 'staff', $args );
		
		// "Staff Title" Custom Taxonomy. Designates a staff member's title
		$labels = array(
			'name' => _x( 'Church Staff Title', 'taxonomy general name' ),
			'singular_name' => _x( 'Church Staff Title', 'taxonomy singular name' ),
			'search_items' =>  __( 'Church Staff Title' ),
			'all_items' => __( 'All Church Staff Titles' ),
			'parent_item' => __( 'Parent Church Staff' ),
			'parent_item_colon' => __( 'Parent Church Staff Title:' ),
			'edit_item' => __( 'Edit Church Staff Title' ), 
			'update_item' => __( 'Update Church Staff Title' ),
			'add_new_item' => __( 'Add New Church Staff Title' ),
			'new_item_name' => __( 'New Church Staff Title' ),
			'menu_name' => __( 'Staff Titles' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'church-staff-title' )
		);
		
		register_taxonomy( 'church-staff-title', array( 'staff' ), $args );
		
		// Add Meta Box for Contact Information
		add_action( 'add_meta_boxes', 'add_staff_metaboxes' );
		// Add the Contact Meta Boxes
		function add_staff_metaboxes() {
    	add_meta_box('staff_contact', 'Contact Information', 'staff_contact', 'staff', 'normal', 'high');
		}
		
		// The Contact Information Metabox
		function staff_contact() {
   		global $post;
    
    	// Noncename needed to verify where the data originated
    	echo '<input type="hidden" name="staffmeta_noncename" id="staffmeta_noncename" value="' .
    	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    	
    	// Get the contact data if its already been entered
    	$email = get_post_meta($post->ID, '_email', true);
        $phone = get_post_meta($post->ID, '_phone', true);
        $facebook = get_post_meta($post->ID, '_facebook', true);
        $twitter = get_post_meta($post->ID, '_twitter', true);
    
    	// Echo out the field
        echo '<p>Enter email address:</p>';
    	echo '<input type="text" name="_email" value="' . $email  . '" class="widefat" />';
        echo '<p>Phone number:</p>';
        echo '<input type="text" name="_phone" value="' . $phone  . '" class="widefat" />';
        echo '<p>Facebook URL: (e.g. facebook.com/WeAreFoursquare)</p>';
        echo '<input type="text" name="_facebook" value="' . $facebook  . '" class="widefat" />';
        echo '<p>Twitter Username: (e.g. WeAreFoursquare)</p>';
        echo '<input type="text" name="_twitter" value="' . $twitter  . '" class="widefat" />';
		}	
		
		// Save the Metabox Data
		function wpt_save_staff_meta($post_id, $post) {
    	// verify this came from the our screen and with proper authorization,
    	// because save_post can be triggered at other times
    	if ( !wp_verify_nonce( $_POST['staffmeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    	}
    
    	// Is the user allowed to edit the post or page?
    	if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    	// OK, we're authenticated: we need to find and save the data
    	// We'll put it into an array to make it easier to loop though.
    	$staff_meta['_email'] = $_POST['_email'];
    	$staff_meta['_phone'] = $_POST['_phone'];
    	$staff_meta['_facebook'] = $_POST['_facebook'];
    	$staff_meta['_twitter'] = $_POST['_twitter'];
    	// Add values of $events_meta as custom fields
    	foreach ($staff_meta as $key => $value) { // Cycle through the $staff_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    	}
		}
		add_action('save_post', 'wpt_save_staff_meta', 1, 2); // save the custom fields
		$staff_meta['_email'] = $_POST['_email'];
		$staff_meta['_phone'] = $_POST['_phone'];
		$staff_meta['_facebook'] = $_POST['_facebook'];
    	$staff_meta['_twitter'] = $_POST['_twitter'];
	}
	
	add_action( 'init', 'fs_add_staff' );
}


// Register Sermon Posts
if ( ! function_exists( 'fs_add_sermons' ) ) {
	function fs_add_sermons() {
	
		global $fs_options;
	
		// "Sermons" Custom Post Type
		$labels = array(
			'name' => _x( 'Sermons', 'post type general name' ),
			'singular_name' => _x( 'Sermon', 'post type singular name' ),
			'add_new' => _x( 'Add New' ),
			'add_new_item' => __( 'Add New Sermon' ),
			'edit_item' => __( 'Edit Sermon' ),
			'new_item' => __( 'New Sermon' ),
			'view_item' => __( 'View Sermon' ),
			'search_items' => __( 'Search Sermons' ),
			'not_found' =>  __( 'No sermons found' ),
			'not_found_in_trash' => __( 'No sermons found in Trash' ), 
			'parent_item_colon' => ''
		);
		
		$sermonitems_rewrite = get_option( 'fs_sermonitems_rewrite' );
 		if( empty( $sermonitems_rewrite ) ) { $sermonitems_rewrite = 'sermons'; }
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => $sermonitems_rewrite ),
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => null, 
			'has_archive' => true, 
			'taxonomies' => array( 'sermon-speakers' ), 
			'supports' => array( 'title','editor','thumbnail' )
		);
		
		register_post_type( 'sermons', $args );
		
		// "Series" Custom Taxonomy. Allows sermons to be grouped together if they are in a series.
		$labels = array(
			'name' => _x( 'Series', 'taxonomy general name' ),
			'singular_name' => _x( 'Series', 'taxonomy singular name' ),
			'search_items' =>  __( 'Series' ),
			'all_items' => __( 'All Series' ),
			'parent_item' => __( 'Parent Series' ),
			'parent_item_colon' => __( 'Parent Series:' ),
			'edit_item' => __( 'Edit Series' ), 
			'update_item' => __( 'Update Series' ),
			'add_new_item' => __( 'Add New Series' ),
			'new_item_name' => __( 'New Series' ),
			'menu_name' => __( 'Series' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'series' )
		);
		
		register_taxonomy( 'series', array( 'sermons' ), $args );
		
		// "Sermon Speaker" Custom Taxonomy. Designates a speaker for a particular sermon post.
		$labels = array(
			'name' => _x( 'Sermon Speaker', 'taxonomy general name' ),
			'singular_name' => _x( 'Sermon Speaker', 'taxonomy singular name' ),
			'search_items' =>  __( 'Sermon Speaker' ),
			'all_items' => __( 'All Sermon Speakers' ),
			'parent_item' => __( 'Parent Sermon Speaker' ),
			'parent_item_colon' => __( 'Parent Sermon Speaker:' ),
			'edit_item' => __( 'Edit Sermon Speaker' ), 
			'update_item' => __( 'Update Sermon Speaker' ),
			'add_new_item' => __( 'Add New Sermon Speaker' ),
			'new_item_name' => __( 'New Sermon Speakers' ),
			'menu_name' => __( 'Sermon Speakers' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sermon-speakers' )
		);
		
		register_taxonomy( 'sermon-speakers', array( 'sermons' ), $args );
		
		// "Topics" Custom Taxonomy. Designates central topic for a particular sermon post.
		$labels = array(
			'name' => _x( 'Topics', 'taxonomy general name' ),
			'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
			'search_items' =>  __( 'Topic' ),
			'all_items' => __( 'All Topics' ),
			'parent_item' => __( 'Parent Topic' ),
			'parent_item_colon' => __( 'Parent Topic:' ),
			'edit_item' => __( 'Edit Topic' ), 
			'update_item' => __( 'Update Topic' ),
			'add_new_item' => __( 'Add New Topic' ),
			'new_item_name' => __( 'New Topic' ),
			'menu_name' => __( 'Topics' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'topics' )
		);
		
		register_taxonomy( 'topics', array( 'sermons' ), $args );
		
		// "Bible Verses" Custom Taxonomy. Designates Bible verse for a particular sermon post.
		$labels = array(
			'name' => _x( 'Bible Verses', 'taxonomy general name' ),
			'singular_name' => _x( 'Bible Verse', 'taxonomy singular name' ),
			'search_items' =>  __( 'Bible Verse' ),
			'all_items' => __( 'All Bible Verses' ),
			'parent_item' => __( 'Parent Bible Verse' ),
			'parent_item_colon' => __( 'Parent Bible Verse:' ),
			'edit_item' => __( 'Edit Bible Verse' ), 
			'update_item' => __( 'Update Bible Verse' ),
			'add_new_item' => __( 'Add New Bible Verse' ),
			'new_item_name' => __( 'New Bible Verses' ),
			'menu_name' => __( 'Bible Verses' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'bible-verses' )
		);
		
		register_taxonomy( 'bible-verses', array( 'sermons' ), $args );
		
		// Add Meta Box for Sermon Media
		add_action( 'add_meta_boxes', 'add_sermon_metaboxes' );
		// Add the Contact Meta Boxes
		function add_sermon_metaboxes() {
    	add_meta_box('sermon_media', 'Sermon Media Files', 'sermon_media', 'sermons', 'normal', 'low');
		}
		
		// The Sermon Media Metabox
		function sermon_media() {
   		global $post;
    
    	// Noncename needed to verify where the data originated
    	echo '<input type="hidden" name="sermonmeta_noncename" id="sermonmeta_noncename" value="' .
    	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    	
    	// Get the contact data if its already been entered
    	$video = get_post_meta($post->ID, '_video', true);
    	$youtube = get_post_meta($post->ID, '_youtube', true);
        $audio = get_post_meta($post->ID, '_audio', true);
        $notes = get_post_meta($post->ID, '_notes', true);
    
    	// Echo out the field
        echo '<p>Enter video file URL from Media Library (must be .mp4 format):</p>';
    	echo '<input type="text" name="_video" value="' . $video  . '" class="widefat" />';
    	echo '<p>Or enter YouTube ID instead:</p>';
    	echo '<input type="text" name="_youtube" value="' . $youtube  . '" class="widefat" />';
        echo '<p>Enter Audio file URL From Media Library:</p>';
        echo '<input type="text" name="_audio" value="' . $audio  . '" class="widefat" />';
        echo '<p>Enter Notes file URL From Media Library:</p>';
        echo '<input type="text" name="_notes" value="' . $notes  . '" class="widefat" />';
		}	
		
		// Save the Metabox Data
		function wpt_save_sermon_meta($post_id, $post) {
    	// verify this came from the our screen and with proper authorization,
    	// because save_post can be triggered at other times
    	if ( !wp_verify_nonce( $_POST['sermonmeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    	}
    
    	// Is the user allowed to edit the post or page?
    	if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    	// OK, we're authenticated: we need to find and save the data
    	// We'll put it into an array to make it easier to loop though.
    	$sermon_meta['_video'] = $_POST['_video'];
    	$sermon_meta['_youtube'] = $_POST['_youtube'];
    	$sermon_meta['_audio'] = $_POST['_audio'];
    	$sermon_meta['_notes'] = $_POST['_notes'];
    	// Add values of $events_meta as custom fields
    	foreach ($sermon_meta as $key => $value) { // Cycle through the $sermon_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    	}
		}
		add_action('save_post', 'wpt_save_sermon_meta', 1, 2); // save the custom fields
		$sermon_meta['_video'] = $_POST['_video'];
		$sermon_meta['_youtube'] = $_POST['_youtube'];
		$sermon_meta['_audio'] = $_POST['_audio'];
		$sermon_meta['_notes'] = $_POST['_notes'];
	}
	
	add_action( 'init', 'fs_add_sermons' );
}

// Misc. Custom Post Type Magic
/* -------------------------------------------------------------------------- */
 
// Get taxonomies terms links
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
		return $return;
	}
}
?>