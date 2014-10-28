<?php
get_header(); ?>

<div class="content_padding">
			<?php
				while ( have_posts() ) : the_post(); 
					?>
						<h1><?php the_title(); ?></h1>
					<?php
						the_content();
				endwhile;
			?>

</div>

<?php

get_footer();

?>