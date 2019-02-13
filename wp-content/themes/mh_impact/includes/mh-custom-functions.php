<?php

/***** Logo/Sitename *****/

if (!function_exists('mh_impact_logo')) {
	function mh_impact_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		$header_desc = get_bloginfo('description');
		echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . "\n";
		echo '<div class="logo-wrap" role="banner">' . "\n";
		if ($header_img) {
			echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
		}
		if (display_header_text()) {
			$text_color = get_header_textcolor();
			if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
				echo '<style type="text/css" id="mh-header-css">';
					echo '.logo-title, .logo-tagline { color: #' . esc_attr($text_color) . '; }';
				echo '</style>' . "\n";
			}
			echo '<div class="logo">' . "\n";
			if ($header_title) {
				echo '<h1 class="logo-title">' . esc_attr($header_title) . '</h1>' . "\n";
			}
			if ($header_desc) {
				echo '<h2 class="logo-tagline">' . esc_attr($header_desc) . '</h2>' . "\n";
			}
			echo '</div>' . "\n";
		}
		echo '</div>' . "\n";
		echo '</a>' . "\n";
	}
}

/***** Page Title Output *****/

if (!function_exists('mh_impact_page_title')) {
	function mh_impact_page_title() {
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
					printf(_x('Articles by %s', 'post author', 'mh-impact'), esc_attr($user_info->display_name));
				} elseif (is_day()) {
					echo get_the_date();
				} elseif (is_month()) {
					echo get_the_date('F Y');
				} elseif (is_year()) {
					echo get_the_date('Y');
				} else {
					_e('Archives', 'mh-impact');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					_e('Page not found (404)', 'mh-impact');
				} elseif (is_search()) {
					printf(__('Search Results for %s', 'mh-impact'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
		}
	}
}

/***** Output Post Meta Data *****/

if (!function_exists('mh_impact_post_meta')) {
	function mh_impact_post_meta() {
		$mh_impact_options = mh_impact_theme_options();
		$post_date = !$mh_impact_options['post_meta_date'];
		$post_author = !$mh_impact_options['post_meta_author'];
		$post_cat = !$mh_impact_options['post_meta_cat'];
		if ($post_date || $post_author || $post_cat ) {
			echo '<p class="entry-meta">' . "\n";
				if ($post_date) {
					echo '<span class="entry-date updated"><i class="fa fa-calendar"></i>' . get_the_date() . '</span>' . "\n";
				}
				if ($post_author) {
					echo '<span class="vcard author"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";
				}
				if ($post_cat && 'post' == get_post_type()) {
					echo '<span class="entry-cats"><i class="fa fa-chevron-circle-right"></i>' . get_the_category_list(', ', '') . '</span>' . "\n";
				}
			echo '</p>' . "\n";
		}
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_impact_featured_image')) {
	function mh_impact_featured_image() {
		$mh_impact_options = mh_impact_theme_options();
		global $page, $post;
		if (has_post_thumbnail() && $page == '1' && $mh_impact_options['featured_image'] == 'enable') {
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<div class="entry-thumbnail">' . "\n";
				the_post_thumbnail('blog');
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_impact_trim_excerpt')) {
	function mh_impact_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$mh_impact_options = mh_impact_theme_options();
			$text = get_the_content('');
			$text = do_shortcode($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', esc_attr($mh_impact_options['excerpt_length']));
			$excerpt_more = apply_filters('excerpt_more', '');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_impact_trim_excerpt');

/***** Add Custom Read More Link to Excerpts *****/

if (!function_exists('mh_impact_custom_excerpt_more')) {
	function mh_impact_custom_excerpt_more() {
		global $post;
		$mh_impact_options = mh_impact_theme_options();
		$excerpt = get_the_excerpt();
		$permalink = get_permalink($post->ID);
		if ($mh_impact_options['excerpt_more'] != '') {
			$excerpt .= ' <a href="' . esc_url($permalink) . '" title="' . the_title_attribute('echo=0') . '">' . esc_attr($mh_impact_options['excerpt_more']) . '</a>' . "\n";
		}
		return $excerpt;
	}
}
add_filter('the_excerpt', 'mh_impact_custom_excerpt_more');

/***** Function for Custom Excerpt Lengths *****/

if (!function_exists('mh_impact_excerpt')) {
	function mh_impact_excerpt($excerpt_length) {
		$excerpt = get_the_excerpt();
		echo '<div class="mh-excerpt">' . wp_trim_words($excerpt , $excerpt_length) . '</div>' . "\n";
	}
}

/***** Pagination *****/

if (!function_exists('mh_impact_pagination')) {
	function mh_impact_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => __('&laquo;', 'mh-impact'),
	    	'next_text' => __('&raquo;', 'mh-impact'),
	    	'total' 	=> $wp_query->max_num_pages
	    ));
	    if ($paginate_links) {
	    	echo '<div class="pagination clearfix">';
				echo $paginate_links;
			echo '</div>';
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_impact_posts_pagination')) {
	function mh_impact_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clear">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mh-impact'), 'previouspagelink' => __('&laquo;', 'mh-impact'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_impact_posts_pagination', 1);

/***** Post / Image Navigation *****/

if (!function_exists('mh_impact_postnav')) {
	function mh_impact_postnav() {
		global $post;
		$mh_impact_options = mh_impact_theme_options();
		if ($mh_impact_options['post_nav'] == 'enable') {
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
									echo '<a href="' . $permalink . '"><i class="fa fa-chevron-left"></i>' . __('Back to post', 'mh-impact') . '</a>';
								} else {
									previous_image_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous image', 'mh-impact'));
								}
							} else {
								previous_post_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous post', 'mh-impact'));
							}
						echo '</li>' . "\n";
					}
					if ($next || $attachment) {
						echo '<li class="post-nav-next">' . "\n";
							if ($attachment) {
								next_image_link('%link', __('Next image', 'mh-impact') . '<i class="fa fa-chevron-right"></i>');
							} else {
								next_post_link('%link', __('Next post', 'mh-impact') . '<i class="fa fa-chevron-right"></i>');
							}
						echo '</li>' . "\n";
					}
				echo '</ul>' . "\n";
			echo '</nav>' . "\n";
		}
	}
}

/***** Custom Commentlist *****/

if (!function_exists('mh_impact_comments')) {
	function mh_impact_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">
				<div class="vcard meta">
					<?php echo get_avatar($comment->comment_author_email, 70); ?>
					<?php echo get_comment_author_link() ?> |
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'mh-impact'), get_comment_date(),  get_comment_time()) ?></a> |
					<?php if (comments_open() && $args['max_depth']!=$depth) { ?>
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
					<?php edit_comment_link(__('(Edit)', 'mh-impact'),'  ','') ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info">
						<?php _e('Your comment is awaiting moderation.', 'mh-impact') ?>
                    </div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_impact_comment_fields')) {
	function mh_impact_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mh-impact') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mh-impact') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mh-impact') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_impact_comment_fields');

/***** Socialise Buttons *****/

if (!function_exists('mh_impact_socialise')) {
	function mh_impact_socialise() {
		$mh_impact_options = mh_impact_theme_options();
		if ($mh_impact_options['social_sharing'] == 'enable') {
			global $post; ?>
            <div class="mh-share-buttons mh-row">
            	<div class="mh-col-1-4 mh-facebook">
            		<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Facebook', 'mh-impact'); ?>"><span class="mh-share-button"><i class="fa fa-facebook fa-2x"></i><?php _e('SHARE', 'mh-impact'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-twitter">
            		<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php _e('Tweet This Post', 'mh-impact'); ?>"><span class="mh-share-button"><i class="fa fa-twitter fa-2x"></i><?php _e('TWEET', 'mh-impact'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-pinterest">
            		<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-thumb'); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php _e('Pin This Post', 'mh-impact'); ?>"><span class="mh-share-button"><i class="fa fa-pinterest fa-2x"></i><?php _e('PIN', 'mh-impact'); ?></span></a>
            	</div>
            	<div class="mh-col-1-4 mh-googleplus">
            		<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Google+', 'mh-impact'); ?>" target="_blank"><span class="mh-share-button"><i class="fa fa-google-plus fa-2x"></i><?php _e('SHARE', 'mh-impact'); ?></span></a>
            	</div>
            </div><?php
		}
	}
}

/***** Load Facebook Script (SDK) *****/

if (!function_exists('mh_impact_facebook_sdk')) {
	function mh_impact_facebook_sdk() {
		if (is_active_widget('', '', 'mh_impact_facebook_page')) {
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
add_action('wp_footer', 'mh_impact_facebook_sdk');

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_impact_body_class')) {
	function mh_impact_body_class($classes) {
		$mh_impact_options = mh_impact_theme_options();
		$classes[] = 'mh-' . $mh_impact_options['sidebar'] . '-sb';
		return $classes;
	}
}
add_filter('body_class', 'mh_impact_body_class');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_impact_ie_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_impact_ie_media_queries');

?>