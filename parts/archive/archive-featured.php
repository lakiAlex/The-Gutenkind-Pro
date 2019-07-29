<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;

if( $paged == 1 ) {

	$query = new WP_Query(array(
		'cat'						=> $category_id,
		'posts_per_page' 			=> '1',
		'posts_per_archive_page' 	=> '1',
		'post_type'					=> 'post',
		'orderby'					=> 'date',
		'order'						=> 'DESC',
	));

?>

		<div class="archive-featured">

		<?php
			if( $query->have_posts() ) {

				while( $query->have_posts() ) {
					$query->the_post();
					if (has_post_thumbnail()) { ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="post-media">
								<a class="post-image" href="<?php echo esc_url(get_permalink()); ?>">
									<?php the_post_thumbnail('landscape-md', array('alt' => get_the_title())); ?>
								</a>
							</div>
							<div class="post-content">
								<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
								<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php gutenkind_excerpt(24); ?>
								<a class="post-more link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'gutenkind'); ?></a>
							</div>
						</article><?php
					}
				}
			}
		?>

		</div>

		<?php wp_reset_postdata(); ?>

<?php } ?>
