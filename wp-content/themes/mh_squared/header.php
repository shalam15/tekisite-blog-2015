<?php $mh_squared_options = mh_squared_theme_options(); ?>
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
<?php if (has_nav_menu('header_nav') || ($mh_squared_options['show_ticker'])) : ?>
	<div class="mh-preheader">
    	<div class="mh-container mh-row clearfix">
    		<?php if (has_nav_menu('header_nav')) : ?>
            	<nav class="header-nav clearfix">
            		<?php wp_nav_menu(array('theme_location' => 'header_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php endif; ?>
			<?php if ($mh_squared_options['show_ticker']) : ?>
				<?php mh_squared_newsticker(); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<header class="mh-header">
	<div class="mh-container mh-row clearfix">
		<?php if (is_active_sidebar('header-ad-top')) : $logo_class = 'header-logo'; else : $logo_class = 'header-logo-full'; endif; ?>
		<div class="mh-col-1-2 <?php echo $logo_class; ?>">
			<?php mh_squared_logo(); ?>
		</div>
		<?php if (is_active_sidebar('header-ad-top')) : ?>
			<div class="mh-col-1-2">
				<?php dynamic_sidebar('header-ad-top'); ?>
			</div>
		<?php endif; ?>
	</div>
</header>
<div class="mh-container">
<nav class="main-nav clearfix">
	<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
</nav>
<div class="slicknav clearfix"></div>
<?php dynamic_sidebar('header-ad-bottom'); ?>
<div class="mh-wrapper">