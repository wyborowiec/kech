<?php
/*
Template Name: Single 
*/

get_header(); ?>

<div class="content_padding">
archive
			<?php 
				// Start the Loop.
				query_posts( 'post_type=kech_article');
				while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<h2>Autor: 
					<?php 
						$id = get_the_ID();
						$author = get_post_meta($id, "author", true);
						echo $author;
					?></h2>
			<?php
					the_content();
				endwhile;
			?>


</div>

<?php

get_footer();

?>