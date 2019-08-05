<?php

$related = gutenkind_related_posts( get_the_ID(), 7 );

if( $related->have_posts() ) : ?>
	<div class="single-related">
		<h4 class="section-title"><?php esc_html_e( 'Related Stories', 'gutenkind' ); ?></h4>

		<div class="vslider"
			data-style="9"
			data-columns="3"
			data-columns-md="3"
			data-columns-xs="2"
			data-autoplay="false"
			data-delay="8000"
			data-loop="false"
			data-centered="false"
			data-pagination="1"
			data-dynamic-bullets="false"
			data-navigation="false"
			data-spacebetween="30"
	   >
			<div class="swiper-wrapper">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>

					<div class="swiper-slide voss-slide">

						<?php if (has_post_thumbnail()) { ?>
							<div class="post-media">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('portrait'); ?>
								</a>
							</div>

							<div class="voss-slide-container">
								<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
								<h4 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
							</div>
						<?php } ?>

					</div>

				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="swiper-pagination swiper-pag-outside-alt"></div>
			<!-- Navigation -->
			<div class="swiper-button-prev"><i class="ion-ios-arrow-left"></i></div>
			<div class="swiper-button-next"><i class="ion-ios-arrow-right"></i></div>

		</div>

	</div>
<?php endif; ?>

	<?php

	wp_reset_postdata();

?>
