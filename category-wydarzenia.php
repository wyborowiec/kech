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



				<h1><?php echo single_cat_title( '', false ); ?></h1>

			<?php
				$paged = get_paged();
				$query = new WP_Query( 
					array( 
						'post_type' => 'kech_event', 
						'post_status'=> 'publish',
						'posts_per_page' => 10,
						'paged' => $paged
					) );
				while ($query->have_posts() ) : $query->the_post();
					$id = get_the_ID();
					$author = get_post_meta($id, "Autor", true);
					$title = get_the_title();
					the_shortlink($title, $title, "<span class=\"page-link\">", "</span>"); 
					echo "<p>Autor: ".$author."</p>";
					the_excerpt();
				endwhile;
				wp_reset_postdata();
				the_pagination($query);
			?>
		</div><!-- #content -->


<?php

get_footer();
