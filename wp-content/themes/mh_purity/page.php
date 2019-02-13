<?php get_header(); ?>
<div class="wrapper clearfix">
    <div class="content <?php mh_content_class(); ?>">
	    <?php while (have_posts()) : the_post(); ?>
    		<?php mh_before_page_content(); ?>
    		<?php dynamic_sidebar('pages-1'); ?>
			<div <?php post_class(); ?>>
	       		<div class="entry clearfix">
		   			<?php the_content(); ?>
	        	</div>
	    	</div>
			<?php dynamic_sidebar('pages-2'); ?>
       		<?php comments_template(); ?>
		<?php endwhile; ?>
    </div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>