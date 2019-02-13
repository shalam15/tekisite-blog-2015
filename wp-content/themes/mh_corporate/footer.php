<?php $options = get_option('mhc_options'); ?>
<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) { ?>
	<footer class="row clearfix">
		<?php if (is_active_sidebar('footer-1')) { ?>
			<div class="col-1-4 mq-footer">
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer-2')) { ?>
			<div class="col-1-4 mq-footer">
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer-3')) { ?>
			<div class="col-1-4 mq-footer">
				<?php dynamic_sidebar('footer-3'); ?>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer-4')) { ?>
			<div class="col-1-4 mq-footer">
				<?php dynamic_sidebar('footer-4'); ?>
			</div>
		<?php } ?>
	</footer>
<?php } ?>
</div>
<div class="copyright-wrap">
	<p class="copyright"><?php echo empty($options['copyright']) ? 'Copyright &copy; ' . date("Y") . ' | Theme by <a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Templates" rel="nofollow">MH Themes</a>' : $options['copyright']; ?></p>
</div>
<?php wp_footer(); ?>
</div>
</body>
</html>