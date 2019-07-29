<?php

$page_header	= get_theme_mod('page-header', true);
$title			= get_theme_mod('page-header-title', true);

if (is_page() && !is_front_page() && !is_404() && $page_header == true) { ?>
	<div class="page-header-full">
		<div class="page-header" data-bg="<?php echo esc_url(gutenkind_thumb_url('fullscreen')); ?>">
			<?php if ($title == true) { ?>
				<h2 class="page-title"><?php the_title(); ?></h2>
			<?php } ?>
		</div>
	</div> <?php
}
