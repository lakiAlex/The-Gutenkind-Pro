<?php

$layout         = get_theme_mod('archive-page-layout', 'masonry');
$sidebar 		= get_theme_mod('archive-page-sidebar', 'none');
$nav 			= get_theme_mod('archive-page-nav', 'load');

$featured 		= get_theme_mod('archive-page-featured', true);
$thumb 			= get_theme_mod('archive-page-thumb', true);
$cat_link 		= get_theme_mod('archive-page-cat-link', true);
$author 		= get_theme_mod('archive-page-author', false);
$date 			= get_theme_mod('archive-page-date', false);
$views 			= get_theme_mod('archive-page-views', false);
$read_time 		= get_theme_mod('archive-page-read', false);
$comments 		= get_theme_mod('archive-page-comments', false);
$excerpt 		= get_theme_mod('archive-page-excerpt', true);
$excerpt_length = get_theme_mod('archive-page-excerpt-length', '5');
$more 			= get_theme_mod('archive-page-more', true);
$more_style 	= get_theme_mod('archive-page-more-style', 'link');
$more_text 		= get_theme_mod('archive-page-more-text', esc_html__('Read More', 'gutenkind'));

$classes[] = 'voss-ajax-'.$nav;
$classes[] = 'voss-sidebar-'.$sidebar;

$i = 0;

?>

<div class="container">

	<?php
		if (is_archive()) {
			get_template_part('parts/archive/archive', 'header');
			if (is_author()) get_template_part('parts/post/post', 'author');
			if ($featured == true) get_template_part('parts/archive/archive', 'featured');
		}
	?>

	<div class="voss-posts <?php echo esc_html(implode(' ', $classes)); ?>">
	    <div class="voss-posts-content">
	        <div class="voss-layout voss-layout-<?php echo esc_html($layout); ?>" <?php if ($layout == 'masonry') { ?>data-col="3"<?php } ?>> <?php

	            if (have_posts()) {

	                while (have_posts()) : the_post();

						if (is_sticky()) {
							get_template_part('parts/content/content', 'sticky');
						} else {
							if ($layout == 'list') { ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('list-post'); ?>>

										<?php if (has_post_thumbnail() && $thumb == true) { ?>
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

											<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>

											<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

											<div class="entry-meta">
												<?php
													if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
													if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
													if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
													if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
													if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
												?>
											</div>

											<?php
												if ($excerpt == true) gutenkind_excerpt($excerpt_length);
												if ($more == true) { ?>
													<a class="post-more <?php echo esc_html($more_style); ?>" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($more_text); ?></a><?php
												}
											?>

										</div>

								</article> <?php

							} else if ($layout == 'grid') { ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('grid-post'); ?>>

									<?php if (has_post_thumbnail() && $thumb == true) { ?>
										<div class="post-media">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										    	<?php
													gutenkind_post_icon();
													the_post_thumbnail('landscape');
												?>
										    </a>
										</div>
									<?php } ?>

									<div class="post-content">

										<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>

										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

										<div class="entry-meta">
											<?php
												if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
												if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
												if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
												if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
												if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
											?>
										</div>

										<?php
											if ($excerpt == true) gutenkind_excerpt($excerpt_length);
											if ($more == true) { ?>
												<a class="post-more <?php echo esc_html($more_style); ?>" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($more_text); ?></a><?php
											}
										?>

									</div>

								</article><?php

							} else if ($layout == 'masonry') { ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-post grid-post'); ?>>
		                    		<?php
										if (in_array($i, array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21))) {
				                            $thumb_size = 'landscape';
				                        } else {
				                            $thumb_size = 'portrait';
				                        }
		                                if (has_post_thumbnail() && $thumb == true) { ?>
		                        			<div class="post-media">
		                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		                        				    <?php
														gutenkind_post_icon();
														the_post_thumbnail($thumb_size, array('alt' => get_the_title()));
													?>
		                                        </a>
		                        			</div> <?php
		                        		}
		                            ?>
									<div class="post-content">

										<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>

										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

										<div class="entry-meta">
											<?php
												if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
												if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
												if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
												if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
												if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
											?>
										</div>

										<?php
											if ($excerpt == true) gutenkind_excerpt($excerpt_length);
											if ($more == true) { ?>
												<a class="post-more <?php echo esc_html($more_style); ?>" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($more_text); ?></a><?php
											}
										?>

									</div>
		                        </article><?php

							} else if ($layout == 'standard') { ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('standard-post'); ?>>

									<div class="post-content">

										<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>

										<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

										<div class="entry-meta">
											<?php
												if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
												if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
												if (function_exists('vossen_meta_views') && $views == true) vossen_meta_views();
												if (function_exists('vossen_meta_read') && $read_time == true) vossen_meta_read();
												if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
											?>
										</div>

									</div>

									<?php if (has_post_thumbnail() && $thumb == true) { ?>
										<div class="post-media">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php
													gutenkind_post_icon();
													the_post_thumbnail('single');
												?>
											</a>
										</div>
									<?php } ?>

									<div class="post-content">
										<?php
											if ($excerpt == true) gutenkind_excerpt($excerpt_length);
											if (function_exists('vossen_social_share')) vossen_social_share();
											if ($more == true) { ?>
												<div class="post-more-wrap">
													<a class="post-more <?php echo esc_html($more_style); ?>" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($more_text); ?></a>
												</div><?php
											}
										?>
									</div>

								</article><?php

							}
						}

					$i++;
	                endwhile;
	            } else {
                    get_template_part( 'parts/content/content', 'none' );
                } ?>

	        </div>

	        <?php gutenkind_pagination($nav); ?>

	    </div>

	    <?php if ($sidebar == 'left' || $sidebar == 'right') get_template_part('sidebar'); ?>

	</div>

</div> <?php
