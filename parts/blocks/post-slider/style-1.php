<?php

$cat_link 	= gutenkind_field('block-carousel-cat-link');
$author 	= gutenkind_field('block-carousel-author');
$date 		= gutenkind_field('block-carousel-date');
$views 		= gutenkind_field('block-carousel-views');
$read_time 	= gutenkind_field('block-carousel-read-time');
$comments 	= gutenkind_field('block-carousel-comments');
$excerpt 	= gutenkind_field('block-carousel-excerpt');
$excerpt_length = gutenkind_field('block-carousel-excerpt-length');
$more 		= gutenkind_field('block-carousel-more');
$more_style = gutenkind_field('block-carousel-more-style');
$more_text  = gutenkind_field('block-carousel-more-text');
$more_text = $more_text ? $more_text : esc_html__('Read More', 'gutenkind');

?>

<div class="swiper-slide voss-slide">

	<div class="voss-slide-container" data-swiper-parallax="-450">

		<div class="voss-slide-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('portrait'); ?>
			</a>
		</div>

		<div class="voss-slide-content">

			<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-meta">
				<?php
					if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
					if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
					if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
					if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
					if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
				?>
			</div>
			<?php
				if ($excerpt == true) gutenkind_excerpt($excerpt_length);
				if ($more == true) { ?>
					<a class="post-more <?php echo esc_html($more_style); ?>" href="<?php the_permalink(); ?>"><?php echo esc_html($more_text); ?></a><?php
				}
			?>

		</div>

	</div>

</div>
