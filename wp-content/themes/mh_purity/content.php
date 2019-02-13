<article <?php post_class(); ?>>
	<header class="post-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php mh_post_header(); ?>
	</header>
	<?php dynamic_sidebar('posts-1'); ?>
	<div class="entry clearfix">
		<?php mh_purity_featured_image(); ?>
		<?php the_content(); ?>
	</div>
    <?php the_tags('<div class="post-tags meta clearfix"><p class="meta-tags"><i class="fa fa-tag"></i>', ', ', '</p></div>'); ?>
	<?php dynamic_sidebar('posts-2'); ?>
</article>