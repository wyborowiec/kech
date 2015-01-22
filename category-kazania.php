<?php
/*
Template Name: Kazania
*/

get_header(); ?>

<div class="content_padding">

<h1>Kazania</h1>

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
	
	while ($query -> have_posts() ) : $query -> the_post();
			$id = $post->ID;
			$author = get_post_meta($id, "author", true);
			$date = get_post_meta($id, "event_date", true);
	?>
	<div class="kazania_list">
		<div class="item_title" >
		<?php echo $author; ?> - <?php echo $post->post_title; ?>
		</div>
		<div class="item_details">
			<div class="kazania_date">
				Data: <?php echo $date; ?>
			</div>
			<div class="kazania_button">
				<div id="button_play" class="follow_link2">Odtwórz</div>
			</div>
			<div class="kazania_button">
				<a class="follow_link2"href="<?php echo the_audio_url($id); ?>" download>Pobierz</a>
			</div>
			<div class="kazania_clear"></div>
		</div>
		<div id="kazania_player"><?php the_content(); ?></div>
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