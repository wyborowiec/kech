<?php
global $wpdb;
get_header(); 
$limit = 8;
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
			
			 post_type in ( 'kech_article', 'kech_event', 'kech_gallery', 'kech_audio' ) AND post_status='publish'

			
		 ORDER BY post_title LIKE '%$s%' DESC, meta_value LIKE '%$s%' DESC, post_date DESC
		 LIMIT $limit
		 OFFSET $offset
	";
}

function the_kech_category() {
	global $post;
	$post_type = get_post_type();
	switch ($post_type) {
		case "kech_article":
			$category = "Czytelnia";
			break;
		case "kech_event":
			$category = "Wydarzenia";
			break;
		case "kech_gallery":
			$category = "Galeria";
			break;
		case "kech_audio":
			$category = "Kazania";
			break;
	}
	echo $category;
}

?>

<div class="content_padding">
			<h1>WYNIKI WYSZUKIWANIA:</h1>
			<div class="box_search2_wrap">
				<div class="box_search2">
					<?php get_search("box_search2_submit"); ?>
				</div>
			</div>
			<div class="search_keywords">Słowa kluczowe: "<?php echo "$s"; ?>"</div>
			<?php
			
//1 Query	SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND (((wp_posts.post_title LIKE '%aaaa%') OR (wp_posts.post_content LIKE '%aaaa%')))  AND wp_posts.post_type IN ('post', 'page', 'attachment', 'kech_article', 'kech_gallery', 'kech_event') AND (wp_posts.post_status = 'publish' OR wp_posts.post_author = 1 AND wp_posts.post_status = 'private')  ORDER BY wp_posts.post_title LIKE '%aaaa%' DESC, wp_posts.post_date DESC LIMIT 0, 10

				$query_sql = get_query_sql();
				$query_result = $wpdb->get_results($query_sql, OBJECT);
				$count_result = $wpdb->get_results("SELECT FOUND_ROWS() as count", OBJECT);
				$total_count = $count_result[0]->count;
			?>
				<div class="search_total">Łącznie znalezionych <?php echo $total_count; ?> pozycji.</div>
			<?php
				foreach ($query_result as $post): 
					setup_postdata($post);
					$id = $post->ID;
					$post_type = get_post_type($id);
					if ($post_type == 'kech_audio') {
						$shortlink = "category/kazania?post_id=$id";
					} else {
						$shortlink = wp_get_shortlink();
					}
					$date = get_the_date("j.m.Y");
			?>
			<div class="search_result">
				<div class="search_result_desc">
					<div class="item_title">
						<?php the_title(); ?>
					</div>
					<div class="item_details">
						Data: <?php echo $date; ?>, kategoria: <?php the_kech_category(); ?>
					</div>
				</div>
				<div class="search_result_link">
					<a class="follow_link" href="<?php echo $shortlink ?>">WEJDŹ &rsaquo;</a>
				</div>
				<div class="search_result_clear">
				</div>
			
			</div>
			<?php 
				endforeach; 
				$max_num_pages = (int)($total_count/$limit) + 1;
				the_pagination_num_pages($max_num_pages);
			?>
</div>

<?php

get_footer();

?>