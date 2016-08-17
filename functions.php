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
			'label'   => esc_html__( 'Background Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'header_background_color' => array(
			'label'   => esc_html__( 'Header Background Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'header_text_color' => array(
			'label'   => esc_html__( 'Header Text Color', 'uptown-style' ),
			'default' => '#222222',
			'css'     => array(
				'.site-title-wrapper .site-title a,.main-navigation ul a' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.site-description' => array(
					'color' => 'rgba(%1$s, 0.6)',
				),
			),
		),
		'menu_background_color' => array(
			'label'   => esc_html__( 'Menu Background Color', 'uptown-style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.main-navigation ul ul' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'menu_text_color' => array(
			'label'   => esc_html__( 'Menu Text Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation ul ul a' => array(
					'color' => '%1$s',
				),
				'.main-navigation .sub-menu .menu-item-has-children > a::after' => array(
					'border-left-color' => '%1$s',
				)
			),
		),
		'button_color' => array(
			'label'   => esc_html__( 'Button Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'button_bg_color' => array(
			'label'   => esc_html__( 'Button Background Color', 'uptown-style' ),
			'default' => '#b5345f',
			'css'     => array(
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
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
			'label'   => esc_html__( 'Footer Widget Background Color', 'uptown-style' ),
			'default' => '#3f3244',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'w_text_color' => array(
			'label'   => esc_html__( 'Footer Widget Text Color', 'uptown-style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-footer-inner' => array(
					'color' => '%1$s',
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
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#b1a18b',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#b1a18b',
				'footer_social_color'     => '#b1a18b',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#b1a18b',
				'w_background_color'      => '#b1a18b',
				'w_text_color'            => '#ffffff',
			),
		),
		'red' => array(
			'label'  => esc_html__( 'Red', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#cc494f',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#cc494f',
				'footer_social_color'     => '#cc494f',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#cc494f',
				'w_background_color'      => '#cc494f',
				'w_text_color'            => '#ffffff',
			),
		),
		'blue' => array(
			'label'  => esc_html__( 'Blue', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#499ccc',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#499ccc',
				'footer_social_color'     => '#499ccc',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#499ccc',
				'w_background_color'      => '#d6ebf9',
				'w_text_color'            => '#636363',
			),
		),
		'green' => array(
			'label'  => esc_html__( 'Green', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#62bf7c',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#62bf7c',
				'footer_social_color'     => '#62bf7c',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#62bf7c',
				'w_background_color'      => '#f2f2f2',
				'w_text_color'            => '#888888',
			),
		),
		'orange' => array(
			'label'  => esc_html__( 'Orange', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#df6135',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#df6135',
				'footer_social_color'     => '#df6135',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#df6135',
				'w_background_color'      => '#222222',
				'w_text_color'            => '#ffffff',
			),
		),
		'yellow' => array(
			'label'  => esc_html__( 'Yellow', 'uptown-style' ),
			'colors' => array(
				'background_color'        => '#e9e73d',
				'header_background_color' => '#e9e73d',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#222222',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#222222',
				'button_bg_color'         => '#e9e73d',
				'footer_social_color'     => '#222222',
				'footer_background_color' => '#e9e73d',
				'link_color'              => '#777777',
				'w_background_color'      => '#e9e73d',
				'w_text_color'            => '#3a3a3a',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'uptown_color_schemes' );
