<!DOCTYPE html>
<html class="no-js<?php mh_html_class(); ?>" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
<header class="header-wrap">
	<div class="header-search"><?php get_search_form(); ?></div>
	<?php mh_purity_logo(); ?>
	<nav class="main-nav clearfix">
		<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
	</nav>
</header>