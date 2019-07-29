<?php get_header(); ?>

    <main class="site-main">

        <div class="container">
        	<div class="voss-posts voss-sidebar-right">
        	    <div class="voss-posts-content">
        	        <div class="voss-layout voss-layout-list"> <?php
        	            if (have_posts()) {
        	                while (have_posts()) : the_post();
        						if (is_sticky()) {
        							get_template_part('parts/content/content', 'sticky');
        						} else { ?>
        							<article id="post-<?php the_ID(); ?>" <?php post_class('list-post'); ?>>
    										<?php if (has_post_thumbnail()) { ?>
    											<div class="post-media">
    												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    											    	<?php
    														gutenkind_post_icon();
    														the_post_thumbnail('portrait');
    													?>
    											    </a>
    											</div>
    										<?php } ?>
    										<div class="post-content">
    											<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
    											<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <div class="entry-meta">
    												<?php
    													if (function_exists('gutenkind_meta_author')) gutenkind_meta_author();
    													if (function_exists('gutenkind_meta_date')) gutenkind_meta_date();
    												?>
    											</div>
    											<?php gutenkind_excerpt('24'); ?>
    											<a class="post-more link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'gutenkind'); ?></a>
    										</div>
    								</article> <?php
        						}
        	                endwhile;
        	            } else {
                            get_template_part( 'parts/content/content', 'none' );
                        } ?>
        	        </div>
        	        <?php gutenkind_pagination('numeric'); ?>
        	    </div>
        	    <?php get_template_part('sidebar'); ?>
        	</div>
        </div>

    </main>

<?php get_footer();
