<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
<div class="wrapper hp clearfix">
	<?php dynamic_sidebar('home-1'); ?>
	<?php if (is_active_sidebar('home-2') || is_active_sidebar('home-3')) : ?>
	<div class="home-wrap clearfix">
		<?php if (is_active_sidebar('home-2')) { ?>
			<div class="content <?php mh_content_class(); ?>">
			    <?php dynamic_sidebar('home-2'); ?>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar('home-3')) { ?>
		    <div class="hp-sidebar <?php mh_sb_class(); ?>">
			    <?php dynamic_sidebar('home-3'); ?>
			</div>
		<?php } ?>
	</div>
	<?php endif; ?>
	<?php dynamic_sidebar('home-4'); ?>
</div>
<?php get_footer(); ?>