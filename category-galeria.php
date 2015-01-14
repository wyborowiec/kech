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
							'post_type' => 'kech_gallery', 
							'post_status'=> 'publish',
							'posts_per_page' => 8,
							'paged' => $paged
						) );
					$i = 1;
					while ($query->have_posts() ) : $query->the_post();
						$id = $post->ID;
						$args = array (
								'post_parent' => $id,
								'post_type' => 'attachment',
								'post_mime_type' => 'image'
							);
							
						$content = get_the_content();
						$matches = array();
						$matched = preg_match('[gallery.*ids="(\d+).*]', $content, $matches);
						if ($matched) {
							$first_img_id = $matches[1];
						} else {
							die("No gallery in the post content.");
						}
						$thumb_file = wp_get_attachment_image($first_img_id, 'gallery-thumbnail');
						$author = get_post_meta($id, "Autor", true);
						$title = get_the_title();
						$gallery_icon_class = $i % 4 == 0 ? "" : "gallery_icon";
						$gallery_margin_bottom_class = $i <= 4 ? "gallery_margin_bottom" : "";
						$date = get_the_date("j.m.Y");
						$link = wp_get_shortlink();
						?>
						<a href="<?php echo $link; ?>">
						<div class="<?php echo "$gallery_icon_class $gallery_margin_bottom_class"; ?>">
							<div class="gallery_thumb">
								<?php echo $thumb_file; ?>
							</div>
							<div class="gallery_title">
								<?php the_title(); ?>
							</div>
							<div class="gallery_date">
								<?php echo $date; ?>
							</div>
						</div>
				<?php
						$i++;
					endwhile;
					wp_reset_postdata();
				?>
				<div class="gallery_clear"></div>
				<?php
					the_pagination($query);
				?>
				
		</div><!-- #content -->


<?php

get_footer();
