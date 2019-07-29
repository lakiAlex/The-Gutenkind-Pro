<?php

    /* Template Name: Blank */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">

		<main class="site-main fullscreen-page" data-bg="<?php echo esc_url(gutenkind_thumb_url('fullscreen')); ?>">
			<div class="container">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</main>

	</div>

<?php wp_footer(); ?>

</body>
</html>
