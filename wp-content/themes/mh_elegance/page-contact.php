<?php /* Template Name: Page - Contact */ ?>
<?php get_header(); ?>
<div class="mh-content-section">
	<div class="mh-container clearfix">
		<div id="main-content">
    		<?php while (have_posts()) : the_post(); ?>
    			<header class="separator">
    	 			<h1 class="page-title section-title"><?php the_title(); ?></h1>
		 		</header>
		 		<?php get_template_part('content', 'page'); ?>
		 	<?php endwhile; ?>
		</div>
		<aside id="main-sidebar" class="mh-sidebar">
			<?php dynamic_sidebar('contact'); ?>
		</aside>
	</div>
</div>
<?php get_footer(); ?>