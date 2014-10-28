<?php

add_theme_support( 'post-thumbnails' ); 

function add_post_types() {
    $args = array(
      'public' => true,
      'label'  => 'Artykuły',
	  'register_meta_box_cb' => 'add_kech_article_meta_boxes'
    );
    register_post_type( 'kech_article', $args );
	$args = array(
      'public' => true,
      'label'  => 'Galerie'
    );
    register_post_type( 'kech_gallery', $args );
	$args = array(
      'public' => true,
      'label'  => 'Wydarzenia',
	  'register_meta_box_cb' => 'add_kech_event_meta_boxes'
    );
    register_post_type( 'kech_event', $args );
}
add_action( 'init', 'add_post_types' );

function add_jQuery_libraries() {

	//wp_deregister_script('jquery');

    // Registering Scripts
     wp_register_script('google-hosted-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);
	 //wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);

     wp_register_script('jquery-validation-plugin', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('google-hosted-jquery'));

    // Enqueueing Scripts to the head section
	wp_enqueue_script('google-hosted-jquery');
    //wp_enqueue_script('google-hosted-jquery');
    wp_enqueue_script('jquery-validation-plugin');
	wp_enqueue_script(
        'wacekplacek_datetime_validate', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/validate.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
}
 
// Wordpress action that says, hey wait! lets add the scripts mentioned in the function as well.
//add_action( 'wp_enqueue_scripts', 'add_jQuery_libraries' );

function the_audio_url($id) {
	$upload_dir = wp_upload_dir();
	$baseurl = $upload_dir['baseurl'];
	$meta = get_post_meta($id);
	echo $baseurl."/".$meta["_wp_attached_file"][0];
}

function the_artist($id) {
	$meta = wp_get_attachment_metadata($id);
	echo $meta["artist"];
}

function add_kech_article_meta_boxes($post) {
	add_meta_box( 'prfx_meta', __( 'Dodatkowe informacje', 'prfx-textdomain' ), 'kech_article_meta_box_callback', 'kech_article' );
}

function add_kech_event_meta_boxes($post) {
	add_meta_box( 'prfx_meta', __( 'Dodatkowe informacje', 'prfx-textdomain' ), 'kech_event_meta_box_callback', 'kech_event' );
}

function prfx_custom_meta() {
	global $post;
	if ($post->post_type == 'attachment') {
		$cats = wp_get_post_categories( $post -> ID);
		$cat = get_category( $cats[0] );
		if ($cat->slug == 'kazania'){
			
			add_meta_box( 'prfx_meta', __( 'Dodatkowe informacje', 'prfx-textdomain' ), 'kazania_meta_callback', 'attachment' );
		} 
	}
}
add_action( 'add_meta_boxes', 'prfx_custom_meta' );

function kech_article_meta_box_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
		?>
	 
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Autor', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="author" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['author'] ) ) echo $prfx_stored_meta['author'][0]; ?>" required/>
		</p>
 
    <?php
}

function kazania_meta_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
		?>
	 
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data', 'prfx-textdomain' )?></label>
			<br>
			<input type="date" name="event_date" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['event_date'] ) ) echo $prfx_stored_meta['event_date'][0]; ?>" />
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Autor', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="author" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['author'] ) ) echo $prfx_stored_meta['author'][0]; ?>" required/>
		</p>
 
    <?php
}

function kech_event_meta_box_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
		?>
	 
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data rozpoczęcia', 'prfx-textdomain' )?></label>
			<br>
			<input type="date" name="event_start_date" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['event_start_date'] ) ) echo $prfx_stored_meta['event_start_date'][0]; ?>" required/>
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Godzina rozpoczęcia (opcjonalnie)', 'prfx-textdomain' )?></label>
			<br>
			<input type="time" name="event_start_time" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['event_start_time'] ) ) echo $prfx_stored_meta['event_start_time'][0]; ?>"/>
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data zakończenia (opcjonalnie)', 'prfx-textdomain' )?></label>
			<br>
			<input type="date" name="event_end_date" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['event_end_date'] ) ) echo $prfx_stored_meta['event_end_date'][0]; ?>"/>
		</p>
    <?php
}

function prfx_meta_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	$meta_fields = array('author', 'event_start_date', 'event_start_time', 'event_end_date');
	foreach ($meta_fields as $i => $meta_field) {
		if( isset( $_POST[$meta_field] ) ) {
			update_post_meta( $post_id, $meta_field, sanitize_text_field( $_POST[$meta_field] ) );
		}
	}
 
    // Checks for input and sanitizes/saves if needed
    /*if( isset( $_POST[ 'event_date' ] ) ) {
        update_post_meta( $post_id, 'event_date', sanitize_text_field( $_POST[ 'event_date' ] ) );
    }
	if( isset( $_POST[ 'event_time' ] ) ) {
        update_post_meta( $post_id, 'event_time', sanitize_text_field( $_POST[ 'event_time' ] ) );
    }
	
	if( isset( $_POST[ 'author' ] ) ) {
        update_post_meta( $post_id, 'author', sanitize_text_field( $_POST[ 'author' ] ) );
    }*/
 
}
add_action( 'save_post', 'prfx_meta_save' );
add_action( 'edit_attachment', 'prfx_meta_save' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}

function get_post_author($id) {
	get_post_meta($id, "author", true);
}

add_action( 'init', 'register_my_menu' );

function wptp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'wptp_add_categories_to_attachments' );

?>