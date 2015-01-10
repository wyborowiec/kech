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

			<?php
				
				$paged = get_paged();
				$query = new WP_Query( 
					array( 
						'post_type' => 'kech_article', 
						'post_status'=> 'publish',
						'posts_per_page' => 2,
						'paged' => $paged
					) );
					
			if ($query -> have_posts()) : ?>

				<h1>CZYTELNIA</h1>

			<?php
					// Start the Loop.
					while ($query -> have_posts() ) : $query -> the_post();
						$id = get_the_ID();
						$author = get_post_meta($id, "author", true);
						$title = get_the_title();
			?>
				<div class="article_item">
					<div class="article_item_title">
					<?php the_title(); ?>
					</div>
					<div class="article_item_thumb">
					<?php 
					echo get_the_post_thumbnail($id, 'article-thumbnail');
					?>
					</div>
					<div class="article_item_summary">
					<?php
					//the_shortlink($title, $title, "<span class=\"page-link\">", "</span>"); 
					echo "<h1>Autor: ".$author."</h1>";
					the_excerpt();
					?>
					</div>
					<div class="article_item_end">
					</div>
				</div>
			<?php

					endwhile;
					// Previous/next page navigation.
					wp_reset_postdata();
					the_pagination($query);

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->


<?php

get_footer();
