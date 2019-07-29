<?php get_header(); ?>

<main class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content">
				<figure class="entry-attachment wp-block-image">
					<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
					<figcaption class="wp-caption-text"><?php echo get_the_excerpt(); ?></figcaption>
				</figure>
				<div class="container">
					<?php
						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gutenkind' ),
								'after'  => '</div>',
							)
						);
						if (comments_open() || get_comments_number()) comments_template();
					?>
				</div>
			</div>

		</article>

	<?php endwhile; ?>
	
</main>

<?php get_footer();
