<?php

$ids            = gutenkind_field('block-carousel-ids');
$style          = gutenkind_field('block-carousel-style');
$style = $style ? $style : '1';

$title          = gutenkind_field('block-carousel-title');
$title_align    = gutenkind_field('block-carousel-title-align');
$title_text     = gutenkind_field('block-carousel-title-text');
$subtitle_text  = gutenkind_field('block-carousel-subtitle-text');
$subtitle_link  = get_permalink(gutenkind_field('block-carousel-subtitle-link'));

$autoplay       = gutenkind_field('block-carousel-autoplay');
$autoplay = $autoplay ? $autoplay : '0';
$autospeed      = gutenkind_field('block-carousel-autospeed');
$loop           = gutenkind_field('block-carousel-loop');
$loop = $loop ? $loop : 'false';
$nav            = gutenkind_field('block-carousel-nav');
$nav = $nav ? $nav : 'false';
$pagination     = gutenkind_field('block-carousel-pagination');
$pagination = $pagination ? $pagination : 'false';

$margin = '15';
$cols_md = '1';
$cols_xs = '1';
$post_num = '4';
if ($style == '1') {
    $cols = '4';
    $cols_md = '3';
    $cols_xs = '2';
    $margin = '15';
    $centered = 'false';
    $parallax = 'false';
    $align = 'alignwide';
    $post_num = '7';
} else if ($style == '2') {
    $cols = '1';
    $centered = 'true';
    $parallax = 'true';
    $align = 'alignwide';
} else if ($style == '3') {
    $cols = '1';
    $centered = 'true';
    $parallax = 'true';
    $align = 'alignfull';
} else if ($style == '4') {
    $cols = '1';
    $centered = 'true';
    $parallax = 'true';
    $align = 'aligncenter';
    $margin = '0';
} else if ($style == '5') {
    $cols = '1';
    $centered = 'true';
    $parallax = 'true';
    $align = 'alignwide';
    $margin = '60';
} else if ($style == '6') {
    $cols = '3';
    $centered = 'true';
    $parallax = 'false';
    $align = 'aligncenter';
    $margin = '5';
} else if ($style == '7') {
    $cols = '4';
    $cols_md = '2';
    $cols_xs = '1';
    $centered = 'false';
    $parallax = 'false';
    $align = 'alignfull';
    $margin = '0';
} else if ($style == '8') {
    $cols = '1';
    $centered = 'true';
    $parallax = 'true';
    $align = 'aligncenter';
    $margin = '0';
} else if ($style == '9') {
    $cols = '4';
    $cols_md = '2';
    $cols_xs = '1';
    $centered = 'false';
    $parallax = 'false';
    $align = 'aligncenter';
    $post_num = '7';
    $margin = '30';
} else {
    $cols = '3';
    $centered = 'true';
    $parallax = 'false';
    $align = $block['align'] ? 'align' . $block['align'] : '';
}

$attr[] = 'data-style='.esc_attr($style).'';
$attr[] = 'data-columns='.esc_attr($cols).'';
$attr[] = 'data-columns-md='.esc_attr($cols_md).'';
$attr[] = 'data-columns-xs='.esc_attr($cols_xs).'';
$attr[] = 'data-autoplay='.esc_attr($autoplay).'';
$attr[] = 'data-delay='.esc_attr($autospeed).'000';
$attr[] = 'data-loop='.esc_attr($loop).'';
$attr[] = 'data-centered='.esc_attr($centered).'';
$attr[] = 'data-pagination='.esc_attr($pagination).'';
$attr[] = 'data-dynamic-bullets="true"';
$attr[] = 'data-navigation='.esc_attr($nav).'';
$attr[] = 'data-spacebetween='.esc_attr($margin).'';
$attr[] = 'data-parallax='.esc_attr($parallax).'';
$attr[] = 'data-overlay=0.5';

if ($ids == '') {
    // Query by latest
    $args = array(
        'posts_per_page' 			=> $post_num,
        'post_type'					=> 'post',
        'post_status'				=> 'publish',
        'orderby'					=> 'date',
    );
} else {
    // Query by selected post ID's
    $args = array(
        'post_type'             => 'post',
        'post_status'			=> 'publish',
        'orderby'               => 'post__in',
        'post__in'              => $ids,
        'posts_per_page'        => $post_num,
    );
}

$posts = new WP_Query( $args );

if( $posts->have_posts() ) : ?>

        <div class="voss-slider swiper-scale-effect <?php echo esc_html($align); ?>" <?php echo implode(' ', $attr); ?>>

            <?php if ($title == true) { ?>
                <div class="block-title <?php echo esc_html($title_align); ?>">
                    <h3><?php echo esc_html($title_text); ?></h3>
                    <a class="block-link link" href="<?php echo esc_url($subtitle_link); ?>"><?php echo esc_html($subtitle_text); ?></a>
                </div>
            <?php } ?>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <div class="swiper-wrapper">
                <?php while ( $posts->have_posts() ) : $posts->the_post();

                    get_template_part( 'parts/blocks/post-slider/style', $style );

                endwhile; ?>
            </div>

            <div class="swiper-pagination"></div>

        </div>

<?php endif;

wp_reset_query();
wp_reset_postdata();
