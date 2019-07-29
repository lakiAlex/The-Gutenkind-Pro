<?php

$layout         = gutenkind_field('block-latest-layout');
$orders         = gutenkind_field('block-latest-orders');
$cat            = gutenkind_field('block-latest-cat');
$posts_num      = gutenkind_field('block-latest-posts-num');
$cols           = gutenkind_field('block-latest-cols');

$title          = gutenkind_field('block-latest-title');
$title_align    = gutenkind_field('block-latest-title-align');
$title_text     = gutenkind_field('block-latest-title-text');
$subtitle_text  = gutenkind_field('block-latest-subtitle-text');
if ($orders == 'popular') {
    $subtitle_link  = get_permalink(gutenkind_field('block-latest-subtitle-link'));
} else if ($orders == 'category') {
    $subtitle_link  = get_category_link($cat);
} else {
    $subtitle_link = get_permalink(get_option('page_for_posts'));
}
$thumb          = gutenkind_field('block-latest-thumb');

$nav            = gutenkind_field('block-latest-nav');
$sidebar        = gutenkind_field('block-latest-sidebar');
$sidebar = $sidebar ? $sidebar : 'none';

$align = $block['align'] ? 'align' . $block['align'] : '';

global $wp_query;
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

if ($orders == 'popular') {
    // Popular query
    $args = array(
        'cat' 						=> $cat,
        'posts_per_page' 			=> $posts_num,
        'posts_per_archive_page' 	=> $posts_num,
        'showposts' 				=> $posts_num,
        'post_type'					=> 'post',
        'post_status' 				=> 'publish',
        'orderby'      				=> 'meta_value_num',
        'meta_key'     				=> 'post_views_count',
        'date_query' => array(
            array(
              'column' => 'post_modified_gmt',
              'after'  => get_theme_mod('block-latest-popular', '999 month ago'),
            )
        ),
        'paged'                     => $paged,
    );

} else if ($orders == 'category') {
    // By category query
    $args = array(
        'cat' 						=> $cat,
        'posts_per_page' 			=> $posts_num,
        'posts_per_archive_page' 	=> $posts_num,
        'showposts' 				=> $posts_num,
        'post_type'					=> 'post',
        'post_status'				=> 'publish',
        //'order'					    => 'ASC',
        'orderby'					=> 'date',
        'paged'                     => $paged,
    );

} else {
    // Latest posts query
    $args = array(
        'posts_per_page' 			=> $posts_num,
        'posts_per_archive_page' 	=> $posts_num,
        'showposts' 				=> $posts_num,
        'post_type'					=> 'post',
        'post_status'				=> 'publish',
        //'order'					    => 'ASC',
        'orderby'					=> 'date',
        //'ignore_sticky_posts' 		=> 1,
        'paged'                     => $paged,
    );
}

$posts = new WP_Query( $args );
$temp_query = $wp_query;
$wp_query = $posts;
$i = 0;

$classes[] = 'voss-thumb-'.$thumb;
$classes[] = 'voss-ajax-'.$nav;
$classes[] = 'voss-sidebar-'.$sidebar;
$classes[] = $align;

$styles[] = 'style=';
$styles[] = 'margin-top:'.gutenkind_field('block-latest-mt').'px;';
$styles[] = 'margin-bottom:'.gutenkind_field('block-latest-mb').'px;';

?>

<div class="voss-posts <?php echo esc_html(implode(' ', $classes)); ?>" <?php echo esc_html(implode('', $styles)); ?>>
    <div class="voss-posts-content">

        <?php if ($title == true) { ?>
            <div class="block-title <?php echo esc_html($title_align); ?>">
                <h3><?php echo esc_html($title_text); ?></h3>
                <a class="block-link link" href="<?php echo esc_url($subtitle_link); ?>"><?php echo esc_html($subtitle_text); ?></a>
            </div>
        <?php } ?>

        <div class="voss-layout voss-layout-<?php echo esc_html($layout); ?>" data-col="<?php echo esc_attr($cols); ?>"> <?php

            if( $posts->have_posts() ) {

                while ( $posts->have_posts() ) : $posts->the_post();

                    if (is_sticky()) {
                        get_template_part('parts/content/content', 'sticky');
                    } else {
                        if (in_array($layout, array('list', 'grid', 'standard'))) {
                            get_template_part('parts/content/content', $layout);
                        } elseif( $layout == 'masonry' ) {
                            if (in_array($i, array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21))) {
                                $thumb_size = 'landscape';
                            } else {
                                $thumb_size = 'portrait';
                            } ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-post'); ?>>
                        		<?php
                                    if( has_post_thumbnail() ) { ?>
                            			<div class="post-media">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            				    <?php the_post_thumbnail($thumb_size); ?>
                                            </a>
                            			</div> <?php
                            		}
                                    get_template_part('parts/content/content', $layout);
                                ?>
                            </article><?php
                        } elseif( $layout == 'full-list' ) {
                            if( $i == 0 || $i == 4 || $i == 8 || $i == 12 || $i == 16 ) {
                                get_template_part('parts/content/content', 'sticky');
                            } else {
                                get_template_part('parts/content/content', 'list');
                            }
                        } elseif( $layout == 'list-full' ) {
                            if( $i == 2 || $i == 5 || $i == 8 || $i == 11 || $i == 14 ) {
                                get_template_part('parts/content/content', 'sticky');
                            } else {
                                get_template_part('parts/content/content', 'list');
                            }
                        } elseif( $layout == 'full-grid' ) {
                            if( $i == 0 && !is_paged() ) {
                                get_template_part('parts/content/content', 'sticky');
                            } else {
                                get_template_part('parts/content/content', 'grid');
                            }
                        }
                    }

                $i++;
                endwhile;
            } ?>

        </div>

        <?php gutenkind_pagination($nav); ?>

    </div>

    <?php if ($sidebar == 'left' || $sidebar == 'right') get_template_part('sidebar'); ?>

</div> <?php

$wp_query = $temp_query;

wp_reset_query();
wp_reset_postdata();
