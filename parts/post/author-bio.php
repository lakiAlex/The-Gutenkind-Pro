<?php

$id = get_the_author_meta('ID');
$name = get_the_author_meta('user_nicename');
$display_name = get_the_author_meta('display_name');
$desc = get_the_author_meta('user_description');

if ((bool) get_the_author_meta('description')) { ?>

	<div class="author-bio">

		<div class="author-img">
			<a href="<?php echo esc_url(get_author_posts_url($id, $name)); ?>">
				<?php if ($desc !== '') echo get_avatar($id, 130); ?>
			</a>
		</div>

		<div class="author-info">

			<span class="author-subheading"><?php esc_html_e('Published by', 'gutenkind' ); ?></span>
			<h4 class="author-name">
				<a class="author-link" href="<?php echo esc_url(get_author_posts_url($id, $name)); ?>">
					<?php echo esc_html($display_name); ?>
				</a>
			</h4>
			<p><?php echo esc_html($desc); ?></p>
			<div class="author-social"></div>

		</div>

	</div><?php

}
