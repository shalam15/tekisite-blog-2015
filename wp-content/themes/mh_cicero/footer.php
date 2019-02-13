<?php $mh_cicero_options = mh_cicero_theme_options(); ?>
<footer id="mh-footer" class="footer clearfix">
	<?php if (has_nav_menu('social_nav')) { ?>
		<nav class="social-nav clearfix">
			<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="social-icon"><i class="fa fa-mh-social"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
		</nav>
	<?php } ?>
	<div class="copyright-wrap">
		<p class="copyright"><?php echo empty($mh_cicero_options['copyright']) ? 'Copyright &copy; ' . date("Y") . ' | MH Cicero by <a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Themes" rel="nofollow">MH Themes</a>' : $mh_cicero_options['copyright']; ?></p>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>