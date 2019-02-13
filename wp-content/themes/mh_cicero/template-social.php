<?php /* Template used for social icons on archives and single posts */ ?>
<?php $mh_cicero_options = mh_cicero_theme_options(); ?>
<?php if (!is_singular() || is_singular() && $mh_cicero_options['social_icons'] == 'enable') { ?>
	<ul class="entry-social clearfix">
		<?php if ($mh_cicero_options['social_icons'] == 'enable') { ?>
    		<li class="entry-social-facebook">
    			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php the_title(); ?>" target="_blank">
				<i class="fa fa-facebook"></i></a>
			</li>
			<li class="entry-social-twitter">
				<a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>:&url=<?php echo get_permalink(); ?>" target="_blank">
				<i class="fa fa-twitter"></i></a>
			</li>
			<li class="entry-social-google">
				<a href="https://plus.google.com/share?<?php echo get_permalink(); ?>" target="_blank">
				<i class="fa fa-google-plus"></i></a>
			</li>
			<li class="entry-social-linkedin">
				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>" target="_blank">
				<i class="fa fa-linkedin"></i></a>
			</li>
		<?php } ?>
		<?php if (!is_singular()) { ?>
			<li class="entry-social-more">
				<a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo esc_attr($mh_cicero_options['excerpt_more']); ?>
				<i class="fa fa-arrow-circle-o-right"></i></a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>