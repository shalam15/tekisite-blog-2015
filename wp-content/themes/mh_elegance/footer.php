<?php $mh_elegance_options = mh_elegance_theme_options(); ?>
<footer class="mh-footer">
	<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) { ?>
		<div class="footer-widgets">
			<div class="mh-container row clearfix">
				<?php if (is_active_sidebar('footer-1')) { ?>
					<div class="mh-col-1-3 footer-1">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-2')) { ?>
					<div class="mh-col-1-3 footer-2">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-3')) { ?>
					<div class="mh-col-1-3 footer-3">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<div class="footer-bottom mh-container">
		<?php if ($mh_elegance_options['footer_logo']) { ?>
			<div class="footer-logo">
				<?php echo '<img src="'. esc_url($mh_elegance_options['footer_logo']) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /> '; ?>
			</div>
		<?php } ?>
		<?php if (has_nav_menu('social_nav')) { ?>
			<nav class="social-nav clearfix">
				<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
			</nav>
		<?php } ?>
		<?php if (has_nav_menu('footer_nav')) { ?>
			<nav class="footer-nav clearfix">
				<?php wp_nav_menu(array('theme_location' => 'footer_nav')); ?>
			</nav>
		<?php } ?>
		<div class="copyright-wrap">
			<p class="copyright"><?php echo empty($mh_elegance_options['copyright']) ? 'Copyright &copy; ' . date("Y") . ' | Theme by <a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Themes" rel="nofollow">MH Themes</a>' : $mh_elegance_options['copyright']; ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>