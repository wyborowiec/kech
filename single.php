<?php
get_header(); ?>

<div class="content_padding">
<h1>single</h1>
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					if ($post->post_type == "attachment") {
						$id = $post->ID;
?>
						<h1><?php the_excerpt(); ?></h1>
						<h2><?php the_artist($id); ?></h2>					
<?php
						$upload_dir = wp_upload_dir();
						$baseurl = $upload_dir['baseurl'];
						$meta = get_post_meta($post->ID);
						$audio_url = $baseurl."/".$meta["_wp_attached_file"][0];
						$attr = array(
							'src'      => $audio_url,
							'loop'     => '',
							'autoplay' => '',
							'preload' => 'none'
							);
						echo wp_audio_shortcode( $attr );
					} elseif ($post->post_type == "page"){
					?>
						<h1><?php the_title(); ?></h1>
					<?php
						the_content();
					}
				endwhile;
			?>

</div>

<?php
get_footer();
get_footer();

?>