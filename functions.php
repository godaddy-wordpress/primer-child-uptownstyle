<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.0' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function uptown_move_elements() {

	remove_action( 'primer_header',                'primer_add_hero',               7 );
	remove_action( 'primer_after_header',          'primer_add_primary_navigation', 11 );
	remove_action( 'primer_after_header',          'primer_add_page_title',         12 );
	remove_action( 'primer_before_header_wrapper', 'primer_video_header',           5 );

	add_action( 'primer_after_header', 'primer_add_hero',               7 );
	add_action( 'primer_header',       'primer_add_primary_navigation', 11 );
	add_action( 'primer_pre_hero',     'primer_video_header',           3 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

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
		'heading_text_color' => array(
			'default' => '#353535',
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
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
			'default' => '#54ccbe',
		),
		'button_color' => array(
			'default' => '#b5345f',
		),
		'button_text_color' => array(
			'default' => '#ffffff',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#252525',
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

	unset( $color_schemes['plum'] );

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['blush']['base'],
				'button_color'                   => $color_schemes['blush']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'bronze' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['bronze']['base'],
				'button_color'                   => $color_schemes['bronze']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'canary' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['canary']['base'],
				'button_color'                   => $color_schemes['canary']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'cool' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['cool']['base'],
				'button_color'                   => $color_schemes['cool']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'dark' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#ffffff',
				'tagline_text_color'               => '#999999',
				'menu_text_color'                  => '#ffffff',
				'heading_text_color'               => '#ffffff',
				'primary_text_color'               => '#e5e5e5',
				'secondary_text_color'             => '#c1c1c1',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				'footer_menu_text_color'           => '#ffffff',
				'footer_text_color'                => '#999999',
				// Backgrounds
				'background_color'                       => '#222222',
				'content_background_color'               => '#333333',
				'hero_background_color'                  => '#282828',
				'menu_background_color'                  => '#333333',
				'footer_widget_content_background_color' => '#333333',
				'footer_widget_background_color'         => '#282828',
				'footer_background_color'                => '#222222',
			),
		),
		'iguana' => array(
			'colors' => array(
				'link_color'                       => $color_schemes['iguana']['base'],
				'button_color'                     => $color_schemes['iguana']['base'],
				'footer_widget_background_color'   => '#303d4c',
			),
		),
		'muted' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#5a6175',
				'tagline_text_color'               => '#5a6175',
				'menu_text_color'                  => $color_schemes['muted']['base'],
				'heading_text_color'               => '#4f5875',
				'primary_text_color'               => '#4f5875',
				'secondary_text_color'             => '#888c99',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_menu_text_color'           => $color_schemes['muted']['base'],
				'footer_text_color'                => '#4f5875',
				// Links & Buttons
				'link_color'   => $color_schemes['muted']['base'],
				'button_color' => $color_schemes['muted']['base'],
				// Backgrounds
				'background_color'               => '#ffffff',
				'hero_background_color'          => '#5a6175',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#b6b9c5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'rose' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['rose']['base'],
				'button_color'                   => $color_schemes['rose']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['tangerine']['base'],
				'button_color'                   => $color_schemes['tangerine']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['turquoise']['base'],
				'button_color'                   => $color_schemes['turquoise']['base'],
				'footer_widget_background_color' => '#303d4c',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'uptown_color_schemes' );
