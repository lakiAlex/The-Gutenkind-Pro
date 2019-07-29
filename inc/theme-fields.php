<?php

/**
* ACF
*/

// Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// Disable ACF Update Notification
function gutenkind_acf_update($value) {
  if ( isset( $value ) && is_object( $value ) ) {
	unset($value->response[ 'advanced-custom-fields-pro/acf.php' ]);
  }
  return $value;
}
add_filter('site_transient_update_plugins', 'gutenkind_acf_update');

// ACF Get Field Function
function gutenkind_field( $key, $id = false, $default = '', $format_value = true ) {
	global $post;
	$key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
	$result = '';
	if ( function_exists( 'get_field' ) ) {
		if ( isset( $post->ID ) && !$id ) {
			$result = get_field( $key, false, $format_value );
		} else {
			$result = get_field( $key, $id, $format_value );
			if ($result == '' && $default !== '') {
				$result = $default;
			}
		}
	} else {
		$result = $default;
	}
	return $result;
}

// Blocks
function gutenkind_register_acf() {
	if (!function_exists('acf_register_block'))
		return;
	acf_register_block( array(
		'name'			=> 'gutenkind-post-carousel',
		'title'			=> esc_html__( 'Post Slider', 'gutenkind' ),
		'render_template'	=> 'parts/blocks/block-post-slider.php',
		'category'		=> 'formatting',
		'icon'			=> gutenkind_template_part('/dist/svg/admin-slider'),
		'mode'			=> 'preview',
		'keywords'		=> array( 'posts', 'carousel', 'slider' )
	));
	acf_register_block( array(
		'name'			=> 'gutenkind-latest-posts',
		'title'			=> esc_html__( 'Posts', 'gutenkind' ),
		'render_template'	=> 'parts/blocks/block-posts.php',
		'category'		=> 'formatting',
		'icon'			=> gutenkind_template_part('/dist/svg/admin-posts'),
		'mode'			=> 'preview',
		'keywords'		=> array( 'posts', 'latest', 'recent' )
	));
	acf_register_block( array(
		'name'			=> 'gutenkind-posts-grid',
		'title'			=> esc_html__( 'Post Box', 'gutenkind' ),
		'render_template'	=> '/parts/blocks/block-post-box.php',
		'category'		=> 'formatting',
		'icon'			=> gutenkind_template_part('/dist/svg/admin-post-box'),
		'mode'			=> 'preview',
		'keywords'		=> array( 'post', 'posts', 'block', 'grid' )
	));
    acf_register_block( array(
		'name'			      => 'gutenkind-promobox',
		'title'			      => esc_html__( 'Promo Box', 'gutenkind' ),
		'render_template'     => '/parts/blocks/block-promobox.php',
		'category'		      => 'formatting',
		'icon'			      => gutenkind_template_part('/dist/svg/admin-promobox'),
		'mode'			      => 'preview',
		'keywords'		      => array( 'promo', 'box', 'promobox' )
	));
}
add_action('acf/init', 'gutenkind_register_acf' );

