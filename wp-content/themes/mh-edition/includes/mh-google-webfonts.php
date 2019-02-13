<?php

/***** Google Webfonts & Character Subsets *****/

$mh_google_webfonts_subsets = array(
	'arabic' => __('Arabic', 'mh-edition'),
	'cyrillic' => __('Cyrillic', 'mh-edition'),
	'cyrillic_ext' => __('Cyrillic Extended', 'mh-edition'),
	'greek' => __('Greek', 'mh-edition'),
	'greek_ext' => __('Greek Extended', 'mh-edition'),
	'hebrew' => __('Hebrew', 'mh-edition'),
	'latin' => __('Latin', 'mh-edition'),
	'latin_ext' => __('Latin Extended', 'mh-edition'),
	'vietnamese' => __('Vietnamese', 'mh-edition')
);

$mh_google_webfonts = array(
	'alef' => array('name' => 'Alef', 'location' => 'Alef', 'css' => '"Alef", sans-serif'),
	'amiri' => array('name' => 'Amiri', 'location' => 'Amiri', 'css' => '"Amiri", serif'),
	'arimo' => array('name' => 'Arimo', 'location' => 'Arimo', 'css' => '"Arimo", sans-serif'),
    'armata' => array('name' => 'Armata', 'location' => 'Armata', 'css' => '"Armata", sans-serif'),
    'arvo' => array('name' => 'Arvo', 'location' => 'Arvo', 'css' => '"Arvo", serif'),
    'asap' => array('name' => 'Asap', 'location' => 'Asap', 'css' => '"Asap", sans-serif'),
    'bree_serif' => array('name' => 'Bree Serif', 'location' => 'Bree+Serif', 'css' => '"Bree Serif", serif'),
    'cousine' => array('name' => 'Cousine', 'location' => 'Cousine', 'css' => '"Cousine"'),
    'dosis' => array('name' => 'Dosis', 'location' => 'Dosis', 'css' => '"Dosis", sans-serif'),
    'droid_sans' => array('name' => 'Droid Sans', 'location' => 'Droid+Sans', 'css' => '"Droid Sans", sans-serif'),
    'droid_sans_mono' => array('name' => 'Droid Sans Mono', 'location' => 'Droid+Sans+Mono', 'css' => '"Droid Sans Mono", sans-serif'),
    'droid_serif' => array('name' => 'Droid Serif', 'location' => 'Droid+Serif', 'css' => '"Droid Serif", serif'),
    'exo' => array('name' => 'Exo', 'location' => 'Exo', 'css' => '"Exo", sans-serif'),
    'fjalla_one' => array('name' => 'Fjalla One', 'location' => 'Fjalla+One', 'css' => '"Fjalla One", sans-serif'),
    'lateef' => array('name' => 'Lateef', 'location' => 'Lateef', 'css' => '"Lateef", cursive'),
    'lato' => array('name' => 'Lato', 'location' => 'Lato', 'css' => '"Lato", sans-serif'),
    'lora' => array('name' => 'Lora', 'location' => 'Lora', 'css' => '"Lora", serif'),
	'lusitana' => array('name' => 'Lusitana', 'location' => 'Lusitana', 'css' => '"Lusitana", serif'),
    'merriweather' => array('name' => 'Merriweather', 'location' => 'Merriweather', 'css' => '"Merriweather", serif'),
    'merriweather_sans' => array('name' => 'Merriweather Sans', 'location' => 'Merriweather+Sans', 'css' => '"Merriweather Sans", sans-serif'),
    'monda' => array('name' => 'Monda', 'location' => 'Monda', 'css' => '"Monda", sans-serif'),
    'montserrat' => array('name' => 'Montserrat', 'location' => 'Montserrat', 'css' => '"Montserrat", sans-serif'),
    'nobile' => array('name' => 'Nobile', 'location' => 'Nobile', 'css' => '"Nobile", sans-serif'),
    'noto_sans' => array('name' => 'Noto Sans', 'location' => 'Noto+Sans', 'css' => '"Noto Sans", sans-serif'),
    'noto_serif' => array('name' => 'Noto Serif', 'location' => 'Noto+Serif', 'css' => '"Noto Serif", serif'),
    'open_sans' => array('name' => 'Open Sans', 'location' => 'Open+Sans', 'css' => '"Open Sans", sans-serif'),
    'oswald' => array('name' => 'Oswald', 'location' => 'Oswald', 'css' => '"Oswald", sans-serif'),
    'playfair_display' => array('name' => 'Playfair Display', 'location' => 'Playfair+Display', 'css' => '"Playfair Display", serif'),
    'pt_sans' => array('name' => 'PT Sans', 'location' => 'PT+Sans', 'css' => '"PT Sans", sans-serif'),
    'pt_serif' => array('name' => 'PT Serif', 'location' => 'PT+Serif', 'css' => '"PT Serif", serif'),
    'raleway' => array('name' => 'Raleway', 'location' => 'Raleway', 'css' => '"Raleway", sans-serif'),
    'roboto' => array('name' => 'Roboto', 'location' => 'Roboto', 'css' => '"Roboto"'),
    'roboto_condensed' => array('name' => 'Roboto Condensed', 'location' => 'Roboto+Condensed', 'css' => '"Roboto Condensed", sans-serif'),
    'scheherazade' => array('name' => 'Scheherazade', 'location' => 'Scheherazade', 'css' => '"Scheherazade", serif'),
    'tinos' => array('name' => 'Tinos', 'location' => 'Tinos', 'css' => '"Tinos", serif'),
    'ubuntu' => array('name' => 'Ubuntu', 'location' => 'Ubuntu', 'css' => '"Ubuntu", sans-serif'),
    'yanone_kaffeesatz' => array('name' => 'Yanone Kaffeesatz', 'location' => 'Yanone+Kaffeesatz', 'css' => '"Yanone Kaffeesatz", sans-serif')
);

