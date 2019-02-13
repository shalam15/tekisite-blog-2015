<?php /* Template Name: Contact */ ?>
<?php $mh_edition_options = mh_edition_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-wrapper clearfix">
    <div id="main-content" class="mh-content"><?php
    	while (have_posts()) : the_post();
			mh_before_page_content();
			mh_edition_page_title(); ?>
			<div <?php post_class(); ?>>
				<div class="entry-content clearfix">
					<?php the_content(); ?>
				</div>
			</div><?php
		endwhile; ?>
	</div>
	<?php if ($mh_edition_options['sidebar'] != 'disable') { ?>
        <aside class="mh-sidebar">
    		<?php dynamic_sidebar('mh-contact'); ?>
		</aside>
	<?php } ?>
</div>
<?php get_footer(); ?>