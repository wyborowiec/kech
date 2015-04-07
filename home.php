<?php 
	get_header()
?>
<?php echo do_shortcode("[metaslider id=37]"); ?>

<div class="columns-or-whatever">
  <div class="column">
	<h3>NAJNOWSZE ARTYKUŁY</h3>

	<?php
		$query = new WP_Query( 
			array( 
				'post_type' => 'kech_article', 
				'post_status' => 'publish',
				'posts_per_page' => 4
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
	<h3>NADCHODZĄCE WYDARZENIA</h3>

	<?php
		$query = new WP_Query( 
			array( 
				'post_type' => 'kech_event', 
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'order'		=> 'ASC',
				'orderby'	=> 'meta_value',
				'meta_key' 	=> 'event_start_date'
			) );
		while ($query->have_posts()) : $query->the_post();
			$id = $post->ID;
			$link = wp_get_shortlink($id);
			$start_date = get_post_meta($id, "event_start_date", true);
			$start_time = get_post_meta($id, "event_start_time", true);
	?>
		<p><?php echo "\"" . $post->post_title . "\""; ?></br>
		<?php 
			echo $start_date; 
			if ($start_time) {
				echo ", $start_time";
			}
		
		?>
		<a id="art-link" href="<?php echo $link; ?>">przeczytaj &rsaquo;&rsaquo;</a></p>	
	<?php
		endwhile;
		wp_reset_postdata();
	?>


  </div>
  <div class="column">
	<h3>NAJNOWSZE KAZANIA</h3>
	<?php
		$query = new WP_Query( 
		array( 
			'post_type' => 'kech_audio', 
			'post_status'=> 'publish',
			'posts_per_page' => 4,
			'order'		=> 'DESC',
			'orderby'	=> 'meta_value',
			'meta_key' 	=> 'event_date'
		) );
		while ($query->have_posts()) : $query->the_post();
			$id = $post->ID;
			$link = wp_get_shortlink($id);
			$author = get_post_meta($id, "author", true);
	?>
		<p>"<?php echo $post->post_title; ?>"</br>
		<?php echo $author; ?>
		</li>	
		</p>
	<?php
		endwhile;
		wp_reset_postdata();
		
	?>
	<a id="art-link" href="category/kazania">posłuchaj &rsaquo;&rsaquo;</a>
  </div>
</div>

<div id="box2" class="left_right_padding">
 <p>Drogi Przyjacielu!</p>
   <p>Zapraszam Cię serdecznie do przeglądania naszej strony internetowej. Znajdziesz tu kilka cennych informacji o naszym Kościele, jak również wiadomości na temat prowadzonych przez nas służb. Tutaj dowiesz się o planowanych w naszej Wspólnocie wydarzeniach oraz terminach spotkań i nabożeństw.
  Przede wszystkim jednak mam nadzieję, że zajrzysz do naszej czytelni by rozważać Pismo Święte i zastanawiać się nad stanem swojej duszy. Wierzę, że treści zawarte w niej nie tylko dadzą Ci poznanie Słowa, ale także przybliżą Cię do osoby Jezusa Chrystusa i przyniosą do twojego życia wiele Bożego pokoju, radości i nadziei.

Niech Bóg Cię błogosławi.</p>
      <p>Pastor Tomasz Chyłka</p>

</div>

<?php 
	get_footer()
?>