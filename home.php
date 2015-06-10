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
		<div class="column_title"><?php echo "\"" . $post->post_title . "\""; ?></div>
		<div class="column_details"><?php echo $author; ?><a id="art-link" href="<?php echo $link; ?>">przeczytaj &rsaquo;&rsaquo;</a></div>
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
			$start_date = format_date(get_post_meta($id, "event_start_date", true));
			$start_time = get_post_meta($id, "event_start_time", true);
	?>
		<div class="column_title"><?php echo "\"" . $post->post_title . "\""; ?></div>
		<div class="column_details"><?php 
			echo $start_date; 
			if ($start_time) {
				echo ", $start_time";
			}
		
		?>
		<a id="art-link" href="<?php echo $link; ?>">przeczytaj &rsaquo;&rsaquo;</a>	
		</div>
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
		<div class="column_title">"<?php echo $post->post_title; ?>"</div>
		<div class="column_details"><?php echo $author; ?> </div>
	<?php
		endwhile;
		wp_reset_postdata();
		
	?>
	<a id="art-link" href="category/kazania">posłuchaj &rsaquo;&rsaquo;</a>
  </div>
</div>

<div id="box2" class="left_right_padding">
<div class="home_invite">
	<img src="<?php bloginfo('template_directory'); ?>/pics/tomasz.jpg" width="105px"/>
</div>
<div>
	 <p>Drogi Przyjacielu!</p>
	   <p>Zapraszam Cię do przeglądania naszej strony internetowej. Znajdziesz tutaj kilka ważnych informacji na temat naszego Kościoła, jego historii i zasad wiary. Tutaj dowiesz się o zbliżających się w naszej Wspólnocie wydarzeniach i nabożeństwach, na które Cię serdecznie zapraszamy. Przede wszystkim jednak mam nadzieję, że zajrzysz do naszej czytelni i odwiedzisz archiwum kazań, by wspólnie z nami rozważać Pismo Święte i zastanawiać się nad stanem swojej duszy. Wierzę, że treści tam zawarte, nie tylko przyniosą Ci odpowiedzi na nurtujące Cię pytania, ale również przybliżą Cię do osoby Jezusa Chrystusa, który przynosi do naszego życia wiele pokoju, radości i nadziei.</p>
	 
	<p style="text-align: center;">"Szukajcie Pana, gdy się pozwala znaleźć, wzywajcie Go, dopóki jest blisko!" Księga Izajasza 66,5 Biblia Tysiąclecia</p>
</div>
 
<p>Niech Bóg Cię błogosławi, <br>
Pastor Tomasz Chyłka</p>

</div>

<?php 
	get_footer()
?>