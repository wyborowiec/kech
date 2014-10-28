<?php 
	get_header()
?>
<?php echo do_shortcode("[metaslider id=37]"); ?>

<div class="columns-or-whatever">
  <div class="column">
	<h3>Najnowsze artykuły</h3>

	<?php
		$query = new WP_Query( 
			array( 
				'post_type' => 'kech_article', 
				'post_status' => 'publish',
				'posts_per_page' => 5
			) );
		while ($query->have_posts()) : $query->the_post();
			$id = $post->ID;
			$link = wp_get_shortlink($id);
			$author = get_post_meta($id, "author", true);
	?>
		<p><?php echo "\"" . $post->post_title . "\""; ?></br>
		<?php echo $author; ?><a id="art-link" href="<?php echo $link; ?>">przeczytaj &rsaquo;&rsaquo;</a></p>	
	<?php
		endwhile;
		wp_reset_postdata();
	?>


  </div>
  <div class="column">
	<h3>Nadchodzące wydarzenia</h3>

	<?php
		$query = new WP_Query( 
			array( 
				'post_type' => 'kech_event', 
				'post_status' => 'publish',
				'posts_per_page' => 5
			) );
		while ($query->have_posts()) : $query->the_post();
			$id = $post->ID;
			$link = wp_get_shortlink($id);
	?>
		<p><?php echo "\"" . $post->post_title . "\""; ?></br>
		<a id="art-link" href="<?php echo $link; ?>">przeczytaj &rsaquo;&rsaquo;</a></p>	
	<?php
		endwhile;
		wp_reset_postdata();
	?>


  </div>
  <div class="column">
	<h3>Najnowsze kazania</h3>
	<?php
		$query = new WP_Query( 
			array( 
				'category_name' => 'kazania', 
				'post_type' => 'attachment', 
				'post_status'=>'all',
				'posts_per_page' => 5
			) );
		while ($query->have_posts()) : $query->the_post();
			$id = $post->ID;
			$link = wp_get_shortlink($id);
			$author = get_post_meta($id, "author", true);
	?>
		<p>"<?php echo $post->post_excerpt; ?>"</br>
		<?php echo $author; ?>
		<a id="art-link" href="<?php echo $link; ?>"> &rsaquo;&rsaquo;</a></li>	
		</p>
	<?php
		endwhile;
		wp_reset_postdata();
	?>
  </div>
</div>

<div id="box2" class="left_right_padding">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet leo tristique, malesuada elit vitae, efficitur ipsum. Aenean venenatis aliquet tincidunt. Nulla sed aliquet ligula, tempor ultrices leo. Pellentesque ut erat at diam imperdiet blandit. Donec efficitur a sem ac molestie. Nunc euismod lorem in sapien ultricies faucibus. Nam quam nisi, semper et justo ut, malesuada cursus elit. Praesent a turpis augue. Sed eu elit ut ex varius mattis. Nunc fringilla nunc a interdum venenatis. In mattis erat ac tristique pulvinar.

Integer non elit gravida, blandit lorem a, pellentesque nisi. Cras at leo at purus lobortis mollis. Fusce in consectetur ante. Donec eu ligula et sapien laoreet consequat. Nullam id odio ac mauris hendrerit pretium. Integer eu tempus nisi. Duis non metus quis massa euismod iaculis. Proin id pellentesque risus, ac elementum eros.
</div>



<?php 
	get_footer()
?>