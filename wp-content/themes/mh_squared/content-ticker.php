<li class="ticker-item">
    <h5 class="ticker-item-title">
    	<span class="ticker-item-date">
    		<?php echo get_the_date(); ?>
    	</span>
        <a class="ticker-item-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        	<?php the_title(); ?>
        </a>
    </h5>
</li>