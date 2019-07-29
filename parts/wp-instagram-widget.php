<?php
$likes         = get_theme_mod( 'footer_instagram_likes', true );
$comments      = get_theme_mod( 'footer_instagram_comments', true );
$desc   	   = get_theme_mod( 'footer_instagram_description', false );
$num	 	   = get_theme_mod( 'footer_instagram_number', 6 );
?>

	<li data-instagram-width="<?php echo esc_html($num); ?>">

		<a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>" data-img-src="<?php echo esc_url( $item[$size] ); ?>">
			
			<div class="instagram-overlay">
				<div class="instagram-meta">
					<div>
						<?php if ($likes == true) { ?>
							<span class="instagram-likes">
								<?php get_template_part('/dist/svg/svg', 'heart'); ?>
								<?php echo gutenkind_format_number( $item['likes'] ); ?>
							</span>
						<?php } ?>
						<?php if ($comments == true) { ?>
							<span class="instagram-comments">
								<?php get_template_part('/dist/svg/svg', 'comments'); ?>
								<?php echo gutenkind_format_number( $item['comments'] ); ?>
							</span>
						<?php } ?>
						<?php if ($desc == true) { ?>
							<p class="instagram-description"><?php echo esc_html( $item['description'] ); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</a>

	</li>

<?php
