<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


		<div id="content" class="content_padding" role="main">

			<?php if ( have_posts() ) : ?>

				<h1><?php echo single_cat_title( '', false ); ?></h1>

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
						$id = get_the_ID();
						$author = get_post_meta($id, "Autor", true);
						$title = get_the_title();
			?>
				<?php 
				the_shortlink($title, $title, "<span class=\"page-link\">", "</span>"); 
				echo "<p>Autor: ".$author."</p>";
				the_excerpt();
				?>
			<?php

					endwhile;
					// Previous/next page navigation.


				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->


<?php

get_footer();
