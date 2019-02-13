<?php /* Comments Template */
if (post_password_required()) {
	return;
}
if (comments_open() || have_comments()) { ?>
	<div class="comment-section">
		<h4 class="comment-section-title"><?php comments_number(__('No Comments, Be The First!', 'mh-cicero'), __('1 Comment', 'mh-cicero'), __('% Comments', 'mh-cicero')); ?></h4> <?php
}
if (have_comments()) { ?>
	<ol class="commentlist">
		<?php echo wp_list_comments('callback=mh_cicero_comments'); ?>
	</ol>
	<?php if (get_comments_number() > get_option('comments_per_page')) { ?>
		<div class="comments-pagination content-margin">
			<?php paginate_comments_links(array('prev_text' => __('&laquo;', 'mh-cicero'), 'next_text' => __('&raquo;', 'mh-cicero'))); ?>
		</div>
	<?php } ?>
	<?php if (!comments_open()) { ?>
		<p class="no-comments"><?php _e('Comments are closed.', 'mh-cicero'); ?></p>
	<?php }
}
if (comments_open() || have_comments()) { ?>
	</div> <?php
}
if (comments_open()) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$custom_args = array(
    	'title_reply' 			=> '',
    	'title_reply_to' 		=> __('Leave a Reply to %s', 'mh-cicero'),
        'comment_notes_before' 	=> '<p class="comment-notes">' . __('Your email address will not be published.', 'mh-cicero') . '</p>',
        'comment_notes_after'  	=> '',
        'id_submit' 			=> 'comment-submit',
        'label_submit' 			=> __('Send Comment', 'mh-cicero'),
        'comment_field' 		=> '<textarea id="comment" name="comment" placeholder="' . __('Enter Message Here', 'mh-cicero') . '" class="comment-text-area" cols="45" rows="5" aria-required="true"></textarea></p>',
        'fields' 				=> apply_filters( 'comment_form_default_fields', array(
			'author'	=>	'<input type="text" id="author" name="author" placeholder="' . __('Enter Name', 'mh-cicero') . '" class="comment-name" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />',
			'email' 	=>	'<input type="text" id="email" name="email" placeholder="' . __('Enter Email', 'mh-cicero') . '" class="comment-email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />',
			'url' 		=>	'<input type="text" id="url" name="url" placeholder="' . __('Enter URL', 'mh-cicero') . '" class="comment-url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />'
		))
    );
	comment_form($custom_args);
}
?>