// Fields
if (function_exists('acf_add_local_field_group')) {

    // Cats
	// acf_add_local_field_group(array(
	// 	'key' => 'group_5c0fb1c3bff59',
	// 	'title' => 'gutenkind-cat-posts',
	// 	'fields' => array(
	// 		array(
	// 			'key' => 'field_5c0fb36175e8c',
	// 			'label' => 'Layout',
	// 			'name' => 'voss-posts-cat-layout',
	// 			'type' => 'radio',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-image-select',
	// 				'id' => '',
	// 			),
	// 			'choices' => array(
	// 				'list' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/list.png"><p>List</p>',
	// 				'grid' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/grid.png"><p>Grid</p>',
	// 				'masonry' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/masonry.png"><p>Masonry</p>',
	// 				'standard' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/standard.png"><p>Standard</p>',
	// 				'list-full' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/mixed.png"><p>Mixed</p>',
	// 				'full-list' => '<img src="' . get_template_directory_uri() . '/dist/img/layout/mixed-2.png"><p>Mixed 2</p>',
	// 			),
	// 			'allow_null' => 0,
	// 			'other_choice' => 0,
	// 			'default_value' => 'list',
	// 			'layout' => 'horizontal',
	// 			'return_format' => 'value',
	// 			'save_other_choice' => 0,
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fb1e4680b9',
	// 			'label' => 'Category',
	// 			'name' => 'voss-posts-cat-taxonomy',
	// 			'type' => 'taxonomy',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'taxonomy' => 'category',
	// 			'field_type' => 'select',
	// 			'allow_null' => 1,
	// 			'add_term' => 0,
	// 			'save_terms' => 0,
	// 			'load_terms' => 0,
	// 			'return_format' => 'id',
	// 			'multiple' => 0,
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fb7ce27ef3',
	// 			'label' => 'Number of Posts',
	// 			'name' => 'voss-posts-cat-num',
	// 			'type' => 'range',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 4,
	// 			'min' => 1,
	// 			'max' => 40,
	// 			'step' => 1,
	// 			'prepend' => '',
	// 			'append' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fb81527ef4',
	// 			'label' => 'Number of Columns',
	// 			'name' => 'voss-posts-cat-cols',
	// 			'type' => 'range',
	// 			'instructions' => '',
	// 			'required' => 0,
    //             'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fb36175e8c',
	// 						'operator' => '==',
	// 						'value' => 'grid',
	// 					),
	// 				),
    //                 array(
	// 					array(
	// 						'field' => 'field_5c0fb36175e8c',
	// 						'operator' => '==',
	// 						'value' => 'masonry',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 2,
	// 			'min' => 2,
	// 			'max' => 4,
	// 			'step' => 1,
	// 			'prepend' => '',
	// 			'append' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fb247680ba',
	// 			'label' => 'Display Most Popular',
	// 			'name' => 'voss-posts-cat-show-popular',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c120b1a8f08c',
	// 			'label' => 'Popular Time Range',
	// 			'name' => 'voss-posts-cat-popular-time',
	// 			'type' => 'select',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fb247680ba',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'choices' => array(
	// 				'24 hour ago' => 'Last 24 Hours',
	// 				'7 day ago' => 'Last 7 Days',
	// 				'1 month ago' => 'Last 30 Days',
	// 				'2 month ago' => 'Last 2 Months',
	// 				'3 month ago' => 'Last 3 Months',
	// 				'6 month ago' => 'Last 6 Months',
	// 				'12 month ago' => 'Last 12 Months',
	// 				'24 month ago' => 'Last 24 Months',
	// 				'999 month ago' => 'The Beginning of Time',
	// 			),
	// 			'default_value' => array(
	// 				0 => '999 month ago',
	// 			),
	// 			'allow_null' => 0,
	// 			'multiple' => 0,
	// 			'ui' => 1,
	// 			'ajax' => 0,
	// 			'return_format' => 'value',
	// 			'placeholder' => '',
	// 		),
    //         /*
	// 		array(
	// 			'key' => 'field_5c0fb2b7680bb',
	// 			'label' => 'Heading',
	// 			'name' => 'voss-posts-cat-heading',
	// 			'type' => 'text',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fb247680ba',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 'Popular from',
	// 			'placeholder' => '',
	// 			'prepend' => '',
	// 			'append' => '',
	// 			'maxlength' => '',
	// 		),
    //         */
	// 		array(
	// 			'key' => 'field_5c0fb6261296b',
	// 			'label' => 'Category Page Link',
	// 			'name' => 'voss-posts-cat-view-all',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fb6591296c',
	// 			'label' => 'Category Page Link Text',
	// 			'name' => 'voss-posts-cat-link_text',
	// 			'type' => 'text',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fb6261296b',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 'View All',
	// 			'placeholder' => '',
	// 			'prepend' => '',
	// 			'append' => '',
	// 			'maxlength' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fba60102a3',
	// 			'label' => 'Display Category Link',
	// 			'name' => 'voss-posts-cat-link',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbce4102a4',
	// 			'label' => 'Display Featured Image',
	// 			'name' => 'voss-posts-cat-featured-img',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd1b102a5',
	// 			'label' => 'Display Author',
	// 			'name' => 'voss-posts-cat-author',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd24102a6',
	// 			'label' => 'Display Date',
	// 			'name' => 'voss-posts-cat-date',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd31102a7',
	// 			'label' => 'Display Comments',
	// 			'name' => 'voss-posts-cat-comments',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 0,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd41102a8',
	// 			'label' => 'Display Views',
	// 			'name' => 'voss-posts-cat-views',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 0,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd53102a9',
	// 			'label' => 'Display Read Time',
	// 			'name' => 'voss-posts-cat-read',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 0,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd60102aa',
	// 			'label' => 'Display Post Excerpt',
	// 			'name' => 'voss-posts-cat-excerpt',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbda0102ad',
	// 			'label' => 'Post Excerpt Length',
	// 			'name' => 'voss-posts-cat-excerpt-length',
	// 			'type' => 'range',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fbd60102aa',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 20,
	// 			'min' => 1,
	// 			'max' => 60,
	// 			'step' => 1,
	// 			'prepend' => '',
	// 			'append' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd71102ab',
	// 			'label' => 'Display Read More',
	// 			'name' => 'voss-posts-cat-more',
	// 			'type' => 'true_false',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'message' => '',
	// 			'default_value' => 1,
	// 			'ui' => 1,
	// 			'ui_on_text' => '',
	// 			'ui_off_text' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbd85102acsd',
	// 			'label' => 'Read More Style',
	// 			'name' => 'voss-posts-cat-more-style',
	// 			'type' => 'radio',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fbd71102ab',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-switch',
	// 				'id' => '',
	// 			),
	// 			'choices' => array(
	// 				'link' => 'Link',
	// 				'btn' => 'Button',
	// 			),
	// 			'allow_null' => 0,
	// 			'other_choice' => 0,
	// 			'default_value' => 'link',
	// 			'layout' => 'vertical',
	// 			'return_format' => 'value',
	// 			'save_other_choice' => 0,
	// 		),
	// 		array(
	// 			'key' => 'field_5c0fbdd9102ae',
	// 			'label' => 'Customize Read More Text',
	// 			'name' => 'voss-posts-cat-more-text',
	// 			'type' => 'text',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => array(
	// 				array(
	// 					array(
	// 						'field' => 'field_5c0fbd71102ab',
	// 						'operator' => '==',
	// 						'value' => '1',
	// 					),
	// 				),
	// 			),
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 'Read More',
	// 			'placeholder' => '',
	// 			'prepend' => '',
	// 			'append' => '',
	// 			'maxlength' => '',
	// 		),
    //         array(
	// 			'key' => 'field_5c0e1ba1018799cat-sidebar',
	// 			'label' => 'Sidebar',
	// 			'name' => 'voss-posts-cat-sidebar',
	// 			'type' => 'select',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'choices' => array(
	// 				'left' => 'Left',
	// 				'right' => 'Right',
    //                 'none' => 'Disable',
	// 			),
	// 			'default_value' => array(
	// 				0 => 'none',
	// 			),
	// 			'allow_null' => 0,
	// 			'multiple' => 0,
	// 			'ui' => 1,
	// 			'ajax' => 0,
	// 			'return_format' => 'value',
	// 			'placeholder' => '',
	// 		),
    //         array(
	// 			'key' => 'field_5c0fc56998b83acat123',
	// 			'label' => 'Block Spacing Top',
	// 			'name' => 'block-cat-posts-mt',
	// 			'type' => 'range',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 60,
	// 			'min' => 0,
	// 			'max' => 200,
	// 			'step' => 1,
	// 			'prepend' => '',
	// 			'append' => '',
	// 		),
    //         array(
	// 			'key' => 'field_5c0fc56998b83bcat123',
	// 			'label' => 'Block Spacing Bottom',
	// 			'name' => 'block-cat-posts-mb',
	// 			'type' => 'range',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => '',
	// 				'id' => '',
	// 			),
	// 			'default_value' => 60,
	// 			'min' => 0,
	// 			'max' => 200,
	// 			'step' => 1,
	// 			'prepend' => '',
	// 			'append' => '',
	// 		),
	// 		array(
	// 			'key' => 'field_5c111c6253612',
	// 			'label' => 'set default',
	// 			'name' => 'set_default',
	// 			'type' => 'checkbox',
	// 			'instructions' => '',
	// 			'required' => 0,
	// 			'conditional_logic' => 0,
	// 			'wrapper' => array(
	// 				'width' => '',
	// 				'class' => 'voss-set-default',
	// 				'id' => '',
	// 			),
	// 			'choices' => array(
	// 				1 => '1',
	// 			),
	// 			'allow_custom' => 0,
	// 			'default_value' => array(
	// 			),
	// 			'layout' => 'vertical',
	// 			'toggle' => 0,
	// 			'return_format' => 'value',
	// 			'save_custom' => 0,
	// 		),
	// 	),
	// 	'location' => array(
	// 		array(
	// 			array(
	// 				'param' => 'block',
	// 				'operator' => '==',
	// 				'value' => 'acf/gutenkind-cat-posts',
	// 			),
	// 		),
	// 	),
	// 	'menu_order' => 0,
	// 	'position' => 'normal',
	// 	'style' => 'default',
	// 	'label_placement' => 'top',
	// 	'instruction_placement' => 'label',
	// 	'hide_on_screen' => '',
	// 	'active' => 1,
	// 	'description' => '',
	// ));

    // Latest
	acf_add_local_field_group(array(
		'key' => 'group_5c0ccdc980531',
		'title' => 'gutenkind-latest-posts',
		'fields' => array(
			array(
				'key' => 'field_5c0cd13b348ff',
				'label' => 'Block Settings',
				'name' => 'block-latest-layout',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-image-select',
					'id' => '',
				),
				'choices' => array(
					'list' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/list.png"><p>List</p>',
					'grid' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/grid.png"><p>Grid</p>',
					'masonry' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/masonry.png"><p>Masonry</p>',
					'standard' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/standard.png"><p>Standard</p>',
					'list-full' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/mixed.png"><p>Mixed</p>',
					'full-list' => '<img src="' .	get_template_directory_uri() . '/dist/img/layout/mixed-2.png"><p>Mixed 2</p>',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'list',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c0cd06ef1290',
				'label' => 'Order by',
				'name' => 'block-latest-orders',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'latest'       => 'Latest',
					'popular'      => 'Popular',
					'category'     => 'Category'
				),
				'default_value' => array(
					0 => 'latest',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
            array(
				'key' => 'field_5c120b1a8f08czad',
				'label' => 'Popular Time Range',
				'name' => 'block-latest-popular',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0cd06ef1290',
							'operator' => '==',
							'value' => 'popular',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'24 hour ago' => 'Last 24 Hours',
					'7 day ago' => 'Last 7 Days',
					'1 month ago' => 'Last 30 Days',
					'2 month ago' => 'Last 2 Months',
					'3 month ago' => 'Last 3 Months',
					'6 month ago' => 'Last 6 Months',
					'12 month ago' => 'Last 12 Months',
					'24 month ago' => 'Last 24 Months',
					'999 month ago' => 'The Beginning of Time',
				),
				'default_value' => array(
					0 => '999 month ago',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5c0cd0e6f1291',
				'label' => 'Category',
				'name' => 'block-latest-cat',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0cd06ef1290',
							'operator' => '==',
							'value' => 'category',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 1,
				'add_term' => 1,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array(
				'key' => 'field_5c0cce30d15fa',
				'label' => 'Number of Posts',
				'name' => 'block-latest-posts-num',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 12,
				'min' => 1,
				'max' => 40,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c0ccec4d15fb',
				'label' => 'Number of Columns',
				'name' => 'block-latest-cols',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0cd13b348ff',
							'operator' => '==',
							'value' => 'grid',
						),
					),
                    array(
						array(
							'field' => 'field_5c0cd13b348ff',
							'operator' => '==',
							'value' => 'masonry',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 2,
				'max' => 4,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
            array(
				'key' => 'field_block_posts_display_title',
				'label' => 'Display Block Title',
				'name' => 'block-latest-title',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
            array(
				'key' => 'field_5c0fb2b7680bb99latest',
				'label' => 'Block Title',
				'name' => 'block-latest-title-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_title',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => esc_html__('Block Title', 'gutenkind'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),

            array(
				'key' => 'field_5c0fb2b7680bb99viewalltext',
				'label' => 'Subtitle Text',
				'name' => 'block-latest-subtitle-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_title',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => esc_html__('Subtitle', 'gutenkind'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
            array(
				'key' => 'field_5c0fc454548c6viewalllink',
				'label' => 'Subtitle Link:',
				'name' => 'block-latest-subtitle-link',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5c0cd06ef1290',
                            'operator' => '==',
                            'value' => 'popular',
                        ),
                        array(
							'field' => 'field_block_posts_display_title',
							'operator' => '==',
							'value' => '1',
						),
                    ),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
            array(
				'key' => 'field_5c0cd13b348fasda88f',
				'label' => 'Title Alignment',
				'name' => 'block-latest-title-align',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_title',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-svg-select',
					'id' => '',
				),
				'choices' => array(
					'text-left' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg>',
					'text-center' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg>',
					'text-right' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg>',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'text-center',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c0f686764fd7',
				'label' => 'Display Category Link',
				'name' => 'block-latest-cat-link',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0ccf34d15fc',
				'label' => 'Display Featured Image',
				'name' => 'block-latest-thumb',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => 1,
				'ui_off_text' => 0,
			),
			array(
				'key' => 'field_5c0ccf67d15fd',
				'label' => 'Display Author',
				'name' => 'block-latest-author',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0ccf7ad15fe',
				'label' => 'Display Date',
				'name' => 'block-latest-date',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0f68cf64fd8',
				'label' => 'Display Comments',
				'name' => 'block-latest-comments',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0f696364fd9',
				'label' => 'Display Views',
				'name' => 'block-latest-views',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0f697d64fda',
				'label' => 'Display Read Time',
				'name' => 'block-latest-read-time',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0ccf8ad15ff',
				'label' => 'Display Post Excerpt',
				'name' => 'block-latest-excerpt',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0ccfa4d1600',
				'label' => 'Post Excerpt Length',
				'name' => 'block-latest-excerpt-length',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0ccf8ad15ff',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 30,
				'min' => 1,
				'max' => 55,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c0cd01dd1601',
				'label' => 'Display Read More',
				'name' => 'block-latest-more',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0cd034d1602',
				'label' => 'Read More Style',
				'name' => 'block-latest-more-style',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0cd01dd1601',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'link' => 'Link',
					'btn' => 'Button',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'link',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c0d935b259f4',
				'label' => 'Customize Read More Text',
				'name' => 'block-latest-more-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0cd01dd1601',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Read More',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c0e1ba101878',
				'label' => 'Navigation',
				'name' => 'block-latest-nav',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'none'          => esc_html__('Disabled', 'gutenkind'),
                    'numeric' 		=> esc_html__('Numeric', 'gutenkind'),
        			'links' 		=> esc_html__('Links', 'gutenkind'),
        			'btn' 			=> esc_html__('Buttons', 'gutenkind'),
        			'load' 			=> esc_html__('Load More Button', 'gutenkind'),
        			'infinite' 		=> esc_html__('Infinite Scroll', 'gutenkind'),
				),
				'default_value' => array(
					0 => 'links',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
            array(
				'key' => 'field_5c0e1ba101879latest-sidebar',
				'label' => 'Sidebar',
				'name' => 'block-latest-sidebar',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'left' => 'Left',
					'right' => 'Right',
                    'none' => 'Disable',
				),
				'default_value' => array(
					0 => 'none',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
            array(
				'key' => 'field_5c0fc56998b83a123latest1',
				'label' => 'Block Spacing Top',
				'name' => 'block-latest-mt',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
            array(
				'key' => 'field_5c0fc56998b83blatest2',
				'label' => 'Block Spacing Bottom',
				'name' => 'block-latest-mb',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c111c8d2a4e0',
				'label' => 'latest-posts-set-default',
				'name' => 'latest-posts-set-default',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-set-default',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/gutenkind-latest-posts',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

    // Slider
	acf_add_local_field_group(array(
		'key' => 'group_5c1004c24567c',
		'title' => 'gutenkind-post-carousel',
		'fields' => array(
			array(
				'key' => 'field_5c1007b3d8236',
				'label' => 'Carousel Posts',
				'name' => 'block-carousel-ids',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'post',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 1,
				'return_format' => 'id',
				'ui' => 1,
			),
			array(
				'key' => 'field_5c10b3692ceb1',
				'label' => 'Carousel Style',
				'name' => 'block-carousel-style',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => 'Style 1',
					2 => 'Style 2',
					3 => 'Style 3',
					4 => 'Style 4',
					5 => 'Style 5',
					6 => 'Style 6',
					7 => 'Style 7',
					8 => 'Style 8',
                    9 => 'Style 9',
				),
				'default_value' => array(
					0 => 1,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5c100afbc2567',
				'label' => 'Autoplay',
				'name' => 'block-carousel-autoplay',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c100b0cc2568',
				'label' => 'Autoplay Speed',
				'name' => 'block-carousel-autospeed',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c100afbc2567',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 8,
				'min' => 1,
				'max' => 60,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c100b4cc2569',
				'label' => 'Loop',
				'name' => 'block-carousel-loop',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c100b925b6c9',
				'label' => 'Display Navigation Arrows',
				'name' => 'block-carousel-nav',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c125759d4d33',
				'label' => 'Display Pagination',
				'name' => 'block-carousel-pagination',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c1004d5d822b',
				'label' => 'Display Category Link',
				'name' => 'block-carousel-cat-link',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c10053cd822c',
				'label' => 'Display Author',
				'name' => 'block-carousel-author',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c1005ced822d',
				'label' => 'Display Date',
				'name' => 'block-carousel-date',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c1005d7d822e',
				'label' => 'Display Comments',
				'name' => 'block-carousel-comments',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c1005e7d822f',
				'label' => 'Display Views',
				'name' => 'block-carousel-views',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c1005f3d8230',
				'label' => 'Display Read Time',
				'name' => 'block-carousel-read-time',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c100603d8231',
				'label' => 'Display Post Excerpt',
				'name' => 'block-carousel-excerpt',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c10068dd8235',
				'label' => 'Post Excerpt Length',
				'name' => 'block-carousel-excerpt-length',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c100603d8231',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 30,
				'min' => 1,
				'max' => 55,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c100631d8232',
				'label' => 'Display Read More',
				'name' => 'block-carousel-more',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c100662d8233a',
				'label' => 'Read More Style',
				'name' => 'block-carousel-more-style',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c100631d8232',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'choices' => array(
					'link' => 'Link',
					'button' => 'Button',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'link',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c10066ad8234',
				'label' => 'Customize Read More Text',
				'name' => 'block-carousel-more-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c100631d8232',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Read More',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
            array(
				'key' => 'field_block_posts_display_titlecarousel',
				'label' => 'Display Block Title',
				'name' => 'block-carousel-title',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
            array(
				'key' => 'field_5c0fb2b7680bb99latestcarousel',
				'label' => 'Block Title',
				'name' => 'block-carousel-title-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_titlecarousel',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => esc_html__('Block Title', 'gutenkind'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),

            array(
				'key' => 'field_5c0fb2b7680bb99viewalltextcarousel',
				'label' => 'Subtitle Text',
				'name' => 'block-carousel-subtitle-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_titlecarousel',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => esc_html__('Subtitle', 'gutenkind'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
            array(
				'key' => 'field_5c0fc454548c6viewalllinkcarousel',
				'label' => 'Subtitle Link:',
				'name' => 'block-carousel-subtitle-link',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
							'field' => 'field_block_posts_display_titlecarousel',
							'operator' => '==',
							'value' => '1',
						),
                    ),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
            array(
				'key' => 'field_5c0cd13b348fasda88fcarousel',
				'label' => 'Title Alignment',
				'name' => 'block-carousel-title-align',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
                'conditional_logic' => array(
					array(
						array(
							'field' => 'field_block_posts_display_titlecarousel',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-svg-select',
					'id' => '',
				),
				'choices' => array(
					'text-left' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg>',
					'text-center' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg>',
					'text-right' => '<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg>',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'text-center',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c111cbf17e76z23',
				'label' => 'block-carousel-set-default',
				'name' => 'block-carousel-set-default',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-set-default',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/gutenkind-post-carousel',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

    // Post box
	acf_add_local_field_group(array(
		'key' => 'group_5c0fc443b0c60',
		'title' => 'gutenkind-posts-grid',
		'fields' => array(
            array(
				'key' => 'field_5c1posts-grid-4z4',
				'label' => 'Block Style',
				'name' => 'block-posts-grid-style',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => 'Style 1',
					2 => 'Style 2',
					3 => 'Style 3',
					4 => 'Style 4',
					5 => 'Style 5',
					6 => 'Style 6',
					7 => 'Style 7',
				),
				'default_value' => array(
					0 => 1,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
            array(
				'key' => 'field_5c0fc454548c6',
				'label' => 'Choose Posts',
				'name' => 'block-posts-grid-ids',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'post',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 1,
				'return_format' => 'id',
				'ui' => 1,
			),
			array(
				'key' => 'field_5c0fc4d898b7a',
				'label' => 'Block Title',
				'name' => 'block-posts-grid-title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => esc_html__('Trending Now', 'gutenkind'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c0fc4ef98b7b',
				'label' => 'Display Category Link',
				'name' => 'block-posts-grid-cat-link',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc52798b7d',
				'label' => 'Display Author',
				'name' => 'block-posts-grid-author',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc53998b7e',
				'label' => 'Display Date',
				'name' => 'block-posts-grid-date',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc53f98b7f',
				'label' => 'Display Comments',
				'name' => 'block-posts-grid-comments',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc54798b80',
				'label' => 'Display Views',
				'name' => 'block-posts-grid-views',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc54f98b81',
				'label' => 'Display Read Time',
				'name' => 'block-posts-grid-read',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc55698b82',
				'label' => 'Display Post Excerpt',
				'name' => 'block-posts-grid-excerpt',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc56998b83',
				'label' => 'Post Excerpt Length',
				'name' => 'block-posts-grid-excerpt-length',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0fc55698b82',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 22,
				'min' => 1,
				'max' => 55,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c0fc59198b84',
				'label' => 'Display Read More',
				'name' => 'block-posts-grid-more',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-switch',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5c0fc5d698b86',
				'label' => 'Customize Read More Text',
				'name' => 'block-posts-grid-more-text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c0fc59198b84',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Read More',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
            array(
				'key' => 'field_5c0fc56998b83a123',
				'label' => 'Block Spacing Top',
				'name' => 'block-posts-grid-mt',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 40,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
            array(
				'key' => 'field_5c0fc56998b83b123',
				'label' => 'Block Spacing Bottom',
				'name' => 'block-posts-grid-mb',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 60,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5c111dbc00c76',
				'label' => 'posts-grid-set-default',
				'name' => 'posts-grid-set-default',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-set-default',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/gutenkind-posts-grid',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

    // Promo Box
    acf_add_local_field_group(array(
    	'key' => 'group_5c8b5c2bc3050',
    	'title' => 'promobox-block',
    	'fields' => array(
    		array(
    			'key' => 'field_5c8b5c7e661f7',
    			'label' => 'Sub Heading',
    			'name' => 'promobox-subheading',
    			'type' => 'text',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => 'Sub Heading',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'maxlength' => '',
    		),
    		array(
    			'key' => 'field_5c8b5c4a661f6',
    			'label' => 'Heading',
    			'name' => 'promobox-heading',
    			'type' => 'text',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => 'Heading',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'maxlength' => '',
    		),
    		array(
    			'key' => 'field_5c8b5c96661f8',
    			'label' => 'Background Image',
    			'name' => 'promobox-bg',
    			'type' => 'image',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'url',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => '',
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    		array(
    			'key' => 'field_5c8b5cbf661f9',
    			'label' => 'Link',
    			'name' => 'promobox-link',
    			'type' => 'url',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => 'http://',
    			'placeholder' => '',
    		),
    		array(
    			'key' => 'field_5c8b5e5fd7f77',
    			'label' => 'Open in New Tab',
    			'name' => 'promobox-target',
    			'type' => 'true_false',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => 'voss-switch',
    				'id' => '',
    			),
    			'message' => '',
    			'default_value' => 0,
    			'ui' => 1,
    			'ui_on_text' => '',
    			'ui_off_text' => '',
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'block',
    				'operator' => '==',
    				'value' => 'acf/gutenkind-promobox',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'side',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));

    // Post Header
	acf_add_local_field_group(array(
		'key' => 'group_5c1b4ba554f38',
		'title' => 'Post Header',
		'fields' => array(
			array(
				'key' => 'field_5c1b4bb8da7b0',
				'label' => '',
				'name' => 'single-field-header-type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-mb-16',
					'id' => '',
				),
				'choices' => array(
					'standard' => 'Standard',
                    'wrapped' => 'Wrapped',
					'fullwidth' => 'Fullwidth',
					'fullscreen' => 'Fullscreen',
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
    // Post Sidebar
	acf_add_local_field_group(array(
		'key' => 'group_5c1b4d0907bb8',
		'title' => 'Sidebar',
		'fields' => array(
			array(
				'key' => 'field_5c1b4d090aca2',
				'label' => '',
				'name' => 'single-field-sidebar',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-mb-16',
					'id' => '',
				),
				'choices' => array(
					'left' => 'Left',
					'right' => 'Right',
					'none' => 'Disable',
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
    // Page title
    acf_add_local_field_group(array(
		'key' => 'group_5c1b4d0907bb8pagetitle',
		'title' => 'Page Title',
		'fields' => array(
			array(
				'key' => 'field_5c1b4d090aca2pagetitle',
				'label' => '',
				'name' => 'page-field-title',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'voss-mb-16',
					'id' => '',
				),
				'choices' => array(
					'true' => 'Hide Page Title',
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

    // Page Header
    acf_add_local_field_group(array(
		'key' => 'group_5c1b4d0907bb8pageheader',
		'title' => 'Header Style',
		'fields' => array(
			array(
				'key' => 'field_5c1b4d090aca2pageheader',
				'label' => '',
				'name' => 'page-field-header',
                'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
                    ''          => esc_html__( 'Default', 'gutenkind' ),
                    '1' 		=> esc_html__( 'Header 1', 'gutenkind' ),
        			'2' 		=> esc_html__( 'Header 2', 'gutenkind' ),
        			'3' 		=> esc_html__( 'Header 3', 'gutenkind' ),
        			'4' 		=> esc_html__( 'Header 4', 'gutenkind' ),
        			'5' 		=> esc_html__( 'Header 5', 'gutenkind' ),
                    '6' 		=> esc_html__( 'Header 6', 'gutenkind' ),
                    '7' 		=> esc_html__( 'Header 7', 'gutenkind' ),
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
    // Page Adbar
    acf_add_local_field_group(array(
		'key' => 'group_5c1b4d0907bb8pageheaderadbar',
		'title' => 'Header Ad-Bar',
		'fields' => array(
			array(
				'key' => 'field_5c1b4d090aca2pageheaderadbar',
				'label' => '',
				'name' => 'page-field-adbar',
                'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
                    '' => 'Default',
                    'true' => 'Enable',
					'false' => 'Disable',
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}

// Nav Menus
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    	'key' => 'group_5c581e56e2443',
    	'title' => 'mega-menu-toggle',
    	'fields' => array(
    		array(
    			'key' => 'field_5c581ee7b7cd8',
    			'label' => 'Mega Menu',
    			'name' => 'enable_mega_menu',
    			'type' => 'true_false',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => 'voss-switch',
    				'id' => '',
    			),
    			'message' => '',
    			'default_value' => 0,
    			'ui' => 0,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'nav_menu_item',
    				'operator' => '==',
    				'value' => 'all',
    			),
    		),
    	),
    	'menu_order' => 1,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));

    acf_add_local_field_group(array(
    	'key' => 'group_5c581e56e2443123',
    	'title' => 'cat-mega-posts-toggle',
    	'fields' => array(
    		array(
    			'key' => 'field_5c581ee7b7cd8123',
    			'label' => 'Category Mega Menu',
    			'name' => 'enable_mega_posts',
    			'type' => 'true_false',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => 'voss-switch',
    				'id' => '',
    			),
    			'message' => '',
    			'default_value' => 0,
    			'ui' => 0,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'nav_menu_item',
    				'operator' => '==',
    				'value' => 'all',
    			),
    		),
    	),
    	'menu_order' => 2,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));

}

// Mega Menu parent class
function gutenkind_enable_mega($items, $args) {
    foreach($items as $item) {
        $mega = gutenkind_field('enable_mega_menu', $item);
        if ($mega == 'true') {
            $item->classes[] = 'voss-mega-menu';
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'gutenkind_enable_mega', 10, 2);

/**
 * Cat Mega Menu Walker
*/
class gutenkind_cat_menu_Walker extends Walker_Nav_Menu {
    private $in_sub_menu = 0;
	var $active_megamenu = 0;
	var $mega_menu_content;

	function start_lvl(&$output, $depth = 0, $args = array()) {

        $indent = str_repeat("\t", $depth);

        if ($depth === 0) {
            $output .= "\n{replace_one}\n";
        }

        if ($this->active_megamenu) {
            $output .= "\n$indent<div class=\"header__mega-cats\"><h4>".esc_html__('Category', 'gutenkind')."</h4><ul class=\"sub-menu ".(($depth === 0) ? "{locate_class}": "")."\">\n";
        } else {
            $output .= "\n$indent<ul class=\"sub-menu ".(($depth === 0) ? "{locate_class}": "")."\">\n";
        }

	}

	function end_lvl(&$output, $depth = 0, $args = array()) {

        $indent = str_repeat("\t", $depth);

        if ($this->active_megamenu) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= "$indent</ul>\n";
        }

        if ($depth === 0 && $this->active_megamenu) {
            $output.= '<div class="header__mega-posts-wrap">'.$this->mega_menu_content.'</div></div></div>';
        }

		if ($depth === 0) {
			if ($this->active_megamenu) {
				$output = str_replace("{replace_one}", '<div class="header__mega"><div class="header__mega-wrap">', $output);
				$output = str_replace("{locate_class}", "header__mega-submenu", $output);
			}
			else {
                $output = str_replace("{replace_one}", "", $output);
                $output = str_replace("{locate_class}", "", $output);
			}
		}

		$this->mega_menu_content = '';

	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if ($depth == 1) {
            if (!$this->in_sub_menu) {
                $this->in_sub_menu = 1;
                array_push($classes, 'active');
            }
        }

        if ($depth == 0) {
            $this->in_sub_menu = 0;
            $this->active_megamenu = gutenkind_field('enable_mega_posts', $item->ID);
        }

        if ($depth === 0 && $this->active_megamenu) {
        	array_push($classes, 'header__mega-menu');
        }

	    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

	    $atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

	    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty( $value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

        $item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$this->in_sub_menu = 1;
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ($depth == 1 && $this->in_sub_menu) {

			if (in_array($item->object, array('post_tag','category'))) {

                if ($item->object == 'category') {
					$args = array(
					    'cat' => $item->object_id,
					    'posts_per_page' => 3,
					    'no_found_rows' => true
					);
				} else if ($item->object == 'post_tag') {
					$args = array(
					    'tag_id' => $item->object_id,
					    'posts_per_page' => 3,
					    'no_found_rows' => true
					);
				}

				$cache_key = 'voss-mega-menu-id------'.$item->object_id;

				if (!$html = get_transient($cache_key)) {
					ob_start();
					$query = new WP_Query($args);

					if ($query->have_posts()) {
                        echo '<div class="header__mega-posts">';
    						while ($query->have_posts()) : $query->the_post();
                                if (has_post_thumbnail()) { ?>
                                    <div class="header__mega-post">
                                        <a href="<?php the_permalink(); ?>">
                                            <div><?php the_post_thumbnail('landscape-sm', array('alt' => get_the_title())); ?></div>
                                            <h4 class="post-title"><?php the_title(); ?></h4>
                                        </a>
                                    </div> <?php
                                }
    						endwhile; ?>
                            <a href="<?php echo get_category_link($item->object_id); ?>" class="header__mega-cat-link">
                                <?php esc_html_e('View All', 'gutenkind'); ?>
                            </a><?php
                        echo '</div>';
					}

					$html = ob_get_clean();
					wp_reset_query();
					wp_reset_postdata();
					set_transient( $cache_key, $html, 12 * HOUR_IN_SECONDS );
				}
				$this->mega_menu_content .= $html;
			}
        }
		$output .= "</li>\n";
	}

}
