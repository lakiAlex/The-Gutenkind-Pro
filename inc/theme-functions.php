<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
* Return Template Part
*/
function gutenkind_template_part($slug) {
	ob_start();
	get_template_part($slug);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

/**
* Menu Dropdown Icon
*/
function gutenkind_menu_arrows($item_output, $item, $depth, $args) {
	if (in_array('menu-item-has-children', $item->classes)) {
		$arrow = gutenkind_template_part('/dist/svg/svg-arrow-down');
		$item_output = str_replace('</a>', ''.$arrow.'</a>', $item_output);
	}
	return $item_output;
}
add_filter('walker_nav_menu_start_el', 'gutenkind_menu_arrows', 10, 4);

/**
 * Enqueue CF 7 for shortcode only
 */
function contactform_dequeue_scripts() {
    $load_scripts = false;
    if (is_singular()) {
    	$post = get_post();
    	if (has_shortcode($post->post_content, 'contact-form-7')) {
        	$load_scripts = true;
    	}
    }
    if (!$load_scripts) {
        wp_dequeue_script('contact-form-7');
        wp_dequeue_style('contact-form-7');
    }
}
add_action( 'wp_enqueue_scripts', 'contactform_dequeue_scripts', 99 );

/**
* Count Format
*/
function gutenkind_format_number($number) {
	$precision = 1;
	if ( $number >= 1000 && $number < 1100 || $number >= 2000 && $number < 2100 ) {
		$formatted = number_format( $number/1000, 0 ).'K';
	} elseif ( $number >= 3000 && $number < 3100 || $number >= 4000 && $number < 4100 ) {
		$formatted = number_format( $number/1000, 0 ).'K';
	} elseif ( $number >= 5000 && $number < 5100 || $number >= 4000 && $number < 6100 ) {
		$formatted = number_format( $number/1000, 0 ).'K';
	} elseif ( $number >= 1100 && $number < 1000000 ) {
		$formatted = number_format( $number/1000, $precision ).'K';
	} else if ( $number >= 1000000 && $number < 1000000000 ) {
		$formatted = number_format( $number/1000000, $precision ).'M';
	} else if ( $number >= 1000000000 ) {
		$formatted = number_format( $number/1000000000, $precision ).'B';
	} else {
		$formatted = $number; // Number is less than 1000
	}
	$formatted = str_replace( '.00', '', $formatted );
	return $formatted;
}

/**
* Meta Category
*/
function gutenkind_meta_cat() {
	$categories_list = get_the_category_list(esc_html__( ' ', 'gutenkind' ));
	if ($categories_list) {
		printf(
			'<span class="meta-cat cat-links">%1$s</span>',
			$categories_list
		);
	}
}

/*
* Meta Author
*/
function gutenkind_meta_author() {
	$post = get_post();
	$author_id = $post->post_author;
	printf(
		'<span class="meta-author byline"><span class="author vcard"><a class="url fn n" href="%2$s">%3$s %4$s</a></span></span>',
		esc_html__('Posted by', 'gutenkind'),
		get_author_posts_url($author_id),
		esc_html__('by', 'gutenkind'),
		get_the_author_meta('display_name', $author_id)
	);
}

/*
* Meta Date
*/
function gutenkind_meta_date() {
	printf(
		'<span class="meta-date posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
		get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')),
		esc_html(get_the_date())
	);
}

/**
* Meta Comments
*/
function gutenkind_meta_comments() {
	if (!post_password_required() && (comments_open() && get_comments_number() >= '1')) {
		echo '<span class="meta-comments">';
			comments_popup_link( '', '1 '. esc_html__('Comment', 'gutenkind'), '% '. esc_html__('Comments', 'gutenkind'), 'comments-link', '');
		echo '</span>';
	}
}

/**
* Excerpt
*/
function gutenkind_excerpt($limit) {
	$content = get_the_content();
	$content = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	printf(
		'<p class="post-excerpt">%1$s</p>',
		wp_trim_words($content, $limit, '&hellip;')
	);
}

/**
* Thumb Placeholder
*/
function gutenkind_thumb_placeholder( $attr, $attachment, $size ) {
		if (!is_string($size)) {
			return $attr;
		}
		$placeholder = wp_get_attachment_image_src($attachment->ID, $size.'-low');
		$attr['data-src']      = $attr['src'];
		$attr['data-sizes']    = 'auto';
		$attr['src']           = $placeholder[0];
		$attr['class']        .= ' voss-lazy lazyload';
		if (isset($attr['srcset'])) {
			$attr['data-srcset'] = $attr['srcset'];
			//unset( $attr['srcset'] );
		}
	return $attr;
}
if (!is_admin()) add_filter('wp_get_attachment_image_attributes', 'gutenkind_thumb_placeholder', 10, 3);

/**
 * Returns Thumb URL.
 */
function gutenkind_thumb_url($size) {
	if (!$size) {
		return;
	}
	$post = get_post();
	$get_format = get_post_format($post->ID);
	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size, false )[0];

	if (!empty($thumb_url)) {
		$url = $thumb_url;
	} else if ( $get_format == 'gallery' ) {
		$images = gutenkind_field( 'post_format_gallery' );
		if ( $images ) {
			foreach( $images as $index => $image ) {
				if ($index == 0) {
					$url = wp_get_attachment_image_url( $image['id'], $size );
				}
			}
		}
	}
	return $url;
}

