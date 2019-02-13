<?php $mh_joystick_options = mh_joystick_theme_options(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (has_nav_menu('header_nav') || has_nav_menu('social_nav')) : ?>
	<div class="mh-preheader">
		<div class="mh-container mh-row clearfix">
			<?php if (has_nav_menu('header_nav')) : ?>
				<nav class="header-nav clearfix">
					<?php wp_nav_menu(array('theme_location' => 'header_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php endif; ?>
			<?php if (has_nav_menu('social_nav')) : ?>
				<nav class="social-nav">
					<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<div class="mh-container">
<header class="mh-header mh-row clearfix">
	<?php if ($mh_joystick_options['show_ticker']) : $logo_class = 'header-logo'; else : $logo_class = 'header-logo-full'; endif; ?>
	<div class="mh-col-1-3 <?php echo $logo_class; ?>">
		<?php mh_joystick_logo(); ?>
	</div><?php
	if ($mh_joystick_options['show_ticker']) :
		mh_joystick_newsticker();
	endif; ?>
</header>
<nav class="main-nav clearfix">
	<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
</nav>
<div class="slicknav clearfix"></div>
<?php dynamic_sidebar('header-ad'); ?>
<div class="mh-wrapper">