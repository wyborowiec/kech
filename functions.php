<?php

add_shortcode( 'gallery', 'new_gallery_shortcode' );

function new_gallery_shortcode($attr) {
	$output = gallery_shortcode($attr);
	if($attr['link'] == "file") {
		$output = preg_replace('/<a href/', '<a rel=lightbox href', $output);
	}
	return $output;
}

function delete_post_media( $post_id ) {

    $attachments = get_posts( array(
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'post_parent'    => $post_id
    ) );

    foreach ( $attachments as $attachment ) {
        if ( false === wp_delete_attachment( $attachment->ID ) ) {
            // Log failure to delete attachment.
        }
    }
}
add_action('before_delete_post', 'delete_post_media');

function get_paged() {
	if (isset($_GET['pg'])){
		return $_GET['pg'];
	} else {
		return 1;
	};
}

function the_pagination($query) {
	$paged = get_paged();
	$max_num_pages = $query->max_num_pages;
	if ($paged > 1){
		$page_link = add_query_arg('pg', $paged-1);
		echo "<a href='$page_link'>&lt;</a> ";
	} else {
		echo "&lt";
	}
	for ($i=1; $i<=$max_num_pages; $i++){ 
		$page_link = add_query_arg('pg', $i);
		echo $i == $paged ? "<b>" : "";
		echo "<a href='$page_link'>$i</a> ";
		echo $i == $paged ? "</b>" : "";
	}
	if ($paged < $max_num_pages){
		$page_link = add_query_arg('pg', $paged+1);
		echo "<a href='$page_link'>&gt;</a> ";
	} else {
		echo "&gt";
	}
}

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
	wp_enqueue_script(
        'wacekplacek_datetime_validate', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/validate.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
	wp_enqueue_script(
        'wacekplacek_datetimepicker', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/datetimepicker/jquery.datetimepicker.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
}
 
add_action('admin_enqueue_scripts', 'add_jQuery_libraries');

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	//wp_register_script('my-upload', get_bloginfo('template_url') . '/functions/my-script.js', array('jquery','media-upload','thickbox'));
	//wp_enqueue_script('my-upload');
}
function my_admin_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

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
	if ($post->post_type == 'attachment' and $post->post_mime_type == 'audio/mpeg') {	
		remove_meta_box( 'attachment-id3' , 'attachment' , 'normal' ); 
		add_meta_box( 'prfx_meta', __( 'Dodatkowe informacje', 'prfx-textdomain' ), 'kazania_meta_callback', 'attachment' );
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
			<input type="text" name="author" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['author'] ) ) echo $prfx_stored_meta['author'][0]; ?>" nonempty/>
		</p>
 
    <?php
}

function link_datetimepicker_css() {
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/datetimepicker/jquery.datetimepicker.css"/ >
	<?php
}

function kazania_meta_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
		link_datetimepicker_css();
		?>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="event_date" id="datepicker" value="<?php if ( isset ( $prfx_stored_meta['event_date'] ) ) echo $prfx_stored_meta['event_date'][0]; ?>" />
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Autor', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="author" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['author'] ) ) echo $prfx_stored_meta['author'][0]; ?>" nonempty/>
		</p>
		
 
    <?php
}

function kech_event_meta_box_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
		link_datetimepicker_css();
		?>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data rozpoczęcia', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="event_start_date" id="meta-text" class="datepicker" value="<?php if ( isset ( $prfx_stored_meta['event_start_date'] ) ) echo $prfx_stored_meta['event_start_date'][0]; ?>" nonempty/>
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Godzina rozpoczęcia (opcjonalnie)', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="event_start_time" id="meta-text" class="timepicker" value="<?php if ( isset ( $prfx_stored_meta['event_start_time'] ) ) echo $prfx_stored_meta['event_start_time'][0]; ?>"/>
		</p>
		<p>
			<label for="meta-text" class="prfx-row-title"><?php _e( 'Data zakończenia (opcjonalnie)', 'prfx-textdomain' )?></label>
			<br>
			<input type="text" name="event_end_date" id="meta-text" class="datepicker" value="<?php if ( isset ( $prfx_stored_meta['event_end_date'] ) ) echo $prfx_stored_meta['event_end_date'][0]; ?>"/>
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
    if( isset( $_POST[ 'event_date' ] ) ) {
        update_post_meta( $post_id, 'event_date', sanitize_text_field( $_POST[ 'event_date' ] ) );
    }
	if( isset( $_POST[ 'event_time' ] ) ) {
        update_post_meta( $post_id, 'event_time', sanitize_text_field( $_POST[ 'event_time' ] ) );
    }
	
	if( isset( $_POST[ 'author' ] ) ) {
        update_post_meta( $post_id, 'author', sanitize_text_field( $_POST[ 'author' ] ) );
    }
 
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