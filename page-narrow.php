<?php

    /* Template Name: Narrow Page */

?>
<?php get_header();

$page_title = get_theme_mod('page-header-title', true);
$page_thumb = get_theme_mod('page-header-thumb', true);

?>

<main class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="container page-container narrow-page">

				<?php
					if (is_page() && !is_front_page() && !is_404()) {
						if ($page_title == true) { ?>
							<h2 class="page-title"><?php the_title(); ?></h2> <?php
						}
						if ($page_thumb == true) { ?>
							<div class="page-featured-image">
								<?php the_post_thumbnail(); ?>
							</div><?php
						}
					}
					get_template_part( 'parts/content/content', 'page' );
					if (comments_open() || get_comments_number()) comments_template();
				?>

			</div>

		<?php endwhile; ?>

</main>

<?php get_footer();
