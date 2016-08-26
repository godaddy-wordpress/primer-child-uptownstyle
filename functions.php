<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function uptown_move_elements() {

	remove_action( 'primer_header',       'primer_add_hero' );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_after_header', 'primer_add_hero' );
	add_action( 'primer_header',       'primer_add_primary_navigation' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'uptown_move_elements' );

/**
 * Set hero image target element.
 *
 * @filter primer_hero_image_selector
 * @since  1.0.0
 *
 * @return string
 */
function uptown_hero_image_selector() {

	return '.hero';

}
add_filter( 'primer_hero_image_selector', 'uptown_hero_image_selector' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function uptown_fonts( $fonts ) {

	$fonts[] = 'Lato';
	$fonts[] = 'Playfair Display';

	return $fonts;

}
add_filter( 'primer_fonts', 'uptown_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function uptown_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Playfair Display',
		),
		'navigation_font' => array(
			'default' => 'Playfair Display',
		),
		'heading_font' => array(
			'default' => 'Playfair Display',
		),
		'primary_font' => array(
			'default' => 'Lato',
		),
		'secondary_font' => array(
			'default' => 'Lato',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'uptown_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function uptown_colors( $colors ) {

	unset(
		$colors['content_background_color'],
		$colors['footer_widget_content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default' => '#353535',
		),
		'tagline_text_color' => array(
			'default' => '#686868',
		),
		'hero_text_color' => array(
			'default'  => '#ffffff',
			'rgba_css' => array(
				'.hero .hero-inner' => array(
					'border-color' => 'rgba(%1$s, 0.5)',
				),
			),
		),
		'menu_text_color' => array(
			'default' => '#252525',
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_widget_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_menu_text_color' => array(
			'default' => '#252525',
			'css'     => array(
				'.footer-menu ul li a:hover' => array(
					'border-color' => '%1$s',
				),
			),
		),
		'footer_text_color' => array(
			'default' => '#252525',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#54ccbe',
		),
		'button_color' => array(
			'default'  => '#b5345f',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#312538',
		),
		'menu_background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_widget_background_color' => array(
			'default' => '#3f3244',
		),
		'footer_background_color' => array(
			'default' => '#ffffff',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'uptown_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function uptown_color_schemes( $color_schemes ) {

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'bronze' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#3f3244',
			),
		),
		'canary' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#3f3244',
			),
		),
		'cool' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'dark' => array(
			'colors' => array(
				'footer_menu_text_color'         => '#7c848c',
				'footer_text_color'              => '#7c848c',
				'link_color'                     => '#54ccbe',
				'button_color'                   => '#b5345f',
				'background_color'               => '#2c3845',
				'hero_background_color'          => '#2c3845',
				'menu_background_color'          => '#303d4c',
				'footer_widget_background_color' => '#303d4c',
				'footer_background_color'        => '#2c3845',
			),
		),
		'iguana' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'muted' => array(
			'colors' => array(
				'footer_widget_background_color' => '#5a6175',
			),
		),
		'plum' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#312538', // Darker
			),
		),
		'rose' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#3f3244',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#3f3244',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#3f3244',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'uptown_color_schemes' );
