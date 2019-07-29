<?php

$prev_post = get_previous_post();
$next_post = get_next_post();

if ($prev_post || $next_post) { ?>

	<div class="single-nav">
		<div><?php if ($prev_post) gutenkind_single_pag($prev_post, esc_html__('Previous Reading', 'gutenkind'), 'square'); ?></div>
		<div><?php if ($next_post) gutenkind_single_pag($next_post, esc_html__('Next Reading', 'gutenkind'), 'square'); ?></div>
	</div> <?php

}
