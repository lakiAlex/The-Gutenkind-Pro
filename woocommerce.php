<?php get_header();

$page_title = get_theme_mod('page-header-title', true);
$page_thumb = get_theme_mod('page-header-thumb', true);

?>

<main class="site-main">
	
	<div class="container page-container">

		<?php
			if ($page_title == true) get_template_part( 'parts/page/page', 'header' );
			woocommerce_content();
		?>

	</div>

</main>

<?php get_footer();
