<?php

/***** Page Title Output *****/

if (!function_exists('mh_elegance_page_title')) {
	function mh_elegance_page_title() {
		if (!is_front_page()) {
			echo '<div class="separator">' . "\n";
			echo '<h1 class="page-title section-title">';
			if (is_archive()) {
				if (is_category() || is_tax()) {
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
					global $author;
					$user_info = get_userdata($author);
					printf(_x('Articles by %s', 'post author', 'mh-elegance'), esc_attr($user_info->display_name));
				} elseif (is_day()) {
					echo get_the_date();
				} elseif (is_month()) {
					echo get_the_date('F Y');
				} elseif (is_year()) {
					echo get_the_date('Y');
				} elseif (is_post_type_archive()) {
					global $post;
					$post_type = get_post_type_object(get_post_type($post));
					echo $post_type->labels->name;
				} else {
					_e('Archives', 'mh-elegance');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					_e('Page not found (404)', 'mh-elegance');
				} elseif (is_search()) {
					printf(__('Search Results for %s', 'mh-elegance'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
			echo '</div>' . "\n";
		}
	}
}
add_action('mh_elegance_before_page_content', 'mh_elegance_page_title');

/***** Output Post Meta Data *****/

if (!function_exists('mh_elegance_post_meta')) {
	function mh_elegance_post_meta() {
		$mh_elegance_options = mh_elegance_theme_options();
		$post_date = !$mh_elegance_options['post_meta_date'];
		$post_author = !$mh_elegance_options['post_meta_author'];
		$post_comments = !$mh_elegance_options['post_meta_comments'];
		$post_cat = !$mh_elegance_options['post_meta_cat'];
		if ($post_date || $post_author || $post_comments || $post_cat ) {
			echo '<p class="entry-meta">' . "\n";
				if ($post_date) {
					echo sprintf(_x('Date: %s', 'post date', 'mh-elegance'), '<span class="updated">' . get_the_date() . '</span><br>') . "\n";
				}
				if ($post_author) {
					echo sprintf(_x('Author: %s', 'post author', 'mh-elegance'), '<span class="vcard author"><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span><br>') . "\n";
				}
				if ($post_comments) {
					echo __('Comments:', 'mh-elegance') . ' <span>' . sprintf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments number', 'mh-elegance'), number_format_i18n(get_comments_number())) . '</span><br>' . "\n";
				}
				if ($post_cat) {
					echo sprintf(__('Categories: %s', 'mh-elegance'), '<span>' . get_the_category_list(', ', '') . '</span>') . "\n";
				}
			echo '</p>' . "\n";
		}
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_elegance_featured_image')) {
	function mh_elegance_featured_image() {
		$mh_elegance_options = mh_elegance_theme_options();
		global $page, $post;
		if (has_post_thumbnail() && $page == '1' && $mh_elegance_options['featured_image'] == 'enable' && !get_post_meta($post->ID, 'mh-header-bg', true)) {
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<div class="entry-thumbnail">' . "\n";
				the_post_thumbnail('blog-single');
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_elegance_trim_excerpt')) {
	function mh_elegance_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$mh_elegance_options = mh_elegance_theme_options();
			$text = get_the_content('');
			$text = do_shortcode($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', esc_attr($mh_elegance_options['excerpt_length']));
			$excerpt_more = apply_filters('excerpt_more', '...');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_elegance_trim_excerpt');

/***** Pagination *****/

if (!function_exists('mh_elegance_pagination')) {
	function mh_elegance_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => __('&laquo;', 'mh-elegance'),
	    	'next_text' => __('&raquo;', 'mh-elegance'),
	    	'total' 	=> $wp_query->max_num_pages)
	    );
		if ($paginate_links) {
	    	echo '<div class="pagination clearfix">';
				echo $paginate_links;
			echo '</div>';
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_elegance_posts_pagination')) {
	function mh_elegance_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clear">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mh-elegance'), 'previouspagelink' => __('&laquo;', 'mh-elegance'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_elegance_posts_pagination', 1);

/***** Post / Image Navigation *****/

if (!function_exists('mh_elegance_postnav')) {
	function mh_elegance_postnav() {
		global $post;
		$mh_elegance_options = mh_elegance_theme_options();
		if ($mh_elegance_options['post_nav'] == 'enable') {
			$parent_post = get_post($post->post_parent);
			$attachment = is_attachment();
			$previous = ($attachment) ? $parent_post : get_adjacent_post(false, '', true);
			$next = get_adjacent_post(false, '', false);

			if (!$next && !$previous)
			return;

			if ($attachment) {
				$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
				$count = count($attachments);
			}
			echo '<nav class="post-nav-wrap" role="navigation">' . "\n";
				echo '<ul class="post-nav clearfix">' . "\n";
					if ($previous || $attachment) {
						echo '<li class="post-nav-prev">' . "\n";
							if ($attachment) {
								if ($count == 1) {
									$permalink = get_permalink($parent_post);
									echo '<a href="' . $permalink . '"><i class="fa fa-chevron-left"></i>' . __('Back to post', 'mh-elegance') . '</a>';
								} else {
									previous_image_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous image', 'mh-elegance'));
								}
							} else {
								previous_post_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous post', 'mh-elegance'));
							}
						echo '</li>' . "\n";
					}
					if ($next || $attachment) {
						echo '<li class="post-nav-next">' . "\n";
							if ($attachment) {
								next_image_link('%link', __('Next image', 'mh-elegance') . '<i class="fa fa-chevron-right"></i>');
							} else {
								next_post_link('%link', __('Next post', 'mh-elegance') . '<i class="fa fa-chevron-right"></i>');
							}
						echo '</li>' . "\n";
					}
				echo '</ul>' . "\n";
			echo '</nav>' . "\n";
		}
	}
}

/***** Custom Commentlist *****/

if (!function_exists('mh_elegance_comments')) {
	function mh_elegance_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard meta">
					<?php echo get_avatar($comment->comment_author_email, 70); ?>
					<span class="comment-author"><?php echo get_comment_author_link() ?></span> |
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'mh-elegance'), get_comment_date(),  get_comment_time()) ?></a> |
					<?php if (comments_open() && $args['max_depth']!=$depth) { ?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
					<?php edit_comment_link(__('(Edit)', 'mh-elegance'),'  ','') ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info"><?php _e('Your comment is awaiting moderation.', 'mh-elegance') ?></div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_elegance_comment_fields')) {
	function mh_elegance_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mh-elegance') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mh-elegance') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mh-elegance') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_elegance_comment_fields');

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_elegance_body_class')) {
	function mh_elegance_body_class($classes) {
		$mh_elegance_options = mh_elegance_theme_options();
		$classes[] = 'mh-' . $mh_elegance_options['sidebar'] . '-sb';
		return $classes;
	}
}
add_filter('body_class', 'mh_elegance_body_class');

/***** Logo / Header Image Fallback *****/

if (!function_exists('mh_elegance_logo')) {
	function mh_elegance_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		$header_desc = get_bloginfo('description');
		if ($header_img || display_header_text()) {
			echo '<div class="logo" role="banner">' . "\n";
				echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($header_title) . '" rel="home">' . "\n";
					if ($header_img) {
						echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
					}
					if (display_header_text()) {
						$text_color = get_header_textcolor();
						if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
							echo '<style type="text/css" id="mh-header-css">';
								echo '.logo-name, .logo-desc { color: #' . esc_attr($text_color) . '; }';
							echo '</style>' . "\n";
						}
						echo '<div class="logo-text">' . "\n";
							if ($header_title) {
								echo '<h1 class="logo-name">' . esc_attr($header_title) . '</h1>' . "\n";
							}
							if ($header_desc) {
								echo '<h2 class="logo-desc">' . esc_attr($header_desc) . '</h2>' . "\n";
							}
						echo '</div>' . "\n";
					}
				echo '</a>' . "\n";
			echo '</div>' . "\n";
		}
	}
}

/***** Social Buttons *****/

if (!function_exists('mh_elegance_socialise')) {
	function mh_elegance_socialise() {
		$mh_elegance_options = mh_elegance_theme_options();
		if ($mh_elegance_options['social_sharing'] == 'enable') {
			global $post; ?>
            <div class="mh-share-buttons row">
            	<div class="mh-col-1-4 mh-facebook">
            		<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Facebook', 'mh-elegance'); ?>"><span class="mh-share-button"><i class="fa fa-facebook fa-2x"></i><?php _e('SHARE', 'mh-elegance'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-twitter">
            		<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php _e('Tweet This Post', 'mh-elegance'); ?>"><span class="mh-share-button"><i class="fa fa-twitter fa-2x"></i><?php _e('TWEET', 'mh-elegance'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-pinterest">
            		<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-thumb'); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php _e('Pin This Post', 'mh-elegance'); ?>"><span class="mh-share-button"><i class="fa fa-pinterest fa-2x"></i><?php _e('PIN', 'mh-elegance'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-googleplus">
            		<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Google+', 'mh-elegance'); ?>" target="_blank"><span class="mh-share-button"><i class="fa fa-google-plus fa-2x"></i><?php _e('SHARE', 'mh-elegance'); ?></span></a>
            	</div>
            </div><?php
		}
	}
}

/***** Load Facebook Script (SDK) *****/

if (!function_exists('mh_elegance_facebook_sdk')) {
	function mh_elegance_facebook_sdk() {
		if (is_active_widget('', '', 'mh_elegance_facebook_page')) {
			global $locale; ?>
			<div id="fb-root"></div>
			<script>
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/<?php echo esc_attr($locale); ?>/sdk.js#xfbml=1&version=v2.9";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script> <?php
		}
	}
}
add_action('wp_footer', 'mh_elegance_facebook_sdk');

/***** Add Tracking Code to Footer *****/

if (!function_exists('mh_elegance_tracking_code')) {
	function mh_elegance_tracking_code() {
		$mh_elegance_options = mh_elegance_theme_options();
		if ($mh_elegance_options['tracking_code']) {
			echo $mh_elegance_options['tracking_code'];
		}
	}
}
add_action('wp_footer', 'mh_elegance_tracking_code');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_elegance_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_elegance_media_queries');

?>