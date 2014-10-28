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
					$query = new WP_Query( 
						array( 
							'post_type' => 'kech_gallery', 
							'post_status'=> 'publish',
							'posts_per_page' => 10
						) );
					while ($query->have_posts() ) : $query->the_post();
						$id = $post->ID;
						$args = array (
								'post_parent' => $id,
								'post_type' => 'attachment',
								'post_mime_type' => 'image'
							);
						$images = get_children($args);
						$keys = array_keys($images);
						$repr_img_id = array_shift($keys);
						$thumb_file = wp_get_attachment_thumb_url($repr_img_id);
						$author = get_post_meta($id, "Autor", true);
						$title = get_the_title();
						?>
						<div class="page-link">
						<img id='gallery_thumb' src="<?php echo $thumb_file; ?>"/>
						<?php the_shortlink($title, $title); ?>
						</div>
				<?php
					endwhile;
					wp_reset_postdata();
				
				?>
		</div><!-- #content -->


<?php

get_footer();
