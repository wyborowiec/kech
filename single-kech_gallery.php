<?php
get_header(); ?>

<div class="content_padding">
			<?php
				while ( have_posts() ) : the_post(); 
					?>
						<h1><?php the_title(); ?></h1>
						<div class="post_content">
					<?php
						$modified_content = preg_replace('/\[gallery.*ids="(.*)".*\]/', '[gallery columns="4" link="file" ids="$1"]', $post->post_content);
						echo do_shortcode($modified_content);
				endwhile;
					?>
						</div>

</div>

<?php

get_footer();

?>