<?php
/**
 * Move titles above menu templates.
 *
 * @package Uptown Style
 */
function uptown_remove_titles() {

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

	if ( ! is_front_page() ) {

		add_action( 'uptown_hero', 'primer_add_page_builder_template_title' );
		add_action( 'uptown_hero', 'primer_add_blog_title' );
		add_action( 'uptown_hero', 'primer_add_archive_title' );

	}

}
add_action( 'init', 'uptown_remove_titles' );

/**
 * Add child and parent theme files.
 *
 * @package Uptown Style
 */
function uptown_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );

}
add_action( 'wp_enqueue_scripts', 'uptown_enqueue_styles' );


/**
 * Register Footer Menu.
 *
 * @package Uptown Style
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
 * Remove primer navigation and add uptown navigation
 *
 * @package Uptown Style
 */
function uptown_navigation() {

	wp_dequeue_script( 'primer-navigation' );

}
add_action( 'wp_print_scripts', 'uptown_navigation', 100 );

/**
 *
 * Adding content to footer via action.
 *
 * @package Uptown Style
 */
add_action( 'primer_footer', '__return_empty_string' );

/**
 * Display the footer nav before the site info.
 *
 * @action primer_after_footer
 *
 * @package Uptown Style
 * @since 1.0.0
 */
function uptown_add_nav_footer() {

	get_template_part( 'templates/parts/footer-nav' );

}
add_action( 'primer_after_footer', 'uptown_add_nav_footer', 10 );

/**
 * Move navigation from after_header to header
 *
 * @package Uptown Style
 * @link https://codex.wordpress.org/Function_Reference/remove_action
 * @link https://codex.wordpress.org/Function_Reference/add_action
 */
function uptown_move_navigation() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );

	get_template_part( 'templates/parts/primary-navigation' );

}
add_action( 'primer_header', 'uptown_move_navigation', 19 );

/**
 * Register sidebar areas.
 *
 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @package Uptown Style
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
 * @package Uptown Style
 * @since   1.0.0
 * @link    https://codex.wordpress.org/Function_Reference/add_image_size
 *
 * @param array $images_sizes
 *
 * @return array
 */
function uptown_add_image_size( $images_sizes ) {

	$images_sizes[ 'primer-hero' ] = array(
		'width'  => 1200,
		'height' => 660,
		'crop'   => array( 'center', 'center' ),
	);

	$images_sizes[ 'primer-hero-2x' ] = array(
		'width'  => 2400,
		'height' => 1320,
		'crop'   => array( 'center', 'center' ),
	);

	return $images_sizes;

}
add_filter( 'primer_image_sizes', 'uptown_add_image_size' );

/**
 * Update custom header arguments
 *
 * @package Uptown Style
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
 * Add hero after header if we are on a post or front page.
 *
 * @package Uptown Style
 * @action primer_after_header
 * @since 1.0.0
 */
function uptown_add_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );

	add_action( 'primer_after_header', 'primer_add_hero', 20 );

}
add_action( 'after_setup_theme', 'uptown_add_hero' );

/**
 * Update colors
 *
 * @package Uptown Style
 * @action primer_colors
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
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a, .main-navigation-container .menu li.current-menu-item > a:hover, .main-navigation-container .menu li.current-menu-item > a' => array(
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
 * @package Uptown Style
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
 * @package Uptown Style
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

/**
 *
 * Default header image in the hero area.
 *
 * @package Uptown Style
 * @since   1.0.0
 *
 * @param $array
 *
 * @return
 */
function uptown_add_default_header_image( $array ) {

	$array['default-image'] = get_stylesheet_directory_uri() . '/assets/img/header.jpg';

	return $array;

}
add_filter( 'primer_custom_header_args', 'uptown_add_default_header_image', 20 );
