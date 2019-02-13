<?php

/***** Page Title Output *****/

if (!function_exists('mh_purity_page_title')) {
	function mh_purity_page_title() {
		if (!is_front_page()) {
			echo '<header class="post-header">' . "\n";
			echo '<h1 class="entry-title">';
			if (is_archive()) {
				if (is_category() || is_tax()) {
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
					global $author;
					$user_info = get_userdata($author);
					printf(_x('Articles by %s', 'post author', 'mhp'), esc_attr($user_info->display_name));
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
					_e('Archives', 'mhp');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					_e('Page not found (404)', 'mhp');
				} elseif (is_search()) {
					printf(__('Search Results for %s', 'mhp'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
			echo '</header>' . "\n";
		}
	}
}
add_action('mh_before_page_content', 'mh_purity_page_title');

/***** Subheading on Posts *****/

if (!function_exists('mh_purity_subheading')) {
	function mh_purity_subheading() {
		global $post;
		if (get_post_meta($post->ID, "mh-subheading", true)) {
			echo '<h2 class="subheading">' . esc_attr(get_post_meta($post->ID, "mh-subheading", true)) . '</h2>' . "\n";
		}
	}
}
add_action('mh_post_header', 'mh_purity_subheading');

/***** Post Meta *****/

if (!function_exists('mh_purity_post_meta')) {
	function mh_purity_post_meta() {
		$mh_purity_options = mh_purity_theme_options();
		$post_meta = isset($mh_purity_options['post_meta']) ? !$mh_purity_options['post_meta'] : true;
		if ($post_meta) {
			echo '<p class="meta post-meta clearfix">';
				echo '<span class="updated meta-date"><i class="fa fa-calendar"></i>' . get_the_date() . '</span>';
				echo '<span class="vcard author meta-author"><span class="fn"><i class="fa fa-user"></i>';
					the_author_posts_link();
				echo '</span></span>';
				echo '<span class="meta-tags"><i class="fa fa-tag"></i>';
					the_category(', ');
				echo '</span>';
				echo '<span class="meta-comments"><i class="fa fa-comment-o"></i>';
					comments_number('0', '1', '%');
				echo '</span>' . "\n";
			echo '</p>' . "\n";
		}
	}
}
add_action('mh_post_header', 'mh_purity_post_meta');

/***** Featured Image on Posts *****/

if (!function_exists('mh_purity_featured_image')) {
	function mh_purity_featured_image() {
		global $post;
		$mh_purity_options = mh_purity_theme_options();
		if (isset($mh_purity_options['featured_image']) ? has_post_thumbnail() && !$mh_purity_options['featured_image'] && !get_post_meta($post->ID, 'mh-no-image', true) : has_post_thumbnail() && !get_post_meta($post->ID, 'mh-no-image', true)) {
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'content');
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			$attachment_page = get_attachment_link(get_post_thumbnail_id());
			echo "\n" . '<div class="post-thumbnail">' . "\n";
				echo '<a href="' . $attachment_page . '"><img src="' . $thumbnail[0] . '" alt="' . get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) . '" title="' . get_post(get_post_thumbnail_id())->post_title . '" /></a>' . "\n";
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_purity_posts_pagination')) {
	function mh_purity_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mhp'), 'previouspagelink' => __('&laquo;', 'mhp'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_purity_posts_pagination', 1);

/***** Author box *****/

if (!function_exists('mh_purity_author_box')) {
	function mh_purity_author_box($author_ID = '') {
		if (!is_attachment() && get_the_author_meta('description', $author_ID)) {
			$author_ID = get_the_author_meta('ID');
			echo '<section class="author-box">' . "\n";
				echo '<div class="author-box-wrap clearfix">' . "\n";
					echo '<div class="author-box-avatar">' . get_avatar($author_ID, 113) . '</div>' . "\n";
					echo '<h5 class="author-box-name">' . esc_html__('About ', 'mhp') . esc_attr(get_the_author_meta('display_name', $author_ID)) . '</h5>' . "\n";
					echo '<div class="author-box-desc">' . wp_kses_post(get_the_author_meta('description', $author_ID)) . '</div>' . "\n";
				echo '</div>' . "\n";
			echo '</section>' . "\n";
		}
	}
}
add_action('mh_after_post_content', 'mh_purity_author_box');

/***** Post / Image Navigation *****/

if (!function_exists('mh_purity_postnav')) {
	function mh_purity_postnav() {
		global $post;
		$mh_purity_options = mh_purity_theme_options();
		if (isset($mh_purity_options['post_nav']) && $mh_purity_options['post_nav']) {
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
			echo '<nav class="post-nav-wrap clearfix" role="navigation">' . "\n";
				echo '<div class="post-nav left">' . "\n";
					if ($attachment) {
						if ($count == 1) {
							$permalink = get_permalink($parent_post);
							echo '<a href="' . $permalink . '">' . __('&larr; Back to article', 'mhp') . '</a>';
						} else {
							previous_image_link('%link', __('&larr; Previous image', 'mhp'));
						}
					} else {
						previous_post_link('%link', __('&larr; Previous article', 'mhp'));
					}
				echo '</div>' . "\n";
				echo '<div class="post-nav post-nav-next right">' . "\n";
					if ($attachment) {
						next_image_link('%link', __('Next image &rarr;', 'mhp'));
					} else {
						next_post_link('%link', __('Next article &rarr;', 'mhp'));
					}
				echo '</div>' . "\n";
			echo '</nav>' . "\n";
		}
	}
}
add_action('mh_after_post_content', 'mh_purity_postnav');

/***** Logo / Header Image Fallback *****/

if (!function_exists('mh_purity_logo')) {
	function mh_purity_logo() {
		$header_img = get_header_image();
		$title = get_bloginfo('name');
		$desc = get_bloginfo('description');
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
		echo '<div class="logo-wrap" role="banner">' . "\n";
		if ($header_img) {
			echo '<img class="header-image" src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
		}
		if (display_header_text()) {
			$header_img ? $logo_pos = 'logo-overlay' : $logo_pos = 'logo-text';
			$text_color = get_header_textcolor();
			if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
				echo '<style type="text/css" id="mh-header-css">';
					echo '.logo-name, .logo-desc { color: #' . esc_attr($text_color) . '; }';
				echo '</style>' . "\n";
			}
			echo '<div class="logo ' . $logo_pos . '">' . "\n";
			if ($title) {
				echo '<h1 class="logo-name">' . esc_attr($title) . '</h1>' . "\n";
			}
			if ($desc) {
				echo '<h2 class="logo-desc">' . esc_attr($desc) . '</h2>' . "\n";
			}
			echo '</div>' . "\n";
		}
		echo '</div>' . "\n";
		echo '</a>' . "\n";
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_purity_trim_excerpt')) {
	function mh_purity_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$text = get_the_content('');
			$text = do_shortcode($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
			$excerpt_length = apply_filters('excerpt_length', '200');
			$excerpt_more = apply_filters('excerpt_more', ' [...]');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_purity_trim_excerpt');

if (!function_exists('mh_purity_excerpt')) {
	function mh_purity_excerpt($excerpt_length = '110') {
		global $post;
		$mh_purity_options = mh_purity_theme_options();
		$permalink = get_permalink($post->ID);
		$excerpt_more = empty($mh_purity_options['excerpt_more']) ? '[...]' : $mh_purity_options['excerpt_more'];
		$excerpt = get_the_excerpt();
		if (!has_excerpt()) {
			$excerpt = substr($excerpt, 0, intval($excerpt_length));
			$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
		}
		echo '<div class="mh-excerpt">' . wp_kses_post($excerpt) . ' <a href="' . $permalink . '" title="' . the_title_attribute('echo=0') . '">' . esc_attr($excerpt_more) . '</a></div>' . "\n";
	}
}

/***** Enable Custom Excerpts for Pages *****/

if (!function_exists('mh_purity_excerpts_pages')) {
	function mh_purity_excerpts_pages() {
		add_post_type_support('page', 'excerpt');
	}
}
add_action('init', 'mh_purity_excerpts_pages');

/***** Custom Commentlist *****/

if (!function_exists('mh_purity_comments')) {
	function mh_purity_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard clearfix">
					<?php echo get_avatar($comment->comment_author_email, 60); ?>
					<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
					<a class="comment-time meta" href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'mhp'), get_comment_date(),  get_comment_time()) ?></a><br>
					<div class="comment-reply">
					<?php if (comments_open() && $args['max_depth']!=$depth) { ?>
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
						<?php edit_comment_link(__('Edit', 'mhp'),'  ','') ?>
					</div>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info"><?php _e('Your comment is awaiting moderation.', 'mhp') ?></div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_purity_comment_fields')) {
	function mh_purity_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mhp') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mhp') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mhp') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_purity_comment_fields');

/***** Pagination *****/

if (!function_exists('mh_purity_pagination')) {
	function mh_purity_pagination() {
		global $wp_query;
	    $big = 9999;
		echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'prev_next' => true, 'prev_text' => __('&laquo;', 'mhp'), 'next_text' => __('&raquo;', 'mhp'), 'total' => $wp_query->max_num_pages));
	}
}

/***** Add CSS classes to content container *****/

if (!function_exists('mh_purity_content_css')) {
	function mh_purity_content_css() {
		$mh_purity_options = mh_purity_theme_options();
		if (isset($mh_purity_options['sb_position']) && $mh_purity_options['sb_position'] == 'left') {
			$float = 'right';
		} else {
			$float = 'left';
		}
		echo $float;
	}
}
add_action('mh_content_class', 'mh_purity_content_css');

/***** Add CSS classes to sidebar container *****/

if (!function_exists('mh_purity_sb_css')) {
	function mh_purity_sb_css($sb_pos = '') {
		$mh_purity_options = mh_purity_theme_options();
		if (isset($mh_purity_options['sb_position']) && $mh_purity_options['sb_position'] == 'left') {
			$sb_pos = 'sb-left';
		} else {
			$sb_pos = 'sb-right';
		}
		echo $sb_pos;
	}
}
add_action('mh_sb_class', 'mh_purity_sb_css');

/***** Add CSS classes to HTML tag *****/

if (!function_exists('mh_purity_html')) {
	function mh_purity_html() {
		$mh_purity_options = mh_purity_theme_options();
		isset($mh_purity_options['full_bg']) && $mh_purity_options['full_bg'] == 1 ? $fullbg = ' fullbg' : $fullbg = '';
		echo $fullbg;
	}
}
add_action('mh_html_class', 'mh_purity_html');

/***** Add Featured Image Size to Media Gallery Selection *****/

if (!function_exists('mh_purity_custom_image_size_choose')) {
	function mh_purity_custom_image_size_choose($sizes) {
		$custom_sizes = array('content' => 'Featured Image');
		return array_merge($sizes, $custom_sizes);
	}
}
add_filter('image_size_names_choose', 'mh_purity_custom_image_size_choose');

/***** Load Facebook Script (SDK) *****/

if (!function_exists('mh_purity_facebook_sdk')) {
	function mh_purity_facebook_sdk() {
		if (is_active_widget('', '', 'mh_purity_facebook_page')) {
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
add_action('wp_footer', 'mh_purity_facebook_sdk');

/***** Add Tracking Code *****/

if (!function_exists('mh_purity_trackingcode')) {
	function mh_purity_trackingcode() {
		$mh_purity_options = mh_purity_theme_options();
		if ($mh_purity_options['tracking_code']) {
			echo $mh_purity_options['tracking_code'];
		}
	}
}
add_filter('wp_footer', 'mh_purity_trackingcode');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_purity_ie_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_purity_ie_media_queries');

/***** Register Widgets *****/

function mh_purity_register_widgets() {
	register_widget('mh_purity_featured_widget');
	register_widget('mh_purity_custom_posts_widget');
	register_widget('mh_purity_slider_widget');
	register_widget('mh_purity_facebook_page');
	register_widget('mh_purity_authors_widget');
	register_widget('mh_purity_comments_widget');
	register_widget('mh_purity_youtube');
}
add_action('widgets_init', 'mh_purity_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-featured.php');
require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-slider.php');
require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-comments.php');
require_once('widgets/mh-youtube.php');

?>