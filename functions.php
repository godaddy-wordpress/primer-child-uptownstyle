<?php

/**
 * Move elements around the theme.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function uptown_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_header',       'primer_add_hero' );

	add_action( 'primer_header', 'primer_add_primary_navigation' );

	if ( is_front_page() && is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_after_header', 'primer_add_hero' );

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

	return '.hero, .page-title-container';

}
add_filter( 'primer_hero_image_selector', 'uptown_hero_image_selector' );

/**
 *
 * Register font types.
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
		'header_font' => array(
			'default' => 'Playfair Display',
			'css'     => array(
				'nav.main-navigation ul li a' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
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
add_action( 'primer_font_types', 'uptown_font_types' );

/**
 * Register colors.
 *
 * @action primer_colors
 * @since  1.0.0
 *
 * @return array
 */
function uptown_colors() {

	return array(
		'background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'button_color' => array(
			'label'   => esc_html__( 'Button Color', 'uptown-style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.cta, button, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_social_color' => array(
			'label'   => esc_html__( 'Footer Social Icon Color', 'uptown-style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a, .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => esc_html__( 'Footer Background Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'uptown-style' ),
			'default' => '#54ccbe',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a, .main-navigation-container .menu li.current-menu-item > a:hover' => array(
					'color' => '%1$s',
				),
			),
		),
		'w_background_color' => array(
			'label'   => esc_html__( 'Widget Background Color', 'uptown-style' ),
			'default' => '#3f3244',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
	);

}
add_action( 'primer_colors', 'uptown_colors' );

/**
 * Register color schemes.
 *
 * @action primer_color_schemes
 * @since  1.0.0
 *
 * @return array
 */
function uptown_color_schemes() {

	return array(
		'bronze' => array(
			'label'  => esc_html__( 'Bronze', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'button_color'            => '#aeaeae',
				'footer_social_color'     => '#c19072',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#c19072',
				'w_background_color'      => '#ffffff',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'uptown_color_schemes' );
