<article <?php post_class('single-wrap'); ?>>
    <header class="entry-header clearfix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php the_tags('<div class="entry-tags clearfix"><i class="fa fa-tags"></i>','','</div>'); ?>
    </header>
    <?php mh_impact_featured_image(); ?>
    <?php mh_impact_post_meta(); ?>
    <div class="entry-content clearfix">
        <?php the_content(); ?>
    </div>
</article>