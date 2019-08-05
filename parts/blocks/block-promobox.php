<?php

$styles[] = 'style=';
$styles[] = 'background-image:url('.gutenkind_field('promobox-bg').');';
$url = gutenkind_field('promobox-link');
$target = gutenkind_field('promobox-target');
$heading = gutenkind_field('promobox-heading');
$subheading = gutenkind_field('promobox-subheading');

?>

<div class="block__promobox" <?php echo esc_html(implode('', $styles)); ?>>
    <a href="<?php echo esc_url($url); ?>" <?php if ($target == true) { ?>target="_blank"<?php } ?>>
        <div class="block__promobox-inner">
            <p class="link"><?php echo esc_html($subheading); ?></p>
            <h4><?php echo esc_html($heading); ?></h4>
        </div>
    </a>
</div>
