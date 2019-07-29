<?php get_header(); ?>

<main class="site-main">
    <div class="container">

        <?php
            get_template_part('parts/archive/archive', 'header');

            if (have_posts()) { ?>
                <div class="voss-posts voss-cat-1 voss-thumb-1 voss-author- voss-date- voss-comments- voss-views- voss-read-time- voss-excerpt-1 voss-more-1 voss-more-style-link voss-ajax-links">
                    <div class="voss-posts-content">
                        <div class="voss-layout voss-layout-list">

                            <?php while (have_posts()) : the_post(); ?>
                                    <div class="archive-featured">
                                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <div class="post-media">
                                                <a class="post-image" href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'landscape-md', array( 'alt' => get_the_title() ) ); ?>
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
                                                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <?php gutenkind_excerpt(25); ?>
                                                <a class="post-more link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'gutenkind'); ?></a>
                                            </div>
                                        </article>
                                    </div>
                            <?php endwhile; ?>

                        </div>

                        <?php gutenkind_pagination('numeric'); ?>

                    </div>
                </div> <?php
            } else {
                get_template_part( 'parts/content/content', 'none' );
            }
        ?>

    </div>
</main>

<?php get_footer();
