<?php

if (post_password_required()) {
	return;
}

$discussion = gutenkind_get_discussion_data();

?>

<div class="comments-show-btn">
	<button class="btn has-background <?php if (have_comments()) echo esc_html('active'); ?>">
		<span class="on"><?php esc_html_e('Show Comments +', 'gutenkind'); ?></span>
		<span class="off"><?php esc_html_e('Hide Comments -', 'gutenkind'); ?></span>
	</button>
</div>

<div id="comments" class="comments-area <?php if (have_comments()) echo esc_html('--has-comments'); ?>">

	<div class="comments-title-wrap">
		<h4 class="comments-title single-section-title">
		<?php
			if (comments_open()) {
				if (have_comments()) {
					esc_html_e( 'Join the Discussion', 'gutenkind' );
				} else {
					esc_html_e( 'Leave a Comment', 'gutenkind' );
				}
			} else {
				esc_html_e('Comments are closed', 'gutenkind');
			}
		?>
		</h4><!-- .comments-title -->
		<?php
			if (have_comments() && comments_open()) {
				if ($discussion->responses > 0) {
					$meta_label = sprintf(_n( '%d Response', '%d Responses', $discussion->responses, 'gutenkind' ), $discussion->responses);
				} else {
					$meta_label = __('No Comments', 'gutenkind');
				} ?>
				<div class="discussion-meta">
					<?php if ($discussion->responses > 0) gutenkind_discussion_avatars_list($discussion->authors); ?>
					<p class="discussion-meta-info">
						<span><?php echo esc_html($meta_label); ?></span>
					</p>
				</div> <?php
			}
		?>
	</div>

    <?php if (have_comments()) { ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 80,
					'style'       => 'ol',
					'max_depth'   => 4,
					'short_ping'  => true,
				) );
			?>
		</ol>

        <?php the_comments_pagination();

    }

	$args = array(
        'title_reply' => '',
    );
    comment_form($args); ?>

</div>
