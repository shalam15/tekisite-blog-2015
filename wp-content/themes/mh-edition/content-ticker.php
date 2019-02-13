<?php /* News Ticker */
$mh_edition_options = mh_edition_theme_options();
$args = array('posts_per_page' => $mh_edition_options['ticker_posts'], 'cat' => $mh_edition_options['ticker_cats'], 'tag' => $mh_edition_options['ticker_tags'], 'offset' => $mh_edition_options['ticker_offset'], 'ignore_sticky_posts' => $mh_edition_options['ticker_sticky']);
$ticker_loop = new WP_Query($args);	?>
<div class="mh-news-ticker">
	<?php if ($mh_edition_options['ticker_title']) { ?>
		<div class="mh-ticker-title">
			<?php echo esc_attr($mh_edition_options['ticker_title']) . '<i class="fa fa-chevron-right"></i>'; ?>
		</div>
	<?php } ?>
	<div class="mh-ticker-content">
		<ul id="mh-ticker-loop"><?php
			while ($ticker_loop->have_posts()) : $ticker_loop->the_post(); ?>
				<li class="mh-ticker-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<span class="mh-ticker-item-date">
                        	<?php echo '[ ' . get_the_date() . ' ]'; ?>
                        </span>
						<span class="mh-ticker-item-title">
							<?php the_title(); ?>
						</span>
						<span class="mh-ticker-item-cat">
							<?php $category = get_the_category(); ?>
							<?php echo esc_attr($category[0]->cat_name); ?>
						</span>
					</a>
				</li><?php
			endwhile;
			wp_reset_postdata(); ?>
		</ul>
	</div>
</div>