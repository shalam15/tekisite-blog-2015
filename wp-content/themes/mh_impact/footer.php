<?php $mh_impact_options = mh_impact_theme_options(); ?>
</div>
<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) { ?>
	<div id="prefooter">
		<div class="mh-container mh-row">
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
<footer class="mh-footer">
	<p class="copyright"><?php echo empty($mh_impact_options['copyright']) ? sprintf(__('Copyright %1$s | MH Impact WordPress Theme by %2$s', 'mh-impact'), date("Y"), '<a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Themes" rel="nofollow">MH Themes</a>') : $mh_impact_options['copyright']; ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>