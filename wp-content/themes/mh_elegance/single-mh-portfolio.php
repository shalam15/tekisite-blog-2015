<?php get_header(); ?>
<div class="mh-content-section">
	<div class="mh-container clearfix">
		<div id="main-content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part('content', 'portfolio'); ?>
				<?php mh_elegance_postnav(); ?>
				<div class="separator separator-margin"></div>
            <?php endwhile; endif; ?>
		</div>
        <?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>