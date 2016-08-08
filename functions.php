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

	if( ! is_front_page() ):
		add_action( 'uptown_hero', 'primer_add_page_builder_template_title' );
		add_action( 'uptown_hero', 'primer_add_blog_title' );
		add_action( 'uptown_hero', 'primer_add_archive_title' );
	endif;

}
add_action( 'init', 'uptown_remove_titles' );

/**
 * Add child and parent theme files.
 *
 * @package Uptown Style
 */
function uptown_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'uptown_theme_enqueue_styles' );

/**
 *
 * Register Footer Menu.
 *
 * @package Uptown Style
 */
function uptown_theme_register_nav_menu() {
	 register_nav_menu( 'footer', __( 'Footer Menu', 'uptown_style' ) );
}
add_action( 'after_setup_theme', 'uptown_theme_register_nav_menu' );

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
function uptown_theme_footer_content() {
	return;
}
add_action( 'primer_footer', 'uptown_theme_footer_content' );

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
 * @package Uptown Style
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 * @since 1.0.0
 */
function uptown_style_register_sidebars() {

	/**
	 *
	 * Register Hero Widget.
	 *
	 * @package Uptown Style
	 */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Hero', 'uptown_style' ),
			'id'            => 'hero',
			'description'   => esc_html__( 'The Hero widget area.', 'uptown_style' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);

}
add_action( 'widgets_init', 'uptown_style_register_sidebars' );


/**
 * Add image size for hero image
 *
 * @package Uptown Style
 * @link https://codex.wordpress.org/Function_Reference/add_image_size
 */
function uptown_style_add_image_size() {

	add_image_size( 'hero', 2400, 1320, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'uptown_style_add_image_size' );

/**
 * Update custom header arguments
 *
 * @package Uptown Style
 * @param $args
 * @return mixed
 */
function uptown_style_update_custom_header_args( $args ) {
	$args['width'] = 2400;
	$args['height'] = 1320;

	return $args;
}
add_filter( 'primer_custom_header_args', 'uptown_style_update_custom_header_args' );

/**
 * Add hero after header if we are on a post or front page.
 *
 * @package Uptown Style
 * @action primer_after_header
 * @since 1.0.0
 */
function uptown_style_add_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );
	add_action( 'primer_after_header', 'primer_add_hero', 20 );

}
add_action( 'after_setup_theme', 'uptown_style_add_hero' );

/**
 * Get header image with image size
 *
 * @package Uptown Style
 * @return false|string
 */
function uptown_style_get_header_image() {
	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	$custom_header = get_custom_header();

	if ( ! empty( $custom_header->attachment_id ) ) {
		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );
		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
	$header_image = get_header_image();
	return $header_image;
}

/**
 * Update colors
 *
 * @package Uptown Style
 * @action primer_colors
 */
function uptown_style_colors() {
	return array(
		array(
			'name'    => 'link_color',
			'label'   => __( 'Link Color', 'uptown_style' ),
			'default' => '#54ccbe',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'button_color',
			'label'   => __( 'Button Color', 'uptown_style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.cta, button, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'w_background_color',
			'label'   => __( 'Widget Background Color', 'uptown_style' ),
			'default' => '#3f3244',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_socialcolor',
			'label'   => __( 'Footer Social Icon Color', 'uptown_style' ),
			'default' => '#b5345f',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a, .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_backgroundcolor',
			'label'   => __( 'Footer Background Color', 'uptown_style' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
	);
}
add_action( 'primer_colors', 'uptown_style_colors', 9 );

/**
 * Change uptown color schemes
 *
 * @package Uptown Style
 * @action primer_color_schemes
 * @since 1.0.0
 * @return array
 */
function uptown_style_color_schemes() {
	return array(
		'bronze' => array(
			'label'  => esc_html__( 'Bronze', 'uptown_style' ),
			'colors' => array(
				'background_color'         => '#ffffff',
				'link_color'               => '#c19072',
				'button_color'			   => '#aeaeae',
				'w_background_color'	   => '#ffffff',
				'footer_socialcolor'       => '#c19072',
				'footer_backgroundcolor'   => '#ffffff',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'uptown_style_color_schemes' );

/**
 *
 * Add selectors for font customizing.
 *
 * @package Uptown Style
 * @since 1.0.0
 */
function uptown_style_update_font_types() {
	return	array(
		array(
			'name'    => 'primary_font',
			'label'   => __( 'Primary Font', 'uptown_style' ),
			'default' => 'Lato',
			'css'     => array(
				'body, p, label' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'header_font',
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
add_action( 'primer_font_types', 'uptown_style_update_font_types', 5 );

/**
 *
 * Default header image in the hero area.
 *
 * @package Uptown Style
 * @since 1.0.0
 */
function uptown_style_add_default_header_image( $array ) {
	$array['default-image'] = get_stylesheet_directory_uri() . '/assets/img/header.jpg';

	return $array;
}
add_filter( 'primer_custom_header_args', 'uptown_style_add_default_header_image', 20 );
