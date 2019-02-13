<li class="ticker-item">
    <div class="ticker-item-thumb">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
	        if (has_post_thumbnail()) {
		        the_post_thumbnail('mh-joystick-thumb');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-thumb.png' . '" alt="No Image" />';
			} ?>
		</a>
    </div>
    <h5 class="ticker-item-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_title(); ?>
        </a>
        <span class="ticker-item-date">
			<?php echo get_the_date(); ?>
		</span>
    </h5>
</li>