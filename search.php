<?php
global $wpdb;
get_header(); ?>

<div class="content_padding">
			<h1>Search result:</h1>
			
			
			
			<?php
			
//1 Query	SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND (((wp_posts.post_title LIKE '%aaaa%') OR (wp_posts.post_content LIKE '%aaaa%')))  AND wp_posts.post_type IN ('post', 'page', 'attachment', 'kech_article', 'kech_gallery', 'kech_event') AND (wp_posts.post_status = 'publish' OR wp_posts.post_author = 1 AND wp_posts.post_status = 'private')  ORDER BY wp_posts.post_title LIKE '%aaaa%' DESC, wp_posts.post_date DESC LIMIT 0, 10
				$search_query = $wp_query->query;
				$s = $search_query['s'];
				$query_sql = "
					 SELECT *
					 FROM $wpdb->posts
					 WHERE 
						 (post_title LIKE '%$s%'
						 OR
						 post_content LIKE '%$s%')
					 AND 
						(
						 (post_type in ( 'kech_article', 'kech_event', 'kech_gallery' ) AND post_status='publish')
						 OR 
						 (post_type = 'attachment' AND post_mime_type = 'audio/mpeg' AND post_status='inherit')
						)
					 ORDER BY post_title LIKE '%$s%' DESC, post_date DESC
				";

				$query_result = $wpdb->get_results($query_sql, OBJECT);
				foreach ($query_result as $post): 
					setup_postdata($post);
					$id = $post->ID;
					$permalink = get_permalink($id);
			?>
			<p>
				<a href="<?php echo $permalink; ?>"><?php the_title(); ?></a>
			</p>
			<?php 
				endforeach; 
			?>
			
			
			
			
			

</div>

<?php

get_footer();

?>