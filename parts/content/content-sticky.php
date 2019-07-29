<?php

$cat_link = array(
	gutenkind_field('block-latest-cat-link'),
	gutenkind_field('voss-posts-cat-link'),
	gutenkind_field('block-carousel-cat-link'),
	gutenkind_field('block-promo-cat-link'),
);
$author = array(
	gutenkind_field('block-latest-author'),
	gutenkind_field('voss-posts-cat-author'),
	gutenkind_field('block-carousel-author'),
	gutenkind_field('block-promo-author'),
);
$date = array(
	gutenkind_field('block-latest-date'),
	gutenkind_field('voss-posts-cat-date'),
	gutenkind_field('block-carousel-date'),
	gutenkind_field('block-promo-date'),
);
$views = array(
	gutenkind_field('block-latest-views'),
	gutenkind_field('voss-posts-cat-views'),
	gutenkind_field('block-carousel-views'),
	gutenkind_field('block-promo-views'),
);
$read_time = array(
	gutenkind_field('block-latest-read-time'),
	gutenkind_field('voss-posts-cat-read-time'),
	gutenkind_field('block-carousel-read-time'),
	gutenkind_field('block-promo-read-time'),
);
$comments = array(
	gutenkind_field('block-latest-comments'),
	gutenkind_field('voss-posts-cat-comments'),
	gutenkind_field('block-carousel-comments'),
	gutenkind_field('block-promo-comments'),
);
$excerpt = array(
	gutenkind_field('block-latest-excerpt'),
	gutenkind_field('voss-posts-cat-excerpt'),
	gutenkind_field('block-carousel-excerpt'),
	gutenkind_field('block-promo-excerpt'),
);

$excerpt_length = gutenkind_field('block-latest-excerpt-length');
$excerpt_length = $excerpt_length ? $excerpt_length : gutenkind_field('voss-posts-cat-excerpt-length');
$excerpt_length = $excerpt_length ? $excerpt_length : gutenkind_field('block-promo-excerpt-length');
$excerpt_length = $excerpt_length ? $excerpt_length : 55;

$more = array(
	gutenkind_field('block-latest-more'),
	gutenkind_field('voss-posts-cat-more'),
	gutenkind_field('block-carousel-more'),
	gutenkind_field('block-promo-excerpt'),
);

$more_style = array(
	gutenkind_field('block-latest-more-style'),
	gutenkind_field('voss-posts-cat-more-style'),
	gutenkind_field('block-carousel-more-style'),
	gutenkind_field('block-promo-more-style'),
);

$more_text = gutenkind_field('block-latest-more-text');
$more_text = $more_text ? $more_text : gutenkind_field('voss-posts-cat-read-btn-text');
$more_text = $more_text ? $more_text : gutenkind_field('block-promo-more-text');
$more_text = $more_text ? $more_text : esc_html__('Read More', 'gutenkind');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sticky-post'); ?>>
	<div class="sticky-post-wrap" data-bg="<?php echo gutenkind_thumb_url('fullscreen'); ?>">
		<?php gutenkind_post_icon(); ?>
		<div class="post-content">
			<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="entry-meta">
				<?php
					if (function_exists('gutenkind_meta_author')) gutenkind_meta_author();
					if (function_exists('gutenkind_meta_date')) gutenkind_meta_date();
					if (function_exists('vossen_meta_views') && in_array(true, $views)) vossen_meta_views();
					if (function_exists('vossen_meta_read') && in_array(true, $read_time)) vossen_meta_read();
					if (function_exists('gutenkind_meta_comments') && in_array(true, $comments)) gutenkind_meta_comments();
				?>
			</div>
			<div class="post-more-wrap">
				<a class="post-more button" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('View Post', 'gutenkind'); ?></a>
			</div>
		</div>
	</div>
</article>
