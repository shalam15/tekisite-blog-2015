<?php $mh_purity_options = mh_purity_theme_options(); ?>
<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) { ?>
<footer class="footer clearfix">
	<?php if (is_active_sidebar('footer-1')) { ?>
		<div class="col-1-3 footer-widget-area">
			<?php dynamic_sidebar('footer-1'); ?>
		</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer-2')) { ?>
		<div class="col-1-3 footer-widget-area">
			<?php dynamic_sidebar('footer-2'); ?>
		</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer-3')) { ?>
		<div class="col-1-3 footer-widget-area">
			<?php dynamic_sidebar('footer-3'); ?>
		</div>
	<?php } ?>
</footer>
<?php } ?>
<div class="copyright-wrap">
	<p class="copyright"><?php echo empty($mh_purity_options['copyright']) ? 'Copyright &copy; ' . date("Y") . ' | MH Purity WordPress Theme by <a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Themes" rel="nofollow">MH Themes</a>' : $mh_purity_options['copyright']; ?></p>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>