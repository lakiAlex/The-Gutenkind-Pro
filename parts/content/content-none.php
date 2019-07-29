<section class="no-results not-found">

    <?php if (is_search()) { ?>

        <h2><?php esc_html_e( 'Nothing Found', 'gutenkind' ); ?></h2>
        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gutenkind' ); ?></p>
        <?php get_search_form(); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="button back-home"><?php esc_html_e('Back to Homepage', 'gutenkind'); ?></a>

    <?php } else if (is_404()) { ?>

        <div class="error-404 not-found">
            <h2><?php esc_html_e('Hmm, That page can&rsquo;t be found.', 'gutenkind'); ?></h2>
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'gutenkind'); ?></p>
            <?php get_search_form(); ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button back-home"><?php esc_html_e('Back to Homepage', 'gutenkind'); ?></a>
        </div>

    <?php } else { ?>

        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gutenkind' ); ?></p>
        <?php get_search_form(); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="button back-home"><?php esc_html_e('Back to Homepage', 'gutenkind'); ?></a>

    <?php } ?>

</section>
