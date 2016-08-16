<?php
/**
 * Move elements around the theme.
 *
 * @action template_redirect
 * @since 1.0.0
 */
function uptown_move_elements() {

	remove_action( 'primer_after_header',  'primer_add_primary_navigation' );
	remove_action( 'primer_header',        'primer_add_hero' );

	add_action( 'primer_header',       'primer_add_primary_navigation' );

	if ( is_front_page() && is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_after_header', 'primer_add_hero' );

	}

}
add_action( 'template_redirect', 'uptown_move_elements' );

/**
 * Register Footer Menu.
 *
 * @filter primer_nav_menus
 * @since   1.0.0
 *
 * @param $menu
 */
function uptown_register_nav_menu( $menu ) {

	$menu[ 'footer' ] = __( 'Footer Menu', 'uptown_style' );

	return $menu;

}
add_filter( 'primer_nav_menus', 'uptown_register_nav_menu' );

/**
 * Add foother navigation
 *
 * @action primer_site_info
 * @since 1.0.0
 */
function uptown_add_footer_navigation() {

	get_template_part( 'templates/parts/footer-navigation' );

}
add_action( 'primer_site_info', 'uptown_add_footer_navigation' );

/**
 * Register sidebar areas.
 *
 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @filter  primer_sidebars
 * @since   1.0.0
 *
 * @param array $sidebars
 *
 * @return array
 */
function uptown_register_sidebars( $sidebars ) {

	/**
	 * Register Hero Widget.
	 */
	$sidebars['hero'] = array(
		'name'          => esc_attr__( 'Hero', 'uptown_style' ),
		'id'            => 'hero',
		'description'   => esc_attr__( 'The Hero widget area.', 'uptown_style' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'uptown_register_sidebars' );

/**
 * Add image size for hero image
 *
 * @filter primer_image_sizes
 * @since   1.0.0
 * @link    https://codex.wordpress.org/Function_Reference/add_image_size
 *
 * @param array $images_sizes
 *
 * @return array
 */
function uptown_add_image_size( $images_sizes ) {

	$images_sizes['primer-hero']['width']  = 2400;
	$images_sizes['primer-hero']['height'] = 1320;

	return $images_sizes;

}
add_filter( 'primer_image_sizes', 'uptown_add_image_size' );

/**
 * Update custom header arguments
 *
 * @filter primer_custom_header_args
 * @param $args
 * @return mixed
 */
function uptown_update_custom_header_args( $args ) {

	$args['width']  = 2400;
	$args['height'] = 1320;

	return $args;

}
add_filter( 'primer_custom_header_args', 'uptown_update_custom_header_args' );

/**
 * Add hero style.
 *
 * @filter primer_hero_style_attr
 * @since 1.0.0
 *
 * @param string $header_styles
 *
 * @return string
 */
function uptown_hero_style_atts( $header_styles ) {

	if ( primer_has_hero_image() ) {

		$header_styles .= sprintf( "background:url('%s') no-repeat top center; background-size: cover;", esc_attr( primer_get_hero_image() ) );

	}

	return $header_styles;

}
add_filter( 'primer_hero_style_attr', 'uptown_hero_style_atts' );

/**
 * Update colors
 *
 * @action primer_colors
 * @since 1.0.0
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
			'label'   => __( 'Button Color', 'uptown_style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.cta, button, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_social_color' => array(
			'label'   => __( 'Footer Social Icon Color', 'uptown_style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a, .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => __( 'Footer Background Color', 'uptown_style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => __( 'Link Color', 'uptown_style' ),
			'default' => '#54ccbe',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a, .main-navigation-container .menu li.current-menu-item > a:hover' => array(
					'color' => '%1$s',
				),
			),
		),
		'w_background_color' => array(
			'label'   => __( 'Widget Background Color', 'uptown_style' ),
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
 * Change uptown color schemes
 *
 * @action primer_color_schemes
 * @since 1.0.0
 * @return array
 */
function uptown_color_schemes() {

	return array(
		'bronze' => array(
			'label'  => esc_html__( 'Bronze', 'uptown_style' ),
			'colors' => array(
				'background_color'         => '#ffffff',
				'button_color'			   => '#aeaeae',
				'footer_social_color'      => '#c19072',
				'footer_background_color'  => '#ffffff',
				'link_color'               => '#c19072',
				'w_background_color'	   => '#ffffff',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'uptown_color_schemes' );

/**
 *
 * Add selectors for font customizing.
 *
 * @filter primer_font_types
 * @since 1.0.0
 */
function uptown_update_font_types() {

	return array(
		'primary_font' => array(
			'label'   => __( 'Primary Font', 'uptown_style' ),
			'default' => 'Lato',
			'css'     => array(
				'body, p, label' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		'header_font' => array(
			'label'   => esc_html__( 'Header Font', 'uptown_style' ),
			'default' => 'Playfair Display',
			'css'     => array(
				'h1, h2, h3, h4, h5, h6, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], .entry-title, .hero .widget h1' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

}
add_action( 'primer_font_types', 'uptown_update_font_types', 5 );