/**
* Post Format Icon
*/
function gutenkind_post_icon() {
	$format = get_post_format();
	$id = get_the_ID();

	if (!($format == 'gallery' || $format == 'video' || $format == 'audio')) {
		return;
	} ?>
	<span class="post-format-icon">
		<?php get_template_part('/dist/svg/svg', $format); ?>
	</span> <?php
}

/**
* Pagination
*/
function gutenkind_pagination($type = '') { ?>
	<div class="pagination-<?php echo esc_attr($type); ?> voss-ajax-pagination"> <?php
	    if ($type == 'btn') {
			if (get_previous_posts_link()) { ?>
				<a class="prev button" href="<?php esc_url(previous_posts()); ?>"><?php esc_html_e('Older Posts', 'gutenkind') ?></a> <?php
			}
			if (get_next_posts_link()) { ?>
				<a class="next button" href="<?php esc_url(next_posts()); ?>"><?php esc_html_e('Newer Posts', 'gutenkind') ?></a> <?php
			}
	    } else if ($type == 'links') {
	        the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => esc_html__('Newer Posts', 'gutenkind'),
				'next_text' => esc_html__('Older Posts', 'gutenkind'),
			));
	    } else if ($type == 'numeric') {
	        the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => ''. gutenkind_template_part('/dist/svg/svg-arrow-down') .''. esc_html__('Previous', 'gutenkind') .'',
				'next_text' => ''. esc_html__('Next', 'gutenkind') .''. gutenkind_template_part('/dist/svg/svg-arrow-down') .'',
			));
	    } else if ($type == 'load') { ?>
			<div class="page-load-status">
				<div class="infinite-scroll-request"><div class="voss-load"></div></div>
				<p class="infinite-scroll-last"><?php esc_html_e('No More Posts', 'gutenkind' ); ?></p>
				<p class="infinite-scroll-error"><?php esc_html_e('No More Posts', 'gutenkind'); ?></p>
			</div>
			<a href="<?php esc_url(next_posts()); ?>" class="button voss-load-btn"><?php esc_html_e('Load More', 'gutenkind'); ?></a> <?php
	    } else if ($type == 'infinite') { ?>
			<div class="page-load-status">
				<div class="infinite-scroll-request"><div class="voss-load"></div></div>
				<p class="infinite-scroll-last"><?php esc_html_e('No More Posts', 'gutenkind'); ?></p>
				<p class="infinite-scroll-error"><?php esc_html_e('No More Posts', 'gutenkind'); ?></p>
			</div>
			<a href="<?php esc_url(next_posts()); ?>" class="voss-load-btn"></a> <?php
	    } ?>
	</div> <?php
}

/**
* Single Tags
*/
function gutenkind_tags() {
	$tags_list = get_the_tag_list( '', '' );
	if ( $tags_list ) {
		printf(
			'<div class="tags-links">%2$s</div>',
			__( 'Tags:', 'gutenkind' ),
			$tags_list
		);
	}
}

/*
* Related Posts
*/
function gutenkind_related_posts( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query',
	) );

	$related_args = array(
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => $args['orderby'],
		'tax_query'      => array(),
		'meta_query' 	 => array( array( 'key' => '_thumbnail_id' ) )
	);

	$post = get_post( $post_id );
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) {
			continue;
		}
		$term_list = wp_list_pluck( $terms, 'slug' );
		$related_args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list
		);
	}

	if ( count( $related_args['tax_query'] ) > 1 ) {
		$related_args['tax_query']['relation'] = 'OR';
	}

	if ( $args['return'] == 'query' ) {
		return new WP_Query( $related_args );
	} else {
		return $related_args;
	}
}

