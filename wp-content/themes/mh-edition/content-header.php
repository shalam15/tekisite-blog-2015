<?php $mh_edition_options = mh_edition_theme_options(); ?>
<div class="mh-header-mobile-nav clearfix"></div>
<?php if (has_nav_menu('mh_header_nav') || has_nav_menu('mh_social_nav')) { ?>
	<div class="mh-preheader">
    	<div class="mh-container mh-container-inner mh-row clearfix">
			<?php if (has_nav_menu('mh_header_nav')) { ?>
            	<nav class="mh-header-nav mh-col-2-3 clearfix">
            		<?php wp_nav_menu(array('theme_location' => 'mh_header_nav')); ?>
				</nav>
			<?php } ?>
			<?php if (has_nav_menu('mh_social_nav')) { ?>
            	<nav class="mh-social-icons mh-social-nav mh-col-1-3 clearfix">
            		<?php wp_nav_menu(array('theme_location' => 'mh_social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<header class="mh-header">
	<div class="mh-container mh-container-inner mh-row clearfix">
		<?php mh_edition_custom_header(); ?>
	</div>
	<nav class="mh-main-nav clearfix">
		<?php wp_nav_menu(array('theme_location' => 'mh_main_nav')); ?>
	</nav>
	<?php if (has_nav_menu('mh_extra_nav')) { ?>
		<nav class="mh-extra-nav clearfix">
			<?php wp_nav_menu(array('theme_location' => 'mh_extra_nav')); ?>
		</nav>
	<?php } ?>
</header>
<?php if ($mh_edition_options['ticker'] == 1 || $mh_edition_options['header_search'] == 'enable') { ?>
	<div class="mh-subheader">
		<div class="mh-container mh-container-inner mh-row clearfix">
			<?php if ($mh_edition_options['ticker'] == 1) { ?>
				<div class="mh-col-2-3 mh-header-ticker">
					<?php get_template_part('content', 'ticker'); ?>
				</div>
			<?php } ?>
			<?php if ($mh_edition_options['header_search'] == 'enable') { ?>
				<aside class="mh-col-1-3 mh-header-search">
					<?php get_search_form(); ?>
				</aside>
			<?php } ?>
		</div>
	</div>
<?php } ?>