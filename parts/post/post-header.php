<?php

$single_header	= gutenkind_field('single-field-header-type');
$single_header = $single_header ? $single_header : get_theme_mod('single-header-type', 'standard');

$cat_link		= get_theme_mod('single-cat-link', true);
$thumb          = get_theme_mod('single-featured', true);
$author         = get_theme_mod('single-author', true);
$date           = get_theme_mod('single-date', true);
$views          = get_theme_mod('single-views', true);
$read_time      = get_theme_mod('single-read', true);
$comments       = get_theme_mod('single-comments', true);
$format = get_post_format() ? : 'standard';
$thumb_size = '';

if ($format == 'standard') {
	if ($single_header == 'wrapped') {
		$thumb_size = 'single';
	} else if (in_array($single_header, array('fullwidth', 'fullscreen'))) {
		$thumb_size = 'fullscreen';
	}
}

?>

<div class="entry-header voss-single-header-<?php echo esc_html($single_header); ?>" data-bg="<?php echo esc_url(gutenkind_thumb_url($thumb_size)); ?>">
	<div class="post-header">
		<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php
				if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
				if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
				if (function_exists('vossen_meta_views') && $views == true) { vossen_set_view(); vossen_meta_views(); }
				if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
				if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
			?>
		</div>
		<?php if (has_post_thumbnail() && $single_header == 'standard' && $thumb == true && $format == 'standard') { ?>
			<div class="post-media">
				<?php the_post_thumbnail('single'); ?>
			</div>
		<?php } ?>
	</div>
</div>
