<?php /* Template for default sidebar */ ?>
<?php $mh_edition_options = mh_edition_theme_options(); ?>
<?php if ($mh_edition_options['sidebar'] != 'disable') { ?>
	<aside class="mh-widget-col-1 mh-sidebar">
		<?php dynamic_sidebar('mh-sidebar'); ?>
	</aside>
<?php } ?>