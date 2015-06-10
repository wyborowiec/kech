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
			<h1>ARTYKUŁY</h1>
			<?php
				
				$paged = get_paged();
				$query = new WP_Query( 
					array( 
						'post_type' => 'kech_article', 
						'post_status'=> 'publish',
						'posts_per_page' => 2,
						'paged' => $paged
					) );
					
			if ($query -> have_posts()) : 
					// Start the Loop.
					while ($query -> have_posts() ) : $query -> the_post();
						$id = get_the_ID();
						$author = get_post_meta($id, "author", true);
						$title = get_the_title();
						$shortlink = wp_get_shortlink();
						$date = get_the_date("j.m.Y");
			?>
				<div class="article_item">
					<div class="article_item_title">
					<h2><a href="<?php echo $shortlink ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article_item_thumb">
					<a href="<?php echo $shortlink ?>"><?php 
					echo get_the_post_thumbnail($id, 'article-thumbnail');
					?></a>
					</div>
					<div class="article_item_summary">
					<h1><?php echo "Autor: $author, data: $date";?></h1>
					<?php
					the_excerpt();
					?>
					<a class="follow_link float_right" href="<?php echo $shortlink ?>">CZYTAJ &rsaquo;</a>
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
