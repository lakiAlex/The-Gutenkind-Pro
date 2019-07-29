<?php

$infinite		= get_theme_mod('single-infinite', false);
$sidebar		= gutenkind_field('single-field-sidebar');
$sidebar = $sidebar ? $sidebar : get_theme_mod('single-sidebar', 'right');

$tags			= get_theme_mod('single-tags', true);
$author_bio		= get_theme_mod('single-author-bio', true);
$nav			= get_theme_mod('single-nav', true);
$related		= get_theme_mod('single-related', true);
$comments		= get_theme_mod('single-comments-form', true);

$classes[] = 'voss-infinite-'.$infinite;
$classes[] = 'voss-sidebar-'.$sidebar;

$single_header	= gutenkind_field('single-field-header-type');
$single_header = $single_header ? $single_header : get_theme_mod('single-header-type', 'standard');

if (in_array($single_header, array('fullwidth', 'fullscreen'))) {
	get_template_part('/parts/post/post', 'header');
}

?>

<div class="container voss-posts <?php echo esc_html(implode(' ', $classes)); ?>">
	<div class="voss-posts-content">
		<?php while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					if (in_array($single_header, array('wrapped', 'standard'))) {
						get_template_part('/parts/post/post', 'header');
					}
				?>
				<div class="entry-content">
					<?php
						the_content();
						wp_link_pages(array('before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gutenkind' ),'after'  => '</div>',));
						if ($tags == true && function_exists('gutenkind_tags')) gutenkind_tags();
					?>
				</div>

				<div class="entry-footer">
					<?php
						if (function_exists('vossen_social_share')) vossen_social_share();
						if ($comments == true) if (comments_open() || get_comments_number()) comments_template();
						if ($author_bio == true) get_template_part( 'parts/post/author', 'bio' );
						if ($nav == true) get_template_part( 'parts/post/post', 'nav' );
						if ($related == true) get_template_part( 'parts/post/post', 'related' );
					?>
				</div>
			</article>

		<?php endwhile; ?>
	</div>

	<?php if ($sidebar !== 'none') get_sidebar(); ?>

</div>

<?php if ($infinite == true) { ?>
	<div class="pagination-infinite container">
		<div class="page-load-status">
			<div class="infinite-scroll-request"><div class="voss-load"></div></div>
			<p class="infinite-scroll-last infinite-scroll-error"><?php esc_html_e('No More Posts', 'gutenkind'); ?></p>
		</div>
	</div>
<?php } ?>
