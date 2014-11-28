<?php
get_header(); ?>

<div class="content_padding">
			<h1>Search result:</h1>
			<?php
				$search_query = $wp_query->query;
				$s = $search_query['s'];
				$query = new WP_Query( 
					array( 
						'post_type' => array( 'kech_article', 'attachment', 'kech_event', 'kech_gallery' ), 
						'post_status' => array( 'publish', 'inherit' ),
						's' => $s
					) );
				while ( $query->have_posts() ) : $query->the_post(); 
					$id = $post->ID;
					$permalink = get_permalink($id);
			?>
			<p>
				<a href="<?php echo $permalink; ?>"><?php the_title(); ?></a>
			</p>
			<?php
				endwhile;
				wp_reset_postdata();
			?>

</div>

<?php

get_footer();

?>