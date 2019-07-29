<?php

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

$wizard = new Merlin(

	$config = array(
		'directory'            => '/inc/theme-setup/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'gutenkind' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'gutenkind' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'gutenkind' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'gutenkind' ),

		'btn-skip'                 => esc_html__( 'Skip', 'gutenkind' ),
		'btn-next'                 => esc_html__( 'Next', 'gutenkind' ),
		'btn-start'                => esc_html__( 'Start', 'gutenkind' ),
		'btn-no'                   => esc_html__( 'Cancel', 'gutenkind' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'gutenkind' ),
		'btn-child-install'        => esc_html__( 'Install', 'gutenkind' ),
		'btn-content-install'      => esc_html__( 'Install', 'gutenkind' ),
		'btn-import'               => esc_html__( 'Import', 'gutenkind' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'gutenkind' ),
		'btn-license-skip'         => esc_html__( 'Later', 'gutenkind' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'gutenkind' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'gutenkind' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'gutenkind' ),
		'license-label'            => esc_html__( 'License key', 'gutenkind' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'gutenkind' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'gutenkind' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'gutenkind' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'gutenkind' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'gutenkind' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'gutenkind' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'gutenkind' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'gutenkind' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'gutenkind' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'gutenkind' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'gutenkind' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'gutenkind' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'gutenkind' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'gutenkind' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'gutenkind' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'gutenkind' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'gutenkind' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'gutenkind' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'gutenkind' ),

		'import-header'            => esc_html__( 'Import Content', 'gutenkind' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'gutenkind' ),
		'import-action-link'       => esc_html__( 'Advanced', 'gutenkind' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'gutenkind' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'gutenkind' ),
		'ready-action-link'        => esc_html__( 'Extras', 'gutenkind' ),
		'ready-big-button'         => esc_html__( 'View your website', 'gutenkind' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'gutenkind' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://vossen.support-hub.io/', esc_html__( 'Get Theme Support', 'gutenkind' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'gutenkind' ) ),
	)
);

function gutenkind_merlin_local_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Import',
			'local_import_file'            => get_parent_theme_file_path( '/inc/theme-setup/demo/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( '/inc/theme-setup/demo/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( '/inc/theme-setup/demo/customizer.dat' ),
			'import_preview_image_url'     => 'http://www.your_domain.com/merlin/preview_import_image1.jpg',
			'import_notice'                => esc_html__( 'A special note for this import.', 'gutenkind' ),
			'preview_url'                  => 'http://www.your_domain.com/my-demo-1',
		),
	);
}
add_filter( 'merlin_import_files', 'gutenkind_merlin_local_import_files' );

// Disable WooCommerce wizard redirect upon plugin activation
//add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_true');