<?php /* Template for sidebar */
$options = mh_theme_options();
if ($options['sidebar'] == 'enable') { ?>
	<aside class="mh-sidebar <?php mh_sb_class(); ?>">
		<?php dynamic_sidebar('sidebar'); ?>
	</aside><?php
} ?>