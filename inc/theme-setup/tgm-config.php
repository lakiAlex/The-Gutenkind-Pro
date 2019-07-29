<?php

require get_parent_theme_file_path('/inc/theme-setup/tgm/class-tgm-plugin-activation.php');

function gutenkind_register_plugins() {

	$plugins = array(
		array(
			'name'          	=> esc_html__('Theme Options', 'gutenkind'),
			'slug'          	=> 'kirki',
			'required'      	=> true,
		),
		array(
			'name'               => esc_html__( 'Theme Blocks & Fields', 'gutenkind' ),
			'slug'               => 'advanced-custom-fields-pro',
			'source'			 => 'https://storage.googleapis.com/codemade-bucket/acfpro.zip',
			'required'           => true,
			'version'            => '5.8.2',
		),
		array(
			'name'          	 => esc_html__('Theme Additions', 'gutenkind'),
			'slug'          	 => 'codemade',
			'source'			 => 'https://storage.googleapis.com/codemade-bucket/codemade.zip',
			'required'      	 => true,
			'version'            => '1.2.1',
		),
		array(
			'name'         		=> esc_html__('WP Instagram Widget', 'gutenkind'),
			'slug'         		=> 'wp-instagram-widget',
			'required'     		=> false,
		),
		array(
			'name'     			=> esc_html__('Contact Form 7', 'gutenkind'),
			'slug'     			=> 'contact-form-7',
			'required' 			=> false,
		),
		array(
			'name'     			=> esc_html__('MailChimp for WordPress', 'gutenkind'),
			'slug'     			=> 'mailchimp-for-wp',
			'required' 			=> false,
		),
		// array(
		// 	'name'     			=> esc_html__('WooCommerce', 'gutenkind'),
		// 	'slug'     			=> 'woocommerce',
		// 	'required' 			=> false,
		// ),
		// This is an example of how to include a plugin from an arbitrary external source in your theme.
/*
		array(
			'name'         => 'TGM New Media Plugin', // The plugin name.
			'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
			'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),
*/

	);

	$config = array(
		'id'           => 'gutenkind',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'gutenkind_register_plugins' );
