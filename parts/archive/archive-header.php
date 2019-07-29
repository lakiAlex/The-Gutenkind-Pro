<div class="archive-page-header">

	<?php
		if (get_theme_mod( 'archive-page-subtitle', true ) == true) { ?>
			<span class="archive-subtitle"> <?php
				if (is_category()) {
					//esc_html_e('Category Archives', 'gutenkind');
				} else if (is_tag()) {
					esc_html_e('Tag Archives', 'gutenkind');
				} else if (is_author()) {
					esc_html_e('Author Archives', 'gutenkind');
				} else if (is_search()) {
					esc_html_e('Search results for', 'gutenkind');
				} else if (is_day()) {
					esc_html_e('Daily Archives', 'gutenkind');
				} else if (is_month()) {
					esc_html_e('Montly Archives', 'gutenkind');
				} else if (is_year()) {
					esc_html_e('Yearly Archives', 'gutenkind');
				} else if (is_post_type_archive()) {
					esc_html_e('Post Type Archives', 'gutenkind');
				} else if (is_tax()) {
					$tax = get_taxonomy( get_queried_object()->taxonomy );
					echo sprintf( esc_html__( '%s Archives:', 'gutenkind' ), $tax->labels->singular_name );
				} ?>
			</span> <?php
		}
	?>

	<?php if(get_theme_mod( 'archive-page-title', true ) == true) { ?>
		<h2 class="archive-title"> <?php
			if (is_category()) {
				single_cat_title();
			} else if (is_tag()) {
				single_tag_title();
			} else if (is_author()) {
				the_author_meta('display_name');
			} else if (is_search()) {
				echo get_search_query();
			} else if (is_day()) {
				echo get_the_date();
			} else if (is_month()) {
				echo get_the_date('F Y');
			} else if (is_year()) {
				echo get_the_date('Y');
			} else {
				esc_html_e( 'Archives', 'gutenkind' );
			} ?>
		</h2>
	<?php } ?>

	<?php if (is_category() && get_theme_mod('archive-page-cat-list', true) == true) { ?>
		<div class="category-cat-list"> <?php
				$count = count( get_categories( array(
					'parent' => 0,
					'hide_empty' => 0
				)));
				if ($count > 1 ) {
					$current = get_category( get_query_var('cat') );
					$current_id = $current->term_id; ?>
					<ul class="list-categories">
						<?php
							wp_list_categories( array(
								'echo' => true,
								'current_category' => $current_id,
								'title_li' => ''
							));
						?>
					</ul> <?php
				}
				if (category_description()) { ?>
					<div class="category-description">
						<?php echo category_description(); ?>
					</div> <?php
				} ?>
		</div>
	<?php } ?>

</div>
