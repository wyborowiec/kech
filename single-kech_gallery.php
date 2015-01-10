<?php
get_header(); ?>

<div class="content_padding">
			<?php
				while ( have_posts() ) : the_post(); 
					?>
						<h1><?php the_title(); ?></h1>
					<?php
						$matches = array();
						$is_match = preg_match('/\[gallery.*ids="(.*)".*\]/', $post->post_content, $matches);
						if ($is_match){
							$ids = $matches[1];
							echo do_shortcode('[gallery columns="4" link="file" ids="'.$ids.'"]');
						} else {
							die("No gallery found in the post content");
						}
				endwhile;
			?>

</div>

<?php

get_footer();

?>