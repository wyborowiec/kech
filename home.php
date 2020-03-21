<?php 
	get_header()
?>
<?php echo do_shortcode("[metaslider id=4]"); ?>

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
	   <p>W czasach epidemii koronawirusa wielu z nas zastanawia się więcej nad wartością życia, jaki jest jego sens, dlaczego tutaj jesteśmy i dokąd zmierzamy. Jaką wartość ma moje życie dla Boga i co On myśli o tym co dzieje się wokół mnie? Mamy więc wyjątkową okazję, aby skłonić swe serca i umysły do refleksji, na które wielu z nas nie stać było wcześniej z powodu zabiegania, pracy, konsumpcji i innych nie cierpiących zwłoki spraw życia codziennego.</p> 
<p>Skoro Twój świat się zatrzymał na moment – może i Ty Przyjacielu zechcesz!</p>
<p>Zapraszam Cię więc do wejścia na baner „Życie to więcej“. Znajdziesz tam wiele cennych myśli i artykułów wzbogacających duszę oraz przynoszących odpowiedzi na trudne pytania. Przede wszystkim jednak mam nadzieję, że zajrzysz do naszej czytelni i odwiedzisz archiwum kazań, by wspólnie z nami rozważać Pismo Święte. Tytuły kazań i artykułów pomogą znaleźć poszukiwane tematy. Jestem przekonany, że treści tam zawarte, przybliżą Cię do osoby Jezusa Chrystusa, który przynosi do naszego życia prawdziwy pokój w dniach paniki, prawdziwą radość w dniach smutku i niebiańską nadzieję w chwilach beznadziei.</p>
<p>Zapraszamy na nabożeństwo nadawane online poprzez nasz kanał <a href="https://www.facebook.com/pages/Kechpszczyna/151944431531784" target="_blank">FB kechpszczyna</a> oraz do odsłuchiwania kazań na kanale <a href="https://www.youtube.com/channel/UCBjOjcfzKhm_QkHWS9fy6Fw" target="_blank">Youtube KECh Pszczyna</a>.</p>
	 
	<p style="text-align: center;">"Szukajcie Pana, gdy się pozwala znaleźć, wzywajcie Go, dopóki jest blisko!" Księga Izajasza 66,5 Biblia Tysiąclecia</p>
</div>
 
<p>Niech Bóg Cię błogosławi, <br>
Pastor Tomasz Chyłka</p>

</div>

<?php 
	get_footer()
?>