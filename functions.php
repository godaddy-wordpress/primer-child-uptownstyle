<?php
/**
 *
 * Add child and parent theme files.
 *
 */
function activation_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'activation_theme_enqueue_styles' );

/**
 *
 * Register Footer Menu.
 *
 */
function uptown_theme_register_nav_menu() {
	 register_nav_menu( 'footer', __( 'Footer Menu', 'uptown' ) );
}
add_action( 'after_setup_theme', 'uptown_theme_register_nav_menu' );

/**
 * Remove primer navigation and add uptown navigation
 */
function uptown_navigation() {
	wp_dequeue_script( 'primer-navigation' );
	wp_enqueue_script( 'uptown-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120206', true );
}
add_action( 'wp_print_scripts', 'uptown_navigation', 100 );

/**
 * Add mobile menu to header
 *
 * @link https://codex.wordpress.org/Function_Reference/get_template_part
 */
function uptown_add_mobile_menu() {
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'primer_header', 'uptown_add_mobile_menu', 0 );

/**
 *
 * Adding content to footer via action.
 *
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
 * @since 1.0.0
 */
function uptown_add_nav_footer() {

	get_template_part( 'templates/parts/footer-nav' );

}
add_action( 'primer_after_footer', 'uptown_add_nav_footer', 10 );

/**
 * Move navigation from after_header to header
 *
 * @link https://codex.wordpress.org/Function_Reference/remove_action
 * @link https://codex.wordpress.org/Function_Reference/add_action
 */
function uptown_move_navigation() {
	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );
	get_template_part( 'templates/parts/primary-navigation' );
}
add_action( 'primer_header', 'uptown_move_navigation', 19 );

/**
 * Returns the featured image, custom header or false in this priority order.
 *
 * @return false|string
 */
function uptown_get_custom_header() {
	$post_id = get_queried_object_id();
	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $image_size );
		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
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
 *
 * Register Hero Widget.
 *
 */
register_sidebar(
	array(
		'name'          => esc_html__( 'Hero', 'uptown' ),
		'id'            => 'hero',
		'description'   => esc_html__( 'The Hero widget area.', 'uptown' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);

/**
 * Add image size for hero image
 *
 * @link https://codex.wordpress.org/Function_Reference/add_image_size
 */
function uptown_add_image_size() {

	add_image_size( 'hero', 2400, 1320, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'uptown_add_image_size' );

/**
 * Update custom header arguments
 *
 * @param $args
 * @return mixed
 */
function uptown_update_custom_header_args( $args ) {
	$args['width'] = 2400;
	$args['height'] = 1320;

	return $args;
}
add_filter( 'primer_custom_header_args', 'uptown_update_custom_header_args' );

/**
 * Display hero in the header
 *
 * @action uptown_header
 */
function uptown_add_hero() {
	get_template_part( 'templates/parts/hero' );
}
add_action( 'primer_after_header', 'uptown_add_hero', 25 );

/**
 * Get header image with image size
 *
 * @return false|string
 */
function uptown_get_header_image() {
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
 * @action primer_colors
 */
function uptown_colors() {
	return array(
		array(
			'name'    => 'link_color',
			'label'   => __( 'Link Color', 'primer' ),
			'default' => '#54ccbe',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'header_textcolor',
			'default' => '#000000',
			'css'     => array(
				'.side-masthead, .site-title a, .site-description, .site-title a:hover, .site-title a:visited, .site-title a:focus, .hero-widget, header .main-navigation-container .menu li a, .main-navigation-container .menu li.current-menu-item > a, .main-navigation-container .menu li.current-menu-item > a:hover, .side-masthead .site-title a, .side-masthead .site-title a:hover, .hero-widget h2.widget-title' => array(
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
			'name'    => 'main_text_color',
			'label'   => __( 'Main Text Color', 'primer' ),
			'default' => '#212121',
			'css'     => array(
				'.site-content, .site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6, .site-content p, .site-content blockquote, legend' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => __( 'Secondary Text Color', 'primer' ),
			'default' => '#999999',
			'css'     => array(
				'.side-masthead .social-menu a, .entry-meta li, .side-masthead .social-menu a:hover' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'button_color',
			'label'   => __( 'Button Color', 'primer' ),
			'default' => '#b5345f',
			'css'     => array(
				'.cta, button, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'w_text_color',
			'label'   => __( 'Widget Text Color', 'primer' ),
			'default' => '#ffffff',
			'css'     => array(
				'.footer-widget-area, .footer-widget .widget-title, .site-footer, .footer-widget-area .footer-widget .widget, .footer-widget-area .footer-widget .widget-title' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'w_background_color',
			'label'   => __( 'Widget Background Color', 'primer' ),
			'default' => '#3f3244',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_socialcolor',
			'label'   => __( 'Footer Social Icon Color', 'primer' ),
			'default' => '#b5345f',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a, .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_menu_textcolor',
			'label'   => __( 'Footer Menu Text Color', 'primer' ),
			'default' => '#212121',
			'css'     => array(
				'.footer-nav ul li a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_textcolor',
			'label'   => __( 'Footer Text Color', 'primer' ),
			'default' => '#898989',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_backgroundcolor',
			'label'   => __( 'Footer Background Color', 'primer' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
	);
}
add_action( 'primer_colors', 'uptown_colors', 9 );

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
			'label'  => esc_html__( 'Bronze', 'uptown' ),
			'colors' => array(
				'header_textcolor'         => '#000000',
				'background_color'         => '#ffffff',
				'link_color'               => '#c19072',
				'main_text_color'          => '#000000',
				'secondary_text_color'     => '#000000',
				'button_color'			   => '#aeaeae',
				'w_text_color'			   => '#000000',
				'w_background_color'	   => '#ffffff',
				'footer_socialcolor'       => '#c19072',
				'footer_menu_textcolor'    => '#000000',
				'footer_textcolor'		   => '#000000',
				'footer_backgroundcolor'   => '#ffffff',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'uptown_color_schemes' );

/**
 *
 * Add selectors for font customizing.
 *
 * @since 1.0.0
 */
function update_font_types() {
	return	array(
		array(
			'name'    => 'primary_font',
			'label'   => __( 'Primary Font', 'primer' ),
			'default' => 'Lato',
			'css'     => array(
				'body, p' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'header_font',
			'label'   => esc_html__( 'Header Font', 'primer' ),
			'default' => 'Playfair Display',
			'css'     => array(
				'h1, h2, h3, h4, h5, h6, label, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], .entry-title, .hero .widget h1' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);
}
add_action( 'primer_font_types', 'update_font_types', 5 );
