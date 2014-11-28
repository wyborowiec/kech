<?php
/*
Template Name: Kazania
*/

get_header(); ?>

<div class="content_padding">

<h1>Kazania1</h1>

<?php

	$audios = get_posts( array (
		'post_type' => 'attachment',
		'post_mime_type' => 'audio'
	));
	
	foreach ( $audios as $audio ) {
			setup_postdata( $audio );
			$id = $audio->ID;
			//$link = wp_get_attachment_link($id);
			$meta = wp_get_attachment_metadata($id);
	?>
	<div>
	<span class="page-link"><?php echo $meta["artist"]; ?> - <?php echo $audio->post_title; ?></span>
	</div>
	<div>
	<p>Data: <?php echo $audio->post_date; ?>
	<a href="<?php echo get_permalink( $id ); ?>">Odtwórz</a>
	<a href="<?php echo the_audio_url($id); ?>" download>Pobierz</a>
	</p>
	</div>
	<?php
	}
	wp_reset_postdata();

	
?>


</div>

<?php

get_footer();

?>