<div class="mh-share-buttons mh-row">
	<a class="mh-col-1-4 mh-facebook" href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Facebook', 'mh-edition'); ?>">
		<span class="mh-share-button"><i class="fa fa-facebook fa-2x"></i></span>
	</a>
	<a class="mh-col-1-4 mh-twitter" href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink(); ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php _e('Tweet This Post', 'mh-edition'); ?>">
		<span class="mh-share-button"><i class="fa fa-twitter fa-2x"></i></span>
	</a>
	<a class="mh-col-1-4 mh-pinterest" href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-thumb'); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php _e('Pin This Post', 'mh-edition'); ?>">
		<span class="mh-share-button"><i class="fa fa-pinterest fa-2x"></i></span>
	</a>
	<a class="mh-col-1-4 mh-googleplus" href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink(); ?>', 'googleShare', 'width=626,height=436'); return false;" title="<?php _e('Share on Google+', 'mh-edition'); ?>" target="_blank">
		<span class="mh-share-button"><i class="fa fa-google-plus fa-2x"></i></span>
	</a>
</div>