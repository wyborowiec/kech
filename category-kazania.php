<?php
/*
Template Name: Kazania
*/

get_header(); ?>

<div class="content_padding">

<h1>Kazania1</h1>

<?php
	$paged = get_paged();
	$query = new WP_Query( 
		array( 
			'post_type' => 'attachment',
			'post_mime_type' => 'audio',
			'paged' => $paged,
			'post_status'=> 'inherit',
			'posts_per_page' => 2
		) );
	
	//foreach ( $audios as $audio ) {
	while ($query -> have_posts() ) : $query -> the_post();
			//setup_postdata( $audio );
			$id = $post->ID;
			//$link = wp_get_attachment_link($id);
			$meta = wp_get_attachment_metadata($id);
	?>
	<div>
	<span class="page-link"><?php echo $meta["artist"]; ?> - <?php echo $post->post_title; ?></span>
	</div>
	<div>
	<p>Data: <?php echo $post->post_date; ?>
	<a href="<?php echo get_permalink( $id ); ?>">Odtwórz</a>
	<a href="<?php echo the_audio_url($id); ?>" download>Pobierz</a>
	</p>
	</div>
	<?php
	endwhile;
	wp_reset_postdata();
	the_pagination($query);
	
?>


</div>

<?php

get_footer();

?>