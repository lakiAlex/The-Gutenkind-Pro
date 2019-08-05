<?php

$align = $block['align'] ? 'align' . $block['align'] : '';
$title          = gutenkind_field('block-posts-grid-title');
$style          = gutenkind_field('block-posts-grid-style');
$style = $style ? $style : '1';
$ids            = gutenkind_field('block-posts-grid-ids');

$cat_link       = gutenkind_field('block-posts-grid-cat-link');
$thumb          = gutenkind_field('block-posts-grid-thumb');
$author         = gutenkind_field('block-posts-grid-author');
$date           = gutenkind_field('block-posts-grid-date');
$comments       = gutenkind_field('block-posts-grid-comments');
$views          = gutenkind_field('block-posts-grid-views');
$read_time      = gutenkind_field('block-posts-grid-read');
$excerpt        = gutenkind_field('block-posts-grid-excerpt');
$excerpt_length = gutenkind_field('block-posts-grid-excerpt-length');
$more           = gutenkind_field('block-posts-grid-more');
$more_style     = gutenkind_field('block-posts-grid-more-style');
$more_text      = gutenkind_field('block-posts-grid-more-text');

$styles[] = 'style=';
$styles[] = 'margin-top:'.gutenkind_field('block-posts-grid-mt').'px;';
$styles[] = 'margin-bottom:'.gutenkind_field('block-posts-grid-mb').'px;';

// Query based on block style condition
$orderby = 'post__in';
if ($style == '1') {
    $posts_per_page = '6';
} else if ($style == '2') {
    $posts_per_page = '3';
} else if ($style == '3') {
    $posts_per_page = '12';
} else if ($style == '4') {
    $posts_per_page = '5';
} else if ($style == '5') {
    $posts_per_page = '3'; // tabs - accordion
} else if ($style == '6') {
    $posts_per_page = '6';
} else if ($style == '7') {
    $orderby = '';
    $posts_per_page = '1';
}

// Query
global $wp_query;
if ($ids == '') {
    // Query by latest
    $args = array(
        'posts_per_page' 			=> $posts_per_page,
        'post_type'					=> 'post',
        'post_status'				=> 'publish',
        'orderby'					=> 'date',
    );
} else {
    // Query by selected post ID's
    $args = array(
        'post_type'             => 'post',
        'post_status'			=> 'publish',
        'orderby'               => $orderby,
        'post__in'              => $ids,
        'posts_per_page'        => $posts_per_page,
    );
}
$posts = new WP_Query( $args );
$temp_query = $wp_query;
$wp_query = $posts;
$i = 0;

// Loop
if( $posts->have_posts() ) : ?>

<div class="block__post-box <?php echo esc_html($align); ?>" <?php echo esc_html(implode('', $styles)); ?> data-style="<?php echo esc_attr($style) ?>">
    <?php
        if ($title) { ?>
            <div class="block__title-sm">
                <h4><?php echo esc_html($title); ?></h4>
            </div><?php
        }
    ?>
    <div class="block__post-box-wrap">
        <div>
        <?php
            while ( $posts->have_posts() ) : $posts->the_post();

                    if ($style == '1' || $style == '2') {

                        if ($style == '1') {
                            $thumb = ($i == 0) ? 'landscape-md' : 'square';
                        } else {
                            $thumb = ($i == 0) ? 'landscape-md' : 'landscape-sm';
                        } ?>
                        <article>
                            <div class="post-media">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                   <?php the_post_thumbnail($thumb); ?>
                               </a>
                            </div>
                            <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                        </article><?php
                        if ($i == 0) { ?></div><div><?php }

                    } else if ($style == '3') {

                        if ($i == 0) { ?>
                            <article>
                                <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                                <div class="post-media" data-bg="<?php echo esc_url(gutenkind_thumb_url('single')); ?>" title="<?php echo esc_html(get_the_title()); ?>">
                                    <a class="post-image" href="<?php echo esc_url(get_permalink()); ?>"></a>
                                </div>
                            </article><?php
                            if ($i == 0) { ?></div><div><?php }
                        } else { ?>
                            <article>
                                <div class="post-media">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                       <?php the_post_thumbnail('square'); ?>
                                   </a>
                                </div>
                                <div class="post-content">
                                    <?php $cat_link = gutenkind_field('block-posts-grid-cat-link'); ?>
                                    <?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
                                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                </div>
                            </article><?php
                        }

                    } else if ($style == '4') {

                        $thumb = in_array($i, array(0, 1, 3, 4)) ? 'square' : 'single'; ?>
                        <article>
                            <div class="post-media">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        			<?php the_post_thumbnail($thumb); ?>
                        		</a>
                            </div>
                            <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                        </article><?php
                        if ($i == 1 || $i == 2) { ?></div><div><?php }

                    } else if ($style == '5') {

                        $thumb = in_array($i, array(0, 2)) ? 'square' : 'landscape-md'; ?>
                        <article>
                            <div class="post-media">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail($thumb); ?>
                                </a>
                            </div>
                            <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                        </article><?php
                        if ($i == 0 || $i == 1) { ?></div><div><?php }

                    } else if ($style == '6') {

                        $thumb = ($i == 0 || $i == 1) ? 'landscape-md' : 'landscape-sm'; ?>
                        <article>
                            <div class="post-media">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                   <?php the_post_thumbnail($thumb); ?>
                               </a>
                            </div>
                            <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                        </article><?php
                        if ($i == 1) { ?></div><div><?php }

                    } else if ($style == '7') { ?>

                        <article>
                            <?php get_template_part( 'parts/blocks/post-box/content' ); ?>
                            <div class="post-media" data-bg="<?php echo esc_url(gutenkind_thumb_url('single')); ?>" title="<?php echo esc_html(get_the_title()); ?>">
                                <a class="post-image" href="<?php echo esc_url(get_permalink()); ?>"></a>
                            </div>
                        </article><?php

                    }

                $i++;
            endwhile;
        ?>
        </div>
    </div>
</div>

<?php endif;

// Reset
$wp_query = $temp_query;

wp_reset_query();
wp_reset_postdata();
