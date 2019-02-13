<?php

/***** Add CSS classes to HTML tag *****/

if (!function_exists('mh_html')) {
	function mh_html() {
		$options = mh_theme_options();
		$sidebars = ' mh-' . $options['sidebar'] . '-sb';
		$options['full_bg'] == 1 ? $fullbg = ' fullbg' : $fullbg = '';
		echo $sidebars . $fullbg;
	}
}
add_action('mh_html_class', 'mh_html');

/***** Page Title Output *****/

if (!function_exists('mh_page_title')) {
	function mh_page_title() {
		if (!is_front_page()) {
			echo '<h1 class="page-title">';
			if (is_archive()) {
				if (is_category() || is_tax()) {
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
					global $author;
					$user_info = get_userdata($author);
					printf(_x('Articles by %s', 'post author', 'mhc'), esc_attr($user_info->display_name));
				} elseif (is_day()) {
					echo get_the_date();
				} elseif (is_month()) {
					echo get_the_date('F Y');
				} elseif (is_year()) {
					echo get_the_date('Y');
				} else {
					_e('Archives', 'mhc');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					_e('Page not found (404)', 'mhc');
				} elseif (is_search()) {
					printf(__('Search Results for %s', 'mhc'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
		}
	}
}
add_action('mh_before_page_content', 'mh_page_title');

/***** Logo / Header Image Fallback *****/

if (!function_exists('mh_logo')) {
	function mh_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		$header_desc = get_bloginfo('description');
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($header_title) . '" rel="home">' . "\n";
		echo '<div class="logo-wrap" role="banner">' . "\n";
		if ($header_img) {
			echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
		}
		if (display_header_text()) {
			$header_img ? $logo_pos = 'logo-overlay' : $logo_pos = 'logo-text';
			$text_color = get_header_textcolor();
			if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
				echo '<style type="text/css" id="mh-header-css">';
					echo '.logo-name, .logo-desc { color: #' . esc_attr($text_color) . '; }';
					echo '.logo-name { border-bottom: 3px solid #' . esc_attr($text_color) . '; }';
				echo '</style>' . "\n";
			}
			echo '<div class="logo ' . $logo_pos . '">' . "\n";
			if ($header_title) {
				echo '<h1 class="logo-name">' . esc_attr($header_title) . '</h1>' . "\n";
			}
			if ($header_desc) {
				echo '<h2 class="logo-desc">' . esc_attr($header_desc) . '</h2>' . "\n";
			}
			echo '</div>' . "\n";
		}
		echo '</div>' . "\n";
		echo '</a>' . "\n";
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_trim_excerpt')) {
	function mh_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$text = get_the_content('');
			$text = do_shortcode($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', '200');
			$excerpt_more = apply_filters('excerpt_more', ' [...]');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_trim_excerpt');

if (!function_exists('mh_excerpt')) {
	function mh_excerpt($excerpt_length = '175') {
		global $post;
		$options = mh_theme_options();
		$permalink = get_permalink($post->ID);
		$excerpt = get_the_excerpt();
		if (!has_excerpt()) {
			$excerpt = substr($excerpt, 0, intval($excerpt_length));
			$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
		}
		echo '<div class="mh-excerpt">' . wp_kses_post($excerpt) . ' <a href="' . $permalink . '" title="' . the_title_attribute('echo=0') . '">' . esc_attr($options['excerpt_more']) . '</a></div>' . "\n";
	}
}

/***** Post Meta *****/

if (!function_exists('mh_post_meta')) {
	function mh_post_meta() {
		$options = mh_theme_options();
		$post_date = !$options['post_meta_date'];
		$post_author = !$options['post_meta_author'];
		$post_cat = !$options['post_meta_cat'];
		$post_comments = !$options['post_meta_comments'];
		if ($post_date || $post_author || $post_cat || $post_comments) {
			echo '<p class="meta post-meta">';
				if ($post_date || $post_author || $post_cat) {
					$post_date ? $date = sprintf(_x('on %s', 'post date', 'mhc'), '<span class="updated">' . get_the_date() . '</span> ') : $date = '';
					$post_author ? $byline = sprintf(_x('by %s', 'post author', 'mhc'), '<span class="vcard author"><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span> ') : $byline = '';
					$post_cat ? $category = sprintf(_x('in %s', 'post category', 'mhc'), get_the_category_list(', ', '')) : $category = '';
					printf(_x('Posted %1$s %2$s %3$s', 'post meta', 'mhc'), $date, $byline, $category);
					if ($post_comments) {
						echo ' | ';
					}
				}
				if ($post_comments) {
					mh_comment_count();
				}
			echo '</p>' . "\n";
		}
	}
}
add_action('mh_post_header', 'mh_post_meta');

/***** Post Meta (Loop) *****/

if (!function_exists('mh_loop_meta')) {
	function mh_loop_meta() {
		$options = mh_theme_options();
		$post_date = !$options['post_meta_date'];
		$post_comments = !$options['post_meta_comments'];
		if ($post_date || $post_comments) {
			echo '<p class="meta">';
			if ($post_date) {
				echo get_the_date();
			}
			if ($post_date && $post_comments) {
				echo ' | ';
			}
			if ($post_comments) {
				mh_comment_count();
			}
			echo '</p>' . "\n";
		}
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_featured_image')) {
	function mh_featured_image() {
		global $page, $post;
		$options = mh_theme_options();
		if (has_post_thumbnail() && $page == '1' && $options['featured_image'] == 'enable' && !get_post_meta($post->ID, 'mh-no-image', true)) {
			if ($options['sidebar'] == 'disable') {
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider');
			} else {
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'content');
			}
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<div class="post-thumbnail">' . "\n";
				echo '<img src="' . $thumbnail[0] . '" alt="' . esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) . '" title="' . esc_attr(get_post(get_post_thumbnail_id())->post_title) . '" />' . "\n";
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}
add_action('mh_post_content_top', 'mh_featured_image');

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_posts_pagination')) {
	function mh_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clearfix">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mhc'), 'previouspagelink' => __('&laquo;', 'mhc'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_posts_pagination', 1);

/***** Author Box *****/

if (!function_exists('mh_author_box')) {
	function mh_author_box($author_ID = '') {
		$options = mh_theme_options();
		if ($options['author_box'] == 'enable' && get_the_author_meta('description', $author_ID) && !is_attachment()) {
			$author_ID = get_the_author_meta('ID');
			echo '<section class="author-box clearfix">' . "\n";
				echo '<div class="author-box-avatar">' . get_avatar($author_ID, 115) . '</div>' . "\n";
				echo '<div class="author-box-desc">' . "\n";
					echo '<h5 class="author-box-name">' . sprintf(esc_html__('About %s', 'mhc'), esc_attr(get_the_author_meta('display_name', $author_ID))) . '</h5>' . "\n";
					echo '<p>' . wp_kses_post(get_the_author_meta('description', $author_ID)) . '</p>' . "\n";
				echo '</div>' . "\n";
			echo '</section>' . "\n";
		}
	}
}
add_action('mh_after_post_content', 'mh_author_box');

/***** Post / Image Navigation *****/

if (!function_exists('mh_postnav')) {
	function mh_postnav() {
		global $post;
		$options = mh_theme_options();
		if ($options['post_nav'] == 'enable') {
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
			if ($attachment && $count == 1) {
				$permalink = get_permalink($parent_post);
				echo '<nav class="post-navigation clearfix" role="navigation">' . "\n";
				echo '<div class="post-nav left">' . "\n";
				echo '<a href="' . $permalink . '">' . __('&larr; Back to post', 'mhc') . '</a>';
				echo '</div>' . "\n";
				echo '</nav>' . "\n";
			} elseif (!$attachment || $attachment && $count > 1) {
				echo '<nav class="post-navigation clearfix" role="navigation">' . "\n";
				echo '<div class="post-nav left">' . "\n";
				if ($attachment) {
					previous_image_link('%link', __('&larr; Previous image', 'mhc'));
				} else {
					previous_post_link('%link', __('&larr; Previous post', 'mhc'));
				}
				echo '</div>' . "\n";
				echo '<div class="post-nav right">' . "\n";
				if ($attachment) {
					next_image_link('%link', __('Next image &rarr;', 'mhc'));
				} else {
					next_post_link('%link', __('Next post &rarr;', 'mhc'));
				}
				echo '</div>' . "\n";
				echo '</nav>' . "\n";
			}
		}
	}
}
add_action('mh_after_post_content', 'mh_postnav');

/***** Related Posts *****/

if (!function_exists('mh_related_posts')) {
	function mh_related_posts() {
		global $post;
		$options = mh_theme_options();
		$tags = wp_get_post_tags($post->ID);
		if ($options['related_posts'] == 'enable' && $tags) {
			$tag_ids = array();
			foreach($tags as $tag) $tag_ids[] = $tag->term_id;
			$args = array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page' => 5, 'ignore_sticky_posts' => 1, 'orderby' => 'rand');
			$related = new wp_query($args);
			if ($related->have_posts()) {
				echo '<section class="related-posts">' . "\n";
				echo '<h3 class="section-title">' . __('Related Posts', 'mhc') . '</h3>' . "\n";
				echo '<ul class="related-wrap round-corners">' . "\n";
				while ($related->have_posts()) : $related->the_post();
					$permalink = get_permalink($post->ID);
					echo '<li class="related-item clearfix">' . "\n";
					echo '<div class="related-thumb">' . "\n";
					echo '<a href="' . $permalink . '" title="' . get_the_title() . '">';
					if (has_post_thumbnail()) {
						the_post_thumbnail('cp_small');
					} else {
						echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage_70x53.png' . '" alt="No Picture" />';
					}
					echo '</a>' . "\n";
					echo '</div>' . "\n";
					echo '<div class="related-data">' . "\n";
					echo '<a href="' . $permalink . '"><h4 class="related-title">' . get_the_title() . '</h4></a>' . "\n";
					echo '<span class="related-subheading">' . esc_attr(get_post_meta($post->ID, "mh-subheading", true)) . '</span>' . "\n";
					echo '</div>' . "\n";
					echo '</li>' . "\n";
				endwhile;
				echo '</ul>' . "\n";
				echo '</section>' . "\n";
				wp_reset_postdata();
			}
		}
	}
}
add_action('mh_after_post_content', 'mh_related_posts');

/***** Enable Custom Excerpts for Pages *****/

if (!function_exists('mh_excerpts_pages')) {
	function mh_excerpts_pages() {
		add_post_type_support('page', 'excerpt');
	}
}
add_action('init', 'mh_excerpts_pages');

/***** Custom Commentlist *****/

if (!function_exists('mh_comments')) {
	function mh_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard meta">
					<?php echo get_avatar($comment->comment_author_email, 30); ?>
					<?php echo get_comment_author_link() ?> //
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'mhc'), get_comment_date(),  get_comment_time()) ?></a> //
					<?php if (comments_open() && $args['max_depth']!=$depth) { ?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
					<?php edit_comment_link(__('(Edit)', 'mhc'),'  ','') ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info"><?php _e('Your comment is awaiting moderation.', 'mhc') ?></div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_comment_fields')) {
	function mh_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mhc') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mhc') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mhc') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_comment_fields');

/***** Comment Count Output *****/

if (!function_exists('mh_comment_count')) {
	function mh_comment_count() {
		printf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments number', 'mhc'), number_format_i18n(get_comments_number()));
	}
}

/***** Pagination *****/

if (!function_exists('mh_pagination')) {
	function mh_pagination() {
		global $wp_query;
	    $big = 9999;
		echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'prev_next' => true, 'prev_text' => __('&laquo;', 'mhc'), 'next_text' => __('&raquo;', 'mhc'), 'total' => $wp_query->max_num_pages));
	}
}

/***** Fix links of carousel widget to work on mobile devices *****/

if (!function_exists('mh_carousel_fix')) {
	function mh_carousel_fix() {
		if (wp_is_mobile() && is_active_widget('', '', 'mh_carousel_hp')) {
			echo '<style type="text/css">.flex-direction-nav { display: none; }</style>';
		}
	}
}
add_action('wp_head', 'mh_carousel_fix');

/***** Add CSS classes to content container *****/

if (!function_exists('mh_content_css')) {
	function mh_content_css() {
		$options = mh_theme_options();
		if ($options['sb_position'] == 'left') {
			$float = 'right';
		} else {
			$float = 'left';
		}
		echo $float;
	}
}
add_action('mh_content_class', 'mh_content_css');

/***** Add CSS classes to sidebar container *****/

if (!function_exists('mh_sb_css')) {
	function mh_sb_css($sb_pos = '', $float = '') {
		$options = mh_theme_options();
		if ($options['sb_position'] == 'left') {
			$sb_pos = 'sb-left';
		} else {
			$sb_pos = 'sb-right';
		}
		echo $sb_pos;
	}
}
add_action('mh_sb_class', 'mh_sb_css');

/***** Add Tracking Code *****/

if (!function_exists('mh_add_trackingcode')) {
	function mh_add_trackingcode() {
		$options = mh_theme_options();
		if ($options['tracking_code']) {
			echo $options['tracking_code'];
		}
	}
}
add_filter('wp_footer', 'mh_add_trackingcode');

/***** Add Featured Image Size to Media Gallery Selection *****/

if (!function_exists('mh_custom_image_size_choose')) {
	function mh_custom_image_size_choose($sizes) {
		$options = mh_theme_options();
		if ($options['sidebar'] == 'disable') {
			$custom_sizes = array('slider' => 'Featured Image (large)', 'content' => 'Featured Image (normal)');
		} else {
			$custom_sizes = array('content' => 'Featured Image');
		}
		return array_merge($sizes, $custom_sizes);
	}
}
add_filter('image_size_names_choose', 'mh_custom_image_size_choose');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_corporate_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_corporate_media_queries');

?>