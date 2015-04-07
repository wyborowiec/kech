<?php
/*
Template Name: Kazania
*/

get_header(); ?>

<div class="content_padding">

<h1>Kazania</h1>

<?php
	$paged = get_paged();
	if (isset($_GET['post_id'])){
		$post_id = $_GET['post_id'];
	} else {
		$post_id = null;
	}
	$query_args = array( 
			'post_type' => 'kech_audio', 
			'post_status'=> 'publish',
			'posts_per_page' => 10,
			'paged' => $paged,
			'order'		=> 'DESC',
			'orderby'	=> 'meta_value',
			'meta_key' 	=> 'event_date'
		);
	if ($post_id) {
		$query_args['p'] = $post_id;
	}
	$query = new WP_Query($query_args);
	
	while ($query -> have_posts() ) : $query -> the_post();
			$id = $post->ID;
			$author = get_post_meta($id, "author", true);
			$date = format_date(get_post_meta($id, "event_date", true));
			
			$matches = array();
			$is_match = preg_match('/\[audio.*mp3="(.*)".*\]/', $post->post_content, $matches);
			if ($is_match){
				$audio_url = $matches[1];
				//echo do_shortcode('$matches[0]');
			} else {
				die("No gallery found in the post content");
			}
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
	if (!$post_id) {
		the_pagination($query);
	}
	
?>


</div>

<?php

get_footer();

?>