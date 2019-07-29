<?php
	$header_style = gutenkind_field('page-field-header');
	$header_style = $header_style ? $header_style : get_theme_mod('header-style', '1');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html__( 'Skip to Content', 'gutenkind' ); ?></a>

	<?php
		get_template_part('/parts/header/header', 'ad');
		get_template_part('/parts/header/header', $header_style);
	?>
