<?php
/*
Template Name: Czytelnia
*/

get_header(); ?>

<div class="content_padding">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<h2>Autor: 
					<?php 
						$id = get_the_ID();
						$author = get_post_meta($id, "author", true);
						echo $author;
					?></h2>
					<div class="post_content">
			<?php
					the_content();
			?>
					</div>
			<?php
				endwhile;
			?>


</div>

<?php

get_footer();

?>