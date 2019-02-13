<?php /* Default template for displaying page content */ ?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</header>
	<div class="entry-content clearfix">
		<?php dynamic_sidebar('mh-pages-1'); ?>
		<?php the_content(); ?>
	</div>
</article>
<?php dynamic_sidebar('mh-pages-2'); ?>