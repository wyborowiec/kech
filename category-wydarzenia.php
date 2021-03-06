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
				<h1>WYDARZENIA</h1>

			<?php
				$paged = get_paged();
				$query = new WP_Query( 
					array( 
						'post_type' => 'kech_event', 
						'post_status'=> 'publish',
						'posts_per_page' => 10,
						'paged' => $paged,
						'order'		=> 'ASC',
						'orderby'	=> 'meta_value',
						'meta_key' 	=> 'event_start_date'
					) );
				while ($query->have_posts() ) : $query->the_post();
					$id = get_the_ID();
					$author = get_post_meta($id, "author", true);
					$title = get_the_title();
					$date = format_date(get_post_meta($id, "event_start_date", true));
					$time = get_post_meta($id, "event_start_time", true);
					$shortlink = wp_get_shortlink();
					?>
					<div class="article_item">
					<div class="item_title">
					<h2><a href="<?php echo $shortlink ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article_item_thumb">
					<a href="<?php echo $shortlink ?>"><?php 
					echo get_the_post_thumbnail($id, 'article-thumbnail');
					?>
					</a>
					</div>
					<div class="article_item_summary">
					<h1>
					<?php 
						echo "Data: $date";
						if ($time) {
							echo ", godz. $time";
						}
					?>
					</h1>
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
				wp_reset_postdata();
				the_pagination($query);
			?>
		</div><!-- #content -->


<?php

get_footer();
