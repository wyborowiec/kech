<?php
global $wpdb;
get_header(); 
$limit = 2;

function get_query_sql($s, $is_count){
	global $wpdb, $limit;
	$select_clause = $is_count ? "count(*) as count" : "*";
	$paged = get_paged();
	//$limit = 4;
	$offset = $limit * ($paged-1);
	$order_limit_offset_clause = $is_count ? "" : 
		"ORDER BY post_title LIKE '%$s%' DESC, meta_value LIKE '%$s%' DESC, post_date DESC
		 LIMIT $limit
		 OFFSET $offset";
	return "
		 SELECT SQL_CALC_FOUND_ROWS $select_clause
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
		 $order_limit_offset_clause
	";
}

?>

<div class="content_padding">
			<h1>WYNIKI WYSZUKIWANIA:</h1>
			<p>Słowa kluczowe: "<?php echo "$s"; ?>"</p>
			<?php
			
//1 Query	SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND (((wp_posts.post_title LIKE '%aaaa%') OR (wp_posts.post_content LIKE '%aaaa%')))  AND wp_posts.post_type IN ('post', 'page', 'attachment', 'kech_article', 'kech_gallery', 'kech_event') AND (wp_posts.post_status = 'publish' OR wp_posts.post_author = 1 AND wp_posts.post_status = 'private')  ORDER BY wp_posts.post_title LIKE '%aaaa%' DESC, wp_posts.post_date DESC LIMIT 0, 10
				$paged = get_paged();
				$search_query = $wp_query->query;
				$s = $search_query['s'];
				$query_count_sql = get_query_sql($s, true);
				$query_result = $wpdb->get_results($query_count_sql, OBJECT);
				$total_count = $query_result[0]->count;
				//print_r($query_result);
			?>
				<p>Łącznie znalezionych <?php echo $total_count; ?> pozycji.</p>
			<?php
				$query_sql = get_query_sql($s, false);
				$query_result = $wpdb->get_results($query_sql, OBJECT);
				echo "NR: ".$wpdb->num_rows;
				$count_result = $wpdb->get_results("SELECT FOUND_ROWS() as count", OBJECT);
				echo "FR: ".$count_result[0]->count;
				
				//print_r($query_result);
			?>
			
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