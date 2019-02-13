<?php $mh_squared_options = mh_squared_theme_options(); ?>
</div><!-- /wrapper -->
<?php dynamic_sidebar('footer-ad'); ?>
</div><!-- /container -->
<footer class="mh-footer">
	<?php if (has_nav_menu('social_nav')) : ?>
		<div class="mh-prefooter">
			<nav class="social-nav">
				<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-stop fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
            </nav>
		</div>
	<?php endif; ?>
	<div class="mh-container">
		<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
			<div class="footer-widgets mh-row clearfix">
				<?php if (is_active_sidebar('footer-1')) : ?>
					<div class="mh-col-1-3 footer-1">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-2')) : ?>
					<div class="mh-col-1-3 footer-2">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-3')) : ?>
					<div class="mh-col-1-3 footer-3">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
				<?php endif; ?>
				<div class="footer-seperator clearfix"></div>
			</div>
		<?php endif; ?>
		<div class="footer-info mh-row clearfix">
			<div class="mh-col-2-3 copyright">
				<?php echo empty($mh_squared_options['copyright']) ? sprintf(__('Copyright &copy; %1$s %2$s', 'mh-squared'), date("Y"), get_bloginfo('name')) : wp_kses_post($mh_squared_options['copyright']); ?>
			</div>
			<?php if ($mh_squared_options['credits'] == 'enable') : ?>
				<div class="mh-col-1-3 credits-text">
					<?php printf(__('MH Squared by %s', 'mh-squared'), '<a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium Magazine WordPress Themes" rel="nofollow">MH Themes</a>'); ?>
                </div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>