/**
* Social Links
*/
function gutenkind_url_strpos($url) {
	if (strpos($url, 'http') === false) {
		$url = 'http://'. $url .'';
	}
	return $url;
}
function gutenkind_social_media() {
	$socials = array(
        'facebook'  => array(
			'link'  => get_theme_mod('social_facebook', esc_url('https://facebook.com')), 'icon'  => 'facebook',
        ),
		'twitter'   => array(
			'link'  => get_theme_mod('social_twitter', esc_url('https://twitter.com')), 'icon'  => 'twitter',
        ),
		'instagram'   => array(
			'link'  => get_theme_mod('social_instagram', esc_url('https://instagram.com')), 'icon'  => 'instagram',
        ),
		'pinterest'   => array(
			'link'  => get_theme_mod('social_pinterest', esc_url('https://pinterest.com')), 'icon'  => 'pinterest',
        ),
		'youtube'   => array(
			'link'  => get_theme_mod('social_youtube', esc_url('https://youtube.com')), 'icon'  => 'youtube',
        ),
		'vimeo'   => array(
			'link'  => get_theme_mod('social_vimeo'), 'icon'  => 'vimeo',
        ),
		'tumblr'   => array(
			'link'  => get_theme_mod('social_tumblr'), 'icon'  => 'tumblr',
        ),
		'bloglovin'   => array(
			'link'  => get_theme_mod('social_bloglovin'), 'icon'  => 'bloglovin',
        ),
		'linkedin'   => array(
			'link'  => get_theme_mod('social_linkedin'), 'icon'  => 'linkedin',
        ),
		'snapchat'   => array(
			'link'  => get_theme_mod('social_snapchat'), 'icon'  => 'snapchat',
        ),
		'google'   => array(
			'link'  => get_theme_mod('social_google'), 'icon'  => 'googleplus',
        ),
		'vk'   => array(
			'link'  => get_theme_mod('social_vk'), 'icon'  => 'vk',
        )
    );
	echo '<div class="social">';
		foreach( $socials as $social ) {
			if ($social['link']) {
				printf(
					'<a class="social__link" href="%1$s" target="_blank" rel="external"><i class="socicon-%2$s"></i></a>',
					gutenkind_url_strpos(esc_url($social['link'])),
					$social['icon']
				);
			}
		}
		$email = get_theme_mod('social_email', 'hello@yourdomain.com');
		if ($email) {
			printf(
				'<a class="social__link" href="%1$s%2$s" target="_top" rel="external"><i class="%3$s"></i></a>',
				'mailto:',
				esc_html($email),
				'socicon-mailru'
			);
		}
	echo '</div>';
}

/**
 * Returns Cart Contents / Ajax
 */
function gutenkind_ajax_cart($fragments) {
 	global $woocommerce;
 	ob_start(); ?>
 	<span class="header__cart-count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span><?php
 	$fragments['.header__cart-count'] = ob_get_clean();
 	return $fragments;
 }
add_filter('woocommerce_add_to_cart_fragments', 'gutenkind_ajax_cart');

/**
 * Single Post Pagination
 */
function gutenkind_single_pag($post, $string ,$thumbSize) {
 	$id				= $post->ID;
	$link 			= get_permalink($id);
	$title			= $post->post_title;
	$cat_link		= get_category_link(get_the_category($id)[0]->term_id);
	$cat_name		= get_the_category($id)[0]->cat_name;
	$thumb_url 		= wp_get_attachment_image_src(get_post_thumbnail_id($id), $thumbSize, false);
	$full_img_url 	= wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full', false);
	$bg = $thumb_url[0] ? $bg = $thumb_url[0] : $full_img_url[0];

	printf(
		'<a href="%1$s"><p class="link">%8$s %2$s</p><h4>%3$s</h4></a>
		<div class="single-nav-tip">
			<div class="single-nav-img" data-bg="%4$s"></div>
			<div class="single-nav-info">
				<div><span class="meta-cat cat-links"><a href="%5$s">%6$s</a></span><h3><a href="%1$s">%7$s</a></h3></div>
			</div>
		</div>',
		esc_url($link),
		esc_html($string),
		wp_trim_words(esc_html($title), 5, '&hellip;'),
		esc_url($bg),
		esc_url($cat_link),
		esc_textarea($cat_name),
		esc_html($title),
		gutenkind_template_part('/dist/svg/svg-arrow-down')
	);
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function gutenkind_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

/**
 * Comments Title Avatars
 */
function gutenkind_get_user_avatar_markup($id_or_email = null) {
	if (!isset($id_or_email)) $id_or_email = get_current_user_id();
	return sprintf('<div class="comment-user-avatar comment-author vcard">%s</div>', get_avatar($id_or_email, '60'));
}

function gutenkind_discussion_avatars_list( $comment_authors ) {
	if (empty($comment_authors)) return;
	echo '<ol class="discussion-avatar-list">', "\n";
	foreach ( $comment_authors as $id_or_email ) {
		printf(
			"<li>%s</li>\n",
			gutenkind_get_user_avatar_markup($id_or_email)
		);
	}
	echo '</ol>', "\n";
}
