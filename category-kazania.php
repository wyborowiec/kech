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
			'post_type' => 'kech_audio', 
			'post_status'=> 'publish',
			'posts_per_page' => 10,
			'paged' => $paged
		) );
	
	while ($query -> have_posts() ) : $query -> the_post();
			$id = $post->ID;
			$author = get_post_meta($id, "author", true);
			$date = get_post_meta($id, "event_date", true);
			$content = get_the_content();
			$media = get_attached_media('audio');
			$audio = array_pop($media);
			$audio_url = wp_get_attachment_url( $audio->ID );
			//echo "--->" . $audio_url;
	?>
	<div class="kazania_list">
		<div class="item_title" >
		<?php echo $author; ?> - <?php echo $post->post_title; ?>
		</div>
		<div class="item_details">
			<div class="kazania_date">
				Data: <?php echo $date; ?>
			</div>
			<div id="<?php echo $id; ?>" class="kazania_button">
				<a class="follow_link2 play_button" href=""><img class="kazania_icon" id="<?php echo $id; ?>" src="<?php echo get_template_directory_uri()."/pics/odtworz.png"; ?>"/> Odtwórz</a>
			</div>
			<div class="kazania_button">
				<a class="follow_link2" href="<?php echo $audio_url; ?>" download><img src="<?php echo get_template_directory_uri()."/pics/pobierz.png"; ?>"/> Pobierz</a>
			</div>
			<div class="kazania_clear"></div>
		</div>
		<div id="<?php echo $id; ?>" class="kazania_player">
			<?php 
				//the_content();
				echo do_shortcode("[audio mp3='$audio_url']");
			?>
		</div>
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