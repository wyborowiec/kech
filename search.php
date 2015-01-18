<?php
global $wpdb;
get_header(); 
$limit = 2;
$paged = get_paged();
$search_query = $wp_query->query;
$s = $search_query['s'];

function get_query_sql(){
	global $wpdb, $limit, $paged, $s;
	$paged = get_paged();
	$offset = $limit * ($paged-1);
	return "
		 SELECT SQL_CALC_FOUND_ROWS *
		 FROM $wpdb->posts as post
		 LEFT OUTER JOIN $wpdb->postmeta as meta
		 ON post.ID=meta.post_id AND meta.meta_key='author'
		 WHERE 
			 (post_title LIKE '%$s%'
			 OR
			 post_content LIKE '%$s%'
			 OR
			 (meta_value LIKE '%$s%')
			 )
		 AND 
			(
			 (post_type in ( 'kech_article', 'kech_event', 'kech_gallery' ) AND post_status='publish')
			 OR 
			 (post_type = 'attachment' AND post_mime_type = 'audio/mpeg' AND post_status='inherit')
			)
		 ORDER BY post_title LIKE '%$s%' DESC, meta_value LIKE '%$s%' DESC, post_date DESC
		 LIMIT $limit
		 OFFSET $offset
	";
}

?>

<div class="content_padding">
			<h1>WYNIKI WYSZUKIWANIA:</h1>
			<p>Słowa kluczowe: "<?php echo "$s"; ?>"</p>
			<?php
			
//1 Query	SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND (((wp_posts.post_title LIKE '%aaaa%') OR (wp_posts.post_content LIKE '%aaaa%')))  AND wp_posts.post_type IN ('post', 'page', 'attachment', 'kech_article', 'kech_gallery', 'kech_event') AND (wp_posts.post_status = 'publish' OR wp_posts.post_author = 1 AND wp_posts.post_status = 'private')  ORDER BY wp_posts.post_title LIKE '%aaaa%' DESC, wp_posts.post_date DESC LIMIT 0, 10

				$query_sql = get_query_sql();
				$query_result = $wpdb->get_results($query_sql, OBJECT);
				$count_result = $wpdb->get_results("SELECT FOUND_ROWS() as count", OBJECT);
				$total_count = $count_result[0]->count;
			?>
				<p>Łącznie znalezionych <?php echo $total_count; ?> pozycji.</p>
			<?php
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
				$max_num_pages = (int)($total_count/$limit) + 1;
				the_pagination_num_pages($max_num_pages);
			?>
</div>

<?php

get_footer();

?>