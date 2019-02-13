<?php /* Default template for displaying page content. */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-margin content-background clearfix'); ?>>
	<header class="page-title-wrap">
		<h1 class="page-title">
			<?php the_title(); ?>
		</h1>
	</header>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
</article>