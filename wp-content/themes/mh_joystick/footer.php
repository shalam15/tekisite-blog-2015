<?php $mh_joystick_options = mh_joystick_theme_options();  ?>
</div><!-- /wrapper -->
<?php dynamic_sidebar('footer-ad'); ?>
</div><!-- /container -->
<footer class="mh-footer mh-row">
    <div class="mh-container">
        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
            <div class="footer-widgets clearfix">
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
        <div class="footer-info">
            <div class="mh-col-2-3 copyright">
                <?php echo empty($mh_joystick_options['copyright']) ? sprintf(__('Copyright &copy; %1$s %2$s', 'mh-joystick'), date("Y"), get_bloginfo('name')) : wp_kses_post($mh_joystick_options['copyright']); ?>
            </div>
            <?php if ($mh_joystick_options['credits'] == 'enable') : ?>
                <div class="mh-col-1-3 credits-text">
                    <?php printf(__('MH Joystick by %s', 'mh-joystick'), '<a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium Magazine WordPress Themes" rel="nofollow">MH Themes</a>'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>