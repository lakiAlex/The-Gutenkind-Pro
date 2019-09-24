<?php
/**
 * Theme functions and definitions
 */
function gutenkind_setup() {

	// Theme available for translation/
	load_theme_textdomain('gutenkind', get_template_directory() . '/lang');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1568, 9999);

	add_image_size('128x128', 128, 128, true);
	add_image_size('128x128-low', 12, 12, true);

	add_image_size('square', 300, 300, true);
	add_image_size('square-low', 30, 30, true);

	add_image_size('landscape', 510, 350, true);
	add_image_size('landscape-low', 51, 35, true);

	add_image_size('portrait', 350, 510, true);
	add_image_size('portrait-low', 35, 51, true);

	add_image_size('landscape-sm', 390, 260, true );
	add_image_size('landscape-sm-low', 39, 26, true );

	add_image_size('landscape-md', 810, 600, true );
	add_image_size('landscape-md-low', 81, 60, true );

	add_image_size('single', 800, 990, true);
	add_image_size('single-low', 80, 98, true);

	add_image_size('fullscreen', 1920, 1080, true);
	add_image_size('fullscreen-low', 19, 10, true);

	register_nav_menus(
		array(
			'menu-header' 	=> esc_html__('Header Menu', 'gutenkind'),
			'menu-footer' 	=> esc_html__('Footer Menu', 'gutenkind'),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support('html5', array('search', 'comment-form', 'comment-list', 'gallery', 'caption'));

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 190,
			'width'       => 190,
			'flex-width'  => false,
			'flex-height' => false,
		)
	);

	// Add support for post formats.
	add_theme_support('post-formats', array('standard', 'gallery', 'video', 'audio'));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Add support for Block Styles.
	add_theme_support('wp-block-styles');

	// Add support for full and wide align images.
	add_theme_support('align-wide');

	// Add support for editor styles.
	add_theme_support('editor-styles');

	// Enqueue editor styles.
	add_editor_style(get_template_directory_uri() . '/style-editor.css');

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Small', 'gutenkind' ),
				'shortName' => __( 'S', 'gutenkind' ),
				'size'      => 19.5,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'Normal', 'gutenkind' ),
				'shortName' => __( 'M', 'gutenkind' ),
				'size'      => 22,
				'slug'      => 'normal',
			),
			array(
				'name'      => __( 'Large', 'gutenkind' ),
				'shortName' => __( 'L', 'gutenkind' ),
				'size'      => 36.5,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'Huge', 'gutenkind' ),
				'shortName' => __( 'XL', 'gutenkind' ),
				'size'      => 49.5,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for responsive embedded content.
	add_theme_support('responsive-embeds');

	// Add support for WooCommerce
	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}
add_action('after_setup_theme', 'gutenkind_setup');

/**
 * Enqueue scripts and styles.
 */
function gutenkind_scripts() {
	wp_enqueue_style('gutenkind-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
	wp_style_add_data('gutenkind-style', 'rtl', 'replace');
	wp_enqueue_script('gutenkind-scripts', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), wp_get_theme()->get('Version'), true);
	if (is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'gutenkind_scripts');


function gutenkind_admin_scripts() {
	wp_enqueue_style('gutenkind-admin-css', get_template_directory_uri() . '/style-admin.css', wp_get_theme()->get('Version'), false);
	wp_enqueue_script('gutenkind-admin-js', get_template_directory_uri() . '/dist/js/admin.min.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('admin_enqueue_scripts', 'gutenkind_admin_scripts');

/**
 * Register menus
 */
function gutenkind_menu_header() {
	$menu = wp_nav_menu(
		array(
			'theme_location' => 'menu-header',
			//'menu_id' 		 => 'menu-header',
			'menu_class'     => 'header__menu menu full-menu nav',
			'container' 	 => '',
			'fallback_cb' 	 => false,
			'echo'			 => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'walker' 		 => new gutenkind_cat_menu_Walker
		)
	);
	if ($menu) {
		printf(
			'<nav>%1$s</nav>',
			$menu
		);
	} else {
		printf(
			'<a class="header__no-menu" href="%1$s">%2$s</a>',
			esc_url(admin_url('customize.php?autofocus[panel]=nav_menus')),
			esc_html__('Click here to create your header menu.', 'gutenkind')
		);
	}
}

function gutenkind_menu_footer() {
	$menu = wp_nav_menu(
		array(
			'theme_location' => 'menu-footer',
			'menu_id' 		 => 'menu-footer',
			'menu_class'     => 'menu',
			'container' 	 => '',
			'fallback_cb' 	 => false,
			'echo'			 => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
	if ($menu) {
		printf(
			'<nav class="menu-footer">%1$s</nav>',
			$menu
		);
	} else {
		printf(
			'<a class="no-menu" href="%1$s">%2$s</a>',
			esc_url(admin_url('customize.php?autofocus[panel]=nav_menus')),
			esc_html__('Click here to create your footer menu.', 'gutenkind')
		);
	}
}

/**
 * Register widget area.
 */
function gutenkind_register_sidebars() {
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'gutenkind'),
			'id'            => 'sidebar',
			'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'gutenkind'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 1', 'gutenkind'),
			'id'            => 'footer-widgets-1',
			'description'   => esc_html__('Add widgets here to appear in your left footer column.', 'gutenkind'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 2', 'gutenkind'),
			'id'            => 'footer-widgets-2',
			'description'   => esc_html__('Add widgets here to appear in your center footer column.', 'gutenkind'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 3', 'gutenkind'),
			'id'            => 'footer-widgets-3',
			'description'   => esc_html__('Add widgets here to appear in your right footer column.', 'gutenkind'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'gutenkind_register_sidebars');

/**
 * Require theme files
 */
require get_parent_theme_file_path('/inc/theme-setup/tgm-config.php');
require_once get_parent_theme_file_path('/inc/theme-setup/merlin/vendor/autoload.php');
require_once get_parent_theme_file_path('/inc/theme-setup/merlin/class-merlin.php');
require_once get_parent_theme_file_path('/inc/theme-setup/merlin-config.php');

require get_parent_theme_file_path('/inc/theme-customizer.php');
require get_parent_theme_file_path('/inc/theme-fields.php');
require get_parent_theme_file_path('/inc/theme-functions.php');

/**
 * Theme content width
 */
function gutenkind_content_width() {
	$GLOBALS['content_width'] = apply_filters('gutenkind_content_width', 640);
}
add_action('after_setup_theme', 'gutenkind_content_width', 0);