$mh_google_webfonts_list = wp_list_pluck($mh_google_webfonts, 'name');

/***** Add Custom Typography Options to Customizer *****/

function mh_edition_typography_options($wp_customize) {
	global $mh_google_webfonts_subsets, $mh_google_webfonts_list;

	/***** Add Section *****/

	$wp_customize->add_section('mh_edition_typo', array('title' => __('Typography', 'mh-edition'), 'priority' => 3, 'panel' => 'mh_edition_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('mh_edition_options[font_size]', array('default' => 14, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
	$wp_customize->add_setting('mh_edition_options[google_webfonts]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_edition_options[google_webfonts_subsets]', array('default' => 'latin', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_google_webfonts_subsets'));
	$wp_customize->add_setting('mh_edition_options[font_heading]', array('default' => 'open_sans', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_google_webfonts'));
	$wp_customize->add_setting('mh_edition_options[font_body]', array('default' => 'open_sans', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_google_webfonts'));
	$wp_customize->add_setting('mh_edition_options[font_styles]', array('default' => '300,400,400italic,600,700', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));

    /***** Add Controls *****/

	$wp_customize->add_control('font_size', array('label' => esc_html__('Change default Font Size (px)', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[font_size]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('google_webfonts', array('label' => esc_html__('Google Webfonts', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[google_webfonts]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mh-edition'), 'disable' => __('Disable', 'mh-edition'))));
	$wp_customize->add_control('google_webfonts_subsets', array('label' => esc_html__('Google Webfonts Characters', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[google_webfonts_subsets]', 'priority' => 3, 'type' => 'select', 'choices' => $mh_google_webfonts_subsets));
	$wp_customize->add_control('font_heading', array('label' => esc_html__('Google Webfont for Headings', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[font_heading]', 'priority' => 4, 'type' => 'select', 'choices' => $mh_google_webfonts_list));
	$wp_customize->add_control('font_body', array('label' => esc_html__('Google Webfont for Body Text', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[font_body]', 'priority' => 5, 'type' => 'select', 'choices' => $mh_google_webfonts_list));
	$wp_customize->add_control('font_styles', array('label' => esc_html__('Imported Google Font Styles', 'mh-edition'), 'section' => 'mh_edition_typo', 'settings' => 'mh_edition_options[font_styles]', 'priority' => 6, 'type' => 'text'));
}
add_action('customize_register', 'mh_edition_typography_options');

/***** Data Sanitization *****/

function mh_sanitize_google_webfonts_subsets($input) {
	global $mh_google_webfonts_subsets;
    $valid = $mh_google_webfonts_subsets;
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

function mh_sanitize_google_webfonts($input) {
	global $mh_google_webfonts_list;
    $valid = $mh_google_webfonts_list;
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Default Custom Fonts *****/

if (!function_exists('mh_edition_custom_fonts')) {
	function mh_edition_custom_fonts() {
		$custom_fonts = wp_parse_args(
			get_option('mh_edition_options', array()),
			mh_edition_default_fonts()
		);
		return $custom_fonts;
	}
}

if (!function_exists('mh_edition_default_fonts')) {
	function mh_edition_default_fonts() {
		$default_fonts = array(
			'font_size' => 14,
			'google_webfonts' => 'enable',
			'google_webfonts_subsets' => 'latin',
			'font_heading' => 'open_sans',
			'font_body' => 'open_sans',
			'font_styles' => '300,400,400italic,600,700'
		);
		return $default_fonts;
	}
}

/***** Load Custom Fonts *****/

if (!function_exists('mh_edition_google_webfonts')) {
	function mh_edition_google_webfonts() {
		$mh_edition_fonts = mh_edition_custom_fonts();
		if ($mh_edition_fonts['google_webfonts'] == 'enable') {
			global $mh_google_webfonts;
			$font_heading = '';
			$font_styles = '';
			$font_subset = '';
			if (!empty($mh_edition_fonts['font_styles'])) {
				$font_styles = ':' . $mh_edition_fonts['font_styles'];
			}
			if ($mh_edition_fonts['font_heading'] != $mh_edition_fonts['font_body']) {
				$font_heading = '|' . $mh_google_webfonts[$mh_edition_fonts['font_heading']]['location'] . esc_attr($font_styles);
			}
			if ($mh_edition_fonts['google_webfonts_subsets'] == 'latin_ext') {
				$font_subset = '&subset=latin,latin-ext';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'arabic') {
				$font_subset = '&subset=latin,arabic';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'cyrillic') {
				$font_subset = '&subset=latin,cyrillic';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'cyrillic_ext') {
				$font_subset = '&subset=latin,cyrillic,cyrillic-ext';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'greek') {
				$font_subset = '&subset=latin,greek';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'greek_ext') {
				$font_subset = '&subset=latin,greek,greek-ext';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'hebrew') {
				$font_subset = '&subset=latin,hebrew';
			} elseif ($mh_edition_fonts['google_webfonts_subsets'] == 'vietnamese') {
				$font_subset = '&subset=latin,vietnamese';
			}
			wp_enqueue_style('mh-google-fonts', 'https://fonts.googleapis.com/css?family=' . $mh_google_webfonts[$mh_edition_fonts['font_body']]['location'] . esc_attr($font_styles) . $font_heading . $font_subset, array(), null);
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_edition_google_webfonts');

/***** Typography Custom CSS Output *****/

if (!function_exists('mh_edition_fonts_css')) {
	function mh_edition_fonts_css() {
		$mh_edition_fonts = mh_edition_custom_fonts();
		if ($mh_edition_fonts['google_webfonts'] == 'enable') {
			global $mh_google_webfonts;
			if (!empty($mh_edition_fonts['font_size']) && $mh_edition_fonts['font_size'] != '14' || $mh_edition_fonts['font_heading'] != 'open_sans' || $mh_edition_fonts['font_body'] != 'open_sans') {
				echo '<style type="text/css">' . "\n";
					if (!empty($mh_edition_fonts['font_size']) && $mh_edition_fonts['font_size'] != '14') {
						echo '.entry-content { font-size: ' . absint($mh_edition_fonts['font_size']) . 'px; font-size: ' . absint($mh_edition_fonts['font_size']) / 16 . 'rem; }' . "\n";
					}
					if ($mh_edition_fonts['font_heading'] != 'open_sans') {
						echo 'h1, h2, h3, h4, h5, h6, .mh-custom-posts-small-title { font-family: ' . $mh_google_webfonts[$mh_edition_fonts['font_heading']]['css'] .'; }' . "\n";
					}
					if ($mh_edition_fonts['font_body'] != 'open_sans') {
						echo 'body { font-family: ' . $mh_google_webfonts[$mh_edition_fonts['font_body']]['css'] . '; }' . "\n";
					}
				echo '</style>' . "\n";
			}
		}
	}
}
add_action('wp_head', 'mh_edition_fonts_css');

?>