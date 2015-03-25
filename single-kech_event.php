<?php

get_header(); ?>

<div class="content_padding">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					$id = $post->ID;
					$start_date = get_post_meta($id, "event_start_date", true);
					$start_time = get_post_meta($id, "event_start_time", true);
					?>
						<h1><?php the_title(); ?></h1>
						<h2><?php 
							echo $start_date; 
							if ($start_time) {
								echo ", godz. $start_time";
							}
						?></h2>
					<?php
						the_content();
				endwhile;
			?>

</div>

<?php

get_footer();

?>