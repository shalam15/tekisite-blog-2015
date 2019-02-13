<?php $mh_impact_options = mh_impact_theme_options(); ?>
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
<?php if ($mh_impact_options['telephone'] || has_nav_menu('social_nav')) { ?>
	<div class="mh-header-top">
		<div class="mh-container mh-row clearfix">
			<?php if ($mh_impact_options['telephone'] && has_nav_menu('social_nav')) { ?>
				<?php $header_columns = '2'; ?>
			<?php } else { ?>
				<?php $header_columns = '1'; ?>
			<?php } ?>
			<?php if ($mh_impact_options['telephone']) { ?>
				<div class="contact-info mh-col-1-<?php echo $header_columns; ?>"><i class="fa fa-phone-square"></i><?php echo esc_attr($mh_impact_options['telephone']); ?></div>
			<?php } ?>
			<?php if (has_nav_menu('social_nav')) { ?>
				<nav class="social-nav clearfix mh-col-1-<?php echo $header_columns; ?>">
					<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<header class="mh-header slicknav">
	<div class="mh-container clearfix">
		<?php mh_impact_logo(); ?>
		<nav class="main-nav clearfix">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
	</div>
</header>
<div id="mh-wrapper">