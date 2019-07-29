<?php

$show_logo			= get_theme_mod('show_header_logo', true);
$logo_type			= get_theme_mod('header_logo_type', 'text');
$logo_img			= get_theme_mod('header_logo_img', get_template_directory_uri() .'/dist/img/logo-dark.png');
$show_tagline		= get_theme_mod('footer_show_tagline', false);

$header_social		= get_theme_mod('header-social', true);

?>

<header class="header header--style-7">

	<div class="header__top">
		<div class="header__ham"><div class="header__ham-inner"></div></div>

		<?php if ($show_logo == true) { ?>
			<a class="header__logo" href="<?php echo esc_url(home_url('/')); ?>">
				<?php if ($logo_type == 'image') { ?>
					<img src="<?php echo esc_url($logo_img); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>"/>
				<?php } else { ?>
					<h1><?php bloginfo('name'); ?></h1>
					<?php if ($show_tagline == true) bloginfo('description'); ?>
				<?php } ?>
			</a>
		<?php } ?>

		<div class="header__icons">
			<?php
				if ($header_social == true && function_exists('gutenkind_social_media')) gutenkind_social_media();
				if (function_exists('WC')) { ?>
					<?php $count = WC()->cart->get_cart_contents_count(); ?>
					<a class="header__cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'gutenkind' ); ?>">
						<?php get_template_part('/dist/svg/svg', 'cart'); ?>
						<span class="header__cart-count">
							<?php $count > 0 ? esc_html($count) : '0'; ?>
						</span>
					</a> <?php
				}
			?>
			<a class="header__search" href="#"><?php get_template_part('/dist/svg/svg', 'search'); ?></a>
		</div>
	</div>

	<div class="header__nav">
		<?php
			gutenkind_menu_header();
			if ($header_social == true && function_exists('gutenkind_social_media'))  gutenkind_social_media();
		?>
	</div>

	<?php get_search_form(); ?>

</header>
