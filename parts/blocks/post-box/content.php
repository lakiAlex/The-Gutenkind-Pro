<?php

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
$more_text      = gutenkind_field('block-posts-grid-more-text');

?>

<div class="post-content">
    <?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php if (in_array(true, array($author, $date, $views, $read_time, $comments))) { ?>
        <div class="entry-meta">
            <?php
                if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
                if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
                if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
                if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
                if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
            ?>
        </div>
    <?php } ?>
    <?php
        if ($excerpt == true) gutenkind_excerpt($excerpt_length);
        if ($more == true) { ?>
            <a class="post-more link" href="<?php the_permalink(); ?>"><?php echo esc_html($more_text); ?></a><?php
        }
    ?>
</div>
