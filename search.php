<?php
get_header(); ?>

<div class="content_padding">
			<h1>Search result:</h1>
			<?php
				//var_dump($wp_query->query);
				while ( have_posts() ) : the_post(); 
					$id = $post->ID;
					$permalink = get_permalink($id);
			?>
			<p>
				<a href="<?php echo $permalink; ?>"><?php the_title(); ?></a>
			</p>
			<?php
				endwhile;
			?>

</div>

<?php

get_footer();

?>