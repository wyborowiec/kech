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
						$id = $post->ID;
						$images =& get_children( array (
							'post_parent' => $id,
							'post_type' => 'attachment',
							'post_mime_type' => 'image'
						));
						$repr_img_id = array_shift(array_keys($images));
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
				
				?>
			<?php

					
					// Previous/next page navigation.

				endif;
			?>
		</div><!-- #content -->


<?php

get_footer();
