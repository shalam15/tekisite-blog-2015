<?php

if (post_password_required()) { ?>
	<p class="no-comments"><?php echo esc_html__('This post is password protected. Enter the password to view comments.', 'mhp'); ?></p><?php
	return;
}
$comments_by_type = separate_comments($comments);
if (have_comments()) {
	if (!empty($comments_by_type['comment'])) {
		$comment_count = count($comments_by_type['comment']); ?>
		<h4 class="widget-title">
			<?php printf(_n('1 Comment', '%1$s Comments', $comment_count, 'mhp'), number_format_i18n($comment_count)); ?>
		</h4>
		<ol class="commentlist">
			<?php echo wp_list_comments('callback=mh_purity_comments&type=comment'); ?>
		</ol><?php
	}
	if (get_comments_number() > get_option('comments_per_page')) { ?>
		<div class="comments-pagination">
			<?php paginate_comments_links(array('prev_text' => esc_html__('&laquo;', 'mhp'), 'next_text' => esc_html__('&raquo;', 'mhp'))); ?>
		</div><?php
	}
	if (!empty($comments_by_type['pings'])) {
		$pings = $comments_by_type['pings'];
		$ping_count = count($comments_by_type['pings']); ?>
		<h4 class="widget-title">
			<?php printf(_n('1 Trackback / Pingback', '%1$s Trackbacks / Pingbacks', $ping_count, 'mhp'), number_format_i18n($ping_count)); ?>
		</h4>
		<ol class="pinglist">
        <?php foreach ($pings as $ping) { ?>
			<li class="pings"><i class="fa fa-link"></i><?php echo get_comment_author_link($ping); ?></li>
        <?php } ?>
        </ol><?php
	}
	if (!comments_open()) { ?>
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'mhp'); ?></p><?php
	}
}
if (comments_open()) {
	$custom_args = array(
    	'title_reply' => esc_html__('Leave a comment', 'mhp'),
        'comment_notes_before' => '<p class="comment-notes">' . esc_html__('Your email address will not be published.', 'mhp') . '</p>',
        'comment_notes_after'  => '',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'mhp') . '</label><br/><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>');
	comment_form($custom_args);
}

?>