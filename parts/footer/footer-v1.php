<?php

$show_footer_logo 				= get_theme_mod( 'show_footer_logo', true );
$logo_type                      = get_theme_mod( 'footer_logo_type', 'text' );
$logo_img                    	= get_theme_mod( 'footer_logo' );
$show_tagline 					= get_theme_mod('footer_show_tagline', false);
$footer_social 					= get_theme_mod( 'footer_social', true );
$footer_menu 					= get_theme_mod( 'footer_menu', true );
$footer_newsletter				= get_theme_mod( 'footer_newsletter', true );
$footer_newsletter_heading		= get_theme_mod( 'footer_newsletter_heading', esc_html__('Subscribe to our weekly newsletter' , 'gutenkind') );
$footer_instagram          		= get_theme_mod( 'footer_instagram', true );
$footer_instagram_user          = get_theme_mod( 'footer_instagram_user', 'codezeit' );
$footer_instagram_number        = get_theme_mod( 'footer_instagram_number', 6 );
$footer_instagram_link          = get_theme_mod( 'footer_instagram_link', esc_html__('https://instagram.com/', 'gutenkind') );
$footer_instagram_link_text     = get_theme_mod( 'footer_instagram_link_text', esc_html__('@thegutenkind', 'gutenkind') );
$footer_disclaimer 				= get_theme_mod( 'footer_disclaimer', '<p>&copy;'. date(' Y ') .'<a href="'. get_home_url('/') .'">'. get_bloginfo( 'name' ) .'</a>'. esc_html__( '. All Rights Reserved.', 'gutenkind' ) .'</p>' );
$sroll_top						= get_theme_mod( 'scroll-top', true);

?>

<footer class="footer footer--style-1">

		<?php if ($footer_newsletter == true && function_exists('mc4wp_show_form')) : ?>
			<div class="block-newsletter">
				<div class="container">
					<div>
						<?php get_template_part('/dist/svg/svg', 'mail-2'); ?>
						<h3><?php echo esc_html($footer_newsletter_heading); ?></h3>
						<div class="footer-form-wrap">
							<?php
								if (function_exists('mc4wp_show_form') && mc4wp_get_api_key() == '' || !function_exists('mc4wp_show_form')) {
									printf(
										'<a href="%1$s" target="_blank" class="newsletter-error">%2$s %3$s</a>',
										esc_url('https://kb.mc4wp.com/'),
										esc_html__('Please setup "Mailchimp for WordPress" plugin in order to display the form.', 'gutenkind'),
										esc_html__('Click here for more details.', 'gutenkind')
									);
								} else {
									mc4wp_show_form();
								}
							?>
						</div>
					</div>

				</div>
			</div>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-widgets-1') || is_active_sidebar('footer-widgets-2') || is_active_sidebar('footer-widgets-3')) { ?>
			<div class="container">
				<div class="footer__widgets">
					<div class="footer__column">
						<?php dynamic_sidebar('footer-widgets-1'); ?>
					</div>
					<div class="footer__column">
						<?php dynamic_sidebar('footer-widgets-2'); ?>
					</div>
					<div class="footer__column">
						<?php dynamic_sidebar('footer-widgets-3'); ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ($footer_instagram == true && $footer_instagram_user !== '' && function_exists('wpiw_widget')) : ?>
			<div class="footer__instagram">
				<a class="link" href="<?php echo esc_url($footer_instagram_link); ?>" target="_blank">
					<?php echo esc_html($footer_instagram_link_text); ?>
				</a>
				<?php
					$args = array(
						'username' => $footer_instagram_user,
						'size' => 'small',
						'number' => $footer_instagram_number,
						'target' => '_blank',
						'link' => ''
					);
					the_widget('null_instagram_widget', $args);
				?>
			</div>
		<?php endif; ?>

		<div class="footer__mid">

			<?php if ( $show_footer_logo == true ) { ?>
				<a class="footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if ( $logo_type == 'image' ) { ?>
						<img src="<?php echo esc_url( $logo_img ); ?>" class="footer__logo-img" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					<?php } else { ?>
						<h2><?php bloginfo('name'); ?></h2>
						<?php if ($show_tagline == true) bloginfo('description'); ?>
					<?php } ?>
				</a>
			<?php } ?>

			<?php if ($footer_social == true && function_exists('gutenkind_social_media')) gutenkind_social_media(); ?>

		</div>

		<div class="footer__copyright">
			<div class="container">
				<?php
					echo wp_kses_post($footer_disclaimer);
					if ($footer_menu == true) gutenkind_menu_footer();
				?>
			</div>
		</div>

		<?php if ($sroll_top == true) { ?>
			<a href="#" class="scroll-top"><?php get_template_part('/dist/svg/svg', 'up'); ?></a>
		<?php } ?>

</footer>