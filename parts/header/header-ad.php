<?php

$ad_bar = gutenkind_field('page-field-adbar');
$ad_bar = $ad_bar ? $ad_bar : get_theme_mod('header-adbar', false);
$ad_type		= get_theme_mod('adbar-type', 'image');
$ad_editor		= get_theme_mod('adbar-editor', '<a href="https://goo.gl/QMgrzW"><img src="'. get_template_directory_uri() .'/dist/img/banner-long.jpg"/></a>');
$ad_code		= get_theme_mod('adbar-code');

$ad = ($ad_type == 'image') ? $ad_editor : $ad_code;

if ($ad_bar == 'true') {
	printf(
		'<div class="header__placement">%1$s</div>',
		wp_kses_post($ad)
	);
}
